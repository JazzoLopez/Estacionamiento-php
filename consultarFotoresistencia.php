<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <th scope="col">Estatus</th>
            <th scope="col">Fecha de encendido</th>
            <th scope="col">Hora de encendido</th>
            <th scope="col">Fecha de apagado</th>
            <th scope="col">Hora de apagado</th>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';

            $query="SELECT * FROM fotoresistencia ORDER BY id DESC LIMIT 1";
            $ejecutar=$conexion->query($query);
            while($result=$ejecutar->fetch_array()){
                if($result["estatus"]){
                echo "<tr>  
                <td style='background:green'></td>
                <td>".$result['fechaEncendido']."</td>
                <td>".$result['horaEncendido']."</td>
                <td>".$result['fechaApagado']."</td> 
                <td>".$result['horaApagado']."</td>
                </tr>";
            } else {
                echo "<tr>  
                <td style='background:red'></td>
                <td>".$result['fechaEncendido']."</td>
                <td>".$result['horaEncendido']."</td>
                <td>".$result['fechaApagado']."</td>
                <td>".$result['horaApagado']."</td>
                </tr>";
            }
            }
            ?>
        </tbody>
    </table>
</div>