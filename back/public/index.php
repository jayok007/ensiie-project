<?php
header("Content-Type:application/json");

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/KeywordController.php';
require_once __DIR__ . '/LoginController.php';
require_once __DIR__ . '/UserController.php';
require_once __DIR__ . '/BarController.php';

\Router\Router::execute();
