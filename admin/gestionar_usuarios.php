<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'administrador') {
    header("Location: ../login.html");
    exit();
}

// Obtener la lista de usuarios
$sql = "SELECT id, nombre, email, rol FROM usuarios";
$result = $conn->query($sql);
$usuarios = [];
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios</title>
</head>
<body>
    <h2>Gestionar Usuarios</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acción</th>
        </tr>
        <?php foreach($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario['nombre'] ?></td>
            <td><?= $usuario['email'] ?></td>
            <td><?= $usuario['rol'] ?></td>
            <td>
                <a href="editar_usuario.php?id=<?= $usuario['id'] ?>">Editar</a>
                <a href="eliminar_usuario.php?id=<?= $usuario['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="agregar_usuario.php">Agregar Nuevo Usuario</a>
</body>
</html>
