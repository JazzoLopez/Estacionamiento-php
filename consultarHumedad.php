<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <th scope="col">Humedad</th>
            <th scope="col">Temperatura</th>
            <th scope="col">fecha</th>
            <th scope="col">hora</th>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';

            $query="SELECT * FROM humedad ORDER BY id DESC LIMIT 1";
            $ejecutar=$conexion->query($query);
            while($result=$ejecutar->fetch_array()){
                echo "<tr>  
                <td>".$result['humedad']."</td>
                <td>".$result['temperatura']."</td>
                <td>".$result['fechaRegistro']."</td>
                <td>".$result['horaRegistro']."</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>