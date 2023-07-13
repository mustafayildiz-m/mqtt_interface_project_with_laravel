<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\Device;
use App\Models\DeviceInfo;
use App\Models\DeviceTempHumLimit;
use App\Models\ErrorLog;
use App\Models\WorkSpace;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->errorLog = new ErrorLog();

    }


    public function index(Request $request, $workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);

        $devices = DB::table('devices as d')
            ->join('allowed_user_and_workspaces as allow', 'allow.allowed_device_serial_no', '=', 'd.serial_no')
            ->leftJoin('zones as z', 'z.id', '=', 'd.zone_id')
            ->where(['allow.allowed_user_id' => auth()->user()->id])
            ->where(['allow.allowed_workspace_id' => $workspace])
            ->select('*', 'z.*', 'z.name as zone_name',)
            ->get();
        $allowed_devices = DB::table('devices as d')
            ->join('allowed_user_and_workspaces as allow', 'd.serial_no', '=', 'allow.allowed_device_serial_no')
            ->where('allow.allowed_email', auth()->user()->email)
            ->where('user_role', 'owner')
            ->distinct('device_name')
            ->get();

        $data['devices'] = $devices;

        $view = $request->input('view', 'card');
        $workspace_detail = WorkSpace::find($workspace);


        config(['seo.page_title' => 'Cihazlar | Superlog']);
        $pageTitle = config('seo.page_title');

        if ($view == 'list') {
            return view('devices.list', $data, compact('pageTitle', 'workspace_detail','workspace_detail','allowed_devices'));
        }

        return view('devices.index', $data, compact('pageTitle', 'workspace_detail','allowed_devices'));
    }


    public function editDevice(Request $request, $workspace, $serial)
    {

        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $device = Device::where('serial_no', $serial)->first();
        $device->zone_id = isset($request->zone_id) ? $request->zone_id : 0;
        if (count($request->file()) !== 0) {
            $filename = '/images/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $device->device_img = $filename;
        }
        $device->notice_period = $request->notice_period;
        $device->device_name = $request->device_name;
        $device->save();
        Alert::success('Cihaz Ekleme Başarılı', 'Cihaz Ekleme Başarılı');
        return redirect()->back();
    }

    public function create($workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(
            ['allowed_user_id' => \auth()->user()->id,
                'allowed_workspace_id' => $workspace]
        )->count() == 0 ? true : false;
        abort_if($abort, 404);

        $allowed_devices = DB::table('devices as d')
            ->join('allowed_user_and_workspaces as allow', 'd.serial_no', '=', 'allow.allowed_device_serial_no')
            ->where('allow.allowed_email', auth()->user()->email)
            ->where('user_role', 'owner')
            ->distinct('device_name')
            ->get();


        $workspace_detail = WorkSpace::find($workspace);
        config(['seo.page_title' => 'Cihaz Ekle | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('devices.create', compact('pageTitle', 'workspace_detail', 'allowed_devices'));
    }

    public function created(Request $request, $workspace)
    {

        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $device = Device::where('serial_no', $request->serial_no)->first();
        $device->workspace_id = $workspace;
        $device->is_active = 1;
        $device->save();
        Alert::success('Cihaz Ekleme Başarılı', 'Cihaz Ekleme Başarılı');
        return redirect()->route('devices', $workspace);

    }

    public function createInvitedDevice(Request $request, $workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);


        $is_allow_count = AllowedUserAndWorkspaces::where(
            ['allowed_device_serial_no' => $request->serial_no,
                'allowed_email' => auth()->user()->email,
                'user_role' => 'owner'])->count();

        $is_allow_count_workspace = AllowedUserAndWorkspaces::where(
            ['allowed_device_serial_no' => $request->serial_no,
                'allowed_email' => auth()->user()->email,
                'user_role' => 'owner',
                'allowed_workspace_id' => $workspace])->count();

        if ($is_allow_count_workspace > 0) {
            Alert::error('Cihaz Ekleme Başarısız', $request->serial_no . ' seri numaralı cihaz bu alana zaten ekli');
            return redirect()->route('devices', $workspace);

        } elseif ($is_allow_count > 0) {
            $allowed = AllowedUserAndWorkspaces::where(['allowed_workspace_id' => $workspace]);
            if ($allowed->count() > 0) {
                foreach ($allowed->get() as $allow) {
                    $insertAllowedData = new AllowedUserAndWorkspaces();
                    $insertAllowedData->allowed_user_id = isset($allow->allowed_user_id) ? $allow->allowed_user_id : null;
                    $insertAllowedData->allowed_workspace_id = $workspace;
                    $insertAllowedData->allowed_email = $allow->allowed_email;
                    $insertAllowedData->allowed_device_serial_no = $request->serial_no;
                    $insertAllowedData->user_role = $allow->user_role;
                    $insertAllowedData->is_register = $allow->is_register;
                    $insertAllowedData->save();
                }
                Alert::success('Cihaz Ekleme Başarılı');
                return redirect()->route('devices', $workspace);
            }
        } else {
            Alert::error($request->serial_no . ' seri numaralı cihaz size ait değil');
            return redirect()->route('devices', $workspace);

        }


    }

    public function createDevice(Request $request)
    {
        //cihaz varlık kontrolü
        $pageTitle = config('seo.page_title');
        $device = Device::where(['serial_no' => trim($request->serial_no)]);

        if (!isset($request->workspace_id)) {
            Alert::error('Çalışma alanı seçin', 'Çalışma alanı seçin')->flash();
            return redirect()->back();

        }

        if ($device->count() == 0) { //yoksa
            Alert::error('Cihaz bulunamadı', 'Seri Numarasını Kontrol ediniz');
            return redirect()->back();
        }
        //sahibi değilse ekleyelemez
        $isset = AllowedUserAndWorkspaces::where(
            [
                'allowed_device_serial_no' => $request->serial_no,

                'user_role' => 'owner']);
        if ($isset->count() > 0) {
            if ($isset->first()->allowed_email !== auth()->user()->email) {
                Alert::error('Cihaz Kullanımda');
                return redirect()->back();
            }
        }


        $workspaces1 = AllowedUserAndWorkspaces::where(
            [
                'allowed_email' => auth()->user()->email,
                'allowed_user_id' => auth()->user()->id,
                'allowed_device_serial_no' => $request->serial_no,
                'allowed_workspace_id' => $request->workspace_id])->select('allowed_workspace_id', 'allowed_device_serial_no');
        if ($workspaces1->count() > 0) {
            Alert::error('Cihaz Bu Alana Zaten Kayıtlı');
            return redirect()->back();

        } elseif ($workspaces1->count() == 0) {


            $device = Device::where('serial_no', $request->serial_no)->first();
            $device->workspace_id = $request->workspace_id;
            $device->is_active = 1;
            $device->save();


            $allowed = AllowedUserAndWorkspaces::where(
                [
                    'allowed_workspace_id' => $request->workspace_id,
                    'allowed_user_id' => $request->user_id,
                    'allowed_email' => \auth()->user()->email
                ]);
            if ($allowed->first()->allowed_device_serial_no == null) {
                $allowed->update(['allowed_device_serial_no' => $request->serial_no]);
                Alert::success(WorkSpace::find($request->workspace_id)->first()->name . PHP_EOL . 'Alanına Cihaz Eklendi', 'Cihaz Ekleme Başarılı');
                return redirect()->back();
            } else {
                $allowed = new AllowedUserAndWorkspaces();
                $allowed->allowed_device_serial_no = $request->serial_no;
                $allowed->allowed_user_id = $request->user_id;
                $allowed->allowed_email = \auth()->user()->email;
                $allowed->allowed_workspace_id = $request->workspace_id;
                $allowed->user_role = 'owner';
                $allowed->is_register = true;
                $allowed->save();
                Alert::success(WorkSpace::find($request->workspace_id)->first()->name . PHP_EOL . 'Alanına Cihaz Eklendi', 'Cihaz Ekleme Başarılı');
                return redirect()->back();
            }


        }

    }

    public function edit($workspace, $device)
    {


        $device_info = DeviceInfo::where(['serial_no' => $device])->orderByDesc('id')->first();
        $device = Device::where(['serial_no' => $device])->first();
        $workspace_detail = WorkSpace::find($workspace);
        $zones = Zone::where('work_space_id', $workspace);
        $periot = [
            '1 dakika' => 1,
            '3 dakika' => 3,
            '5 dakika' => 5,
            '10 dakika' => 10,
            '15 dakika' => 15,
            '30 dakika' => 30,
            '40 dakika' => 40,
            '50 dakika' => 50,
            '60 dakika' => 60,
        ];

        $allowed_users = DB::table('work_spaces as w')
            ->join('allowed_user_and_workspaces as allow', 'allow.allowed_workspace_id', '=', 'w.id')
            ->join('users as u', 'u.id', '=', 'allow.allowed_user_id')
            ->select('*', 'u.name as user_name')
            ->where('allowed_workspace_id', $workspace_detail->id)
            ->where('user_role', '!=', 'owner')
            ->get();

        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        if (!$device) {
            abort_if(true, 404);
        }
        config(['seo.page_title' => 'Cihaz Düzenle | Superlog']);
        $pageTitle = config('seo.page_title');

        $trashhold = DeviceTempHumLimit::where(['serial_no' => $device->serial_no])->orderBy('id', 'desc')->first();

        return view('devices.edit', compact('pageTitle', 'workspace_detail', 'periot', 'device_info', 'device', 'zones', 'trashhold', 'allowed_users'));
    }


    function editTrashhold(Request $request, $workspace, $serial)
    {
        try {

            $workspace_detail = WorkSpace::find($workspace);
            $response = Http::withHeaders([
                'authorization' => $workspace_detail->api_key,
            ])->post(config('constants.options.request_url'), [
                'workspace_id' => $workspace_detail->id,
                'topic' => $serial,
                'statu' => "trashold",
                'trashold' => array_slice($request->all(), 2)
            ]);

            if ($response->json()['message'] === 'success') {
                Alert::success('Güncelleme Başarılı', 'Cihaz ısı ve nem değerleri güncellendi');
                return redirect()->back();
            }

        } catch (\Throwable $e) {
            $this->errorLog->error_log = $e->getMessage();
            $this->errorLog->save();
        }


    }
}
