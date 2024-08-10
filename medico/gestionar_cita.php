<?php
session_start();
include('../config/db.php');
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] != 'medico') {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cita = $_POST['id_cita'];
    $accion = $_POST['accion'];

    if ($accion == "confirmar") {
        $estado = "confirmada";
    } elseif ($accion == "cancelar") {
        $estado = "cancelada";
    }

    $sql = "UPDATE citas SET estado='$estado' WHERE id='$id_cita'";

    if ($conn->query($sql) === TRUE) {
        echo "Cita $estado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: ver_citas.php");
    exit();
}

$conn->close();
?>
