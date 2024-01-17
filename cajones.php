<div class="row mt-2 px-5">
    <div class="col-8 mx-auto my-auto"> <!-- Ajusta la clase col-4 según tus necesidades -->
        <div class="card">
            <div class="card-body">
            <p>Cajones</p>
                <hr>
                <form action="" method="post"> <!-- FORM-->
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="numero" class="form-label" required>N.Cajon :</label>
                            <input type="number" id="numero" name="numero" min="1" class="form-control"
                                placeholder="Numero de cajon" />
                        </div>
                        <div class="col-lg-12">
                            <label for="estatus" class="form-label">Estatus</label>
                            <select class="form-control" name="estatus" id="estatus">
                                <option value="" select>- SELECCIONA -</option>
                                <option value="">Ocupado-</option>
                                <option value="">Libre</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="btn btn-primary mb-2">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
