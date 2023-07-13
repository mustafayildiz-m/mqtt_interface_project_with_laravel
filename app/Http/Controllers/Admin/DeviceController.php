<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    public function index()
    {
        print("test");
        die();
        config(['seo.page_title' => 'Cihazlar | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.index', compact('pageTitle'));
    }

    public function create()
    {
        config(['seo.page_title' => 'Cihaz Ekle | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.create', compact('pageTitle'));
    }

    public function edit()
    {
        config(['seo.page_title' => 'Cihaz Düzenle | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.edit', compact('pageTitle'));
    }

    public function assignment()
    {
        config(['seo.page_title' => 'Cihaz Atamaları | Superlog']);
        $pageTitle = config('seo.page_title');

        return view('admin.devices.assignment', compact('pageTitle'));
    }
}
