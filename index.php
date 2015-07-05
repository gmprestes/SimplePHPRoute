<?php

require 'route.php';

$route = new route('/404', true);
$route->add('/', 'home.php');
$route->add('/site/contato', 'contato.php');
$route->add('/sobre', 'sobre.php');

// Erro route
$route->add('/404', '404.php');


$route->handle();
