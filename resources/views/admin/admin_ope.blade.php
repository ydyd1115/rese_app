<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_ope.css') }}">
  <title>管理者ページ</title>
</head>
<body>
  <header>
    <h1>管理者ページ</h1>
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
    <section class="manager_register">
      <h2>店舗代表登録</h2>
      <div class="manager_register__form">
        <form action="{{route('admin.add_manager')}}" method="post">
          <div class="manager_register__btn">
            <button class="admin_btn" type="submit">登録</button>
          </div>
          @csrf
          <input type="number" name="role" value="2" hidden>
          <table class="manager_register__table">
            <tr>
              <th>
                店舗名
              </th>
              <td>
                <select name="shop_name">
                  @foreach($shops as $shop)
                    <option value="{{$shop->name}}">
                      {{$shop->name}}
                    </option>
                  @endforeach
                </select>
              </td>
            </tr>
            @if($errors->has('family_name'))
              <tr>
                <th></th>
                <td class="error_message">
                  {{$errors->first('family_name')}}
                </td>
              </tr>
            @endif
            <tr>
              <th>
                <label for="family_name">姓</label>
              </th>
              <td class="manager_register__table__name">
                <input type="text" name="family_name" id="family_name">
              </td>
            </tr>
            @if($errors->has('first_name'))
              <tr>
                <th></th>
                <td class="error_message">
                  {{$errors->first('first_name')}}
                </td>
              </tr>
            @endif
            <tr>
              <th>
                <label for="first_name">名</label>
              </th>
              <td class="manager_register__table__name">
                <input type="text" name="first_name" id="first_name">
              </td>
            </tr>
            @if($errors->has('email'))
              <tr>
                <th></th>
                <td class="error_message">
                  {{$errors->first('email')}}
                </td>
              </tr>
            @endif
            <tr>
              <th>
                <label for="email">メールアドレス</label>
              </th>
              <td>
                <input type="email" name="email" id="email">
              </td>
            </tr>
            @if($errors->has('password'))
              <tr>
                <th></th>
                <td class="error_message">
                  {{$errors->first('password')}}
                </td>
              </tr>
            @endif
            <tr>
              <th>
                <label for="password">パスワード</label>
              </th>
              <td>
                <input type="password" name="password" id="password">
              </td>
            </tr>
          </table>
        </form>    
      </div>
    </section>
    <section class="manager_list">
      <h2>店舗代表編集</h2>
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
      <div class="manager_edit">
        <table class="manager_edit__table">
          <tr class="manager_edit__table__head">
            <th class="manager_edit__table__shop">店舗</th>
            <th class="manager_edit__table__family_name">姓</th>
            <th class="manager_edit__table__first_name">名</th>
            <th class="manager_edit__table__email">メールアドレス</th>
            <th>更新</th>
            <th>削除</th>
          </tr>
          @foreach($managers as $manager)
            <tr>
              <form action="{{route('admin.update_manager',['id' => $manager->id])}}" method="post">
                @csrf
                <input type="text" name="password" value="{{$manager->password}}" hidden>
                <td class="manager_edit__table__shop">
                  <select name="shop_id">
                    @foreach($shops as $shop)
                      @if($shop->id === $manager->shopAdmin->shop_id)
                        <option value="{{$shop->id}}" selected>{{$shop->name}}</option>
                      @else
                        <option value="{{$shop->id}}">{{$shop->name}}</option>
                      @endif
                    @endforeach
                  </select>
                </td>
                <td class="manager_edit__table__family_name">
                  <input type="text" name="m_family_name" value="{{explode(' ',$manager->name)[0]}}">
                </td>
                <td class="manager_edit__table__first_name">
                  <input type="text" name="m_first_name" value="{{explode(' ',$manager->name)[1]}}">
                </td>
                <td class="manager_edit__table__email">
                  <input type="email" name="m_email" value="{{$manager->email}}">
                </td>
                <td>
                  <button class="edit_btn" type="submit">更新</button>
                </td>
              </form>
              <td>
                <form action="/delete_manager/?id={{$manager->id}}" method="post">
                  @csrf
                  <button class="edit_btn" type="submit">削除</button>
                </form>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </section>
  </main>
</body>
</html>