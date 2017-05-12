<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PermissionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
      $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
          'url' => url('/'),
          'user_right' => $this->inputs['user_right'] == '1' ? 'ユーザー' : '',
          'store_right' => $this->inputs['store_right'] == '1' ? '店舗' : ''
        ];
        return $this->view('mail.access_permited_email')->with($data);
    }
}
