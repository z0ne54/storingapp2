<?php


$config = require __DIR__ . '/config.php';

if (!is_array($config)) {
    throw new UnexpectedValueException('config.php must return a database configuration array.');
}

$conn = new PDO(
    "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8mb4",
    $config['username'],
    $config['password'],
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
