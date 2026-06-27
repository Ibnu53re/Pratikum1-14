<?php
namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        $title = 'About';
        return view('page/about', compact('title'));
    }

    public function contact()
    {
        $title = 'Contact';
        return view('page/contact', compact('title'));
    }

    public function faqs()
    {
        $title = 'FAQs';
        return view('page/faqs', compact('title'));
    }
}