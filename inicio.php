<h1>Dashboard</h1>

<?php
include 'conexion.php';
$query = "SELECT id_cajon, numero, estatus FROM cajones ORDER BY numero";
$ejecutar =  $conexion->query($query);
echo "<div class='row'>";
while($result=$ejecutar->fetch_array()){
    echo "<div class='col-sm-3'>
    <div class='card' style='width:18rem;'>
        <img src='imagenes/coche.png' class='card-img-top' alt'imagen'>
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
            echo "<a href='#' class='btn btn-warning' onclick='eliminarRegistro(".$result2['id_registro'].")' >Salir</a>";
            
         }
    }
    else{
        echo "<p class='card-text'>No existe un vehiculo ocupando este cajon</p>";
        echo "<a href='#' class='btn btn-info' data-toggle='modal' data-target='#myModal' onclick='abrirModal(".$result['id_cajon'].")' >Ocupar</a>";
    }
echo "</div></div></div>" ;
}
?>


<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Cabecera del Modal -->
      <div class="modal-header">
        <h4 class="modal-title">Formulario</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Contenido del Modal -->
      <div class="modal-body">
        <!-- Formulario -->
        <form id="miFormulario">
          <div class="form-group">
            <label for="campo1">Campo 1:</label>
            <input type="text" class="form-control" id="campo1" name="campo1" required>
          </div>
          <!-- Agrega más campos según sea necesario -->

          <!-- Botones Guardar y Cancelar -->
          <button type="button" class="btn btn-primary" onclick="guardarDatos()">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
