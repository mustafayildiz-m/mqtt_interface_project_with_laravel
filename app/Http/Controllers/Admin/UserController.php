<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        config(['seo.page_title' => 'Kullanıcılar | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('admin.users.index', compact('pageTitle'));
    }

    public function show()
    {
        config(['seo.page_title' => 'Kullanıcı: Ali Onur Serçe | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('admin.users.show', compact('pageTitle'));
    }

    public function plan()
    {
        config(['seo.page_title' => 'Kullanıcı: Ali Onur Serçe | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('admin.users.plan', compact('pageTitle'));
    }
}
