<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Administer;
use App\Models\ShopAdmin;
use App\Http\Requests\ShopRequest;
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\AdministerRequest;
use App\Http\Requests\ManagerRequest;
use Carbon\Carbon;


class AdministerController extends Controller
{
    public function admin_ope()
    {
        if(Auth::guard('admin')->user()->role == 2){
            return view('admin.different_role');
        }else{
            $shops = Shop::all();
            $managers = Administer::where('role','=',2)->get();
            $param = ['shops'=>$shops,'managers'=>$managers];

            return view('admin.admin_ope',$param);
        }
    }

    public function add_manager(AdministerRequest $request)
    {
        $manager = Administer::create([
            'name' => $request->family_name." ".$request->first_name,
            'role' => '2',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->latest('id')->first();
        $shop = Shop::where('name','=',$request->shop_name)->first();
        ShopAdmin::create([
            'administer_id' => $manager->id,
            'shop_id' => $shop->id
        ]);

        return redirect('/admin/admin_ope');
    }

    public function update_manager(ManagerRequest $request)
    {

        Administer::find($request->id)
            ->update([
                'name' => $request->m_family_name." ".$request->m_first_name,
                'email' => $request->m_email,
            ]);
        ShopAdmin::where('Administer_id',"=",$request->id)
            ->update(['shop_id' => $request->shop_id]);

        return redirect('/admin/admin_ope');
    }
    
    public function delete_manager(Request $request)
    {
        Administer::find($request->id)
            ->delete();
        
        return redirect('/admin/admin_ope');
    }
    
    public function management(){
        if(Auth::guard('admin')->user()->role == 1){
            return view('admin.different_role');
        }else{
            $shop_id = Auth::guard('admin')->user()
                ->shopAdmin()->first()->shop_id;
            $shop = Shop::where('id','=',$shop_id)->first();
            $today =new Carbon('today');
            $reserves = Reserve::where('shop_id','=',$shop_id)
                ->where('date_time','>=',$today->format('Y-m-d'))
                ->orderby('date_time','asc')->get();
            $param = ['shop' => $shop, 'reserves' => $reserves];
            
            return view('admin.management',$param);
        }
        
    }

    public function img_up(Request $request)
    {
        $img = Storage::disk('s3')
            ->putFile('/',$request->file('file'));
        
        $image_URL =['image_URL' =>Storage::disk('s3')->url($img)];
        Shop::find($request->id)
            ->update($image_URL);
        
        return redirect('/admin/management');
    }
    
    public function update_shop(ShopRequest $request)
    {
        $update = $request->all();
        unset($update['_token']);
        Shop::find($request->id)
            ->update($update);
        
        return redirect('/admin/management');
    }

    public function update_reserve(ReserveRequest $request)
    {
        Reserve::find($request->id)
            ->update([
                'user_id' => $request->user_id,
                'shop_id' =>$request->shop_id,
                'number' =>$request->number,
                'date_time' =>$request->date." ".$request->time
            ]);
        
        return redirect('/admin/management');
    }

    public function delete_reserve(Request $request)
    {
        Reserve::find($request->id)
            ->delete();
        
        return redirect('/admin/management');
    }
}