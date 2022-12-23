<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
  <title>店舗詳細「{{$shop['name']}}」</title>
</head>
<body>
  <h1 class="logo"><a href="/">Rese</a></h1>
  <div class="shop_detail">
    <div class="shop_info">
      <div class="shop_info__head">
        <button class="back_btn" onclick="history.back();">＜</button>
        <h2>{{$shop['name']}}</h2>
      </div>
      <div class="shop_info__main">
        <img src="{{$shop['image_URL']}}" alt="{{$shop['name']}}">
        <p class="shop_card__tag">
          <span>#{{$shop['area']}}</span><span>#{{$shop['genre']}}</span>
        </p>
        <p>{{$shop['comment']}}</p>
      </div>
    </div>
    <div class="shop_reserve">
      <h2>予約</h2>
      @if(Auth::check())
        <form action="/reserve" method="post" name="reserve_post">
          <div class="shop_reserve__content" id="reserve_form">
            @csrf
            <input type="text" name="user_id" value="{{$user['id']}}" hidden>
            <input type="text" name="shop_id" value="{{$shop['id']}}" hidden>
            @if ($errors->has('date'))
              <p class="error_message">{{$errors->first('date')}}</p>
            @endif
              <input class="shop_reserve__date" type="date" name="date" value="{{old('date')}}" v-model="date">
            @if ($errors->has('time'))
              <p class="error_message">{{$errors->first('time')}}</p>
            @endif
            <input class="shop_reserve__time" type="time" name="time" value="{{old('time')}}" v-model="time">
            @if ($errors->has('number'))
              <p class="error_message">{{$errors->first('number')}}</p>
            @endif
            <input class="shop_reserve__number" type="number" name="number" value="{{old('number')}}" min="1" max="30" v-model="number">
            <div class="shop_reserve__confirm">
              <table>
                <tr>
                  <th>Shop</th>
                  <td>{{$shop['name']}}</td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td>@{{date}}</td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td>@{{time}}</td>
                </tr>
                <tr>
                  <th>Number</th>
                  <td>@{{number}}</td>
                </tr>
              </table>
            </div>
          </div>
          <a href="javascript:reserve_post.submit()" class="shop_reserve__btn">予約する</a>
        </form>
      @else
        <div class="shop_reserve__content">
          <h3>ご予約の場合は</h3>
            <a class="shop_reserve__before_login" href="{{route('login')}}">
              <p>こちらからログイン</p>
            </a>
          <h3>してください。</h3>
        </div>
      @endif
    </div>
  </div>
  <div class="shop_review">
    <div class="shop_review__head">
      @if (count($reviews) >0)
        <p>レビュー数:{{count($reviews)}}件(平均評価：☆{{round($reviews->average('grade'),2)}})</p>
      @endif
      @if(Auth::check())
        <button class="shop_review__post" id="modalOpen" >レビューを書く</button>
      @else
        <a class="shop_review__post" href="{{route('login')}}">レビューを書く<br>(ログイン)</a>
      @endif
    </div>
    @if(Auth::check())
      <div class="shop_review__modal" id="shop_review__modal">
        <div class="shop_review__modal__inner">
          <button id="modalClose" class="closeBtn">×</button>
          <h2>レビュー</h2>
          <div class="shop_review__modal__content">
            <form action="{{route('review')}}" method="post">
              @csrf
              <input type="text" name="user_id" value="{{$user['id']}}" hidden>
              <input type="text" name="shop_id" value="{{$shop['id']}}" hidden>
              <table>
                <tr>
                  <th>
                    ニックネーム
                  </th>
                  <td>
                    {{$user['nickname']}}
                  </td>
                </tr>
                <tr>
                  <th></th>
                  <td>
                    @if ($errors->has('date_time'))
                      <p class="error_message">{{$errors->first('date_time')}}</p>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>
                    <label for=date_time>ご来店日</label>
                  </th>
                  <td>
                    <input type="date" name="date_time" id="date_time">
                  </td>
                </tr>
                <tr>
                  <th></th>
                  <td>
                    @if ($errors->has('grade'))
                      <p class="error_message">{{$errors->first('grade')}}</p>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>
                    <label for="grade">評価(☆1-5)</label>
                  </th>
                  <td>
                    <input type="number" name="grade" id="grade" min="1" max="5">
                  </td>
                </tr>
                <tr>
                  <th></th>
                  <td>
                    @if ($errors->has('grade'))
                      <p class="error_message">{{$errors->first('grade')}}</p>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>
                    <label for="comment">コメント</label>
                  </th>
                  <td>
                    <textarea name="comment" id="comment" cols="40" rows="4"
                    placeholder="コメントを入力してください"></textarea>
                  </td>
                </tr>
              </table>
              <div class="postBtn">
                <button type="submit">書き込む</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endif
    <div class="shop_review__list">
      @if (count($reviews) == 0)
        <p>レビューの投稿がありません</p>
      @else
        <table>
          <tr class="shop_review__t_head">
            <th class="shop_review__date">レビュー日</th>
            <th class="shop_review__nickname">ニックネーム</th>
            <th class="shop_review__date">ご来店日</th>
            <th class="shop_review__grade">評価</th>
            <th class="shop_review__comment">コメント</th>
          </tr>
          @foreach($reviews as $review)
            <tr class="shop_review__t_body">
              <td>
                {{\Carbon\Carbon::parse($review->created_at)->toDateString()}}                      
              </td>
              <td>
                {{$review->user->nickname}}
              </td>
              <td>
                {{\Carbon\Carbon::parse($review->date_time)->toDateString()}}         
              </td>
              <td>☆{{$review->grade}}</td>
              <td class="shop_review__comment">
                  {{$review->comment}}
              </td>
            </tr>
          @endforeach
        </table>
      @endif 
    </div>
  </div>
  <script src="{{ asset('js/detail.js') }}"></script>
</body>
</html>