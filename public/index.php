<?php
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

use Src\Shared\Infrastructure\Routing\Router;


$router = new Router();
$router->dispatch();