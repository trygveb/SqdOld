<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class MenuController extends Controller {

    private $currentUser;
   
    public function __construct()    {
       $this->currentUser= Auth::user();
    }
    
    public function about() {
        return view('menu.about', [
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
}
