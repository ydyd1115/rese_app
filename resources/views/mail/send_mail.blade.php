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

    .rese{
      color:#44c;
    }

    .to_name{
      font-size:18px;
      margin:16px 0;
    }

    .to_name span{
      font-weight:600;
    }

    .from_name{
      margin:
    }

    .caution{
      margin:8px
    }

    .message{
      display:inline-block;
      margin:8px 0;
      padding:16px 5%;
      border:dashed 2px #cacaca;
      font-size:14px;
      width:60%;
    }

    .shop_info{
      padding:8px 4px;
      border-top:solid 1px #333;
    }
  </style>
  <title>Reseよりお知らせ</title>
</head>
<body>
  <header>
    <h1><span class="rese">Rese</span>よりお知らせ</h1>
  </header>
  <main>
    <div class="to_name">

    </div>
    <div class="from_name">
      <h2>『{{$shop_name}}』様より
        <br>メッセージをお預かりしております</h2>
        <p>
    </div>
    <div class="message">
      <p>件名：{{$mail_title}}</p>
      <p>{{$msg}}</p>
      <div class="shop_info">
        <div class="caution">
          ※このメッセージは送信用アドレスから送信されています。<br>
          　ご返信はメール下部のご連絡先へお願いします。
        </p>
        </div> 
        <p>店舗名：{{$shop_name}}</p>
        <p>e-mail:{{$shop_email}}<br></p>
      </div>
    </div>
  </main>
</body>
</html>
