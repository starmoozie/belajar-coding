### Install Requirement
1. php >= 8.1
2. composer
3. mysql

### Installation
1. `composer install`
2. Copy file .env.example menjadi .env
3. Sesuaikan koneksi database pada file `.env`
4. `php artisan migrate --seed`