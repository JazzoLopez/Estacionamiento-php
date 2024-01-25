<?php
include 'conexion.php'
?>

<div class="row mt-2 px-2">
    <div class="col-10 mx-auto my-auto"> <!-- Ajusta la clase col-4 según tus necesidades -->
        <div class="card">
            <div class="card-body">
            <p>Tarifas</p>
                <hr>
                <form action="" method="post"> <!-- FORM-->
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="tarifa" class="form-label" required>Tarifa:</label>
                            <input type="text" name="tarifa" id="tarifa" placeholder="tarifa">
                        </div>
                        <div class="col-lg-12">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="text" name="monto" id="monto" onclick="registrarTarifa();" placeholder="monto">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <input class="btn btn-primary mb-2" value="guardar" type="submit"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php
    include './consultar/consultarTarifa.php'
    ?>
</div>