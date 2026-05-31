<?php

try {
    require __DIR__ . '/../public/index.php';
} catch (\Exception $e) {
    header('Content-Type: text/plain');
    echo "Laravel Bootstrap Error:\n";
    echo $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " on line " . $e->getLine() . "\n";
    exit(1);
}
