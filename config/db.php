<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "citas_medicas";

// Habilitar informes de errores y excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    // echo "Conexión exitosa"; // Comentado para evitar salida no deseada
} catch (mysqli_sql_exception $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>