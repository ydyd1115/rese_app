@extends('layouts.admin_default')
<link rel="stylesheet" href="{{ asset('css/admin_auth.css') }}">
@section('title','管理者ログイン')

@section('content')
<form method="POST" action="{{ route('admin.login') }}">
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
    <button class="submit_btn" type="submit">ログイン</button>
    </div>
</form>
@endsection