# grtech
Online Test

# How to running this project on your local pc
1. create your database on local then config on your .env file like you want, this is in my .env config file
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=grtech
    - DB_USERNAME=root
    - DB_PASSWORD=

    - MAIL_MAILER=smtp
    - MAIL_HOST=smtp.googlemail.com
    - MAIL_PORT=465
    - MAIL_USERNAME=denmas.yono@gmail.com
    - MAIL_PASSWORD=testing
    - MAIL_ENCRYPTION=null
    - MAIL_FROM_ADDRESS=null
    - MAIL_FROM_NAME="${APP_NAME}"
    
2. git clone https://github.com/taryono/grtech.git on your local pc running web server
3. composer update if running well then 
4. php artisan migrate:refresh --seed


