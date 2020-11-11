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
- [4. Views](#4-views)
- [5. Middlewares](#5-middlewares)
- [6. Database Access](#6-database-access)


# 1. Installing dependencies
To use the framework, you **MUST** install the necessary dependencies.

1.1. Enviroment
- NodeJS
- NPM (Node Package Manager)
- Composer (PHP Package Manager)
- You **MUST** fill `config/.env` with **your database credentials** file same as `config/.env.example` is filled.

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

    get('/', 'user_controller#index')

];

return $routes;
```

2.1. Passing parameters to URL

Now, you know [**how to declare a route**](#2-routes), so let's suppose that you want to pass a number id to `user_controller#show` function, for example. You just need to add 
```
get('/users{id}', 'user_controller#show')
``` 
on the `$routes` array.

I'll be like this:
```
$routes = [

    get('/', 'user_controller#index'),
    get('/users/{id}, 'user_controller#show')

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

# 4. Views

You know [**how to use a route**](#2-routes) and [**how to use a controller**](#3-controllers). And how we can render view dinamically with Strato? Simple!

Strato use the **Twig Template Engine**, for more information read the official [documentation](https://twig.symfony.com/doc/3.x/).

4.1. Basics

If you declared a route `user_controller#index` in the `/users` URI, **you don't need to execute any function** to render a **Twig view**. If the view `index.twig` exists on the `app/views/users` directory, it **will be rendered automatically**. Otherwise, nothing gonna happen.

So, if you have a controller like this:

```
<?php
declare(strict_types=1);

namespace app\controllers\user_controller;

//...

function index()
{
}
```

The `app/views/users/index.twig` view will be presented automatically.

4.2. Passing parameters to a view

If you declared a route `user_controller#hello` in the `/hello/{name}` URI, your controller must be like this:

```
<?php
declare(strict_types=1);

namespace app\controllers\user_controller;

//...

function hello($name)
{
    return ['name' => $name];
}
```

Now, the view `app/views/users/hello.twig` can render the `$name` value:

```
Hello, {{name}}!
```

# 5. Middlewares

Middlewares are functions called **before the action** and they are very util and important to protect your routes. They **stays unconditionally** on `app/middlewares` and the function with the **same name** of the script will be called. Let's check their syntax. Example with `auth` middleware:

We can see here on `config/routes.php` that the middleware to `GET '/'` route is `auth`.
```
<?php

$routes = [
    get('/', 'user_controller#index', 'auth'),
    get('/hello/{name}', 'user_controller#hello')
];

return $routes;
```

So, the file at `app/middleware/auth.php` must be like this:

```
<?php
declare(strict_types=1);

namespace app\middlewares\auth;

function auth()
{
    $is_not_authorized = true;
    if ($is_not_authorized) {
        header('Location: /hello/stranger');
    }
}
```
Now everytime that `GET '/'` is accessed, the browser will be redirected to `GET /hello/stranger` route.

# 6. Database Access
To execute SQL queries, if you have `config/.env` configurated, it's just use the `pdo()` helper,

Example 1:
```
$stmt = pdo('select * from users);
$users = $stmt->fetchAll();
```

Example 2:
```
$id = 1;
$stmt = pdo('select * from users where id = :id, ['id' => $id]);
$user = $stmt->fetchAll();
```

---

Credits:

- Moisés Mariano
- [GitHub Project](https://github.com/moisesduartem/strato)