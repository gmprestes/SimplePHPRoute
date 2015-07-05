<?php

require 'route.php';

// Do not run debug mode on production, because it exposes exception details
$route = new route('/404', true);
$route->add('/', 'home.php');
$route->add('/site/contact', 'contact.php');
$route->add('/about', 'about.php');

// Error route
$route->add('/404', '404.php');


$route->handle();
