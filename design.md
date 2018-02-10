# アプリの設計
## 基本構成
`
App   
│   
┝─Http
│　　　　　　└─Controllers
│      └─ArtistController.php
┝Providers
│      └─AppServiceProvider.php
└Repositories
　　　　　　 └─ArtistRepositories.php
    └─ArtistRepositoryInterface.php
`
### 構成の説明
- リポジトリにビジネスロジックを入れておき、コントローラーで呼び出して利用する、リポジトリパターンを採用する。
- `Repositories`ディレクトリは自作。
- 作成した`Repositories`は、それぞれ`App\Providers\AppServiceProvider`に登録し、Serviceコンテナに入れておく。

## データの操作
- DBファサード(`DB::table()->method()`みたいなやつ)を利用する
- リポジトリパターンを利用するので、モデルを作成するとビジネスロジックと永続化層がごちゃごちゃとなり、扱いづらい。
- DBファサードの方が、よりSQLライクで扱えてメンテナンスしやすい。
