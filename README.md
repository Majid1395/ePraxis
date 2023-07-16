<p align="center"><img src="assets/../public/assets/images/logo.png"width="300"></p>

<!-- <p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>  -->

## Über ePraxis

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

<!-- - [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications. -->

## Einrichten der Entwicklungsumgebung

Stellen Sie bitte sicher, dass [Composer](https://getcomposer.org/) und [XAMPP](https://www.apachefriends.org) auf Ihrem Computer installiert sind.
<!-- Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library. -->

## Installationsschritte

<!-- We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**

- [SOFTonSOFA](https://softonsofa.com/) -->
1. Navigieren Sie zum Projektordner:

Um die Anwendung lokal ausführen zu können, stellen Sie bitte sicher, dass der Projektordner in der XAMPP-Datei auf 'htdocs' gesetzt ist.

z.B.
```console
cd htdocs/epraxis/
```
2. Composer-Abhängigkeiten installieren:
```console
composer install
```
3. NPM-Abhängigkeiten installieren:
```console
npm install
```
4. Kopieren Sie die Datei **.env.example** und erstellen Sie ein Duplikat. Verwenden Sie den Befehl **cp** für Linux- oder Mac-Benutzer.
```console
cp .env.example .env
```
Wenn Sie Windows verwenden, verwenden Sie **copy** anstelle von **cp**.
```console
copy .env.example .env
```
5. Generieren Sie den Verschlüsselungsschlüssel für die Anwendung:
```console
php artisan key:generate
```
6. Datenbankmigrationen ausführen:
```console
php artisan migrate
```

7. Datenbank-Seeder ausführen:
```console
php artisan db:seed
```  
8. Starten Sie den localhost-Server:
```console
php artisan serve
```  
Dann gehen Sie zu http://127.0.0.1:8000
<!-- ## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
