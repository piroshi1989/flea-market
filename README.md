#アプリケーション名  
flea-market  
メルカリ風フリマサイトのwebアプリケーション  
商品出品、購入などができる  
お気に入り機能、決済機能など搭載  
  
![image](https://github.com/piroshi1989/flea-market/assets/123999429/fce8be5e-91b4-4dea-8936-b8c2acecf185)
  
  
##作成した目的  
COACHTECH フリマサービス模擬案件  
  
##アプリケーションURL  
http://ec2-18-177-5-172.ap-northeast-1.compute.amazonaws.com  
  
##他のリポジトリ  
なし  
  
##機能一覧  
・会員登録  
・ログイン  
・ログアウト  
・商品一覧取得  
・商品詳細取得  
・ユーザー商品お気に入り一覧取得  
・ユーザー情報取得  
・ユーザ購入商品一覧取得  
・ユーザ出品商品一覧取得  
・プロフィール変更  
・商品お気に入り追加  
・商品お気に入り削除  
・商品コメント追加 
・商品コメント削除  
・出品  
・購入  
・stripe決済  
・配送先変更  
・管理者権限作成  
・メール送信
・商品表示選択機能  
(販売中のみ表示される)  
・商品表示並び替え機能  
・レスポンシブデザイン(ブレイクポイント768px)  
・グラフ表示機能  
(商品が購入された件数を時間別でグラフ表示する)  
・検索機能(キーワード、ブランド、カテゴリーで検索)  
・ユーザーフォロー機能  
  
##使用技術  
Laravel 8.75  
PHP 7.4.33  
mysql 8.0.33  
nginx 1.12.2  
  
##テーブル設計  
![image](https://github.com/piroshi1989/flea-market/assets/123999429/3be32db0-540f-464a-b698-670f52e4e35c)  
![image](https://github.com/piroshi1989/flea-market/assets/123999429/df0c6599-b738-431e-8f86-91af15ee6ad8)  
![image](https://github.com/piroshi1989/flea-market/assets/123999429/937e33a4-6f16-4704-9c72-cca3feee340a)  
![image](https://github.com/piroshi1989/flea-market/assets/123999429/f7c7fad4-b5d5-49f2-80c0-57f4d13e8dca)  
  
##ER図  
![image](https://github.com/piroshi1989/flea-market/assets/123999429/a1bd4bb9-314b-49c4-b283-ac569d2f7bf0)  
  
##環境構築  
dockerでの環境構築  
//コマンドライン上で以下のコマンドを入力  
$ git clone git@github.com:piroshi1989/flea-market.git  
$ docker-compose up -d --build  
$ docker-compose exec php bash  
//PHPコンテナ上で以下のコマンドを入力  
$ composer install  
$ composer require stripe/stripe-php  
$ composer require league/flysystem-aws-s3-v3 ^1.0  
$ cp .env.example .env  
$ cp .env.example .env.testing  
$ php artisan key:generate  
$ php artisan key:generate --env=testing  
$ php artisan migrate  
$ php artisan db:seed  
$ php artisan migrate --env=testing  
$ php artisan db:seed --env=testing  
$ exit  
  
envファイルの以下の項目を修正  
DB_HOST=mysql  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass  
STRIPE_PUBLIC_KEY=pk_test_51xxxxxxxxxxxxxxxxxxx  
STRIPE_SECRET_KEY=sk_test_51xxxxxxxxxxxxxxxxxxx  
*51以下は任意のkeyを入力  
  
EC2での環境構築  
$ sudo yum update  
$ sudo yum install git  
//sshキー作成
$ ssh-keygen -t rsa -b 4096  
$ cat ~/.ssh/id_rsa.pub  
//GithubのSSH keyに登録  
$ git clone git@github.com:piroshi1989/flea-market.git  
$ sudo yum install -y docker  
$ sudo service docker start  
$ sudo usermod -aG docker ec2-user  
$ sudo mkdir -p /usr/local/lib/docker/cli-plugins  
$ sudo curl -SL https://github.com/docker/compose/releases/download/v2.4.1/docker-compose-linux-x86_64 -o /usr/local/lib/docker/cli-plugins/docker-compose  
$ sudo chmod +x /usr/local/lib/docker/cli-plugins/docker-compose  
$ sudo systemctl status docker  
$ docker compose up -d  
$ docker compose exec php bash  
//PHPコンテナ上で以下のコマンドを入力  
$ composer install  
$ composer require stripe/stripe-php  
$ composer require league/flysystem-aws-s3-v3 --with-all-dependencies  
$ cp .env.example .env  
$ cp .env.example .env.testing  
$ php artisan key:generate  
$ php artisan key:generate --env=testing  
$ exit  
  
//RDSの設定 mysqlコンテナ上で以下のコマンドを入力  
$ docker compose exec mysql bash  
$ mysql -h <RDSのエンドポイント> -P 3306 -u admin -p  
$ CREATE DATABASE laravel_db;  
$ CREATE DATABASE demo_test;  
  
//.envを修正  
//RDS
DB_CONNECTION=mysql  
DB_HOST=RDSのエンドポイント  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=RDSのuser  
DB_PASSWORD=RDSのpass  
//stripe  
STRIPE_PUBLIC_KEY=pk_test_51xxxxxxxxxxxxxxxxxxx  
STRIPE_SECRET_KEY=sk_test_51xxxxxxxxxxxxxxxxxxx  
//s3  
AWS_ACCESS_KEY_ID=#ここにアクセスキーを入れます#  
AWS_SECRET_ACCESS_KEY=#ここにシークレットキーを入れます#  
AWS_DEFAULT_REGION=ap-northeast-1 #東京リージョンを指定します。  
AWS_BUCKET=#バケット名を入れます#  
AWS_USE_PATH_STYLE_ENDPOINT=false  
  
//.env.testingを修正  
APP_ENV=test  
  
DB_CONNECTION=mysql  
DB_HOST=RDSのエンドポイント  
DB_PORT=3306  
DB_DATABASE=demo_test  
DB_USERNAME=RDSのuser  
DB_PASSWORD=RDSのpass  
//stripe  
STRIPE_PUBLIC_KEY=pk_test_51xxxxxxxxxxxxxxxxxxx  
STRIPE_SECRET_KEY=sk_test_51xxxxxxxxxxxxxxxxxxx  
//s3  
AWS_ACCESS_KEY_ID=#ここにアクセスキーを入れます#  
AWS_SECRET_ACCESS_KEY=#ここにシークレットキーを入れます#  
AWS_DEFAULT_REGION=ap-northeast-1 #東京リージョンを指定します。  
AWS_BUCKET=#バケット名を入れます#  
AWS_USE_PATH_STYLE_ENDPOINT=false  
  
//phpコンテナ上で以下のコマンドを入力  
$ docker compose exec php bash  
$ php artisan migrate  
$ php artisan db:seed  
$ php artisan migrate --env=testing  
$ php artisan db:seed --env=testing  
$ exit  


##他に記載することがあれば記述する
・アカウントの種類
テストユーザー  
mail:a@gmail.com password:password  
mail:b@gmail.com password:password  
mail:c@gmail.com password:password  
mail:d@gmail.com password:password  
mail:e@gmail.com password:password  
  
管理者  
mail:f@gmail.com  password:password  
  
・追加実装項目の環境の切り分けではテスト環境用のEC2インスタンスを作成しました
RDSは別のインスタンスを接続しました  
テスト:http://ec2-3-113-123-157.ap-northeast-1.compute.amazonaws.com  
  
・EC2上では.envのmail関連は設定していません。ですので、新規ユーザー作成の場合、認証はURLの末尾に:8080を追加してphpmyadminで直接入力をお願いします。  
