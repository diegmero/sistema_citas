<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'medico') {
    header("Location: ../login.html");
    exit();
}

$id_medico = $_SESSION['user_id'];
$sql = "SELECT c.id, u.nombre AS paciente, c.fecha_hora, c.estado FROM citas c JOIN usuarios u ON c.id_paciente = u.id WHERE c.id_medico = '$id_medico'";
$result = $conn->query($sql);
$citas = [];
while ($row = $result->fetch_assoc()) {
    $citas[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas Programadas</title>
</head>
<body>
    <h2>Mis Citas Programadas</h2>
    <table>
        <tr>
            <th>Paciente</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        <?php foreach($citas as $cita): ?>
        <tr>
            <td><?= $cita['paciente'] ?></td>
            <td><?= $cita['fecha_hora'] ?></td>
            <td><?= $cita['estado'] ?></td>
            <td>
                <?php if ($cita['estado'] == 'pendiente'): ?>
                    <form action="gestionar_cita.php" method="POST">
                        <input type="hidden" name="id_cita" value="<?= $cita['id'] ?>">
                        <button type="submit" name="accion" value="confirmar">Confirmar</button>
                        <button type="submit" name="accion" value="cancelar">Cancelar</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
