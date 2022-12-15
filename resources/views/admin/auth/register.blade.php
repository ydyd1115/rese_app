@extends('layouts.admin_default')

@section('title','管理者登録')

@section('content')
    <form class="admin_form" action="{{route('admin.register')}}" method="post">
        <table>
        @csrf
        @if ($errors->has('family_name'))
        <tr class="error-message">
            <th></th>
            <td>{{$errors->first('family_name')}}</td>
        </tr>
        @endif      
        <tr>
            <th><label for="family_name">姓</label></th>
            <td><input type="text" name="family_name" id="family_name"></td>
        </tr>
        @if ($errors->has('first_name'))
        <tr class="error-message">
            <th></th>
            <td>{{$errors->first('first_name')}}</td>
        </tr>
        @endif      
        <tr>
            <th>名</th>
            <td><input type="text" name="first_name"></td>
        </tr>
        @if ($errors->has('email'))
        <tr class="error-message">
            <th></th>
            <td>{{$errors->first('email')}}</td>
        </tr>
        @endif      
        <tr>
            <th><label for="email">メールアドレス</label></th>
            <td><input type="email" name="email" id="email"></td>
        </tr>
        @if ($errors->has('password'))
        <tr class="error-message">
            <th></th>
            <td>{{$errors->first('password')}}</td>
        </tr>
        @endif      
        <tr>
            <th><label for="password">パスワード</label></th>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        </table>
        <div class="buttons">
        <button type="submit" class="submit_btn">登録</button>  
        </div>
    </form>
    <div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.login') }}">
        登録済の場合(ログイン)
    </a>

    </div>
@endsection