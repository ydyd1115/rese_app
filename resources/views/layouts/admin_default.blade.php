<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_auth.css') }}">
  <title>@yield('title')</title>

</head>
<body>
  <div class="container">
    <div class="container__head">
      <h1>@yield('title')</h1>
    </div>
    <div class="container__body">
      @yield('content')
    </div>
  </div>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>