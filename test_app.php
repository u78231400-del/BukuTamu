<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
echo "Class: " . get_class($app) . PHP_EOL;
echo "handleRequest exists: " . (method_exists($app, 'handleRequest') ? 'yes' : 'no') . PHP_EOL;
echo "HttpKernel bound: " . ($app->bound(Illuminate\Contracts\Http\Kernel::class) ? 'yes' : 'no') . PHP_EOL;
