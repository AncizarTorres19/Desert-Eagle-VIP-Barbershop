<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "conexion.php";

// Crear tabla barberos si no existe
definirBarberosTabla($conn);
$sql = "SELECT id, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_apellido, Especialidad, Telefono, Correo FROM barberos ORDER BY Primer_nombre, Primer_apellido";
$resultado = $conn->query($sql);

function definirBarberosTabla($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS barberos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Primer_nombre VARCHAR(50) NOT NULL,
        Segundo_nombre VARCHAR(50),
        Primer_apellido VARCHAR(50) NOT NULL,
        Segundo_apellido VARCHAR(50),
        Especialidad VARCHAR(100),
        Telefono VARCHAR(15) NOT NULL,
        Correo VARCHAR(100) NOT NULL UNIQUE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $conn->query($sql);
}

$barberos = [];
if ($resultado && $resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $barberos[] = $row;
    }
}
$conn->close();
?>
<table>
    <tr>
        <th>Primer Nombre</th>
        <th>Segundo Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Especialidad</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    <?php if (!empty($barberos)): ?>
        <?php foreach($barberos as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['Primer_nombre']) ?></td>
                <td><?= htmlspecialchars($row['Segundo_nombre']) ?></td>
                <td><?= htmlspecialchars($row['Primer_apellido']) ?></td>
                <td><?= htmlspecialchars($row['Segundo_apellido']) ?></td>
                <td><?= htmlspecialchars($row['Especialidad']) ?></td>
                <td><?= htmlspecialchars($row['Telefono']) ?></td>
                <td><?= htmlspecialchars($row['Correo']) ?></td>
                <td class="acciones">
                    <button class="btn-accion" title="Editar"><i class="fa fa-edit"></i></button>
                    <button class="btn-accion" title="Eliminar"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="8">No hay barberos registrados.</td></tr>
    <?php endif; ?>
</table>
<link rel="stylesheet" href="../css/barberos.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
