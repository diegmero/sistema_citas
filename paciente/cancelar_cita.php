<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'paciente') {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cita = $_POST['id_cita'];
    $sql = "UPDATE citas SET estado='cancelada' WHERE id='$id_cita'";

    if ($conn->query($sql) === TRUE) {
        echo "Cita cancelada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: ver_citas.php");
    exit();
}

$conn->close();
?>
