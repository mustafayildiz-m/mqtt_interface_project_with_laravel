<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function workspaces()
    {
        $pageTitle = config('seo.page_title');

        $workspaces = [
            'Supercode',
            'Ultron',
            'Newdata'
        ];

        return view('workspaces.workspaces', compact('workspaces', 'pageTitle'));
    }
}
