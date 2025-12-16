<?php

require __DIR__ . '/../../../vendor/autoload.php';

header('Content-Type: application/json');

$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/doc_setup.php',
    __DIR__ . '/../../../rest/routes'
]);

echo $openapi->toJson();
