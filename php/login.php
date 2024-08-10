<?php
session_start();
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['contrasena'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_rol'] = $row['rol'];
            echo "Inicio de sesión exitoso";
            // Redireccionar según el rol
            if ($row['rol'] == 'paciente') {
                header("Location: ../paciente/dashboard.php");
            } elseif ($row['rol'] == 'medico') {
                header("Location: ../medico/dashboard.php");
            } elseif ($row['rol'] == 'administrador') {
                header("Location: ../admin/dashboard.php");
            }
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "No existe una cuenta con este correo";
    }

    $conn->close();
}
?>
