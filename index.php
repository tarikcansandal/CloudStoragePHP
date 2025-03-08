<?php

require __DIR__ . '/php/autoloader.php';

use Core\Router;
use Core\Database;
use Models\SEO;

$db = new Database();
$router = new Router();
$seo = new SEO();

$router->add('GET', '', 'index.php');
$router->add('GET', '/index', 'index.php');

$router->dispatch();
