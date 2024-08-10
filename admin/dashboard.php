<?php
session_start();
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'admin') {
    header("Location: ../login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Admin</title>
</head>
<body>
    <a href="gestionar_usuarios.php">Gestionar Usuarios</a>
    <a href="gestionar_citas.php">Gestionar Citas</a>
    <h2>Bienvenido, Admin</h2>
    <p>Aquí puedes gestionar tus citas.</p>
    <!-- Enlaces a funcionalidades -->
</body>
</html>
