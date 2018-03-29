<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class PageController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact')->with([
            'email' => Config::get('app.supportEmail')
        ]);
    }
}