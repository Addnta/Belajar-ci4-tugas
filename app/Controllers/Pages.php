<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function profile()
    {
        return view('pages/profile');
    }

    public function faq()
    {
        return view('pages/faq');
    }

    public function contact()
    {
        return view('pages/contact');
    }
}
