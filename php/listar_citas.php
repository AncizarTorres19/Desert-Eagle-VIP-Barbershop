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

// Listar citas
$sql = "SELECT cliente, barbero, fecha, hora, servicio FROM citas ORDER BY fecha DESC, hora DESC";
$result = $conn->query($sql);

?>
<table>
    <tr>
        <th>Cliente</th>
        <th>Barbero</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Servicio</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['cliente']) ?></td>
                <td><?= htmlspecialchars($row['barbero']) ?></td>
                <td><?= htmlspecialchars($row['fecha']) ?></td>
                <td><?= htmlspecialchars($row['hora']) ?></td>
                <td><?= htmlspecialchars($row['servicio']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No hay citas registradas.</td></tr>
    <?php endif; ?>
</table>
<link rel="stylesheet" href="../css/agenda.css">
