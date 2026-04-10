<?php
$output = shell_exec('C:\xampp\php\php.exe artisan l5-swagger:generate -vv 2>&1');
file_put_contents('swagger_debug.txt', $output);
echo "Written!";
