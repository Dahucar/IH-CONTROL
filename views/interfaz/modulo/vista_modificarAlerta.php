<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Modificar alerta <?= $a->asunto ?></h1>


        <?php if (isset($_SESSION['ALERTMOD']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['ALERTMOD']['ERR'] ?></strong>
            </div>
        <?php else: ?>

            <form action="http://localhost/Inmuebles-Herrera/alerta/modificar&id=<?= $a->idalertas ?>" method="POST"> 
                <div class="form-group">
                    <label data-error="wrong" data-success="right" for="txt-asunto">Asunto</label>
                    <input type="text" class="form-control" id="txt-asunto" name="txt-asunto" placeholder="Ingrese asunto"
                           value="<?= $a->asunto ?>">
                </div>
                <div class="form-group">
                    <label data-error="wrong" data-success="right" for="txt-mensaje">Mensaje</label>
                    <textarea type="text" id="txt-mensaje" name="txt-mensaje" class="md-textarea form-control" rows="4">
                        <?= $a->mensaje ?>
                    </textarea>
                </div> 

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
                <a href="http://localhost/Inmuebles-Herrera/alerta/alertas" class="btn btn-danger">Cancelar</a> 
            </form>

        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('ALERTMOD', 'ERR') ?>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>

</div>