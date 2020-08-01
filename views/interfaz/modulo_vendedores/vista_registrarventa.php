<div class="ayuda container">
    <h1>Módulo vendedor: registrar venta</h1>

    <!-- 	idventas 	codigo 	fecha 	detalle 	vendedores_idvendedores 	clientes_idclientes    -->

    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="txt-cod">Código producto</label>
                <input type="text" class="form-control" id="txt-cod" name="txt-cod" placeholder="Ingrese codigo">
            </div>  
        </div> 
        <div class="form-group">

        </div>
        <div class="form-group">
            <label data-error="wrong" data-success="right" for="txt-caracte">Caracteristica</label>
            <textarea type="text" id="txt-caracte" name="txt-caracte" class="md-textarea form-control" rows="4"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="txt-cod">Precio producto</label>
                <input type="text" class="form-control" id="txt-cod" name="txt-cod" placeholder="Ingrese precio">
            </div> 
            <div class="form-group col-md-6">
                <label for="txt-cod">Cantidad</label>
                <input type="number" class="form-control" id="txt-cod" name="txt-cod" placeholder="Ingrese cantidad">
            </div> 
        </div> 
        <div class=" md-form mb-3">
            <label data-error="wrong" data-success="right" for="txt-categ-model">Categoria</label>
            <select class="form-control" id="txt-categ-model" name="txt-categ-model">
                <option value="" >Seleccione</option>
                <option value="categ01" >Categ 01</option>
                <option value="categ02" >Categ 02</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="submit" class="btn btn-secondary">Limpiar</button>
    </form>
</div>
