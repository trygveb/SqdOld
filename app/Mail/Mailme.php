<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mailme extends Mailable {

    use Queueable, SerializesModels;

    private $myAdress;
    private $myFrom;
    public $myMessage='Hello';

    public function __construct($myAdress, $name, $msg, $fromAdress) {
        $this->myAdress = $myAdress;
        $this->myName = $name;
        $this->myMessage = $msg;
        $this->fromAdress = $fromAdress;
    }

    public function build() {
        $subject = 'sqd.se kontakt';
        //return $this->view('emails.mailme')->from($this->myAdress, $this->myName)->subject($subject);
        
        return $this->view('emails.mailme')->with([
                "myMessage" => $this->myMessage,
                "fromAdress" => $this->fromAdress
                ])->from($this->myAdress, $this->myName)->subject($subject);
        
    }

}
