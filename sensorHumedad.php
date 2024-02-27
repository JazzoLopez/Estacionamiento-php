<?php
include "conexion.php";
$humedad = $_GET["humedad"];
$temperatura=$_GET["temperatura"];
date_default_timezone_set('America/Mexico_City');           
$fechaIngreso = date("Y-m-d");
$horaIngreso = date("H:i:s");

$stmt = $conexion->prepare("INSERT INTO humedad (temperatura, humedad, fechaRegistro, horaRegistro) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $humedad, $temperatura, $fechaIngreso, $horaIngreso);

$result = $stmt->execute();

if ($result) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conexion->close();

?>