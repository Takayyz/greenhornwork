<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class AdminAccountRegister extends Mailable
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
       $adminuser = $this->adminusers;
       $mailpassword = env('MAIL_ADDRESSPASS');
       $email = $adminuser['email'];
       $mailenc = openssl_encrypt($email, 'aes-256-ecb', $mailpassword);
       $mailhex = bin2hex($mailenc);
       $emailkey = '?m=';

       $privilegespassword = env('MAIL_PRIVILEGES');
       $privileges = $adminuser['privileges'];
       $privilegesenc = openssl_encrypt($privileges, 'aes-256-ecb', $privilegespassword);
       $privilegeshex = bin2hex($privilegesenc);
       $privilegeskey = '&p=';
       $path = url('/');

        return $this->view('mail.admin_accountregister')
                    ->with([
                      'path' => $path,
                      'adminuser' => $adminuser,
                      'mailhex' => $mailhex,
                      'email' => $emailkey,
                      'privilegeshex' => $privilegeshex,
                      'privileges' => $privilegeskey,
                    ]);
    }
}
