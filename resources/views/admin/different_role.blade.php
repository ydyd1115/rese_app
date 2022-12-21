@extends('layouts.admin_default')

@section('title','権限エラー')

@section('content')
@if(Auth::guard('admin')->user()->role == 1)
  <h1>ログイン中のユーザー権限は<br>
  『管理者』です。</h1>
  <a href="/admin/admin_ope">
    管理者用ページへ
</a>
@elseif(Auth::guard('admin')->user()->role == 2)
  <h1>ログイン中のユーザー権限は<br>
  『店舗代表者』です。</h1>
  <a href="/admin/management">
    店舗代表者用ページへ
</a>
@endif
@endsection