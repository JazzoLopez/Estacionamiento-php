<?php
include '../conexion.php';

$id_servomotor = $_POST['id_servomotor'];
$descripcion = $_POST['descripcion'];
$grados = $_POST['grados'];
$estatus = $_POST['estatus'];

$stmt =$conexion->prepare( "UPDATE servomotor SET descripcion = '".$descripcion."', grados = '".$grados."', estatus = '".$estatus."' WHERE id_servomotor ='".$id_servomotor."'");

$result = $stmt->execute();
if ($result) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conexion->close();

?>