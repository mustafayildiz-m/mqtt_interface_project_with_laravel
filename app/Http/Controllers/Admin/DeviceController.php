<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    public function index()
    {
        print("test");
        die();
        config(['seo.page_title' => 'Cihazlar | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.index', compact('pageTitle'));
    }

    public function create()
    {
        config(['seo.page_title' => 'Cihaz Ekle | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.create', compact('pageTitle'));
    }

    public function edit()
    {
        config(['seo.page_title' => 'Cihaz Düzenle | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.edit', compact('pageTitle'));
    }

    public function assignment()
    {
        config(['seo.page_title' => 'Cihaz Atamaları | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.assignment', compact('pageTitle'));
    }
}
