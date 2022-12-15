@extends('layouts.auth_default')

@section('title','Login')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <table >
        <tr>
            <th>
                <label for="email">Email</label>
            </th>
            <td>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus />
            </td>
        </tr>
        @if ($errors->has('email'))
        <tr class="error-message">
            <th></th>
            <td>{{$errors->first('email')}}</td>
        </tr>
        @endif       
        <tr>
            <th>
                <label for="password">Password</label>
            </th>
            <td>
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="current-password" />
            </td>
        </tr>
        @if ($errors->has('password'))
        <tr class="error-message">
            <th></th>
            <td>{{$errors->first('password')}}</td>
        </tr>
        @endif  
    </table>
    <div class="submit">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
        <span class="ml-2 text-sm text-gray-600">パスワードを記憶</span>
    </label>

    <div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
            パスワードをお忘れの場合
        </a>
    @endif
        <button class="submit__btn" type="submit">ログイン</button>
    </div>
</form>
@endsection