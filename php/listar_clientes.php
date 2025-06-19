<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "conexion.php";

definirClientesTabla($conn);
$sql = "SELECT id, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_apellido, Numero_documento, Correo, Telefono, Sexo FROM clientes ORDER BY Primer_nombre, Primer_apellido";
$resultado = $conn->query($sql);

function definirClientesTabla($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Primer_nombre VARCHAR(50) NOT NULL,
        Segundo_nombre VARCHAR(50),
        Primer_apellido VARCHAR(50) NOT NULL,
        Segundo_apellido VARCHAR(50),
        Numero_documento VARCHAR(30) NOT NULL UNIQUE,
        Correo VARCHAR(100) NOT NULL UNIQUE,
        Telefono VARCHAR(15) NOT NULL,
        Sexo VARCHAR(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $conn->query($sql);
}

$clientes = [];
if ($resultado && $resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $clientes[] = $row;
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
        <th>Documento</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Sexo</th>
        <th>Acciones</th>
    </tr>
    <?php if (!empty($clientes)): ?>
        <?php foreach($clientes as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['Primer_nombre']) ?></td>
                <td><?= htmlspecialchars($row['Segundo_nombre']) ?></td>
                <td><?= htmlspecialchars($row['Primer_apellido']) ?></td>
                <td><?= htmlspecialchars($row['Segundo_apellido']) ?></td>
                <td><?= htmlspecialchars($row['Numero_documento']) ?></td>
                <td><?= htmlspecialchars($row['Correo']) ?></td>
                <td><?= htmlspecialchars($row['Telefono']) ?></td>
                <td><?= htmlspecialchars($row['Sexo']) ?></td>
                <td class="acciones">
                    <button class="btn-accion" title="Editar"><i class="fa fa-edit"></i></button>
                    <button class="btn-accion" title="Eliminar"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="9">No hay clientes registrados.</td></tr>
    <?php endif; ?>
</table>
<link rel="stylesheet" href="../css/clientes.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
