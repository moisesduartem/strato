# Strato MVC Framework for PHP developers

Strato is a PHP function-based framework that provides a routing system to work with model-view-controller pattern without so many abstraction and limitation, but with **conventions** to avoid unnecessary configuration.

# Installation

```
composer create-project --prefer-dist strato/strato blog
```
or
```
git clone https://github.com/moisesduartem/strato blog
```

# Summary

- [Strato MVC Framework for PHP developers](#strato-mvc-framework-for-php-developers)
- [Installation](#installation)
- [Summary](#summary)
- [1. Installing dependencies](#1-installing-dependencies)
- [2. Routes](#2-routes)
- [3. Controllers](#3-controllers)


# 1. Installing dependencies
To use the framework, you **MUST** install the necessary dependencies.

1.1. Enviroment
- NodeJS
- NPM (Node Package Manager)
- Composer (PHP Package Manager)

1.2. Composer
```
cd composer
```
```
composer install
```
1.3. NodeJS & Webpack Mix
```
npm install
```

# 2. Routes
2.1. Basics

Route declarations are in `config/routes.php` file. Supposing that you want to use the `index` function on `app/user_controller.php` file when you go to the `/` uri in the HTTP method `GET`: 

```
$routes = [

    ['method' => 'GET', 'uri' => '/', 'to' => 'user_controller#index']

];

return $routes;
```

2.1. Passing parameters to URL

Now, you know [**how to declare a route**](#2-routes), so let's suppose that you want to pass a number id to `user_controller#show` function, for example. You just need to add 
```
['method' => 'GET', 'uri' => '/users/{id}', 'to' => 'user_controller#show']
``` 
on the `$routes` array.

I'll be like this:
```
$routes = [

    ['method' => 'GET', 'uri' => '/', 'to' => 'user_controller#index'],
    ['method' => 'GET', 'uri' => '/users/{id}', 'to' => 'user_controller#show']

];

return $routes;
```

# 3. Controllers

Here, controllers are scripts that **stays unconditionally** on `app/controllers`. Let's check their syntax. Example with `user_controller`:

```
<?php
declare(strict_types=1);

namespace app\controllers\user_controller;

function index() // user_controller#index
{
}
```

Now, you want to catch the parameter that you had passed on URL to your controller, so...

```
<?php
declare(strict_types=1);

namespace app\controllers\user_controller;

function show($id) // user_controller#show
{
    echo 'Your id is: ' . $id;
}
```