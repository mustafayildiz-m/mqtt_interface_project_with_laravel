<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        config(['seo.page_title' => 'Kullanıcılar | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.users.index', compact('pageTitle'));
    }

    public function show()
    {
        config(['seo.page_title' => 'Kullanıcı: Ali Onur Serçe | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.users.show', compact('superLOG'));
    }

    public function plan()
    {
        config(['seo.page_title' => 'Kullanıcı: Ali Onur Serçe | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.users.plan', compact('pageTitle'));
    }
}
