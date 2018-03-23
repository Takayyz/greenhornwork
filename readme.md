
- Use
  - PHP   : Version >= 7.0.*
  - Mysql : Version >= 5.7.*
  - Node  : Version >= v8.9.*

installation guide
----

```shell
git clone http://gitbucket.gizumo-inc.work:8080/products/greenhorn_works.git
cd greenhorn_works

# .env fileの作成
cp .env{.example,}
composer install

```

#### env fileの編集・追記

```
# 各自自身でDBを作成し自身の環境にあった物に変更してください
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user_name
DB_PASSWORD=your_db_user_password

# 以下を追記してください。
MAIL_ADDRESSPASS=some_word
MAIL_PRIVILEGES=some_word
ACCESS_RIGHT_ADMIN=100
ACCESS_RIGHT_USER=010
ACCESS_RIGHT_STORE=001
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_FROM_NAME=Greenhorn_works
MAIL_FROM_ADDRESS=atsushi0202test@gmail.com
MAIL_USERNAME=atsushi0202test@gmail.com
MAIL_PASSWORD=hwrtwvrqwnvybxlv
MAIL_ENCRYPTION=ssl
MAIL_PRETEND=false
SLACK_KEY=42620444977.204696413047
SLACK_SECRET=b90b7ef77a8b8d9a28b102d47a0a2705
SLACK_REDIRECT_URI=http://127.0.0.1:8000/callback

```

### アプリケーション起動

```shell
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Access URL
> http://127.0.0.1:8000


### UIを編集する際は、以下コマンドを実行しresource/assets/css以下を変更すること
```shell
npm install
npm run dev
```


### Git Rule 

- branch name
  - branch作成する前に必ずdevelopを最新状態にしてからbranch作成をすること
  - Readmineのチケットのトラッカー名に依存します
  - Feature  >> feature_チケットNo

- Commit Comment
  - 日本語で書くようにしてください
  - チケット内容に付随する修正した内容、編集したファイル名を書くこと
  - 末尾に必ず日付を書くようにしてください
  - feature_**  : comment >  User作成の編集をしました。 2017-mm-dd

- commitからpush > pull requestの流れ
  - addする際、`必ず`file名を指定すること
  - commitする際は、`必ず`コメントを上記の例のように記載すること
  - pushする際は、作業Branchをpushすること
  - pushしたらdevelop branchに対してpull requestすること
  - merge処理は、北原に依頼すること `絶対に自身でmerge処理をしないこと`
