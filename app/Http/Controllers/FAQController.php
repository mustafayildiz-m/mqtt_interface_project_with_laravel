<?php

namespace App\Http\Controllers;

class FAQController extends Controller
{
    public function index()
    {
        config(['seo.page_title' => 'Sıkça Sorulan Sorular | superLOG']);
        $pageTitle = config('seo.page_title');

        return view('faq.index', compact('pageTitle'));
    }


}
