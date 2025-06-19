<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "conexion.php";

    // Recibir datos del formulario
    $primer_nombre = $_POST['Primer_nombre'];
    $segundo_nombre = $_POST['Segundo_nombre'];
    $primer_apellido = $_POST['Primer_apellido'];
    $segundo_apellido = $_POST['Segundo_apellido'];
    $numero_documento = $_POST['Numero_documento'];
    $correo = $_POST['Correo'];
    $telefono = $_POST['Telefono'];
    $sexo = $_POST['Sexo'];

    // Validar duplicados antes de registrar
    $sql_check = "SELECT * FROM clientes WHERE Correo = ? OR Numero_documento = ? LIMIT 1";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $correo, $numero_documento);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    if ($row = $result_check->fetch_assoc()) {
        if ($row['Correo'] === $correo) {
            header('Location: ../clientes.html?error=correo');
            exit();
        }
        if ($row['Numero_documento'] === $numero_documento) {
            header('Location: ../clientes.html?error=documento');
            exit();
        }
    }
    $stmt_check->close();

    // Insertar nuevo cliente
    $sql = "INSERT INTO clientes (Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_apellido, Numero_documento, Correo, Telefono, Sexo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("❌ Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("ssssssss", $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $numero_documento, $correo, $telefono, $sexo);

    if ($stmt->execute()) {
        header('Location: ../clientes.html?success=1');
        exit();
    } else {
        $errorMsg = urlencode($stmt->error);
        header('Location: ../clientes.html?error=sql&msg=' . $errorMsg);
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "⚠️ Acceso no permitido.";
}
?>
