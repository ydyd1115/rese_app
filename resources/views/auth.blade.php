@extends('layouts.auth_default')
<style>
th {
background-color: #289ADC;
color: white;
padding: 5px 40px;
}
tr:nth-child(odd) td{
background-color: #FFFFFF;
}
td {
padding: 25px 40px;
background-color: #EEEEEE;
text-align: center;
}
</style>
@section('title', 'auth.blade.php')

@section('content')
<p>{{$text}}</p>
<form action="/auth" method="post">
    @csrf
    <table>
        <tr>
            <th>メール: </th>
            <td><input type="text" name="email"></td>
        </tr>
            @if ($errors->has('email'))
                <tr class="error-message">
                    <th></th>
                    <td>{{$errors->first('email')}}</td>
                </tr>
            @endif   
        <tr>
            <th>パスワード: </th>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="送信"></td>
        </tr>
    </table>
</form>
@endsection