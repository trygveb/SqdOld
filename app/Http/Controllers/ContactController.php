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
    
    /**
     * Currently we have no captcha test, as Googles terms are unacceptable,
     * and other tests user unfriendly
     * @return boolean
     */
    private function captcha() {
       return true;
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
        if ( $this->captcha()) {
            \Mail::to(config('app.adminEmail'))->send(new Mailme('contact@abctrav.se', $name, $msg, $adress));
            return redirect(route('contact.showForm'))->withSuccess(__('E-Mail sent!'));
        } else {
           return redirect(route('contact.showForm'))->withError(__('E-Mail not sent!'));
        }
    }
}
