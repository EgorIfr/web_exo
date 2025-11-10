<?php 
$servername = 'localhost';
$db_host = 'root';
$db_password = '';
$db_name = 'db_auth_ex';

$conn = new mysqli($servername, $db_host, $db_password, $db_name);

if ($conn -> connect_error){
    die('Ошибка подключения' . $conn->connect_error);
}