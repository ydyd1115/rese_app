<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Like;
use App\Models\Reserve;
use App\Models\Review;
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\ReviewRequest;


class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shops = Shop::all();
        $param = ['user'=>$user, 'shops'=>$shops];
        
        return view('index',$param);
    }

    public function search(Request $request)
    {
        $genre = $request->genre;
        $area = $request->area;
        $name = $request->name;
        $datas =[
            'genre' => $genre,
            'area' => $area,
            'name' => $name,
        ];
        $user = Auth::user();
        $shops = Shop::ShopSearch($datas);
        $param = ['user'=>$user, 'shops'=>$shops];

        return view('index',$param);
    }
    
    public function detail(Request $request)
    {
        $user = Auth::user();        
        $shop = Shop::find($request->id);
        $reviews = Review::where('shop_id','=',$request->id)
            ->orderby('created_at','desc')->get();
        $param = ['user'=>$user, 'shop'=>$shop, 'reviews'=>$reviews];

        return view('detail',$param);
    }
    
    public function like(Request $request)
    {
        $user=Auth::user();
        
        $like =[
            'user_id'=>$user->id,
            'shop_id'=>$request->id,
        ];
        
        Like::create($like);
        return back();
    }
    
    public function dis_like(Request $request)
    {
        $user=Auth::user();
        Like::where('shop_id', '=', $request->id)->delete();

        return back();
    }
    
    public function reserve(ReserveRequest $request)
    {   
        $user = Auth::user();
        Reserve::create([
            'user_id'=>$user->id,
            'shop_id'=>$request->shop_id,
            'number' =>$request->number,
            'date_time'=>$request->date." ".$request->time
            ]);
        
        return view('done');
    }

    public function update(ReserveRequest $request)
    {   
        $user = Auth::user();
        Reserve::find($request->id)
            ->update([
                'user_id'=>$user->id,
                'shop_id'=>$request->shop_id,
                'number' =>$request->number,
                'date_time'=>$request->date." ".$request->time
            ]);
        
        return redirect()->route('mypage');
    }
    
    public function delete(Request $request)
    {
        Reserve::find($request->id)->delete();
        return redirect()->route('mypage');
    }
    
    public function review(ReviewRequest $request)
    {
        $review = $request->all();
        Review::create($review);

        return back();
    }
}
