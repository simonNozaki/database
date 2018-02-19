# アプリケーションの設計
## 基本構成
### Directories
App   
│    
┝─Http    
│  　└─Controllers    
│  　　    └─ArtistController.php    
┝Providers    
│ 　     └─AppServiceProvider.php    
└Repositories    
　　       └─ArtistRepositories.php    
　　       └─ArtistRepositoryInterface.php    

### 構成の詳細
- リポジトリにビジネスロジックを入れておき、コントローラーで呼び出して利用する、リポジトリパターンを採用する。
- `Repositories`ディレクトリは自作。
- 作成した`Repositories`は、それぞれ`App\Providers\AppServiceProvider`に登録し、Serviceコンテナに入れておく。

## データの操作
- DBファサード(`DB::table()->method()`みたいなやつ)を利用する
- リポジトリパターンを利用するので、モデルを作成するとビジネスロジックと永続化層がごちゃごちゃとなり、扱いづらい。
- DBファサードの方が、よりSQLライクで扱えてメンテナンスしやすい。


# コマンド
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
## MySQL
### コマンド
- `mysql.server start` : MySQLのサーバを起動する。`stop`で停止。
### SQL文
#### DML(Database Manipulation Language)
- `CREATE DATABASE db_name;`スキーマの作成。
- `DROP DATABASE db_name;`スキーマの削除。
- `ALTER db_table ADD COLUMN column_name data_info` : カラムの追加。ALTER文で、テーブルの仕様を変更できる。
## Git
### Gitコマンド
- `git log` : コミットの履歴を表示。過去コミットを参照するときに使う。
- `git reflog` : これまでに行ったブランチの切替履歴を表示する。IDやHEADを参照できる。
- `git remote -v` : 管理しているリモートのリポジトリを表示する。
- `git remote add 【ラベル名】 【リモートリポジトリURI】` : 管理するリモートのリポジトリを追加する。デフォルトのラベル名は`origin`だが、変更可能。
  - git内ではラベルとURIを紐付けてリポジトリを識別している（はず）
  - 初期化したGitのDirectoryで、このコマンドを行うとリモートのリポジトリを作成した後でもGitの管理対象にできる。
- `git push origin 【ブランチ名】` : ローカルブランチをリモートにプッシュする。
- `git reset --hard [commit ID]` : コミットしたところまで戻す。
### Notice
- ローカルのブランチもリモートにプッシュすることで、ローカルとリモートで保存の状況を揃える。
## artisan
- `php artisan make:migration create_xxxx_table` : マイグレーションファイルを作成する。
- `php artisan migrate` : マイグレーションを実行する。
- `php artisan make:notification [クラス名]` : Notificationクラスを自動で生成する。
- `php artisan event:generate` : Eventクラスの自動生成。

# Laravelのシステム
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
