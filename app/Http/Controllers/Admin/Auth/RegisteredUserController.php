<?php

namespace App\Http\Controllers\Admin\Auth;

// use App\Models\User;
use App\Models\Administer;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AdministerRequest;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(AdministerRequest $request)
    {        
        $administer = Administer::create([
            'name' => $request->family_name." ".$request->first_name,
            'role' => '1',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($administer));
        // Auth::login($Administer);
        Auth::guard('admin')->login($administer);
        return redirect('/admin/admin_ope');
    }

}
