<?php
session_start();
$config = require_once './dbconnect.php';
try {
    $db = new PDO("mysql:host={$config['host']};dbname={$config['db']};charset=utf8", $config['user'], $config['pass'], [PDO::ATTR_EMULATE_PREPARES => false, PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $error) {
    echo $error->getMessage();
}
