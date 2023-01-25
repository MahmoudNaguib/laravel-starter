## VHR

VHR is a web application for recruitment:
## Setup

```bash
git clone https://github.com/MahmoudNaguib/laravel-starter.git
cd  laravel-starter
cp .env.example .env // Change your configurations
sudo npm install
sudo composer install
sudo chmod -R 777 storage
sudo chmod -R 777 public
php artisan migrate --seed
php artisan serve
```
## To run unit testing
```bash
vendor/bin/phpunit
```

## Translation commands
```bash
php artisan lang:sync
```

## Assets compiling
```bash
npm run production
npm run dev
npm run watch
```



## Default Admin user
```bash
Email: admin@demo.com
Password: demo@12345
```
## Default Guest user
```bash
Email: user1@demo.com
Password: demo@12345
```
## POSTMAN API
```bash
https://documenter.getpostman.com/view/375068/2s8ZDVaPn4

with the below env variables
url: localhost:8000
email: user1@demo.com
password: demo@12345
push_token: anyrandomtext
token: empty
```
## Serving uploads
```bash
{baseURL}/uploads/small/{imageName}
{baseURL}/uploads/large/{imageName}
