<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\Device;
use App\Models\DeviceConnectionInfo;
use App\Models\DeviceInfo;
use App\Models\DeviceLog;
use App\Models\DeviceTempHumLimit;
use App\Models\ErrorLog;
use App\Models\EthernetDynamic;
use App\Models\WifiDynamic;
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
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);

        $devices = DB::table('devices as d')
            ->join('allowed_user_and_workspaces as allow', 'allow.allowed_device_serial_no', '=', 'd.serial_no')
            ->leftJoin('zones as z', 'z.id', '=', 'd.zone_id')
            ->where(['allow.allowed_user_id' => auth()->user()->id])
            ->where(['allow.allowed_workspace_id' => $workspace])
            ->select('*', 'z.*', 'z.name as zone_name', 'z.id as zone_id')
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


        config(['seo.page_title' => 'Cihazlar | superLOG']);
        $pageTitle = config('seo.page_title');

        if ($view == 'list') {
            return view('devices.list', $data, compact('pageTitle', 'workspace_detail', 'workspace_detail', 'allowed_devices'));
        }

        return view('devices.index', $data, compact('pageTitle', 'workspace_detail', 'allowed_devices'));
    }


    public function editDevice(Request $request, $workspace, $serial)
    {

        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $device = Device::where('serial_no', $serial)->first();
        DeviceConnectionInfo::where('serial_no', $serial)->update(['hostname' => trim($request->hostname)]);
        $device->zone_id = isset($request->zone_id) ? $request->zone_id : null;
        if (count($request->file()) !== 0) {
            $filename = '/images/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $device->device_img = $filename;
        }

        $device->notice_period = $request->notice_period;
        $device->device_name = $request->device_name;
        $device->save();
        Alert::success('Cihaz ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');;
        session(['tab' => 'general']);

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
        config(['seo.page_title' => 'Cihaz Ekle | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('devices.create', compact('pageTitle', 'workspace_detail', 'allowed_devices'));
    }

    public function created(Request $request, $workspace)
    {
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }

        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $device = Device::where('serial_no', $request->serial_no)->first();
        $device->workspace_id = $workspace;
        $device->is_active = 1;
        $device->save();
        session('general');
        Alert::success('Cihaz ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');;
        return redirect()->route('devices', $workspace);

    }

    public function createInvitedDevice(Request $request, $workspace)
    {
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
//        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
//        abort_if($abort, 404);


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
            Alert::error('Cihaz ekleme başarısız' . $request->serial_no . ' seri numaralı cihaz bu alanda kayıtlı.')->showConfirmButton('Tamam', '#3085d6');;
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
                Alert::success('Cihaz ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');;
                return redirect()->route('devices', $workspace);
            }
        } else {
            Alert::error($request->serial_no . ' seri numaralı cihaz size ait değil')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->route('devices', $workspace);

        }


    }

    public function createDevice(Request $request)
    {
        //cihaz varlık kontrolü
        $pageTitle = config('seo.page_title');
        $device = Device::where(['serial_no' => trim($request->serial_no)]);

        if (!isset($request->workspace_id)) {
            Alert::error('Lütfen çalışma alanı seçin.')->showConfirmButton('Tamam', '#3085d6');;
            return redirect()->back();

        }

        if ($device->count() == 0) { //yoksa
            Alert::error('Cihaz bulunamadı.', 'Seri numarasını kontrol ediniz.')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->back();
        }
        //sahibi değilse ekleyelemez
        $isset = AllowedUserAndWorkspaces::where(
            [
                'allowed_device_serial_no' => $request->serial_no,

                'user_role' => 'owner']);
        if ($isset->count() > 0) {
            if ($isset->first()->allowed_email !== auth()->user()->email) {
                Alert::error('Cihaz kullanımda.')->showConfirmButton('Tamam', '#3085d6');
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
            Alert::error('Cihaz bu alana önceden kayıt edildi.')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->back();

        } elseif ($workspaces1->count() == 0) {


            $device = Device::where('serial_no', $request->serial_no)->first();
            $device->workspace_id = $request->workspace_id;
            $device->is_active = 1;
            $device->save();


            $allowed = AllowedUserAndWorkspaces::where(
                [
                    'allowed_workspace_id' => $request->workspace_id,
                    'allowed_device_serial_no' => NULL

                ]);
            if ($allowed->count() > 0) {
                foreach ($allowed->get() as $item) {
                    $allowed->update(['allowed_device_serial_no' => $request->serial_no]);

                }

                Alert::success('Cihaz ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');
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

                // katılımcılara cihazı ekle

                $a = AllowedUserAndWorkspaces::where('allowed_workspace_id', $request->workspace_id)->whereIn('user_role', ['user', 'admin'])->distinct('allowed_email');
                if ($a->count() > 0) {
                    foreach ($a->get() as $item) {
                        $allowed = new AllowedUserAndWorkspaces();
                        $allowed->allowed_device_serial_no = $request->serial_no;
                        isset($item->allowed_user_id) && $allowed->allowed_user_id = $item->allowed_user_id;
                        $allowed->allowed_email = $item->allowed_email;
                        $allowed->allowed_workspace_id = $request->workspace_id;
                        $allowed->user_role = $item->user_role;
                        $allowed->register_code = $item->register_code;
                        isset($item->is_register) && $allowed->is_register = $item->is_register;
                        $allowed->save();
                    }
                }
//
                Alert::success('Cihaz ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');
                return redirect()->back();
            }


        }
        return redirect()->back();


    }

    function buildTree(array $items, $parentId = null)
    {
        $tree = [];
        foreach ($items as $item) {
            if ($item['parent_id'] === $parentId) {
                $children = $this->buildTree($items, $item['id']);
                if ($children) {
                    $item['children'] = $children;
                }
                $tree[] = $item;
            }
        }
        return $tree;
    }

    public function setSessionData(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');

        // Veriyi oturumda güncelleme
        session([$key => $value]);

        return response()->json(['status' => 'success', 'message' => 'Oturum verisi güncellendi.']);
    }


    public function edit($workspace, $device)
    {

        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }

        $device_info = DeviceInfo::where(['serial_no' => $device])->orderByDesc('id')->first();
        $device_conn_info_w_sta = DeviceConnectionInfo::where(['serial_no' => $device, 'connection_type' => 1])->latest('id')->first();
        $device_conn_info_e_sta = DeviceConnectionInfo::where(['serial_no' => $device, 'connection_type' => 0])->latest('id')->first();
        $device_conn_info = DeviceConnectionInfo::where(['serial_no' => $device])->latest('id')->first();
        $conn_encrpte = [
            'WEP',
            'WPA',
            'WPA2',
            'WPA3',
        ];

        $device = Device::where(['serial_no' => $device])->first();
        $workspace_detail = WorkSpace::find($workspace);
        $zones = $this->buildTree(Zone::where('work_space_id', $workspace)->get()->toArray());

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
        config(['seo.page_title' => 'Cihaz Düzenle | superLOG']);
        $pageTitle = config('seo.page_title');

        $trashhold = DeviceTempHumLimit::where(['serial_no' => $device->serial_no])->orderBy('id', 'desc')->first();
        $wifiDynamic = WifiDynamic::where(['serial_no' => $device->serial_no])->latest('id')->first();
        $ethernetDynamic = EthernetDynamic::where(['serial_no' => $device->serial_no])->latest('id')->first();


        switch (session('tab')) {
            case 'general':
                session(['tab' => 'general']);
                break;
            case 'trashold':
                session(['tab' => 'trashold']);
                break;
            case 'network':
                session(['tab' => 'network']);
                break;
            case 'notifications':
                session(['tab' => 'notifications']);
                break;
            case 'permissions':
                session(['tab' => 'permissions']);
                break;
            case 'ownership':
                session(['tab' => 'ownership']);
                break;
            default:
                session(['tab' => 'device_info']);
                break;

        }
        //dd(session('tab'));


        return view('devices.edit', compact('pageTitle', 'workspace_detail', 'periot', 'device_info', 'device', 'zones', 'trashhold', 'allowed_users', 'device_conn_info_w_sta', 'conn_encrpte', 'device_conn_info', 'device_conn_info_e_sta', 'wifiDynamic', 'ethernetDynamic'));
    }


    // publishes


    function updateEthernetSetting(Request $request)
    {
        try {
            if ($request->ip_set) {
                $data = [
                    'gateway' => trim($request->gateway),
                    'hostname' => $request->hostname,
                    'ip' => trim($request->ip),
                    'submask' => trim($request->submask),
                    'dns' => trim($request->dns),
                    'port' => trim($request->port),
                    'ip_set' => $request->ip_set,
                    'connection_type' => 0
                ];


            } else {
                $data = [
                    'ip_set' => $request->ip_set,
                    'connection_type' => 0
                ];

            }
            $device_con_info = new DeviceConnectionInfo();

            $device_con_info->serial_no = $request->serial_no;
            $device_con_info->gateway = $request->gateway;
            $device_con_info->hostname = $request->hostname;
            $device_con_info->ip = $request->ip;
            $device_con_info->submask = $request->submask;
            $device_con_info->dns = $request->dns;
            $device_con_info->port = $request->port;
            $device_con_info->ip_set = $request->ip_set;
            $device_con_info->connection_type = 0;
            $device_con_info->save();
            $workspace_detail = WorkSpace::find($request->device_workspace_id);
            $response = Http::withHeaders([
                'authorization' => $workspace_detail->api_key,
            ])->post(config('constants.options.request_url'), [
                'workspace_id' => $workspace_detail->id,
                'topic' => $request->serial_no,
                'statu' => "ethernet",
                'ethernet' => $data
            ]);

            if ($response->json()['message'] === 'success') {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } catch (\Throwable $e) {
            $this->errorLog->error_log = $e->getMessage();
            $this->errorLog->save();
            return response()->json(['success' => false, 'data' => $e->getMessage()]);

        }


    }

    function updateWifiSetting(Request $request)
    {

        try {

            if ($request->ip_set) {
                $data = [
                    'encryption' => trim($request->encry),
                    'gateway' => trim($request->gateway),
                    'hostname' => $request->hostname,
                    'ip' => trim($request->ip),
                    'password' => trim($request->password),
                    'ssid' => trim($request->ssid),
                    'submask' => trim($request->submask),
                    'dns' => trim($request->dns),
                    'port' => trim($request->port),
                    'ip_set' => $request->ip_set,
                    'connection_type' => 1
                ];


            } else {
                $data = [
                    'password' => trim($request->password),
                    'ssid' => trim($request->ssid),
                    'ip_set' => $request->ip_set,
                    'encryption' => trim($request->encry),
                    'connection_type' => 1

                ];

            }
            $device_con_info = new DeviceConnectionInfo();

            $device_con_info->serial_no = trim($request->serial_no);
            $device_con_info->encryption = trim($request->encry);
            $device_con_info->gateway = trim($request->gateway);
            $device_con_info->hostname = trim($request->hostname);
            $device_con_info->ip = trim($request->ip);
            $device_con_info->password = trim($request->password);
            $device_con_info->submask = trim($request->submask);
            $device_con_info->ssid = trim($request->ssid);
            $device_con_info->dns = trim($request->dns);
            $device_con_info->port = trim($request->port);
            $device_con_info->ip_set = trim($request->ip_set);
            $device_con_info->connection_type = 1;
            $device_con_info->save();
            $workspace_detail = WorkSpace::find($request->device_workspace_id);

            $response = Http::withHeaders([
                'authorization' => $workspace_detail->api_key,
            ])->post(config('constants.options.request_url'), [
                'workspace_id' => $workspace_detail->id,
                'topic' => $request->serial_no,
                'statu' => "wifi",
                'wifi' => $data
            ]);

            if ($response->json()['message'] === 'success') {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } catch (\Throwable $e) {
            $this->errorLog->error_log = $e->getMessage();
            $this->errorLog->save();
            return response()->json(['success' => false, 'data' => $e->getMessage()]);

        }


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
                session(['tab' => 'trashold']);
                Alert::success('Cihazın ısı ve nem değerleri güncellendi.')->showConfirmButton('Tamam', '#3085d6');
                return redirect()->back();
            } else {
                session(['tab' => 'trashold']);
                Alert::error('Cihazın fişe takılı olduğundan emin olun.')->showConfirmButton('Tamam', '#3085d6');
                return redirect()->back();
            }

        } catch (\Throwable $e) {
            Alert::error('Cihazın fişe takılı olduğundan emin olun.')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->back();
            $this->errorLog->error_log = $e->getMessage();
            $this->errorLog->save();
        }

        Alert::error('Cihazın fişe takılı olduğundan emin olun.')->showConfirmButton('Tamam', '#3085d6');
        return redirect()->back();
    }

    function deleteDevice(Request $request)
    {
        $device = Device::where('serial_no', $request->serial_no);
        if ($device) {
            try {
                $countWorkspaceDevices = AllowedUserAndWorkspaces::where(function ($q) {
                    $q->whereNotNull('allowed_device_serial_no')->where('allowed_email', auth()->user()->email)->select('allowed_device_serial_no');
                })->where('allowed_workspace_id', $request->workspace_id);

                if ($countWorkspaceDevices->count() == 1) { // son kalanı güncelleyelim tamamen silinmemeli
                    AllowedUserAndWorkspaces::where(['allowed_device_serial_no' => $request->serial_no, 'allowed_workspace_id' => $request->workspace_id])->update(['allowed_device_serial_no' => null]);
                } else {
                    AllowedUserAndWorkspaces::where(['allowed_device_serial_no' => $request->serial_no, 'allowed_workspace_id' => $request->workspace_id])->delete();
                }

                $device->delete();
                DeviceConnectionInfo::where('serial_no', $request->serial_no)->delete();
                DeviceInfo::where('serial_no', $request->serial_no)->delete();
                DeviceLog::where('serial_no', $request->serial_no)->delete();
                DeviceTempHumLimit::where('serial_no', $request->serial_no)->delete();
                EthernetDynamic::where('serial_no', $request->serial_no)->delete();
                WifiDynamic::where('serial_no', $request->serial_no)->delete();

                $countDevice = AllowedUserAndWorkspaces::where(function ($q) {
                    $q->whereNotNull('allowed_device_serial_no')->where('allowed_email', auth()->user()->email)->select('allowed_device_serial_no');
                });

                return response()->json(['success' => true, 'data' => 'ok', 'countDevice' => $countDevice->count()]);
            } catch (\Throwable $e) {
                $errorLog = new ErrorLog();
                $errorLog->error_log = $e->getMessage();
                $errorLog->save();
                return response()->json(['success' => false, 'data' => $e->getMessage()]);

            }

        }

    }
}
