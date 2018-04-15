# duskについて
Laravelでのブラウザテスト用ライブラリ。  
Controllerクラスなど、画面上でのユーザ操作をテストケースとしてテストする際に利用する。  

# 設定方法
1. `composer.json`に設定を追加する
`composer.json`に、`"laravel/dusk": "^2.0"`を追加する。  
2. パッケージのインストール
`composer update`を実行。  
3. ServiceProviderに登録する
`Providers\AppServiceProvider.php`に、  
`if ($this->app->environment('local', 'testing')) {`
`            $this->app->register(DuskServiceProvider::class);`
`        }`  
と  
`use Laravel\Dusk\DuskServiceProvider;`をそれぞれ追加する。
4. テストクラスの作成
`php artisan dusk:install`を実行し、テストケース、クラスを自動生成します。  
5. テストの実行
`php artisan dusk`で、テストを実行します。
