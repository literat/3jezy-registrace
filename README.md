# 3 jezy | Registration App

[![Build Status](https://travis-ci.org/literat/3jezy-registrace.svg?branch=master)](https://travis-ci.org/literat/3jezy-registrace) [![Coverage Status](https://coveralls.io/repos/github/literat/3jezy-registrace/badge.svg)](https://coveralls.io/github/literat/3jezy-registrace)

## Development

* commit messages should follow [rules](docs/commit-messages.md) for easier release process

Require installed composer - [get composer](https://getcomposer.org/download/)

**Composer scripts**

* `php artisan serve` - Run local php development server
* `composer serve` - Run local php development server
* `composer deploy-test` - Run deployment test
* `composer deploy` - Run deployment
* `composer test` - Run tests

### Environments

#### Local

##### Domain

`https://registrace.3jezy.dev`

##### Testing accounts for SkautIS

uživatelské jméno    | heslo           | oprávnění
-------------------- | --------------- | -----------------------------------------------------------------------------
kraj.vary            | vary.Web2       | Vedoucí/administrátor kraje: testovací "Karlovy Vary"
kraj.tgm             | tgm.Web3        | Vedoucí/administrátor kraje: testovací "Jihomoravský kraj T.G.M."
okres.blansko        | blansko.Web1    | Vedoucí/administrátor okresu: testovací "okres Blansko"
stredisko.koprivnice | koprivnice.Web5 | Vedoucí/administrátor střediska: testovací "středisko Kopřivnice" v KV kraji
snem.sneznik.kk      | komise1         | Člen kandidátní komise střediskového sněmu
snem.sneznik.uc      | ucastnik1       | Účastník střediskového sněmu

#### Production

##### Domain

`https://registrace.3jezy.cz`

## Backgrounds

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

### About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

### Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
