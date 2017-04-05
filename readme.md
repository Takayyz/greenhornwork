
- Use
  - PHP : Version 7.0.*
  - Mysql : Version 5.7.* 


```shell
git clone http://gitbucket.gizumo-inc.work:8080/products/greenhorn_works.git
composer install
cp .env{.env.example}
# .env ファイルの編集を行い、以下を追記してください。
# MAIL_ADDRESSPASS=some_word
# MAIL_PRIVILEGES=some_word
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

http://127.0.0.1:8000
