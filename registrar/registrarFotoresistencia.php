<?php
include '../conexion.php';

$estatus = $_GET['estatus'];
date_default_timezone_set('America/Mexico_City');           
$fechaIngreso = date("Y-m-d");  
$horaIngreso = date("H:i:s");

$stmt = $conexion->prepare("INSERT INTO fotoresistencia (estatus, fechaEncendido, horaEncendido) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $estatus, $fechaIngreso, $horaIngreso);

$result = $stmt->execute();

if ($result) {
    echo "Encendido";
} else {
    echo "Apagado";
}

$stmt->close();
$conexion->close();
?>
