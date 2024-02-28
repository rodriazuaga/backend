<?php

$host = "mysql:host=localhost;dbname=xrv";
$user = "root";
$password = "";

try {
    $conn = new PDO($host, $user, $password);

} catch (PDOException $e) {
    
    die ("Error de conexion: " . $e->getMessage());
}

?>