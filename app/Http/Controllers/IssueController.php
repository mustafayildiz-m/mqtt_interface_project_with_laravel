<?php

namespace App\Http\Controllers;

use App\Models\AllowedUserAndWorkspaces;
use App\Models\WorkSpace;

class IssueController extends Controller
{
    public function index($workspace)
    {

        $abort = AllowedUserAndWorkspaces::where(['allowed_user_id' => \auth()->user()->id, 'allowed_workspace_id' => $workspace])->count() == 0 ? true : false;
        abort_if($abort, 404);
        $workspace_detail = WorkSpace::find($workspace);


        config(['seo.page_title' => 'Olaylar | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('issues.index', compact('pageTitle', 'workspace_detail'));
    }
}
