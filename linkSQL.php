<?php
$server = '127.0.0.1'; //127.0.0.1
$port = '3306'; 
$username = 'root';
$password = '368la1996';
$db_name = 'sql_lessons';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$connection = new PDO("mysql:host=$server;port=$port;dbname=$db_name",$username,$password,$options);

$tb_products = 'CREATE TABLE IF NOT EXISTS tb_products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200),
    part VARCHAR(100),
    sell VARCHAR(100),
    description VARCHAR(300),
    photo VARCHAR(100)
 );';
$result = $connection->exec($tb_products);

// if($connection->exec($tb_products) !== false) echo"Таблица  успешно создана";
?>