# requirement #
xampp or php environmet (php > 7.3)
composer


create database news_api_main / news_api_english / news_api_sinhala

# run this command #

composer install (install vendor files)

php artisan migrate:fresh --seed (create tables and insert testing data)

php artisan key:generate (generate app key)

php artisan passport:keys (keys for passsport)

php artisan passport:install (setup passport requirments)

php artisan l5-swagger:generate

# final steps #

if run on virtual host

stop npm run dev
php artisan serve

or else rename server.php -> index.php 
host in linux var/html/www
xampp htdocs

change env file
----------------
get backup from .env.example and rename to .env

db credentials and APP_URL



# swagger Document #
<APP_URL>/api/documentation

