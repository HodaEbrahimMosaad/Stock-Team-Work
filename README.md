# stock
laravel project works as a port for the currencyLayer API

# How to install on your local machine
1. first clone the repo 

    `$ git clone https://github.com/MahmoudFarouq/stock`

2. go to the project directory
    
    `$ cd stock`

3. run this to install all dependencies

    `$ composer install`
    
4. in **.env** change the **DB_DATABASE, DB_USERNAME, DB_PASSWORD** to yours, 

    and the default database if you want to use database other than mysql

    or you can just qun `$ php artisan migrate` to build your own DB

5. to use the cron scheduling
    run `crontab -e`
    add this line `1 * * * * cd {path to the project} && php artisan schedule:run`
    this will run the scheduler every hour 

6. finally, run `$ php artisan serve` and goto `localhost:8000`

