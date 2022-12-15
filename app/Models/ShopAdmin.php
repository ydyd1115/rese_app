<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'administer_id',
        'shop_id',
    ];


    public function administers(){
        return $this->belongsTo('App\Models\Administer');
    }

    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }
}
