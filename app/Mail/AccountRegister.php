<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $userinfo;

    public function __construct($userinfo)
    {
        $this->userinfo = $userinfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

  public function build()
    {
      $mailpassword = env('MAIL_ADDRESSPASS');
      $email = $this->userinfo['email'];
      $mailenc = openssl_encrypt($email, 'aes-256-ecb', $mailpassword);
      $mailhex = bin2hex($mailenc);
      $emailkey = '?query=';
      $path = url('/');
      return $this->view('email.AccountRegister')
                  ->with([
                    'path' => $path,
                    'mailhex' => $mailhex,
                    'email' => $emailkey,
                  ]);
    }
}