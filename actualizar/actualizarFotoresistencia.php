<?php

include '../conexion.php';
$estatus = $_GET['estatus'];
date_default_timezone_set('America/Mexico_City');           
$fechasalida = date("Y-m-d");  
$horasalida = date("H:i:s");
$query = "SELECT id FROM fotoresistencia ORDER BY id DESC LIMIT 1";
$ejecutar=$conexion->query($query);
$result=$ejecutar->fetch_array();

$stmt =$conexion->prepare( "UPDATE fotoresistencia SET estatus = '".$estatus."', fechaApagado = '".$fechasalida."', horaApagado='".$horasalida."' WHERE id ='".$result[0]."'");
$result = $stmt->execute();
if ($result) {
    echo $result;
} else {
    echo "error";
}
?>