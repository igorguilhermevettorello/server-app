# server-app

Backend desenvolvido em PHP 7.4.9

- git clone git@github.com:igorguilhermevettorello/server-app.git
- cd server-app
- composer i
- cria database no mysql
- cria arquivo .env com base no .env.example
DB_CONNECTION=mysql
DB_HOST=[host]
DB_PORT=[porta]
DB_DATABASE=[base]
DB_USERNAME=[usuario]
DB_PASSWORD=[senha]

- php artisan migrate
- php -S localhost:8080 -t public
- acessa a url: http://localhost:8080/api