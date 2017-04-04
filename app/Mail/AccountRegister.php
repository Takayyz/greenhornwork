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
        $userinfo = $this->userinfo;
        $password = 'hogehoge';
        $bytes = openssl_encrypt($userinfo['email'], 'aes-256-ecb', $password); 
        $hex = bin2hex($bytes);
        
       //$thisはAccountRegisterのクラスを引っ張り、新規作成で保存されたメアドを$bytesで暗号化して、２進数を１６進数に変換している。１６進数に変換する事でセキュリティが増す。

        $userinfo = $this->userinfo;
        return $this->view('email.AccountRegister')
                    ->with('hex', $hex);

        // メールのビュー画面にユーザー新規作成画面にて作成、保存されたデータが全て渡っている。全て渡っているが、URLの末尾に使用されるのはメアドのデータだけ。アカウント登録と共に、ユーザーIDとパスワードがUSERテーブルに保存され、URL　のメアドを元にWHEREでUSERINFOSテーブルのメアドが検索される。
    }

}
