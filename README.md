# 和ダイニング CMS (Laravel 10)

オフィシャルサイトと管理サイトを併せ持つシンプルな CMS 風アプリです。ネットワーク遮断環境で作成したため、依存パッケージは取得していません。インターネットに接続できる環境で `composer install` を実行してください。

## 必要要件
- PHP 8.1+
- Composer
- SQLite (デフォルト) / MySQL (本番想定)

## セットアップ
1. `.env` を作成
```bash
cp .env.example .env
php artisan key:generate
```
2. SQLite ファイルを作成
```bash
mkdir -p database
touch database/database.sqlite
```
3. 依存インストール
```bash
composer install
```
4. マイグレーションと初期データ投入（管理者パスワード: `password`）
```bash
php artisan migrate --seed
```
5. 開発サーバー起動
```bash
php artisan serve
```

## お名前.com 共用サーバーへの配置
- `public` を DocumentRoot にリンクできない場合、`public` ディレクトリの内容を公開ディレクトリにコピーし、`index.php` 内の `require` パスを実際のアプリパスに合わせて編集してください。
- または、公開ディレクトリに `public` へのシンボリックリンクを張り、`.htaccess` のリライトが有効になっていることを確認します。
- `storage` ディレクトリには書き込み権限を付与してください。
