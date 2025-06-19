<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "conexion.php";
    $correo = $conexion->real_escape_string($_POST['correo']);
    $sql = "SELECT * FROM personas WHERE Correo = ? LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        // Aquí deberías enviar un correo real con un enlace de recuperación
        $mensaje = "<span style='color:green;'>Se ha enviado un enlace de recuperación a: <b>".htmlspecialchars($correo)."</b> (simulado)</span>";
    } else {
        $mensaje = "<span style='color:red;'>El correo no está registrado.</span>";
    }
    $stmt->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña - Desert Eagle VIP</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        .recovery-container { display: flex; justify-content: center; align-items: center; height: 100vh; }
        .recovery-form { background: #222; padding: 40px 30px; border-radius: 30px; box-shadow: 0 0 20px #0008; width: 350px; text-align: center; }
        .recovery-form h2 { color: #fff; margin-bottom: 20px; }
        .recovery-form input[type=email] { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 15px; font-size: 16px; }
        .recovery-form button { width: 100%; background: #007bff; color: #fff; border: none; border-radius: 8px; padding: 12px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        .recovery-form button:hover { background: #218838; }
        .back-link { display: block; margin-top: 20px; color: #fff; text-decoration: underline; }
        .mensaje { margin: 10px 0; font-size: 15px; }
    </style>
</head>
<body class="login">
    <div class="recovery-container">
        <div class="recovery-form">
            <h2>Recuperar Contraseña</h2>
            <form method="POST" action="recuperar.php">
                <input type="email" name="correo" placeholder="Tu correo electrónico" required>
                <button type="submit">Enviar enlace</button>
            </form>
            <?php if (!empty($mensaje)) echo '<div class="mensaje">'.$mensaje.'</div>'; ?>
            <a href="../login.html" class="back-link">Volver al inicio</a>
        </div>
    </div>
</body>
</html>
