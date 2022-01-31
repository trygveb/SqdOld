<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Http\Controllers\BaseController;
use App\Mail\Mailme;
use App\Classes\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuController extends BaseController {

    private $currentUser;
   
    public function __construct()    {
       $this->currentUser= Auth::user();
    }
    
    public function about() {
       $app=$this->names()['application'];
        return view('menu.about', [
            'application' => $app,
            'title'=>'About']);
    }


    public function privacy() {
        return view('about.privacy',[
            'currentUser' => $this->currentUser,
            'title'=>'Policy']);
    }

   /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view ('about.contact', [
            'currentUser' => $this->currentUser,
            'title'=>'Kontakt']);
    }

//    /**
//     * Send contact email
//     *
//     * @param  ContactRequest $request
//     * @return \Illuminate\Http\Response
//     */
//    public function contactSendMail(ContactRequest $request)
//    {
//        Mail::to('trygve.botnen@gmail.com')->send(new mailme);
// 
//        return view('emails.mailme');
//    }

    /**
     * Show the hep page.
     *
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
        return view ('home.help', [
            'currentUser' => $this->currentUser,
            'title'=>'Hjälp']);
    }
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
            \Mail::to(config('app.adminEmail'))->send(new Mailme($this->names()['application'], 'contact@abctrav.se', $name, $msg, $adress));
            return redirect(route('about'))->withSuccess(__('E-Mail sent!'));
        } else {
           return redirect(route('about'))->withError(__('E-Mail not sent!'));
        }
    }
}
