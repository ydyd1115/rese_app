<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area',
        'genre',
        'comment',
        'image_URL'
    ];

    public function likes()
    {
        $user = Auth::user();
        return $this->hasMany('App\Models\Like')
                ->where('user_id', '=', $user->id);
    }

    public function reserves()
    {
        return $this->hasmany('App\Models\Reserve');
    }

    public function reviews()
    {
        return $this->hasmany('App\Models\Review');
    }

    public function administers()
    {
        return $this->hasManyThrough(Administer::class,ShopAdmin::class);
    }

    public static function shopSearch($datas)
    {
        $query = self::query();
    if (!empty($datas['area'])) {
        $query->where('area', 'like binary', "%{$datas['area']}%");
    }
    if (!empty($datas['genre'])) {
        $query->where('genre', '=' ,$datas['genre']);
    }
    if (!empty($datas['name'])) {
        $query->where('name', 'like binary', "%{$datas['name']}%");
    }
    $results = $query->get();
    return $results;
    }

}
