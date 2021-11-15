<?php
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    $server = $_ENV['SERVER_NAME'];
    $username = $_ENV['USER_NAME'];
    $password = $_ENV['USER_IDENTIFICATION'];
    $database = $_ENV['DB_NAME'];

    $conn = mysqli_connect($server, $username, $password, $database);
?>