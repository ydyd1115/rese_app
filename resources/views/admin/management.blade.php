<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/management.css') }}">
  <title>店舗代表者ページ</title>
</head>
<body>
  <header>
    <h1>店舗代表者ページ</h1>
    <div class="auth_info">
      <p>ログイン中：{{Auth::guard('admin')->user()->name}}</p>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <x-dropdown-link class="logout_btn" 
        :href="route('admin.logout')"
        onclick="event.preventDefault();
        this.closest('form').submit();">
        ログアウト
        </x-dropdown-link>
      </form>
    </div>
  </header>
  <main>
    <section class="shop_info">
      <h2 class="shop_info__head">店舗情報</h2>
      <div class="shop_info__content">
        <div class="shop_info__content__texts">
          <p>店舗名:{{$shop['name']}}</p>
          <div class="shop_info__content__tags">
            <p>ジャンル:{{$shop['genre']}}</p>
            <p>エリア:{{$shop['area']}}</p>
          </div>
          <div class="shop_info__content__comment">
            <p>コメント:
            <p>{{$shop['comment']}}</p>
          </div>
          <div class="shop_info__content__edit">
            <button class="modal_open_btn" id="shop_edit__openBtn">テキスト編集</button>
          </div>
          <div class="shop_info__image_up">
            <form 
            action="{{route('admin.img_up',['id'=> $shop['id']])}}" 
            method="post" enctype="multipart/form-data">
            <h3>画像を変更</h3>
              @csrf
              <div class="postBtn">
                <input type="file" name="file"><br>
                <button type="submit">画像を更新</button>
              </div>
            </form>
          </div>
        </div>
        <img class="shop_info__content__img" src="{{$shop['image_URL']}}" alt="{{$shop['name']}}">
      </div>
      <div class="shop_edit__modal" id="shop_edit__modal">
        <div class="shop_edit__modal__inner">
          <div class="close">
            <button class="closeBtn" id="shop_edit__closeBtn">×</button>
          </div>
          <h2>店舗情報編集</h2>
          <div class="shop_edit__modal__content">
            <form  action="{{route('admin.update_shop',['id'=> $shop['id']])}}" method="post">
              @csrf
              <table  class="shop_edit__modal__table">
                @if($errors->has('name'))
                <tr>
                  <th></th>
                  <td class="error_message">
                    {{$errors->first('name')}}
                  </td>
                </tr>
                @endif
                <tr>
                  <th><label for="name">店舗名</label></th>
                  <td>
                    <input type="text" name="name" id="name" value="{{$shop['name']}}">
                  </td>
                </tr>
                @if($errors->has('genre'))
                <tr>
                  <th></th>
                  <td class="error_message">
                    {{$errors->first('genre')}}
                  </td>
                </tr>
                @endif
                <tr>
                  <th><label for="genre">ジャンル</label></th>
                  <td>
                    <input type="text" name="genre" id="genre" value="{{$shop['genre']}}">
                  </td>
                </tr>
                @if($errors->has('area'))
                <tr>
                  <th></th>
                  <td class="error_message">
                    {{$errors->first('area')}}
                  </td>
                </tr>
                @endif
                <tr>
                  <th><label for="area">エリア</label></th>
                  <td>
                    <input type="text" name="area" id="area" value="{{$shop['area']}}">
                  </td>
                </tr>
                @if($errors->has('comment'))
                <tr>
                  <th></th>
                  <td class="error_message">
                    {{$errors->first('comment')}}
                  </td>
                </tr>
                @endif
                <tr class="shop_edit__comment">
                  <th><label for="comment">コメント</label></th>
                  <td>
                    <textarea name="comment" id="comment" cols="40" rows="6">{{$shop['comment']}}
                      </textarea>
                    </td>
                  </tr>
              </table>
              <input type="text" name="image_URL" id="image_URL" value="{{$shop['image_URL']}}" hidden>
              <div class="postBtn">
                <button type="submit">更新</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    @if (count($errors) > 0)
    <div class="error_message">
      <p>入力に問題がありました。
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <section class="reserve_list">
      <h2>予約編集</h2>
      @if(count($reserves) >0)
      <div class="reserve_edit">
        <table class="reserve_edit__table">
          <tr class="reserve_edit__table__head">
            <th class="reserve_edit__table__date">予約日</th>
            <th class="reserve_edit__table__time">時間</th>
            <th class="reserve_edit__table__name">お名前</th>
            <th class="reserve_edit__table__number">人数</th>
            <th>更新</th>
            <th>削除</th>
            <th>連絡</th>
          </tr>
          @foreach($reserves as $reserve)
          <tr>
            <form action="{{route('admin.update_reserve',['id' => $reserve->id])}}" method="post">
              @csrf
              <input type="text" name="shop_id" value="{{$shop['id']}}" hidden>
              <input type="text" name="user_id" value="{{$reserve['user_id']}}" hidden>
              <td class="reserve_edit__table__date">
                <input type="date" name="date" 
                value="{{\Carbon\Carbon::parse($reserve->date_time)->toDateString()}}">
              </td>
              <td class="reserve_edit__table__time">
                <input type="time" name="time"
                value="{{\Carbon\Carbon::parse($reserve->date_time)->toTimeString()}}">
              </td>
              <td class="reserve_edit__table__name">
                <input type="text" name="user_id" value="{{$reserve->user_id}}" hidden>{{$reserve->user->name}} 様
              </td>
              <td class="reserve_edit__table__number">
                <input type="number" name="number" value="{{$reserve->number}}">
              </td>
              <td class="reserve_edit__table__update">
                <button class="edit_btn" type="submit">更新</button>
              </td>
            </form>
            <td class="reserve_edit__table__update">
              <form action="{{route('admin.delete_reserve',['id' => $reserve->id])}}" method="post">
                @csrf
                <button class="edit_btn" type="submit">削除</button>
              </form>
            </td>
            <td class="reserve_edit_Auth_table__mail">
              <button class="edit_btn" id="send_mail__openBtn">連絡</button>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      <div class="send_mail__modal" id="send_mail__modal">
        <div class="send_mail__modal__inner">
          <div class="close">
            <button class="closeBtn" id="send_mail__closeBtn">×</button>
          </div>
          <h2>メッセージ作成</h2>
          <div class="send_mail__modal__content">
            <form  action="{{route('admin.send_mail')}}" method="post">
              @csrf
              <table  class="send_mail__modal__table">
                  <th><label for="user_name">送信先</label></th>
                  <td>
                    <input type="text" name="user_name" id="user_name" value="{{$reserve->user->name}}">様
                    <input type="text" name="user_email" value="{{$reserve->user->email}}"  hidden>
                  </td>
                </tr>
                @if($errors->has('mail_title'))
                <tr>
                  <th></th>
                  <td class="error_message">
                    {{$errors->first('mail_title')}}
                  </td>
                </tr>
                @endif
                <tr>
                  <th><label for="mail_title">件名</label></th>
                  <td>
                    <input type="text" name="mail_title" id="mail_title" value="{{old('mail_title')}}">
                  </td>
                </tr>
                @if($errors->has('message'))
                <tr>
                  <th></th>
                  <td class="error_message">
                    {{$errors->first('message')}}
                  </td>
                </tr>
                @endif
                <tr class="send_mail__comment">
                  <th><label for="msg" >メッセージ</label></th>
                  <td>
                    <textarea name="msg" id="msg" cols="40" rows="6"></textarea>
                    </td>
                  </tr>
              </table>
              <input type="text" name="shop_name" value="{{$shop['name']}}" hidden>
              <input type="text" name="shop_email" value="{{Auth::guard('admin')->user()->email}}" hidden>
              <div class="postBtn">
                <button type="submit">送信</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @else
      <p>予約はありません</p>
      @endif
    </section>
  </main>
  <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html