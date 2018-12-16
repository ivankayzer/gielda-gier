@servers(['web' => 'root@145.239.80.94'])

@task('dev', ['on' => 'web'])
cd /var/www/beta.gielda-gier.pl

php artisan down
git fetch origin develop
git checkout --force develop
git reset --hard FETCH_HEAD
git clean -df

composer install --no-interaction --prefer-dist --ignore-platform-reqs
npm install --only=prod

php artisan migrate

php artisan cache:clear
php artisan view:clear
php artisan config:cache

npm run production

php artisan up
@endtask

@task('prod', ['on' => 'web'])
cd /var/www/gielda-gier.pl

php artisan down
git fetch origin master
git checkout --force master
git reset --hard FETCH_HEAD
git clean -df

composer install --no-interaction --prefer-dist --ignore-platform-reqs --no-dev
npm install --only=prod

php artisan migrate

php artisan cache:clear
php artisan view:clear
php artisan config:cache

npm run production

php artisan up
@endtask