<?php
$host = "db"; // nombre del servicio en docker-compose
$user = "root";
$pass = "Hola123**"; // tu contraseña de MySQL
$db = "barberia";
$port = 3306; // puerto interno del contenedor

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>