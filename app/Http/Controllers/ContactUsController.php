<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
      
    public function index(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        $submission = ContactUs::create($validated);

        Mail::to($validated['email'])->send(new \App\Mail\UserThankYouMail($submission));
        //recruitment@bridgingfx.net

        Mail::to('tanujapathania333@gmail.com')->send(new \App\Mail\AdminNotificationMail($submission));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');

    }
}
