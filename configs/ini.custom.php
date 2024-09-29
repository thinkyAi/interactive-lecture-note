<?php
declare(strict_types=1);

use App\helper\Ini;

$error_log_path = __DIR__ . '/../storage/php_errors/error.log';

return function (Ini $ini) use ($error_log_path) {
    $ini->set('log_errors', 'On')
        ->set('error_reporting', E_ALL)
        ->set('error_log', $error_log_path)
        ->set('upload_max_filesize', '20M')
        ->set('post_max_size', '20M');

};


