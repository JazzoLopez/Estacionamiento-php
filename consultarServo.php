<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <th scope="col">id</th>
            <th scope="col">descripcion</th>
            <th scope="col">grados</th>
            <th scope="col">Estatus</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Eliminar</th>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';

            $query="SELECT * FROM servomotor";
            $ejecutar=$conexion->query($query);
            while($result=$ejecutar->fetch_array()){
                echo "<tr>  
                <td>".$result['id_servomotor']."</td>
                <td>".$result['descripcion']."</td>
                <td>".$result['grados']."</td>
                <td>".$result['estatus']."</td>
                <td><a href='#' onclick='actualizarServo(".$result['id_servomotor'].")'>Actualizar</a></td>
                <td><a href='#' onclick='eliminarServo(".$result['id_servomotor'].")'>Eliminar</a></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>