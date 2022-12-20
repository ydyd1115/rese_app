目的#アプリケーション名:Rese（リーズ）
ある企業のグループ会社の飲食店予約サービス

##作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

##アプリケーションURL
http://13.230.153.221/

##機能一覧
ログイン機能(ユーザー・管理者・店舗代表者)
-ユーザー機能
--予約機能
--予約変更機能
--お気に入り機能
--店舗レビュー機能
--リマインド機能(当日予約確認:QRコード付)

-管理者機能
--店舗代表者登録・編集機能

-店舗代表者機能
--店舗情報編集機能
--予約変更機能
--メール連絡機能

##仕様技術
--Laravel 8.X
-vue.js 2.X
-JavaScript
-Amazon-Web-Service
-MySQL

##テーブル設計
-users
--id unsighned bigiht notnull
--name
--nickname
--email
--password
--created_at
--updated_at

-shops
--id unsighned bigiht notnull
--name
--area
--genre
--comment
--created_at
--updated_at

-likes
--id unsighned bigiht notnull
--user_id
--shop_id
--created_at
--updated_at

-reviews
--id unsighned bigiht notnull
--user_id
--shop_id
--date_time
--grade
--comment
--created_at
--updated_at

-reserves
--id unsighned bigiht notnull
--user_id
--shop_id
--num_of_people
--date_time
--created_at
--updated_at

-administers
--id unsighned bigiht notnull
--name
--role
--email
--password
--created_at
--updated_at

-shops_administers
--id
--administer_id
--created_at
--updated_at

##ER図

##環境構築
-php8.1.12
-php-extention:gd,ImageMagick
-web-server:nginx/1.22.0
-database:mysql(local:ver.15.1)(AWS:ver.8.0.31)
-node:v16.17.1
-nmp:ver8.15

-added package
--"league/flysystem": "^1.1",
--"league/flysystem-aws-s3-v3": "~1.0",
--"league/flysystem-cached-adapter": "~1.0",
--"simplesoftwareio/simple-qrcode": "^4.2"

##その他


