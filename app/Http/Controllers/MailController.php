<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMail;
use App\Http\Requests\MailRequest;
use App\Models\Reserve;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MailController extends Controller
{
    public function send_mail(MailRequest $request)
    {
        $user_name = $request->user_name;
        $user_email = $request->user_email;
        $mail_title = $request->mail_title;
        $msg = $request->msg;
        $shop_name = $request->shop_name;
        $shop_email = $request->shop_email;

        $param = [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'mail_title'=> $mail_title,
            'msg' => $msg,
            'shop_name' => $shop_name,
            'shop_email' => $shop_email,
        ];
        Mail::send(new AdminMail($param));
        
        return redirect('/admin/management');
    }

}
