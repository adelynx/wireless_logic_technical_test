<?php

use App\Console\Application;

require 'vendor/autoload.php';

$app = new Application();

$productOptions = $app->run();

echo $productOptions;
