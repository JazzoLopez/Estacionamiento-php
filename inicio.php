<h1>Dashboard</h1>

<?php
include 'conexion.php';
$query = "SELECT id_cajon, numero, estatus FROM cajones ORDER BY numero";
$ejecutar =  $conexion->query($query);
echo "<div class='row'>";
while($result=$ejecutar->fetch_array()){
    echo "<div class='col-sm-3'>
    <div class='card' style='width:18rem;'>
        <img src='imagenes/menu.png' class='card-img-top' alt'imagen'>
            <div class='card-body'>
                <h5 class='card-title'> Cajon ".$result['numero']."</h5>";
    if($result['estatus']==1){
        $query2 = "SELECT * FROM registro INNER JOIN vehiculos ON 
        vehiculos.id_vehiculo = registro.id_vehiculo INNER JOIN cajones ON 
        cajones.id_cajon = registro.id_cajon INNER JOIN tarifa ON 
        tarifa.id_tarifa = registro.id_tarifa INNER JOIN empleados ON
         empleados.id_empleado = registro.id_empleado WHERE registro.id_cajon = ".$result['id_cajon']."";
         $ejecutar2 = $conexion->query($query2);
         while($result2 = $ejecutar2->fetch_array()){
            echo "<h4>Matricula:".$result2['matricula']."</h4>";
            echo "<p>".$result2['fechaIngreso']." ".$result2['horaIngreso']."</p>";
            echo "<p>".$result2['tarifa']."</p>";
            echo "<p>".$result2['nombre']."</p>";
            echo "<a href='#' class='btn btn-warning' onclick='abrirModal(".$result['id_cajon'].")' >Salir</a>";
         }
    }
    else{
        echo "<p class='card-text'>No existe un vehiculo ocupando este cajon</p>";
        echo "<a href='#' class='btn btn-info' onclick='abrirModal(".$result['id_cajon'].")' >Ocupar</a>";
    }
echo "</div></div></div>" ;
}
?>