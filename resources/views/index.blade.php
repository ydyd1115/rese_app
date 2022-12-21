<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/shops.css') }}">
  <title>店舗一覧</title>
</head>
<body>
  <header>
    <h1 class="logo"><a href="/">Rese</a></h1>
    <div class="header__flex">
      <div class="header__menu">
        <button class="header__menu__btn" id="drawer_on">
          @if(Auth::check())
          {{$user['nickname']}}様
          @else
          ログイン
          @endif
        </button>
      </div>
      <div class="header__nav_menu" id="header__nav_menu">
        <button class="closeBtn"
        id="closeBtn">x</button>
        @if(Auth::check())
          <a class="header__nav_menu__link" href="/">HOME</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link class="header__nav_menu__link" 
                          :href="route('logout')"
                          onclick="event.preventDefault();
                                          this.closest('form').submit();">
                          {{ __('Log Out') }}
            </x-dropdown-link>
          </form>
          <a class="header__nav_menu__link" href="{{route('mypage')}}">Mypage</a>
        @else
          <a class="header__nav_menu__link" href="/">HOME</a>
          <a class="header__nav_menu__link" href="{{route('register')}}">Register</a>
          <a class="header__nav_menu__link" href="{{route('login')}}">Login</a>
        @endif
      </div>
      <div class="header__search">
        <form method="post" action="/search">
          @csrf
          <select name="area" value="{{old('area')}}">
            <option value="">#all_area</option>
            <option value="大阪府">#大阪府</option>
            <option value="東京都">#東京都</option>
            <option value="福岡県">#福岡県</option>
          </select>
          <select name="genre" value="{{old('genre')}}">
            <option value="">#all_genre</option>
            <option value="イタリアン">#イタリアン</option>
            <option value="ラーメン">#ラーメン</option>
            <option value="居酒屋">#居酒屋</option>
            <option value="寿司">#寿司</option>
          </select>
          <input type="text" name="name" placeholder="search…"  value="{{old('name')}}">
          <button class="header__search__btn">検索</button>
        </form>
      </div>
    </div>    
  </header>
  <main>
    @foreach($shops as $shop)
      <div class="shop_card">
        <img src="{{$shop->image_URL}}" class="shop_card__img" alt="{{$shop->name}}">
        <div class="shop_card__detail">
          <h3>{{$shop->name}}</h3>
          <p class="shop_card__tag">
            <span>#{{$shop->area}}</span><span>#{{$shop->genre}}</span>
          </p>
        </div>  
        <div class="shop_card__bottom">
        <a href="{{route('detail',['id' => $shop->id])}}">詳しく見る</a>
        @if(!Auth::check())
          <button class="shop_card__like__btn" onclick="alert('お気に入り追加にはログインが必要です。')">☆</button>
        @elseif($shop->likes != "[]")
          <form action="{{route('dislike',['id' => $shop->id])}}" method="POST">
            @csrf 
            <button class="shop_card__like__btn like_true" type="submit">
              ★
            </button>
          </form>
        @elseif($shop->likes == "[]")
          <form id="dis_like" action="{{route('like',['id' => $shop->id])}}" method="POST">
            @csrf 
            <button class="shop_card__like__btn" type="submit">
              ☆
            </button>
          </form>
        @endif
        </div>
      </div>
    @endforeach
  </main>
  <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>