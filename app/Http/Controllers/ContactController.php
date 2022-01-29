<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\Mailme;


class ContactController extends Controller {

    public $add1, $add2;
    
        public function __construct()    {
//        $getCurrentUser= true;               // We need current user in this controller
//        parent::aconstruct($getCurrentUser);  // Needed for the Logging trait
    }
    
    public function showForm(Request $request) {
        $this->add1=rand(1, 20); 
        $this->add2=rand(1, 20); 
        return view('menu.contact', [
            'add1' => $this->add1,
            'add2' => $this->add2
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
            \Mail::to('trygve.botnen@gmail.com')->send(new Mailme('contact@abctrav.se', $name, $msg, $adress));
//            \Mail::to('trygve.botnen@gmail.com')->send(new Mailme($adress, $name, $msg));
            return \View::make('emails.emailsent');
        } else {
            return \View::make('emails.emailNotSent');
        }
    }
}
