<?php
include 'conexion.php'
?>

<div class="row mt-2 px-2">
    <div class="col-10 mx-auto my-auto"> <!-- Ajusta la clase col-4 según tus necesidades -->
        <div class="card">
            <div class="card-body">
            <p>Servomotor</p>
                <hr>
                <form action="" method="post"> <!-- FORM-->
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="descripcion" class="form-label" required>Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="descripcion">
                        </div>
                        <div class="col-lg-12">
                            <label for="grados" class="form-label">Grados</label>
                            <input type="number" class="form-control" name="grados" id="grados" min="1" max="360" placeholder="grados">
                        </div>
                        <div class="col-lg-12">
                        <label for="estatus" class="form-label">Estatus</label>
                        <select class="form-control" name="estatus" id="estatus">
                                <option value="" select>- SELECCIONA -</option>
                                <option value="0" select>- Inactivo -</option>
                                <option value="1" select>- Activo -</option>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <input class="btn btn-primary mb-2" value="guardar" onclick="registrarServo()" type="button"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container" id="result">
    <?php
    include './consultarServo.php'
    ?>
</div>