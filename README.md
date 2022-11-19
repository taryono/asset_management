# asset
Online Test

# How to running this project on your local pc
1. create your database on local then config on your .env file like you want, this is in my .env config file
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=asset
    - DB_USERNAME=root
    - DB_PASSWORD=

    - MAIL_MAILER=smtp
    - MAIL_HOST= 
    - MAIL_PORT=465
    - MAIL_USERNAME= 
    - MAIL_PASSWORD=testing
    - MAIL_ENCRYPTION=null
    - MAIL_FROM_ADDRESS=null
    - MAIL_FROM_NAME="${APP_NAME}"
    
2. git clone https://github.com/taryono/asset_management.git on your local pc running web server
3. composer update if running well then 
4. php artisan migrate:refresh --seed


