<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class AdminAccountMailEdit extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $adminuser;

    public function __construct($adminuser)
    {
        $this->adminusers = $adminuser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $mailpassword = 'hogehoge';
      $email = $this->adminusers;
      $mailenc = openssl_encrypt($email, 'aes-256-ecb', $mailpassword);
      $mailhex = bin2hex($mailenc);
      $emailkey = '?m=';
      $path = url('/');
      return $this->view('mail.admin_accountmailedit')
                  ->with([
                    'path' => $path,
                    'mailhex' => $mailhex,
                    'email' => $emailkey,
                  ]);
    }
}
