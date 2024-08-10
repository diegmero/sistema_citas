<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'administrador') {
    header("Location: ../login.html");
    exit();
}

// Obtener la lista de citas
$sql = "SELECT c.id, p.nombre AS paciente, m.nombre AS medico, c.fecha_hora, c.estado 
        FROM citas c 
        JOIN usuarios p ON c.id_paciente = p.id 
        JOIN usuarios m ON c.id_medico = m.id";
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
    <title>Gestionar Citas</title>
</head>
<body>
    <h2>Gestionar Citas</h2>
    <table>
        <tr>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        <?php foreach($citas as $cita): ?>
        <tr>
            <td><?= $cita['paciente'] ?></td>
            <td><?= $cita['medico'] ?></td>
            <td><?= $cita['fecha_hora'] ?></td>
            <td><?= $cita['estado'] ?></td>
            <td>
                <form action="gestionar_cita.php" method="POST">
                    <input type="hidden" name="id_cita" value="<?= $cita['id'] ?>">
                    <select name="accion">
                        <option value="confirmar" <?= $cita['estado'] == 'confirmada' ? 'disabled' : '' ?>>Confirmar</option>
                        <option value="cancelar" <?= $cita['estado'] == 'cancelada' ? 'disabled' : '' ?>>Cancelar</option>
                    </select>
                    <button type="submit">Aplicar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
