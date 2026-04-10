<?php

require __DIR__ . '/vendor/autoload.php';

try {
    $openapi = \OpenApi\Generator::scan([\OpenApi\Util::finder(__DIR__ . '/app/Http/Controllers')]);
    echo "Success!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
