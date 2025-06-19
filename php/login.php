<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "conexion.php";
    $usuario = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Buscar usuario por correo o documento
    $sql = "SELECT * FROM users WHERE Correo = ? OR Numero_documento = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        // Validar contraseña (en este ejemplo, sin hash)
        if ($row['Contrasena'] === $password) {
            $_SESSION['usuario'] = $row['Primer_nombre'];
            header("Location: ../administrador.html");
            exit();
        } else {
            header("Location: ../login.html?error=login");
            exit();
        }
    } else {
        header("Location: ../login.html?error=login");
        exit();
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login.html");
    exit();
}
?>
