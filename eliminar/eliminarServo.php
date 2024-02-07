<?php
include '../conexion.php';

$id_servomotor = $_POST['id_servomotor'];

$stmt = $conexion->prepare("DELETE FROM servomotor WHERE id_servomotor='".$id_servomotor."'");
// $stmt->bind_param("ss", $tarifa, $monto);
$result = $stmt->execute();
if ($result) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conexion->close();

?>
