<div class="ayuda container">
    <h1>Módulo administrador: Hacer pedido de emergencia</h1>
    <!-- 
	idpedido 	codigo 	cantidadProdcutos 	precioUnitario 	precioTotal 	detalleSolicitud 	estadoPedido 	fechaSolicitud 	proveedores_idproveedores 	administrador_idadministrador  -->

    <!-- formulario agregar pedido -->
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="txt-cod">Código producto</label>
                <input type="text" class="form-control" id="txt-cod" name="txt-cod" placeholder="Ingrese codigo">
            </div> 
        </div> 
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="txt-cod">Cantidad producto</label>
                <input type="number" class="form-control" id="txt-cant-p" name="txt-cant-p" placeholder="Ingrese cantidad">
            </div> 
            <div class="form-group col-md-6">
                <label for="txt-precio">Precio producto</label>
                <input type="number" class="form-control" id="txt-precio" name="txt-precio" placeholder="Ingrese precio">
            </div> 
        </div>  
        
        <div class="form-group">
            <label data-error="wrong" data-success="right" for="txt-detalle">Detalle de solicitud</label>
            <textarea type="text" id="txt-detalle" name="txt-detalle" class="md-textarea form-control" rows="4"></textarea>
        </div> 
        <div class=" md-form mb-3">
            <label data-error="wrong" data-success="right" for="txt-categ-model">Seleccionar proveedores</label>
            <select class="form-control" id="select-provee" name="select-provee">
                <option value="" >Seleccione</option>
                <option value="categ01" >Proveedor 01</option>
                <option value="categ02" >Proveedor 02</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </form>


</div>