<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('website.about');
    }

    public function viewPolicy()
    {
        return view('website.policy');
    }
}
