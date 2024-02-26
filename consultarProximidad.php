<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <th scope="col">id</th>
            <th scope="col">descripcion</th>
            <th scope="col">fecha</th>
            <th scope="col">hora</th>
            <th scope="col">estatus</th>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';

            $query="SELECT * FROM proximidad";
            $ejecutar=$conexion->query($query);
            while($result=$ejecutar->fetch_array()){
                echo "<tr>  
                <td>".$result['id']."</td>
                <td>".$result['descripcion']."</td>
                <td>".$result['fecha']."</td>
                <td>".$result['hora']."</td>
                <td>".$result['estatus']."</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>