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
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);

        $pageTitle = config('seo.page_title');
        config(['seo.page_title' => 'Dashboard | superLOG']);

        $workspace_detail = WorkSpace::find($workspace);


        return view('zones.index', compact('pageTitle', 'workspace_detail'));
    }

    public function create($workspace)
    {
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspace_detail = WorkSpace::find($workspace);
        $zones = Zone::where('work_space_id', $workspace);
        $tree = Zone::getTree($workspace);

        config(['seo.page_title' => 'Bölge Oluştur | superLOG']);
        $pageTitle = config('seo.page_title');

        //return view('zones.create', compact('pageTitle', 'tree', 'workspace_detail', 'zones'));
        return view('zones.create', ['pageTitle'=>$pageTitle, 'tree'=>$tree, 'workspace_detail'=>$workspace_detail, 'zones'=>$zones]);
    }

    public function created(Request $request, $workspace)
    {

        Zone::create([
            'work_space_id' => $workspace,
            'name' => $request->name,
            'parent_id' => $request->parent_id == 0 ? null : $request->parent_id
        ]);
        Alert::success('Bölge ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');

        return redirect()->route('zones', $workspace);

    }

    //@if(session('tab')==='general') active @endif

    public function createdInDevice(Request $request, $workspace)
    {

        $zone = new Zone();
        $zone->work_space_id = $workspace;
        $zone->name = $request->name;
        $zone->parent_id = $request->parent_id == 0 ? null : $request->parent_id;
        $zone->save();
        Alert::success('Bölge ekleme başarılı.')->showConfirmButton('Tamam', '#3085d6');
        session(['tab' => 'general']);
        return back();

    }

    public function edit($workspace, $id)
    {
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        if (!isset(\auth()->user()->id)) {
            abort_if(true, 404);
        }
        $workspaces = \auth()->user()->workspaces;
        $zones = Zone::all();
        $zone = Zone::find($id);
        $workspace_detail = WorkSpace::find($zone->work_space_id);


        config(['seo.page_title' => 'Bölge Düzenle | superLOG']);
        $pageTitle = config('seo.page_title');


        return view('zones.edit', compact('pageTitle', 'zone', 'zones', 'workspace_detail', 'workspaces'));
    }

    public function update(Request $request)
    {
        $parent = null;
        if ($request->id !== null) {
            $parent = $request->id;
        }
        $zone = Zone::where(['work_space_id' => $request->workspace_id, 'id' => $request->zone_id]);

        if ($zone->count() > 0) {
            $zone->update([
                'name' => $request->input('name'),
                'parent_id' => $parent
            ]);

            config(['seo.page_title' => 'Dashboard | superLOG']);
            Alert::success('Bölge düzenlendi.')->showConfirmButton('Tamam', '#3085d6');
            return redirect()->back();
        }
        Alert::error('Bölge düzenlenemedi.');
        return redirect()->back();


    }

}
