<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
  <title>マイページ</title>
</head>
<body>
  <header>
    <div class="header">
      <h1 class="logo"><a href="/">Rese</a></h1>
      <div class="header__nav">
        <button class="header__nav__btn" id="drawer_on">
          マイページ<br>「{{$user->nickname}}」様
        </button>      
      </div>
    </div>
    <div class="header__nav_menu" id="header__nav_menu">
      <button class="closeBtn"
      id="closeBtn">x</button>
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
    </div>
  </header>
  <main>
    <div class="reserves_list">
      <h2>予約状況</h2>
      @foreach($reserves as $reserve)
        <div class="reserve">
          <div class="reserve__head">
            <h3>予約</h3>
          </div>
          <form class="reserve__del" 
            action="{{route('delete',['id' => $reserve->id])}}" method="post">
            @csrf
            <button class="reserve_del_btn" type="submit">予約取消</button>
          </form>
          <div class="reserve__update">
            <div class="reserve__content">
              <form action="{{route('update',['id' => $reserve->id])}}" method="post">
                @csrf
                <button class="reserve_update_btn" type="submit">更新</button>
                <table>
                  <tr>
                    <th class="reserve__content__head">Shop</th>
                    <input type="text" name="shop_id"
                    value="{{$reserve->shop_id}}" hidden>
                    <td class="reserve__content__info">{{$reserve->shop->name}}</td>
                  </tr>
                  <tr>
                    <th class="reserve__content__head">Date</th>
                    <td class="reserve__content__info">
                    <input type="date" name="date" 
                    value="{{\Carbon\Carbon::parse($reserve->date_time)->toDateString()}}">
                    </td>
                  </tr>
                  <tr>
                    <th class="reserve__content__head">Time</th>
                    <td class="reserve__content__info">
                    <input id="time" type="time" name="time"
                    min="00:00" max="23:59" 
                    value="{{\Carbon\Carbon::parse($reserve->date_time)->toTimeString()}}">
                    </td>
                  </tr>
                  <tr>
                    <th class="reserve__content__head">Number</th>
                    <td class="reserve__content__info">
                      <input id="number" type="number" name="number" value="{{$reserve->number}}">
                    </td>
                  </tr>
                </table>
              </form>
            </div>
            <div class="reserve__check">
              @if(count($errors)>0)
                <div class="error_message">
                  <p>入力に問題がありました。
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="likes_list">
      <h2>お気に入り店舗</h2>
      <div class="likes__shops">
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
              <form action="{{route('dislike',['id' => $shop->id])}}" method="POST">
                @csrf 
                <input class="shop_card__like__btn like_true " type="submit" value="★">
              </form>
            </div>
          </div>      
        @endforeach
      </div>
    </div>
  </main>
  <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>