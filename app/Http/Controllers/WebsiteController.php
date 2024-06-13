<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function viewLanding()
    {
        return view('website/page-1');
    }

    public function viewPartner()
    {
        return view('website/page-2');
    }
}
