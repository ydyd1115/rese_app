<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reserve;
use Carbon\Carbon;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $today =new Carbon('today');
        $reserves = Reserve::where('user_id','=',$user->id)
        ->where('date_time','>=',$today->format('Y-m-d'))
        ->orderby('date_time','asc')->get();
        $shops = User::find($user->id)->shops()->get();
        $param = ['user'=>$user,'reserves'=>$reserves,'shops'=>$shops];
        return view('mypage',$param);
    }
}
