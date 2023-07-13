<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\WorkSpace;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index($workspace)
    {


        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspace_detail = WorkSpace::find($workspace);
        $zones = Zone::where('work_space_id', $workspace)->get();
        $deviceLogs = DB::table('device_logs as dl')
            ->select('dl.*', 'd.*', 'th.*', 'z.id as zone_id', 'z.*', 'z.name as zone_name', 'dl.created_at as d_created_at')
            ->join('devices as d', 'd.serial_no', '=', 'dl.serial_no')
            ->join('work_spaces as ws', 'ws.id', '=', 'd.workspace_id')
            ->join('device_temp_hum_limits as th', 'th.id', '=', 'dl.limit_id')
            ->leftJoin('zones as z', 'z.id', '=', 'd.zone_id')
            ->distinct('dl.created_at')
            ->orderBy('dl.created_at', 'DESC')
            ->where('ws.id', $workspace)
            ->get();


        config(['seo.page_title' => 'Raporlar | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('reports.index', compact('pageTitle', 'workspace_detail', 'zones', 'deviceLogs'));
    }

    public function deviceReports($workspace, $serial)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspace_detail = WorkSpace::find($workspace);
        $zones = Zone::where('work_space_id', $workspace)->get();
        $deviceLogs = DB::table('device_logs as dl')
            ->select('dl.*', 'd.*', 'z.id as zone_id', 'th.*',  'z.*', 'z.name as zone_name', 'dl.created_at as d_created_at')
            ->join('devices as d', 'd.serial_no', '=', 'dl.serial_no')
            ->join('work_spaces as ws', 'ws.id', '=', 'd.workspace_id')
            ->join('device_temp_hum_limits as th', 'th.serial_no', '=', 'd.serial_no')
            ->distinct('dl.created_at')
            ->orderBy('dl.created_at', 'DESC')

            ->leftJoin('zones as z', 'z.id', '=', 'd.zone_id')
            ->where(['ws.id' => $workspace, 'dl.serial_no' => $serial])
            ->get();


        config(['seo.page_title' => 'Raporlar | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('reports.index', compact('pageTitle', 'workspace_detail', 'zones', 'deviceLogs'));


    }


}
