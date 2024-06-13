<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use Illuminate\Support\Facades\Mail;
use App\Mail\PartnerMail;

class BecomePartnerController extends Controller
{
    public function index()
    {
        return view('become-a-partner');
    }

    public function create(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => ['required', 'string'],
            'company' => ['required', 'string'],
            'position' => ['required', 'string'],
            'email' => ['required', 'email',],
            'contact_number' => ['required', 'string'],
        ]);

        $partner = Partner::create([
            "name" => $request->name,
            "company" => $request->company,
            "position" => $request->position,
            "email" => $request->email,
            "contact_number" => $request->contact_number
        ]);

        /*Mail::to('ashaariazman@cakexp.com')->send(new SendVerificationMail(
            $partner->name,
            $partner->company,
            $partner->position,
            $partner->email,
            $partner->contact_number,
            )
         );

        */

        Mail::to('ashaariazman@cakexp.com')->send(new PartnerMail($partner));

        return redirect()->back()->with('success', 'partner created');
    }
}
