<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\ErrorLog;
use App\Models\WorkSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class WorkspaceController extends Controller
{
    protected $errorLog;

    public function __construct()
    {
        $this->errorLog = new ErrorLog();

    }

    public function index()
    {


        config(['seo.page_title' => 'Çalışma Alanları | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('workspaces.index', compact('pageTitle'));
    }


    public function store(Request $req)
    {


        $isSameWorkspaceName = WorkSpace::where('user_id', auth()->user()->id)
            ->where('name', $req->input('name'))->exists();
        // aynı çalışma alanı adı girilmesini engelleyen kısım
        if ($isSameWorkspaceName) {
            Alert::error('Çalışma alanı isimleri aynı olamaz.')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->back();
        }
        $hasDevice = AllowedUserAndWorkspaces::where('allowed_user_id', auth()->user()->id)->where('allowed_device_serial_no', '!=', NULL)->count();
        if ($hasDevice > 0) {
            //cihaz var
            try {
                $workspace = new WorkSpace();
                $workspace->name = $req->input('name');
                $workspace->user_id = $req->input('user_id');
                $workspace->api_key = md5(time());
                $workspace->save();
                $allowed = AllowedUserAndWorkspaces::where(['allowed_user_id' => $req->input('user_id'), 'allowed_email' => auth()->user()->email]);


                if ($allowed->first()->allowed_workspace_id != null) {
                    $allow = new AllowedUserAndWorkspaces();
                    $allow->allowed_user_id = $req->input('user_id');
                    $allow->user_role = 'owner';
                    $allow->allowed_email = auth()->user()->email;
                    $allow->allowed_workspace_id = $workspace->id;
                    $allow->is_register = true;
                    $allow->save();
                    Alert::success('Çalışma alanı ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');
                    return redirect()->back();
                } else {
                    Alert::success('Çalışma alanı ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');
                    $allowed->update(['allowed_workspace_id' => $workspace->id]);
                    return redirect()->back();

                }


            } catch (\Throwable $e) {
                $this->errorLog->error_log = $e->getMessage();
                $this->errorLog->save();
                return redirect()->route('select-workspace')->with('error', 'Çalışma alanı eklenemedi.');

            }
        } else {
            //cihaz yok
            $countWorkspace = WorkSpace::where('user_id', \auth()->user()->id)->count();
            if ($countWorkspace == 2) {
                //burada eklemeyi engelle
                Alert::error('Çalışma alanı ekleyebilmek için lütfen cihaz ekleyiniz.')->showConfirmButton('Tamam', '#3085d6');
                return redirect()->back();
            } else {
                try {
                    $workspace = new WorkSpace();
                    $workspace->name = $req->input('name');
                    $workspace->user_id = $req->input('user_id');
                    $workspace->api_key = md5(time());
                    $workspace->save();
                    $allowed = AllowedUserAndWorkspaces::where(['allowed_user_id' => $req->input('user_id'), 'allowed_email' => auth()->user()->email]);


                    if ($allowed->first()->allowed_workspace_id != null) {
                        $allow = new AllowedUserAndWorkspaces();
                        $allow->allowed_user_id = $req->input('user_id');
                        $allow->user_role = 'owner';
                        $allow->allowed_email = auth()->user()->email;
                        $allow->allowed_workspace_id = $workspace->id;
                        $allow->is_register = true;
                        $allow->save();
                        Alert::success('Çalışma alanı ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');
                        return redirect()->back();
                    } else {
                        Alert::success('Çalışma alanı ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');
                        $allowed->update(['allowed_workspace_id' => $workspace->id]);
                        return redirect()->back();

                    }


                } catch (\Throwable $e) {
                    $this->errorLog->error_log = $e->getMessage();
                    $this->errorLog->save();
                    return redirect()->route('select-workspace')->with('error', 'Çalışma alanı eklenemedi.');


                }
            }
        }

    }

    public function settings($workspace)
    {
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $workspace_detail = WorkSpace::find($workspace);
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        config(['seo.page_title' => 'Çalışma Alanı Ayarları | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('workspaces.settings', compact('pageTitle', 'workspace_detail'));
    }

    public function collaborations($workspace)
    {
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $isOwner = AllowedUserAndWorkspaces::where(['allowed_user_id' => auth()->user()->id, 'allowed_workspace_id' => $workspace])->first()->user_role === 'owner' ? false : true;
        abort_if($isOwner, 404);


        $allowed_users = DB::table('work_spaces as w')
            ->join('allowed_user_and_workspaces as allow', 'allow.allowed_workspace_id', '=', 'w.id')
            ->join('users as u', 'u.id', '=', 'allow.allowed_user_id')
            ->select('*', 'u.name as user_name')
            ->where('allowed_workspace_id', $workspace)
            ->where('user_role', '!=', 'owner')
            ->distinct('allow.allowed_email')
            ->get();
        $not_registered = DB::table('work_spaces as w')
            ->join('allowed_user_and_workspaces as allow', 'allow.allowed_workspace_id', '=', 'w.id')
            ->where('allowed_workspace_id', $workspace)
            ->where('user_role', '!=', 'owner')
            ->where('allow.is_register', '=', false)
            ->where('allow.allowed_user_id', '=', null)
            ->distinct('allow.allowed_email')
            ->get();

        $device = AllowedUserAndWorkspaces::where(['allowed_workspace_id' => $workspace, 'allowed_user_id' => auth()->user()->id])->select('allowed_device_serial_no')->first();
        $device = $device->allowed_device_serial_no;
        $workspace_detail = WorkSpace::find($workspace);
        config(['seo.page_title' => 'Çalışma Alanı Katılımcıları | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('workspaces.collaborations', compact('pageTitle', 'workspace_detail', 'allowed_users', 'device', 'not_registered'));
    }

    public function inviteEmail(Request $request, $workspace)
    {

        if (AllowedUserAndWorkspaces::where(
                [
                    'allowed_workspace_id' => $request->workspace_id,
                    'allowed_email' => trim($request->email)])->count() > 0) {
            Alert::error('Bu mail adresi bu alana kayıtlı')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->back();
        } else {
            $user = AllowedUserAndWorkspaces::where(['allowed_email' => $request->email])->first();
        }
        //$workspace_detail = WorkSpace::find($workspace);

        $devices = AllowedUserAndWorkspaces::where(['allowed_workspace_id' => $request->workspace_id, 'allowed_user_id' => auth()->user()->id]);


        if ($devices->count() > 0) {
            $uniq = uniqid();
            foreach ($devices->get() as $device) {
                $allowed_user = new AllowedUserAndWorkspaces();
                $allowed_user->allowed_email = $request->email;
                $allowed_user->allowed_device_serial_no = $device->allowed_device_serial_no;
                $allowed_user->allowed_workspace_id = $request->workspace_id;
                $allowed_user->allowed_user_id = isset($user->allowed_user_id) ? $user->allowed_user_id : NULL;
                $allowed_user->register_code = $uniq;
                $allowed_user->is_register = false;
                $allowed_user->user_role = $request->user_role;
                $allowed_user->save();

            }
        } elseif ($devices->count() == 0) {

            $uniq = uniqid();

            $allowed_user = new AllowedUserAndWorkspaces();
            $allowed_user->allowed_email = $request->email;
            $allowed_user->allowed_workspace_id = $request->workspace_id;
            $allowed_user->register_code = $uniq;
            $allowed_user->is_register = false;
            $allowed_user->user_role = $request->user_role;
            $allowed_user->save();
        }

        Alert::success('İşlem başarılı.')->showConfirmButton('Tamam', '#3085d6');
        return redirect()->back();


    }

}
