# database
Artistの情報を登録・読み出しするアプリケーションです。     
典型的なCRUDアプリの構成になっています。
## Directories構成
App   
│    
┝─Http    
│  　└─Controllers    
│  　　    └─ArtistController.php    
│  　　    └─UserController.php    
│  　　    └─HomeController.php    
│  　　    └─Controller.php    
┝Providers    
│ 　     └─AppServiceProvider.php    
┝Constants    
│ 　     └─CodeDefine.php    
└Repositories    
　　      └─ArtistRepositories.php    
　　      └─ArtistRepositoryInterface.php    
     └─UserRepositories.php    
　　      └─UserRepositoryInterface.php    

### 構成の詳細
- リポジトリにビジネスロジックを入れておき、コントローラーで呼び出して利用する、リポジトリパターンを採用する。
- `Repositories`ディレクトリは自作。
- 作成した`Repositories`は、それぞれ`App\Providers\AppServiceProvider`に登録し、Serviceコンテナに入れておく。

## データの操作
- DBファサード(`DB::table()->method()`みたいなやつ)を利用する
- リポジトリパターンを利用するので、モデルを作成するとビジネスロジックと永続化層がごちゃごちゃとなり、扱いづらい。
- DBファサードの方が、よりSQLライクで扱えてメンテナンスしやすい。


# ライブラリ系コマンド
## Tinker
### Tinkerとは
- 公式ドキュメント : https://readouble.com/laravel/5.4/ja/artisan.html
- デバッガー。対話型シェル(REPL)で、コンソール上からコマンドでデバッグを行える。
### Tinker内コマンド
- `php artisan tinker` : Tinkerの起動
- 基本的な使い方として、PHPコードを書いて結果の取得、DBへの書き込みチェックなどができる。
tinker内
- `Config::get('database.connections.mysql.database');` : DBの設定を取得する。
- `whereami` : 現在の操作位置を表示する。
## artisan
- `php artisan make:migration create_xxxx_table` : マイグレーションファイルを作成する。
- `php artisan migrate` : マイグレーションを実行する。
- `php artisan make:notification [クラス名]` : Notificationクラスを自動で生成する。
- `php artisan event:generate` : Eventクラスの自動生成。

# Laravelのシステム
## Gitによるバージョン管理
何点か、気をつけることがあります。
- `.env`は、`.gitignore`によりクローンを無視されるので、`.env.example`を複製してローカルにあわせます
- `vendor`配下のディレクトリがまるっとないので、composerを利用して補完します。
    - `composer install`で必要なパッケージをまるっと取得します。
- `.env.example`には、アプリ固有のキーを含めないので、ローカルで生成します
    - `php artisan key:generate`を利用すること。
## ServiceProvider
- Serviceコンテナが、各サービスのInterfaceと実装を管理する。
- `AppServiceProvider.php`でサービスコンテナにバインドするリポジトリを定義する。
- 管理するサービスは、Interfaceと実装を一組ずつ分けてバインドする。
- コマンドベースでサービスプロバイダーを自作する場合、作成したプロバイダーにリポジトリをバインドし、かつ`app\config.php`にプロバイダを登録する。
## 通知システム
Laravelでは、デフォルトでメールやSMS、Slackへの通知機能を装備しており、設定をすることで通知を行える。
## ソーシャル認証
### 概要
Socialiteのパッケージを利用して、SNS等のアカウントやServiceと連携した認証を行うことができる。  
このアプリでは、Githubとの連携を行う。
### 設定手順
- Socialiteのインストール
  - `composer require laravel/socialite`
- `config/services.php`に、クライアントIDやリダイレクト先URLを設定する
- `Auth\LoginController`に、認証先のServiceへのリダイレクト、及びユーザ情報取得のメソッドを準備する。
- Github上で、OAuthアプリケーションを登録し、キーとIDを取得する。
