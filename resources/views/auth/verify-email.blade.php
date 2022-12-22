@extends('layouts.auth_default')

@section('title','Caution!!')

@section('content')
        <div class="mb-4 text-sm text-gray-600">
            {{ __('サイト会員ご登録ありがとうございます！全ての会員サービスを有効にご利用にはいただくにはメール認証が必要となります。ご登録時に送信されたメールよりメール認証を完了させてください。認証用メールは下記ボタンから再送されます。') }}
        </div>
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <x-button>
                        {{ __('認証メール再送') }}
                    </x-button>
                </div>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
            <a href="/">トップへ戻る</a>
        </div>
    @endsection