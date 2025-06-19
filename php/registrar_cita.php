<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "conexion.php";

// Crear tabla citas si no existe
$sql = "CREATE TABLE IF NOT EXISTS citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100) NOT NULL,
    barbero VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    servicio VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
$conn->query($sql);

// Insertar nueva cita
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST['cliente'];
    $barbero = $_POST['barbero'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $servicio = $_POST['servicio'];

    $stmt = $conn->prepare("INSERT INTO citas (cliente, barbero, fecha, hora, servicio) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $cliente, $barbero, $fecha, $hora, $servicio);
    if ($stmt->execute()) {
        header('Location: ../agenda.html?success=1');
        exit();
    } else {
        $errorMsg = urlencode($stmt->error);
        header('Location: ../agenda.html?error=sql&msg=' . $errorMsg);
        exit();
    }
}
$conn->close();
?>
