<?php

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
