<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\Device;
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


        config(['seo.page_title' => 'Çalışma Alanları | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('workspaces.index', compact('pageTitle'));
    }


    public function store(Request $req)
    {

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
                Alert::success('Çalışma Alanı Ekleme Başarılı');
                return redirect()->back();
            } else {
                Alert::success('Çalışma Alanı Ekleme Başarılı');
                $allowed->update(['allowed_workspace_id' => $workspace->id]);
                return redirect()->back();

            }


        } catch (\Throwable $e) {
            $this->errorLog->error_log = $e->getMessage();
            $this->errorLog->save();
            return redirect()->route('select-workspace')->with('error', 'Çalışma alanı eklenemedi');


        }


    }

    public function settings($workspace)
    {
        $workspace_detail = WorkSpace::find($workspace);
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        config(['seo.page_title' => 'Çalışma Alanı Ayarları | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('workspaces.settings', compact('pageTitle', 'workspace_detail'));
    }

    public function collaborations($workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);


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
        config(['seo.page_title' => 'Çalışma Alanı Katılımcıları | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('workspaces.collaborations', compact('pageTitle', 'workspace_detail', 'allowed_users', 'device', 'not_registered'));
    }

    public function inviteEmail(Request $request, $workspace)
    {
        $workspace_detail = WorkSpace::find($workspace);

        if (AllowedUserAndWorkspaces::where(
                [
                    'allowed_workspace_id' => $request->workspace_id,
                    'allowed_email' => trim($request->email)])->count() > 0) {
            Alert::warning('Bu mail adresi bu alana kayıtlı', 'işlem başarısız');
            return redirect()->route('workspaces.collaborations', $workspace_detail);
        }

        $devices = Device::where(['workspace_id' => $request->workspace_id]);
        if ($devices->count() > 0) {
            $uniq = uniqid();
            foreach ($devices->get() as $device) {
                $allowed_user = new AllowedUserAndWorkspaces();
                $allowed_user->allowed_email = $request->email;
                $allowed_user->allowed_device_serial_no = $device->serial_no;
                $allowed_user->allowed_workspace_id = $request->workspace_id;
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

        Alert::success('işlem başarılı', 'işlem başarılı');
        return redirect()->route('workspaces.collaborations', $workspace_detail);


    }

}
