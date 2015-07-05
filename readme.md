#Simple PHP Route
Very simple and easy way to use routes in PHP.

It's fully independent of other frameworks.

#How to use
Just copy route.php, inde.php and .htacces files into your application directory.

#Configuring Routes
It's to easy to configure routes. Just add your routes in index.php like this :

´´´php
require 'route.php';

// Do not run debug mode on production, because it exposes exception details
$route = new route('/404', true);

// Put your routes above
$route->add('/', 'home.php');
$route->add('/site/contact', 'contact.php');
$route->add('/about', 'about.php');

// Error route
$route->add('/404', '404.php');


$route->handle();

´´´
