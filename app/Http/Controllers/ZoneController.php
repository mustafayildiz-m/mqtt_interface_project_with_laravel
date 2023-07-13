<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\WorkSpace;
use App\Models\Zone;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ZoneController extends Controller
{
    public function index($workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);

        $pageTitle = config('seo.page_title');
        config(['seo.page_title' => 'Dashboard | Superlog']);

        $workspace_detail = WorkSpace::find($workspace);


        return view('zones.index', compact('pageTitle', 'workspace_detail'));
    }

    public function create($workspace)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspace_detail = WorkSpace::find($workspace);
        $zones = Zone::where('work_space_id', $workspace);
        config(['seo.page_title' => 'Bölge Oluştur | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('zones.create', compact('pageTitle', 'workspace_detail', 'zones'));
    }

    public function created(Request $request, $workspace)
    {

        $zone = new Zone();
        $zone->work_space_id = $workspace;
        $zone->name = $request->name;
        $zone->parent_id = $request->parent_id;
        $zone->save();
        Alert::success('Bölge Ekleme Başarılı', 'Bölge Ekleme Başarılı');

        return redirect()->route('zones', $workspace);

    }

    public function edit($workspace, $id)
    {
        $workspaces = \auth()->user()->workspaces;
        $zones = Zone::all();
        $zone = Zone::find($id);
        $workspace_detail = WorkSpace::find($zone->work_space_id);
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);

        config(['seo.page_title' => 'Bölge Düzenle | Superlog']);
        $pageTitle = config('seo.page_title');


        return view('zones.edit', compact('pageTitle', 'zone', 'zones', 'workspace_detail', 'workspaces'));
    }

    public function update(Request $request)
    {
        $parent = 0;
        if ($request->id !== null) {
            $parent = $request->id;
        }
        $zone = Zone::where(['work_space_id' => $request->workspace_id,  'id' => $request->zone_id]);

        if ($zone->count() > 0) {
            $zone->update([
                'name' => $request->input('name'),
                'parent_id' => $parent
            ]);

            config(['seo.page_title' => 'Dashboard | Superlog']);
            Alert::success('Bölge Düzenlendi');
            return redirect()->back();
        }
        Alert::error('Bölge Düzenlenemedi');
        return redirect()->back();


    }

}
