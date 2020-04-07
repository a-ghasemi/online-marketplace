@servers(['localhost'   => '127.0.0.1'])

@task('setup')
composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts
cp .env.example .env
php artisan key:generate
php artisan storage:link
echo "** Prepare DB connection and then run [envoy run fresh_db]\r\n"
echo "*** After all run [php artisan passport:install]\r\n"
@endtask

@story('fresh_db')
    composer_dump
    cache_clear
    config_clear
    down_artisan
    fresh_migrate
    seed
    up_artisan
    cache_clear
    view_clear
    config_clear
    routes_clear
@endstory

@story('4clear')
    cache_clear
    view_clear
    config_clear
    routes_clear
    composer_dump
@endstory


@task('composer_dump')
composer dump-autoload
@endtask

@task('cache_clear')
sudo php artisan cache:clear
@endtask

@task('config_clear')
sudo php artisan config:clear
@endtask

@task('view_clear')
sudo php artisan view:clear
@endtask

@task('routes_clear')
sudo php artisan route:clear
@endtask






@task('migrate')
    php artisan migrate
@endtask

@task('fresh_migrate')
    php artisan migrate:fresh
@endtask

@task('seed')
    php artisan db:seed
@endtask

@task('down_artisan')
    php artisan down
@endtask

@task('up_artisan')
    php artisan optimize
    php artisan up
@endtask


@finished
    echo "Envoy deployment complete.\r\n";
@endfinished
