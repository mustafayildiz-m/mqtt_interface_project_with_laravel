<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        config(['seo.page_title' => 'Destek Talepleri | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('tickets.index', compact('pageTitle'));
    }

    public function create()
    {
        config(['seo.page_title' => 'Yeni Destek Talebi | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('tickets.create', compact('pageTitle'));
    }

    public function details($id)
    {
        config(['seo.page_title' => 'Destek Talebi #' . intval($id) . ' | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('tickets.details', compact('pageTitle'));
    }
}
