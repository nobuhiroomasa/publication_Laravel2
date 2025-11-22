# 和ダイニング CMS (Laravel 10)

オフィシャルサイトと管理サイトを併せ持つシンプルな CMS 風アプリです。ネットワーク遮断環境で作成したため、依存パッケージは取得していません。インターネットに接続できる環境で `composer install` を実行してください。

## 必要要件
- PHP 8.1+
- Composer
- SQLite (デフォルト) / MySQL (本番想定)

### PHP / Composer のインストール例（macOS/Homebrew）
`php` コマンドが見つからない場合は、以下のように Homebrew で PHP と Composer を入れてください。

```bash
# Homebrew が未インストールの場合は https://brew.sh の手順で追加
brew install php composer

# 端末を再起動するか、必要に応じて PATH を更新
echo 'export PATH="/opt/homebrew/bin:$PATH"' >> ~/.zprofile
source ~/.zprofile

# インストールを確認
php -v
composer -V
```

#### Homebrew でエラーになった場合の対処
Homebrew の一時 Ruby などが展開できず `Write failed` や `Can't create` が大量に表示される場合は、
Homebrew ディレクトリのパーミッションが崩れている可能性があります。以下を試してください。

```bash
# Homebrew の prefix を確認（Apple Silicon は /opt/homebrew、Intel は /usr/local が多い）
brew --prefix

# 書き込み権限を修正（パスは上記結果に置き換え）
sudo chown -R "$(whoami)" $(brew --prefix)/*

# 不整合を検出
brew doctor

# 再度インストール
brew install php composer
```

`brew install` 中に「Warning: Building composer from source: The bottle (and many others) needs to be installed into /opt/homebrew.」
と表示された場合、Homebrew のインストール先とボトルの想定プレフィックスが一致していません。Apple Silicon なら
`/opt/homebrew` に、Intel Mac なら `/usr/local` に Homebrew があることを確認し、必要に応じて公式手順で再インストールしてください
（`brew config` でプレフィックスを確認できます）。

##### sudo のパスワードが分からない場合
- `sudo` で求められるパスワードは macOS ログイン時のユーザーパスワードです（Homebrew 独自のものではありません）。
- 入力が通らない場合は、別の管理者ユーザーでログインしてパスワードを変更するか、Apple メニュー → **システム設定** → **ユーザとグループ** → **パスワードを変更** からリセットしてください。
- 管理者権限がないユーザーでは `sudo chown` が実行できないため、その場合は管理者アカウントで実行する必要があります。

##### 「No space left on device @ rb_sysopen - ...」が出る場合
- Homebrew のキャッシュがディスクを圧迫している可能性があります。
- 十分な空き容量（最低でも数 GB）を確保してから再実行してください。
- まずキャッシュを削除し、再度 `brew doctor` や `brew install` を試します。

```bash
# Homebrew のキャッシュ削除（問題ないが時間短縮のため最近のダウンロードは残す場合は --prune なども可）
brew cleanup -s
rm -rf "$(brew --cache)"

# ディスク使用量の確認例
df -h /

# 再度状態確認
brew doctor
```

- `Command Line Tools` の更新警告が出ている場合は、`ソフトウェア・アップデート` か `sudo xcode-select --install` で最新化してから再試行します。

##### 「Your Command Line Tools (CLT) does not support macOS 14.」が出る場合
- **フルの Xcode アプリは不要** で、コマンドライン開発に必要なのは Command Line Tools だけです（サイズも数百 MB 程度）。
- インストール済みの Command Line Tools が古いか破損しています。以下の手順でクリーンアップ後に再インストールしてください。

```bash
sudo rm -rf /Library/Developer/CommandLineTools
sudo xcode-select --install
# インストール後に確認
xcode-select -p
```
- もしソフトウェア・アップデートで新しい CLT が見つからない場合は、Apple の開発者ダウンロードサイトから対象 macOS 用の
「Command Line Tools for Xcode 16.2」などの最新パッケージを手動で取得してインストールします。
- `xcode-select` は macOS 標準のコマンドラインユーティリティで、Xcode や Command Line Tools の「有効なインストール先」を切り替えるためのものです。
  Visual Studio Code とは無関係で、VS Code を使っていても CLI 開発ツールは別途インストール・更新する必要があります。

## セットアップ
1. `.env` を作成
```bash
cp .env.example .env
```
2. 依存インストール（`vendor/autoload.php` がなくエラーになる場合は必ず実行）
```bash
composer install
```
   - `database/factories` は Composer のクラスマップ対象なので、空でも削除しないでください。
   - `vendor/autoload.php` が見つからないエラーが出る場合は、**必ずこのリポジトリのルート（`composer.json` と同じ場所）で**
     `composer install` を実行してください。以前のインストールに失敗していた場合は、`rm -rf vendor composer.lock` で削除してから
     再実行するとクリーンな状態になります。
3. アプリキー生成
```bash
php artisan key:generate
```
4. SQLite ファイルを作成
```bash
mkdir -p database
touch database/database.sqlite
```
5. マイグレーションと初期データ投入（管理者パスワード: `password`）
```bash
php artisan migrate --seed
```
6. 開発サーバー起動
```bash
php artisan serve
```

## お名前.com 共用サーバーへの配置
- `public` を DocumentRoot にリンクできない場合、`public` ディレクトリの内容を公開ディレクトリにコピーし、`index.php` 内の `require` パスを実際のアプリパスに合わせて編集してください。
- または、公開ディレクトリに `public` へのシンボリックリンクを張り、`.htaccess` のリライトが有効になっていることを確認します。
- `storage` ディレクトリには書き込み権限を付与してください。
