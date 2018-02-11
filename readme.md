# アプリの設計
## 基本構成
`
App   
│   
┝─Http
│  └─Controllers
│      └─ArtistController.php
┝Providers
│      └─AppServiceProvider.php
└Repositories
       └─ArtistRepositories.php
       └─ArtistRepositoryInterface.php
`

- リポジトリにビジネスロジックを入れておき、コントローラーで呼び出して利用する、リポジトリパターンを採用する。
- `Repositories`ディレクトリは自作。
- 作成した`Repositories`は、それぞれ`App\Providers\AppServiceProvider`に登録し、Serviceコンテナに入れておく。

## データの操作
- DBファサード(`DB::table()->method()`みたいなやつ)を利用する
- リポジトリパターンを利用するので、モデルを作成するとビジネスロジックと永続化層がごちゃごちゃとなり、扱いづらい。
- DBファサードの方が、よりSQLライクで扱えてメンテナンスしやすい。


# コマンド
## Tinker
- `php artisan tinker` : Tinkerの起動
***
tinker内
- `Config::get('database.connections.mysql.database');` : DBの設定を取得する。
## MySQL
- `mysql.server start` : MySQLのサーバを起動する。`stop`で停止。
- `create database db_name;`スキーマの作成。
- `drop database db_name;`スキーマの削除。
## Git
- `git remote -v` : 管理しているリモートのリポジトリを表示する。
- `git remote add 【ラベル名】 【リモートリポジトリURI】` : 管理するリモートのリポジトリを追加する。デフォルトのラベル名は`origin`だが、変更可能。
  - git内ではラベルとURIを紐付けてリポジトリを識別している（はず）
## artisan
- `php artisan make:migration create_xxxx_table` : マイグレーションファイルを作成する。
- `php artisan migrate` : マイグレーションを実行する。
