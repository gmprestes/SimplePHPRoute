#Simple PHP Route
Very simple and easy way to use routes in PHP.

It's fully independent of other frameworks.

##How to use
Just copy route.php, index.php and .htaccess files into root folder of your project.

##Configuring Routes
It's to easy to configure routes. Just add your routes in index.php like this :

```php

require 'SimplePHPRoute.php';

// Do not run debug mode on production, because it exposes exception details
$route = new SimplePHPRoute('/404', true);

// Put your routes above
$route->add('/', 'home.php');
$route->add('/site/contact', 'contact.php');
$route->add('/about', 'about.php');

// Error route
$route->add('/404', '404.php');


$route->handle();

```
##404 - Not Found Error on Handling
If you don't configure the default 404 - Not Found route, Simple PHP Route will redirect to '/' of your site.
You can configure default 404 redirect when you create a Simple PHP Route instance.

```php
require 'route.php';

// Set 404 - Not Found redirection to '/404'
$route = new route('/404');

// Put your routes above
$route->add('/', 'home.php');
$route->add('/site/contact', 'contact.php');
$route->add('/about', 'about.php');

// Error route
$route->add('/404', '404.php');

$route->handle();

```
