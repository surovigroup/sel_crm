# Laravel web app starting point

### Following packages/Libraries used
- [Laravel Permission by Spatie](https://github.com/spatie/laravel-permission)
- [Modular Admin Html](https://github.com/modularcode/modular-admin-html)

### Installation Instruction
- Clone the repository `` git clone https://github.com/devfaysal/laravel-starter.git your_project_name``
- Enter to the project folder `` cd your_project_name ``
- Install composer packages `` composer install ``
- Copy .env.example to .env `` cp .env.example .env ``
- Generate encryption key `` php artisan key:generate ``
- Update the .env file with database credentials
- Run migration `` php artisan migrate ``
- Seed database `` php artisan db:seed ``
- Run the server `` php artisan serve ``
- Visit [localhost:8000/admin/login](http://localhost:8000/admin/login) `` email: faysal@faysal.me Password: password ``
