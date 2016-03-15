<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{


    public function about_us()
    {
        return view('material.app.about-us');
    }


    public function contact_us()
    {
        return view('material.app.contact-us');
    }


    public function sitemap()
    {
        return view('material.app.sitemap');
    }


    public function terms()
    {
        return view('material.app.terms');
    }
}
