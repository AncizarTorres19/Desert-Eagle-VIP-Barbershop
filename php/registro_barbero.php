<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "conexion.php";

    $primer_nombre = $_POST['Primer_nombre'];
    $segundo_nombre = $_POST['Segundo_nombre'];
    $primer_apellido = $_POST['Primer_apellido'];
    $segundo_apellido = $_POST['Segundo_apellido'];
    $especialidad = $_POST['Especialidad'];
    $telefono = $_POST['Telefono'];
    $correo = $_POST['Correo'];

    // Validar duplicados
    $sql_check = "SELECT * FROM barberos WHERE Correo = ? LIMIT 1";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    if ($row = $result_check->fetch_assoc()) {
        header('Location: ../registro_barbero.html?error=correo');
        exit();
    }
    $stmt_check->close();

    // Insertar barbero
    $sql = "INSERT INTO barberos (Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_apellido, Especialidad, Telefono, Correo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("❌ Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssss", $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $especialidad, $telefono, $correo);
    if ($stmt->execute()) {
        header('Location: ../registro_barbero.html?success=1');
        exit();
    } else {
        $errorMsg = urlencode($stmt->error);
        header('Location: ../registro_barbero.html?error=sql&msg=' . $errorMsg);
        exit();
    }
    $stmt->close();
    $conn->close();
} else {
    echo "⚠️ Acceso no permitido.";
}
