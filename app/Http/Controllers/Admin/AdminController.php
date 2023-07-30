<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        config(['seo.page_title' => 'Kullanıcılar | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.admins.index', compact('pageTitle'));
    }
}
