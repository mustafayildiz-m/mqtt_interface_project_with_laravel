<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\WorkSpace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard($workspace = null)
    {


//        if (is_null(\auth()->user())) {
//            Auth::logout();
//            return Redirect::to('/login');
//        }

        $workspace_detail = WorkSpace::find($workspace);
        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspaces = DB::table('allowed_user_and_workspaces as allow')
            ->join('work_spaces as ws', 'allow.allowed_workspace_id', '=', 'ws.id')
            ->select('*', 'ws.id as workspace_id')
            ->where('allow.allowed_user_id', \auth()->user()->id)->get();

        $pageTitle = config('seo.page_title');
        //kayıtlı cihazı varmı kontrol
        $allowed = AllowedUserAndWorkspaces::where(function ($q) {
            $q->whereNotNull('allowed_device_serial_no')->where('allowed_email', Auth::user()->email)->select('allowed_device_serial_no');
        });

        if ($allowed->count() === 0) {
            Alert::error('Kayıtlı cihazınız yok.', 'Lütfen bu alana giriş yapabilmek için cihaz ekleyin')->flash();
            return redirect()->back();
        }

        config(['seo.page_title' => 'Dashboard | Superlog']);

        return view('dashboard', compact('pageTitle', 'workspace_detail', 'workspaces'))->with('alert', 'Giriş Başarılı');
    }

    public function workspaces()
    {
        $pageTitle = config('seo.page_title');

        if (!auth()->check()) {
            return redirect(route('login'));
        }

        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        $workspaces = DB::table('allowed_user_and_workspaces as allow')
            ->join('work_spaces as ws', 'allow.allowed_workspace_id', '=', 'ws.id')
            ->select('*', 'ws.id as workspace_id')
            ->distinct('ws.name')
            ->where('allow.allowed_user_id', \auth()->user()->id)->get();
        return view('workspaces.workspaces', compact(['pageTitle', 'workspaces']));
    }
}
