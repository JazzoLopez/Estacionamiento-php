<?php
include '../conexion.php';

$descripcion = $_POST['descripcion'];
$estatus = $_POST['estatus'];
date_default_timezone_set('America/Mexico_City');           
$fechaIngreso = date("Y-m-d");
$horaIngreso = date("H:i:s");

$stmt = $conexion->prepare("INSERT INTO proximidad (descripcion, fecha, hora, estatus) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $descripcion, $fechaIngreso, $horaIngreso, $estatus);

$result = $stmt->execute();

if ($result) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conexion->close();
?>
