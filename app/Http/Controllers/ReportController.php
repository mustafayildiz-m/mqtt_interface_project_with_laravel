<?php

namespace App\Http\Controllers;

use App\Exports\SampleDataExport;
use App\Exports\SampleExport;
use App\Models\AllowedUserAndWorkspaces;
use App\Models\DeviceLog;
use App\Models\WorkSpace;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


// SampleDataExport, verileri Excel'e aktaracak özel bir Export sınıfıdır.


class ReportController extends Controller
{

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

    public function index(Request $request, $workspace)
    {
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }

        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        if (isset($request->reset)) {
            Session::forget('searchTermSession');
            return back();
        }

        $workspace_detail = WorkSpace::find($workspace);
        $zones = $this->buildTree(Zone::where('work_space_id', $workspace)->get()->toArray());
        $deviceLogs = DB::table('device_logs as dl');
        $deviceLogs->select('dl.*', 'd.*', 'th.*', 'z.id as zone_id', 'z.*', 'z.name as zone_name', 'dl.created_at as d_created_at');
        $deviceLogs->join('devices as d', 'd.serial_no', '=', 'dl.serial_no');
        $deviceLogs->join('allowed_user_and_workspaces as allow', 'allow.allowed_device_serial_no', '=', 'd.serial_no');
        $deviceLogs->join('work_spaces as ws', 'ws.id', '=', 'allow.allowed_workspace_id');
        $deviceLogs->join('device_temp_hum_limits as th', 'th.id', '=', 'dl.limit_id');
        $deviceLogs->leftJoin('zones as z', 'z.id', '=', 'd.zone_id');
        $deviceLogs->where(['allow.allowed_user_id' => auth()->user()->id, 'allow.allowed_workspace_id' => $workspace]);

        $deviceLogs->orderBy('dl.created_at', 'DESC');
        $deviceLogs->distinct('dl.created_at');


        $searchTerm = [];


        if ($request->method() == 'POST') {
            if (isset($request->q_temp_min)) {
                $searchTerm['q_temp_min'] = trim(floatval($request->q_temp_min));
            }
            if (isset($request->q_temp_max)) {
                $searchTerm['q_temp_max'] = trim(floatval($request->q_temp_max));

            }
            if (isset($request->q_moisture_min)) {
                $searchTerm['q_moisture_min'] = trim(floatval($request->q_moisture_min));

            }
            if (isset($request->q_moisture_max)) {
                $searchTerm['q_moisture_max'] = trim(floatval($request->q_moisture_max));
            }
            if (isset($request->q_serial_no)) {
                $searchTerm['q_serial_no'] = trim($request->q_serial_no);
            }
            if (isset($request->q_state)) {
                $searchTerm['q_state'] = trim($request->q_state);
            }
            if (isset($request->q_zone_id)) {
                $searchTerm['q_zone_id'] = trim($request->q_zone_id);
            }
            if (isset($request->start_date)) {
                $searchTerm['q_start_date'] = trim($request->start_date);
            }
            if (isset($request->end_date)) {
                $searchTerm['q_end_date'] = trim($request->end_date);
            }
            Session::put('searchTermSession', $searchTerm);
            Session::save();

        }

        $searchTermSession = Session::get('searchTermSession');
        if (isset($searchTermSession)) {
            if (isset($searchTermSession['q_temp_min'])) {
                $deviceLogs->where('dl.temp', '>=', $searchTermSession['q_temp_min']);
            }
            if (isset($searchTermSession['q_temp_max'])) {
                $deviceLogs->where('dl.temp', '<=', $searchTermSession['q_temp_max']);
            }
            if (isset($searchTermSession['q_moisture_min'])) {
                $deviceLogs->where('dl.humd', '>=', $searchTermSession['q_moisture_min']);
            }
            if (isset($searchTermSession['q_moisture_max'])) {
                $deviceLogs->where('dl.humd', '<=', $searchTermSession['q_moisture_max']);
            }
            if (isset($searchTermSession['q_serial_no'])) {
                $deviceLogs->where('dl.serial_no', '=', $searchTermSession['q_serial_no']);
            }
            if (isset($searchTermSession['q_state'])) {
                $deviceLogs->where('dl.state', '=', $searchTermSession['q_state']);
            }
            if (isset($searchTermSession['q_zone_id'])) {
                $deviceLogs->whereIn('z.id', getSubtreeIds($searchTermSession['q_zone_id']));
            }
            if (isset($searchTermSession['q_start_date'])) {
                $convertedDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $searchTermSession['q_start_date'])->format('Y-m-d H:i');
                $deviceLogs->where('dl.created_at', '>=', $convertedDate);
            }
            if (isset($searchTermSession['q_end_date'])) {
                $convertedDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $searchTermSession['q_end_date'])->format('Y-m-d H:i');
                $deviceLogs->where('dl.created_at', '<=', $convertedDate);
            }
        }

        if (isset($request->export_excel)) {
            date_default_timezone_set('Europe/Istanbul');
            $selectedData = $deviceLogs->get()->map(function ($item) {
                if ($item->state == 'alarm') {
                    $state = 'Alarm';
                } elseif ($item->state == 'critical_alarm') {
                    $state = 'Kritik Alarm';
                } else {
                    $state = 'Normal';
                }
                return [
                    'Cihaz Adı' => $item->device_name,
                    'Seri Numarası' => $item->serial_no,
                    'Bölge' => $item->zone_name,
                    'Isı' => $item->temp,
                    'Nem' => $item->humd,
                    'Durum' => $state,
                    'Tarih' => turkishDate('j F Y , l', explode(' ', $item->d_created_at)[0]) . ' ' . explode(' ', $item->d_created_at)[1]
                ];
            });
            return Excel::download(new SampleExport($selectedData), date('Y-m-d H:i:s') . '_Rapor.xlsx');
        }
        $allowed_devices = DB::table('devices as d')
            ->join('allowed_user_and_workspaces as al', 'al.allowed_device_serial_no', '=', 'd.serial_no')
            ->where(['al.allowed_workspace_id' => $workspace, 'al.allowed_user_id' => auth()->user()->id])->get();

        config(['seo.page_title' => 'Raporlar | superLOG']);
        $pageTitle = config('seo.page_title');


        return view('reports.index', [
            'pageTitle' => $pageTitle,
            'workspace_detail' => $workspace_detail,
            'zones' => $zones,
            'deviceLogs' => $deviceLogs,
            'searchTerm' => $searchTermSession,
            'allowed_devices' => $allowed_devices
        ]);
    }


    function deviceReports(Request $request, $workspace, $serial)
    {

        //      $deviceLogs->where(['ws.id' => $workspace, 'dl.serial_no' => $serial]);
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        if (isset($request->reset)) {
            Session::forget('searchTermSession');
            return back();
        }

        $workspace_detail = WorkSpace::find($workspace);
        $zones = $this->buildTree(Zone::where('work_space_id', $workspace)->get()->toArray());
        $deviceLogs = DB::table('device_logs as dl');
        $deviceLogs->select('dl.*', 'd.*', 'th.*', 'z.id as zone_id', 'z.*', 'z.name as zone_name', 'dl.created_at as d_created_at');
        $deviceLogs->join('devices as d', 'd.serial_no', '=', 'dl.serial_no');
        $deviceLogs->join('allowed_user_and_workspaces as allow', 'allow.allowed_device_serial_no', '=', 'd.serial_no');
        $deviceLogs->join('work_spaces as ws', 'ws.id', '=', 'd.workspace_id');
        $deviceLogs->join('device_temp_hum_limits as th', 'th.id', '=', 'dl.limit_id');
        $deviceLogs->leftJoin('zones as z', 'z.id', '=', 'd.zone_id');
        $deviceLogs->where(['allow.allowed_user_id' => auth()->user()->id, 'dl.serial_no' => $serial, 'allow.allowed_workspace_id' => $workspace]);
        $deviceLogs->orderBy('dl.created_at', 'DESC');
        $deviceLogs->distinct('dl.created_at');


        $searchTerm = [];


        if ($request->method() == 'POST') {
            if (isset($request->q_temp_min)) {
                $searchTerm['q_temp_min'] = trim(floatval($request->q_temp_min));
            }
            if (isset($request->q_temp_max)) {
                $searchTerm['q_temp_max'] = trim(floatval($request->q_temp_max));

            }
            if (isset($request->q_moisture_min)) {
                $searchTerm['q_moisture_min'] = trim(floatval($request->q_moisture_min));

            }
            if (isset($request->q_moisture_max)) {
                $searchTerm['q_moisture_max'] = trim(floatval($request->q_moisture_max));
            }
            if (isset($request->q_serial_no)) {
                $searchTerm['q_serial_no'] = trim($request->q_serial_no);
            }
            if (isset($request->q_state)) {
                $searchTerm['q_state'] = trim($request->q_state);
            }
            if (isset($request->q_zone_id)) {
                $searchTerm['q_zone_id'] = trim($request->q_zone_id);
            }
            if (isset($request->start_date)) {
                $searchTerm['q_start_date'] = trim($request->start_date);
            }
            if (isset($request->end_date)) {
                $searchTerm['q_end_date'] = trim($request->end_date);
            }
            Session::put('searchTermSession', $searchTerm);
            Session::save();

        }

        $searchTermSession = Session::get('searchTermSession');
        if (isset($searchTermSession)) {
            if (isset($searchTermSession['q_temp_min'])) {
                $deviceLogs->where('dl.temp', '>=', $searchTermSession['q_temp_min']);
            }
            if (isset($searchTermSession['q_temp_max'])) {
                $deviceLogs->where('dl.temp', '<=', $searchTermSession['q_temp_max']);
            }
            if (isset($searchTermSession['q_moisture_min'])) {
                $deviceLogs->where('dl.humd', '>=', $searchTermSession['q_moisture_min']);
            }
            if (isset($searchTermSession['q_moisture_max'])) {
                $deviceLogs->where('dl.humd', '<=', $searchTermSession['q_moisture_max']);
            }
            if (isset($searchTermSession['q_serial_no'])) {
                $deviceLogs->where('dl.serial_no', '=', $searchTermSession['q_serial_no']);
            }
            if (isset($searchTermSession['q_state'])) {
                $deviceLogs->where('dl.state', '=', $searchTermSession['q_state']);
            }
            if (isset($searchTermSession['q_zone_id'])) {
                // dd(getSubtreeIds($request->q_zone_id));
                $deviceLogs->whereIn('z.id', getSubtreeIds($searchTermSession['q_zone_id']));
                // $deviceLogs->orderBy('dl.id', 'DESC');
            }
            if (isset($searchTermSession['q_start_date'])) {
                $convertedDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $searchTermSession['q_start_date'])->format('Y-m-d H:i');
                $deviceLogs->where('dl.created_at', '>=', $convertedDate);
            }
            if (isset($searchTermSession['q_end_date'])) {
                $convertedDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $searchTermSession['q_end_date'])->format('Y-m-d H:i');
                $deviceLogs->where('dl.created_at', '<=', $convertedDate);
            }
        }
        if (isset($request->export_excel)) {
            date_default_timezone_set('Europe/Istanbul');
            $selectedData = $deviceLogs->get()->map(function ($item) {
                if ($item->state == 'alarm') {
                    $state = 'Alarm';
                } elseif ($item->state == 'critical_alarm') {
                    $state = 'Kritik Alarm';
                } else {
                    $state = 'Normal';
                }
                return [
                    'Cihaz Adı' => $item->device_name,
                    'Seri Numarası' => $item->serial_no,
                    'Bölge' => $item->zone_name,
                    'Isı' => $item->temp,
                    'Nem' => $item->humd,
                    'Durum' => $state,
                    'Tarih' => turkishDate('j F Y , l', explode(' ', $item->d_created_at)[0]) . ' ' . explode(' ', $item->d_created_at)[1]
                ];
            });
            return Excel::download(new SampleExport($selectedData), date('Y-m-d H:i:s') . '_Rapor.xlsx');
        }


        config(['seo.page_title' => 'Raporlar | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('reports.device_report', [
            'pageTitle' => $pageTitle,
            'workspace_detail' => $workspace_detail,
            'zones' => $zones,
            'deviceLogs' => $deviceLogs,
            'searchTerm' => $searchTermSession,
            'serial' => $serial]);


    }

//    public function exportToExcel(Request $request, $workspace)
//    {
////
////        $deviceLogs = DB::table('device_logs as dl');
////        $deviceLogs->select('dl.*', 'd.*', 'th.*', 'z.id as zone_id', 'z.*', 'z.name as zone_name', 'dl.created_at as d_created_at');
////        $deviceLogs->join('devices as d', 'd.serial_no', '=', 'dl.serial_no');
////        $deviceLogs->join('allowed_user_and_workspaces as allow', 'allow.allowed_device_serial_no', '=', 'd.serial_no');
////        $deviceLogs->join('work_spaces as ws', 'ws.id', '=', 'allow.allowed_workspace_id');
////        $deviceLogs->join('device_temp_hum_limits as th', 'th.id', '=', 'dl.limit_id');
////        $deviceLogs->leftJoin('zones as z', 'z.id', '=', 'd.zone_id');
////        $deviceLogs->where(['allow.allowed_user_id' => auth()->user()->id, 'allow.allowed_workspace_id' => $workspace]);
////
////        $deviceLogs->orderBy('dl.created_at', 'DESC');
////        $deviceLogs->distinct('dl.created_at');
////
////        // return response()->json($deviceLogs->get());
////
////        $data = collect([$deviceLogs->get()]);
////        $export = new SampleDataExport($data);
////        $filePath = storage_path('app/public/exports/veriler.xlsx');
////        Excel::store($export, 'exports/veriler.xlsx');
////
////        // Dosya indirme bağlantısını döndürün
////        return response()->json([
////            'fileUrl' => asset('storage/exports/veriler.xlsx')
////        ]);
//
//        // Verileri alın
//        $user = User::find(1);
//
//        if (!$user) {
//            return response()->json([
//                'error' => 'Kullanıcı bulunamadı.'
//            ], 404);
//        }
//
//        // Excel dosyasını oluşturun
//        $data = collect([$user]);
//        dd($data);
//        $export = new SampleDataExport($data);
//        $filePath = storage_path('app/public/exports/veriler.xlsx');
//        Excel::store($export, 'exports/veriler.xlsx');
//
//        // Dosya indirme bağlantısını döndürün
//        return response()->json([
//            'fileUrl' => asset('storage/exports/veriler.xlsx')
//        ]);
//
//
//    }

    public function exportToExcel(Request $request)
    {
        $veriler = DeviceLog::all(); // Verileri burada çekiyoruz, VeriModeli kısmını kendi modelinizle değiştirmeyi unutmayın

        return Excel::download(function () use ($veriler) {
            echo "Id,Name,Email\n"; // Excel dosyasının başlık satırı
            foreach ($veriler as $veri) {
                echo $veri->id . ',' . $veri->name . ',' . $veri->email . "\n";
            }
        }, 'veritabani_verileri.xlsx');
    }


}
