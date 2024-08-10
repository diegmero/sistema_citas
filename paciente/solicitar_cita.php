<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'paciente') {
    header("Location: ../login.html");
    exit();
}

// Obtener la lista de médicos
$sql = "SELECT id, nombre FROM usuarios WHERE rol='medico'";
$result = $conn->query($sql);
$medicos = [];
while ($row = $result->fetch_assoc()) {
    $medicos[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente = $_SESSION['user_id'];
    $id_medico = $_POST['id_medico'];
    $fecha_hora = $_POST['fecha_hora'];

    $sql = "INSERT INTO citas (id_paciente, id_medico, fecha_hora) VALUES ('$id_paciente', '$id_medico', '$fecha_hora')";

    if ($conn->query($sql) === TRUE) {
        echo "Cita solicitada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Cita</title>
</head>
<body>
    <h2>Solicitar Cita Médica</h2>
    <form action="solicitar_cita.php" method="POST">
        <label for="id_medico">Selecciona un Médico:</label>
        <select id="id_medico" name="id_medico" required>
            <?php foreach($medicos as $medico): ?>
                <option value="<?= $medico['id'] ?>"><?= $medico['nombre'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="fecha_hora">Fecha y Hora:</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" required>

        <button type="submit">Solicitar Cita</button>
    </form>
</body>
</html>
