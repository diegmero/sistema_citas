<?php
session_start();
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'medico') {
    header("Location: ../login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Médico</title>
</head>
<body>
    <a href="ver_citas.php">Ver Mis Citas</a>
    <h2>Bienvenido, Médico</h2>
    <p>Aquí puedes gestionar tus citas.</p>
    <!-- Enlaces a funcionalidades -->
</body>
</html>
