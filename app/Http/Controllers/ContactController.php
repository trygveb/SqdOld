<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\Mailme;


class ContactController extends Controller {

    
        public function __construct()    {
//        $getCurrentUser= true;               // We need current user in this controller
//        parent::aconstruct($getCurrentUser);  // Needed for the Logging trait
    }
    
    public function showForm(Request $request) {
       $application='sqd.se';
        return view('menu.contact', [
            'application' => $application,
           ]);
    }

    public function sendMail(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        //ContactUs::create($request->all());
        $name = $request->input('name');
        $adress = $request->input('email');
        $msg = $request->input('message');
        $correctAnswer=$request->input('add1')+$request->input('add2');
        $userAnswer=$request->input('addSum');
        if ( $correctAnswer == $userAnswer) {
           // TODO: email adress in env
            \Mail::to('trygve.botnen@gmail.com')->send(new Mailme('contact@abctrav.se', $name, $msg, $adress));
//            \Mail::to('trygve.botnen@gmail.com')->send(new Mailme($adress, $name, $msg));
//            return \View::make('emails.emailsent');
            $application='sqd.se'; // TODO: not needed?
            return redirect(route('contact.showForm', ['application' => $application]))->withSuccess(__('Email sent'));
        } else {
            return \View::make('emails.emailNotSent');
        }
    }
}
