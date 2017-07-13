
- Use
  - PHP : Version 7.0.*
  - Mysql : Version 5.7.* 

### installation guide


```sh
git clone http://gitbucket.gizumo-inc.work:8080/products/greenhorn_works.git
cd greenhorn_works
cp .env{.example,} # 自身の環境に合わせて変更してください
composer install

# .env ファイルの編集を行い、以下を追記してください。
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

# mysqlの設定に関しても各自の環境等々に変更してください
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Access URL
> http://127.0.0.1:8000

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
 
