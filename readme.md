Стек:
nginx, php7.2-fpm, postgres, Laravel 5.4, Supervisor

$ sudo nano /etc/supervisor/conf.d/laravel-worker.conf

    [program:laravel-worker]
    command=php /var/www/currency.local/artisan queue:work
    autostart=true
    autorestart=true
    user=www-data
    numprocs=1
    redirect_stderr=true
    stdout_logfile=/var/www/currency.local/worker.log
    
$ sudo nano /etc/supervisor/conf.d/laravel-socket-server.conf

    $ sudo nano /etc/supervisor/conf.d/laravel-socket-server.conf
    [program:laravel-socket-server]
    command=php /var/www/currency.local/artisan socketpusher:start
    autostart=true
    autorestart=true
    user=www-data
    numprocs=1
    redirect_stderr=true
    stdout_logfile=/var/www/currency.local/socket-server.log

sudo supervisorctl reread

sudo supervisorctl update

php artisan queue:table

php artisan migrate

sudo supervisorctl start all




