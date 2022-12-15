<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $datas =[
            $this->user_name = $param['user_name'],
            $this->user_email = $param['user_email'],
            $this->mail_title = $param['mail_title'],
            $this->msg = $param['msg'],
            $this->shop_name = $param['shop_name'],
            $this->shop_email = $param['shop_email']
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $datas =[
            'user_name'=> $this->user_name,
            'shop_name'=> $this->shop_name,
            'mail_title'=> $this->mail_title,
            'msg'=> $this->msg,
            'shop_email'=> $this->shop_email,
        ];
        return $this->to($this->user_email)
            ->subject('Reseからのお知らせ')
            ->view('mail.send_mail')
            ->with($datas);
    }
}
