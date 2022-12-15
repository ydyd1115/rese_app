<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'status'
    ];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }

    public static function userLike($user)
    {
        $items = self::all();
        if(!empty($user))
        {
            $items->where('user_id','=',$user->id);
        }
    
        return $items;
    }
}
