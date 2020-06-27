@servers(['web' => 'root@78.46.229.210'])

@task('demo', ['on' => 'web'])
cd /var/www/gielda-gier

php artisan down
git fetch origin master
git checkout --force master
git reset --hard FETCH_HEAD
git clean -df

composer install --no-interaction --prefer-dist --ignore-platform-reqs --no-dev
npm install --only=prod

php artisan migrate:fresh --seed

php artisan cache:clear
php artisan view:clear
php artisan config:cache

npm run production

php artisan up
@endtask
