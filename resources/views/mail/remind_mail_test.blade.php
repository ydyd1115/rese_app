<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <style>
    body{
      color:#555;
      margin:24px 8px;
      text-align:center;
    }

    h1{
      font-size:24px;
      height:40px;
    }

    p{
      line-height:24px;
    }

    .caution{
      margin:8px
    }

    .reserve_info{
      display:inline-block;
      margin:8px 0;
      padding:16px 5%;
      border:dashed 2px #cacaca;
      font-size:14px;
      width:60%;
    }

  </style>
  <title>ご予約の確認</title>
</head>
<body>
  @foreach($reserves as $reserve)
  <header>
    <h1>本日はご予約当日です。</h1>
    <div class="greeting">
      <h3>{{$reserve['user']->name}}様のご来店をお待ちしております。</h3>
    </div> 
    <div class="coution">
      <p>※送信用アドレスからメール送信しております。<br>
    </div>
  </header>
  <main>
    <div class="reserve_info">
      <h3>ご予約店舗『{{$reserve['shop']->name}}』</h3>
      <h2>[ご予約日時]<br>
      {{\Carbon\Carbon::parse($reserve['date_time'])->month}}月
      {{\Carbon\Carbon::parse($reserve['date_time'])->day}}月
      {{\Carbon\Carbon::parse($reserve['date_time'])->hour}}時
      {{\Carbon\Carbon::parse($reserve['date_time'])->minute}}分
      </h2>

      {{QrCode::format('svg')->generate($reserve->id)}}
    </div>
</main>
@endforeach
</body>
</html>
