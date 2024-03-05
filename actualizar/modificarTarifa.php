<?php

include '../conexion.php';
$estatus = $_GET['estatus'];
date_default_timezone_set('America/Mexico_City');           
$fechasalida = date("Y-m-d");  
$horasalida = date("H:i:s");
$id = "SELECT id FROM fotoresistencia ORDER BY id DESC LIMIT 1";

$stmt =$conexion->prepare( "UPDATE fotoresistencia SET estatus = '".$estatus."', fechaApagado = '".$fechasalida."', horaApagado='".$horasalida."' WHERE id ='".$id."'");
$result = $stmt->execute();
if ($result) {
    echo "success";
} else {
    echo "error";
}
?>