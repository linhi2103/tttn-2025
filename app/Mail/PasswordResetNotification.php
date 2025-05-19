<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class PasswordResetNotification extends Mailable
{
    public $token;
    public $name;
    
    public function __construct($token,$name)
    {
        $this->token = $token;
        $this->name = $name;
    }

    public function build()
    {
        return $this->markdown('mails.password-reset-notifications')->with([
            'token' => $this->token,
            'name' => $this->name
        ]);
    }
}
