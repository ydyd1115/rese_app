@extends('layouts.auth_default')

@section('title','Registration')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <table >
        <tr>
            <th>
                <label for="name">Name</label>
            </th>
            <td>
                <x-input id="name" type="text" name="name" :value="old('name')"  autofocus />            
            </td>
        </tr>
        @if ($errors->has('name'))
            <tr class="error-message">
                <th></th>
                <td>{{$errors->first('name')}}</td>
            </tr>
        @endif        
        <tr>
            <th>
                <label for="nickname">NickName</label>
            </th>
            <td>
                <x-input id="nickname" type="text" name="nickname" :value="old('nickname')"  />            
            </td>
        </tr>
        @if ($errors->has('nickname'))
            <tr class="error-message">
                <th></th>
                <td>{{$errors->first('nickname')}}</td>
            </tr>
        @endif
        <tr>
            <th>
                <label for="email">Email</label>
            </th>
            <td>
                <x-input id="email" type="email" name="email" :value="old('email')"  />
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
                <x-input id="password" 
                                type="password"
                                name="password"
                                autocomplete="new-password" />
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
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            登録済の方はこちら
        </a>
        <button class="submit__btn" type="submit" >登録</button>
    </div>
    <div class="caution">
        <p>全ての会員機能をご利用いただくには<br>
        登録時に送信されるメールより<br>
        メール認証をしていただく必要がございます。</p>
    </div>
</form>

@endsection