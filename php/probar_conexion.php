<?php
header('Content-Type: text/html; charset=utf-8');

include 'conexion.php';

if ($conn->connect_error) {
    echo "Error de conexión: " . $conn->connect_error;
    // También puedes registrar el error en un archivo log si lo deseas
    // error_log($conn->connect_error, 3, 'error_log.txt');
} else {
    echo "¡Conexión exitosa a la base de datos!<br>";
    // Consulta de prueba
    $sql = "SELECT COUNT(*) as total FROM users";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        echo "Total de usuarios en la tabla 'users': " . $row['total'];
    } else {
        echo "No se pudo realizar la consulta de prueba: " . $conn->error;
    }
}
?>
