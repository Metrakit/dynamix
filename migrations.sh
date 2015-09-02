#!./bin/sh

php artisan migrate --path="database/migrations/modules/i18n"
php artisan migrate
php artisan migrate --path="database/migrations/modules/pager"

php artisan db:seed --class="I18nDatabaseSeeder"
php artisan db:seed
php artisan db:seed --class="PagerDatabaseSeeder"