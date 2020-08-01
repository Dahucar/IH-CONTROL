$(document).ready(function () {

    console.log("SCRIPT CALENDARIO ACTIVO DESDE JQUERY 2020");

    //CONFIRMACION PARA ELIMINAR CATEGORIA
    $(document).on('click', '.btn-eliminar', function () {

        let url = "http://localhost/Inmuebles-Herrera/categoria/eliminarCategoria&id=";

        let fila = $(this)[0].parentElement.parentElement;
        let id = $(fila).attr('id_producto');

        console.log(id);

        $('#confirmar-eliminar').attr('href', url + id);

    });

    //CONFIRMACION PARA ELIMINAR ESTADO
    $(document).on('click', '.btn-delEstado', function () {



        let url = "http://localhost/Inmuebles-Herrera/estado/eliminar&id=";

        let fila = $(this)[0].parentElement.parentElement;
        let id = $(fila).attr('id_producto');
        console.log(id);

        $('#confirmar-delEstado').attr('href', url + id);

    });

    //CONFIRMACION PARA ELIMINAR PRODUCTO
    $(document).on('click', '#btn-delProucto', function () {

        let url = "http://localhost/Inmuebles-Herrera/producto/eliminar&id=";

        let fila = $(this)[0].parentElement.parentElement;

        let id = $(fila).attr('id_producto');

        console.log(id);

        $('#confirmar-delPro').attr('href', url + id);

    });

    //CONFIRMACION PARA ELIMINAR UN PROVEEDOR
    $(document).on('click', '#btnDelProveedor', function () {

        let url = "http://localhost/Inmuebles-Herrera/proveedor/eliminar&id=";

        let fila = $(this)[0].parentElement.parentElement;

        let id = $(fila).attr('id_product');

        console.log(id);

        $('#confirmar-delProve').attr('href', url + id);

    });

    //CONFIRMACION PARA ELIMINAR UN VENDEDOR
    $(document).on('click', '#btnDelvent', function () {

        let url = "http://localhost/Inmuebles-Herrera/vendedor/eliminar&id=";

        let fila = $(this)[0].parentElement.parentElement;
        console.log(fila);

        let id = $(fila).attr('id_product');

        console.log(id);

        $('#btnDelVendedor').attr('href', url + id);

    });

    //CONFIRMACION PARA ELIMINAR UNA ALERTA
    $(document).on('click', '#btn-delAlets', function () {

        let url = "http://localhost/Inmuebles-Herrera/alerta/eliminar&id=";

        let fila = $(this)[0].parentElement.parentElement;
        console.log(fila);

        let id = $(fila).attr('id_product');

        console.log(id);

        $('#confirmar-delAlets').attr('href', url + id);

    });

    //CONFIRMACION PARA ELIMINAR UN TURNO
    $(document).on('click', '#btn-delTurno', function () {

        let url = "http://localhost/Inmuebles-Herrera/turno/eliminar&id=";

        let fila = $(this)[0].parentElement.parentElement;
        console.log(fila);

        let id = $(fila).attr('id_product');

        console.log(id);
        console.log(url + id);

        $('#delTurno').attr('href', url + id);

    });

    //CONFIRMACION PARA ELIMINAR UN PEDIDO
    $(document).on('click', '#btn-delPedido', function () {

        let url = "http://localhost/Inmuebles-Herrera/pedido/eliminarPedido&id=";

        let fila = $(this)[0].parentElement.parentElement;
        console.log(fila);

        let id = $(fila).attr('id_pedido');

        console.log(id);
        console.log(url + id);

        $('#confirmDelPedido').attr('href', url + id);

    });

    //CONFIRMACION GENERAR REPORTEES
    $(document).on('click', '.pdf', function () {
        let botn = $(this)[0];
        let URL = $(botn).attr('href');

        $('#form-report').attr('action', URL);

        $("#form-repor").submit(function (event) {
            alert("Handler for .submit() called.");
            event.preventDefault();
        });

    });
    

    //CONFIRMACION PARA ELIMINAR UN ADMINISTRADOR
    $(document).on('click', '#btndDelAdm', function () {

        let url = "http://localhost/Inmuebles-Herrera/administrador/eliminar&id=";

        let fila = $(this)[0].parentElement.parentElement;
        console.log(fila);

        let id = $(fila).attr('id_product');

        console.log(id);
        console.log(url + id);

        $('#delAdm').attr('href', url + id);

    });

});
