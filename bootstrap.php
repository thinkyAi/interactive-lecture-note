<?php

declare(strict_types = 1);

use App\helper\Ini;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/configs/path_constants.php';

# custom php ini
$customIni = require __DIR__ . '/configs/ini.custom.php';
$customIni(new Ini());

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return require CONFIG_PATH . '/container/container.php';
