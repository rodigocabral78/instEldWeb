# Additional

## Artisan
```bash
./artisan clear-compiled -vvv && ./artisan cache:clear -vvv && ./artisan config:clear -vvv && ./artisan event:clear -vvv && ./artisan optimize:clear -vvv && ./artisan route:clear -vvv && ./artisan view:clear -vvv

./artisan optimize -vvv

./artisan clear-compiled --verbose && ./artisan cache:clear --verbose && ./artisan config:clear --verbose && ./artisan route:clear --verbose && ./artisan view:clear --verbose && ./artisan serve --verbose --no-interaction --host=localhost --port=8081

./artisan serve -vvv --ansi --no-interaction --host=localhost --port=8081
```

## [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)

## [Laravel Melhores Práticas](https://www.laravelbestpractices.com)

## Configs Timezone & Localization
-   [Laravel Lang](https://laravel-lang.github.io/lang) [https://github.com/caouecs/Laravel-lang](https://github.com/caouecs/Laravel-lang).
-   Tradução do Laravel para português brasileiro (pt-BR) [lucascudo/laravel-pt-BR-localization](https://github.com/lucascudo/laravel-pt-BR-localization).
-   A Laravel package for multilingual models [Astrotomic/laravel-translatable](https://docs.astrotomic.info/laravel-translatable).

```bash
sed -i "s/'timezone'.*/'timezone' => env('APP_TZ', 'UTC'),/" config/app.php
sed -i "s/'locale'.*/'locale' => env('APP_LOCALE', 'en'),/" config/app.php
sed -i "s/'fallback_locale'.*/'fallback_locale' => env('APP_FALLBACK', 'en'),/" config/app.php
sed -i "s/'faker_locale'.*/'faker_locale' => env('APP_FAKER', 'en_US'),/" config/app.php
sed -i "s/.*APP_URL.*/&\\n\nAPP_TZ=America\/Manaus\nAPP_LOCALE=pt_BR\nAPP_FALLBACK=pt_BR\nAPP_FAKER=pt_BR/" .env.example
cp -rfv .env.example .env
./artisan key:generate --verbose --ansi

composer require lucascudo/laravel-pt-br-localization --dev
./artisan vendor:publish --tag=laravel-pt-br-localization

mv -fv ./resources/lang/pt-BR ./resources/lang/pt_BR
mv -fv ./resources/lang/pt-BR.json ./resources/lang/pt_BR.json
```

## Storage - Create the symbolic link using relative paths
```bash
cd public
ln -sfv ../storage/app/public storage
cd -

sed -i "s/FILESYSTEM_DRIVER.*/FILESYSTEM_DRIVER=public/" .env.example
cp -rfv .env.example .env
./artisan key:generate --verbose --ansi

composer require symfony/filesystem
./artisan storage:link -vvv --relative
```

## Migrations & Seeders
-   [How to seed your database using PHP laravel](https://www.codementor.io/@chinemeremnwoga/how-to-seed-your-database-using-php-laravel-10mhltm0ts).
-   [Como fazer a propagação de banco de dados no Laravel](https://artisansweb.net/database-seeding-laravel).
-   [Forçando o faker a falar nossa língua](https://medium.com/@vs0uz4/for%C3%A7ando-o-faker-a-falar-nossa-l%C3%ADngua-72d9ee73244c).
-   [Faker é uma biblioteca PHP que gera dados falsos para você](https://github.com/fzaninotto/Faker).

```bash
sed -i "s/mysql/pgsql/;s/3306/5432/;s/127.0.0.1/docker/" .env.example
sed -i "s/pgsql/mysql/;s/5432/3306/;s/127.0.0.1/docker/" .env.example
cp -rfv .env.example .env

sed -i 's/DB_DATABASE=laravel/DB_DATABASE=default/g' ./.env
sed -i 's/DB_USERNAME=root/DB_USERNAME=default/g' ./.env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=secret/g' ./.env
./artisan key:generate --verbose --ansi

touch database/database.sqlite
DB_FOREIGN_KEYS=true
DB_CONNECTION=sqlite
DB_DATABASE=/database/database.sqlite

DB_HOST=docker ./artisan migrate:fresh -vvv --force --seed
./artisan migrate:fresh -vvv --force --seed --path=database/migrate-l7_acl

./artisan migrate:fresh -vvv --force --seed
./artisan migrate:fresh -vvv --drop-views --force --seed
./artisan migrate:fresh -vvv --force && ./artisan db:seed -vvv --force

./artisan migrate:refresh -vvv --force --seed
./artisan migrate:refresh -vvv --force && ./artisan db:seed -vvv --force
DB_HOST=docker ./artisan migrate:rollback -vvv && DB_HOST=docker ./artisan migrate -vvv --pretend > .docker/mysql/mysql.sql

./artisan make:migration create_people_table
./artisan make:migration create_groups_table --table=groups --create=groups
./artisan make:migration create_groups_table

./artisan make:seeder -vvv UserSeeder
```

## [Laravel Migrations Generator](https://github.com/kitloong/laravel-migrations-generator)
```bash
composer require doctrine/dbal:^2 --dev
composer require kitloong/laravel-migrations-generator --dev

./artisan migrate:generate -vvv --ansi --defaultFKNames --defaultIndexNames --useDBCollation --path=database/migrate-l7_acl

./artisan migrate:generate -vvv --ansi --default-fk-names --default-index-names --use-db-collation --path=database/migrate-l6_acl
```

## [Eloquent Model Generator](https://github.com/krlove/eloquent-model-generator)
```bash
composer require doctrine/dbal:^2 --dev
composer require krlove/eloquent-model-generator --dev

./artisan krlove:generate:model Category --table-name=categories
./artisan krlove:generate:model Device --table-name=devices

./artisan krlove:generate:model Category --table-name=categories --namespace=App\\Modules\\Models --output-path=Modules/Models/
./artisan krlove:generate:model Device --table-name=devices --namespace=App\\Modules\\Models --output-path=Modules/Models/

touch ./config/eloquent_model_generator.php
```

```php
<?php

return [
    'model_defaults' => [
        'namespace'       => 'App\\Models',
        'base_class_name' => \Illuminate\Database\Eloquent\Model::class,
        'output_path'     => 'Models',
        // 'no_timestamps'   => true,
        'no_timestamps'   => false,
        // 'date_format'     => 'Y-m-d H:i:s',
        'date_format'     => 'U',
        'connection'      => null,
        'backup'          => true,
    ],
];
```

## [Api Generator](https://github.com/rodrixcornell/laravel-api-generate)
```bash
composer require rodrixcornell/apigenerate:^1.0.2 --dev

./artisan api-generate --con=conection_name
```

## Crie um novo arquivo de migração, um novo controlador de recursos para o modelo
## laravel ^5.6 --all Generate a migration, factory, and resource controller for the model
```bash
./artisan make:model -vvv --force --migration -- App\\Models\\Role
./artisan make:model -vvv --force --migration -- App\\Models\\Permission
./artisan make:model -vvv --force --migration -- App\\Models\\PermissionRole
./artisan make:model -vvv --force --migration -- App\\Models\\RoleUser
./artisan make:model -vvv --force --migration -- App\\Models\\PermissionUser


./artisan make:model -vvv --force --all -- App\\Models\\Device
./artisan make:model -vvv --force --all -- App\\Models\\Category
./artisan make:model -vvv --force --migration --seed --factory --controller --api -- App\\Models\\Category
./artisan make:model -vvv --force --migration --seed --factory --controller --resource -- App\\Models\\Category
./artisan make:model -vvv --force --controller --resource -- Category
```

## Authorized & Validation Request
```bash
./artisan make:request -vvv UserRequest
./artisan make:request -vvv UserStoreUpdate

./artisan make:request -vvv --ansi App\\Modules\\Api\\Requests\\CategoryRequest
./artisan make:request -vvv --ansi App\\Modules\\Api\\Requests\\CategoryStore
./artisan make:request -vvv --ansi App\\Modules\\Api\\Requests\\CategoryUpdate
```

## [Laravel UI](https://github.com/laravel/ui)
-   [JavaScript & CSS Scaffolding v6.x](https://laravel.com/docs/6.x/frontend).
```bash
composer require laravel/ui

// Generate basic scaffolding...
./artisan ui bootstrap
./artisan ui vue
./artisan ui react

// Generate login / registration scaffolding...
./artisan ui bootstrap --auth
./artisan ui vue --auth
./artisan ui react --auth

// Scaffold the authentication controllers
./artisan ui:controllers -vvv --ansi

// Scaffold basic login and registration views and routes
./artisan ui:auth -vvv --ansi --force --views bootstrap

// Writing CSS & JavaScript
npm install
npm run dev
npm install resolve-url-loader@^4.0.0 --save-dev --legacy-peer-deps
npm run dev
```

## Laravel and JWT
-   [JSON Web Token Authentication for Laravel & Lumen](https://jwt-auth.readthedocs.io/en/docs).
-   [Laravel and JWT](https://blog.pusher.com/laravel-jwt).
-   [JWT authentication for Lumen 5.4](https://dev.to/ziishaned/jwt-authentication-for-lumen-5-4-3d2m).
-   [Build a JWT Authenticated API with Lumen(v5.8)](https://dev.to/ndiecodes/build-a-jwt-authenticated-api-with-lumen-2afm).
-   [JWT Auth Guard for Lumen 5.4](https://github.com/gboyegadada/lumen-jwt).
-   [Guide for setting up with Lumen? #1102](https://github.com/tymondesigns/jwt-auth/issues/1102).
```bash
composer require tymon/jwt-auth

./artisan vendor:publish -vvv --ansi --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

// Skip confirmation when overwriting an existing key.
./artisan jwt:secret -vvv --ansi --force

// Display the key instead of modifying files.
./artisan jwt:secret -vvv --ansi --show

./artisan make:controller AuthController
```

## API RESTful
-   [Construindo uma API RESTful com Laravel - Parte 1](https://rafaell-lycan.com/2015/construindo-restful-api-laravel-parte-1).
-   [Construindo uma API RESTful com Laravel - Parte 2](https://rafaell-lycan.com/2015/construindo-restful-api-laravel-parte-2).
-   [Construindo uma API RESTful com Laravel - Parte 3](https://rafaell-lycan.com/2016/construindo-restful-api-laravel-parte-3).

## Laravel OCI8
-   Installing Laravel OCI8: [yajra/laravel-oci8](https://yajrabox.com/docs/laravel-oci8/master/installation).
-   [Utilizando Laravel e OCI8 em 4+1 passos](https://medium.com/@jhonatanvinicius/utilizando-laravel-e-oci8-em-4-passos-48278c4bb8cf).

## Técnicas de Controle de Acesso de Usuários
-   [Artigo](https://blog.welrbraga.eti.br/?p=642).
-   [Simple RBAC/ACL for Laravel 5.5 caching and permission groups](https://github.com/YaroslavMolchan/rbac).
-   [Role based access control for Laravel 5](https://packagist.org/packages/visualappeal/laravel-rbac).
-   [Two Best Laravel Packages to Manage Roles/Permissions](https://laravel-news.com/two-best-roles-permissions-packages).
-   [Light-weight role-based permissions system for Laravel 6 built in Auth system](https://github.com/kodeine/laravel-acl).
-   [Laravel RBAC (Role Based Access Control) Model Relationship](https://stackoverflow.com/questions/24301274/laravel-rbac-role-based-access-control-model-relationship).
-   [Laravel authorization and roles permission management](https://medium.com/swlh/laravel-authorization-and-roles-permission-management-6d8f2043ea20).
-   [laravel-permission](https://docs.spatie.be/laravel-permission/v3/introduction).

## Categoria de visualização hierárquica
-   [Hierarchical Treeview Category Example in Laravel](https://www.codechief.org/article/hierarchical-treeview-category-example-in-laravel).
-   [Laravel Treeview | Structure and Display Hierarchical Data Example](https://www.codechief.org/article/laravel-treeview-structure-and-display-hierarchical-data-example).
-   [Structure and Display Hierarchical / Multi-level data in Laravel](https://www.5balloons.info/hierarchical-data-laravel-relationship-display).
-   [Laravel - Category Treeview Hierarchical Structure Example with Demo](https://www.itsolutionstuff.com/post/laravel-5-category-treeview-hierarchical-structure-example-with-demoexample.html).

## Nesteds
-   [Effective tree structures in Laravel 4-5](https://github.com/lazychaser/laravel-nestedset).
-   [Nested set in laravel tutorial](https://appdividend.com/2018/04/30/nested-set-in-laravel-tutorial/).
-   [Criar menu dynamic usando conjuntos nesteds](https://php.docow.com/criar-menu-dynamic-usando-conjuntos-nesteds.html).
-   [Implementing Nested Order Set in MySQL/PHP](https://stackoverflow.com/questions/43201104/implementing-nested-order-set-in-mysql-php).
-   [Managing Hierarchical Data in MySQL](http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql).
