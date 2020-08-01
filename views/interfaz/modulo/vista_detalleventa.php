<div class="ayuda container">
    <h1>Módulo administrador: Detalle de venta</h1>
    <div class="container">
        
        <!-- contenedor de tarjetas -->
        <div class="row"> 

            <!-- Cliente -->
            <div class="card m-2" style="width: 18rem;">
                <img class="card-img-top" src="http://localhost/Inmuebles-Herrera/assets/img/portfolio/cabin.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Cliente</h5> 
                    <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/administrador/asignarturno"><i class="ico-btn fas fa-eye"></i></a> 
                </div>
            </div> 

            <!-- Vendedor -->
            <div class="card m-2" style="width: 18rem;">
                <img class="card-img-top" src="http://localhost/Inmuebles-Herrera/assets/img/portfolio/cabin.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Vendedor</h5> 
                    <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/administrador/asignarturno"><i class="ico-btn fas fa-eye"></i></a> 
                </div>
            </div> 

        </div> 

        <!-- 
        tabla 
        idventas 	codigo 	fecha 	detalle 	vendedores_idvendedores 	clientes_idclientes 
        -->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id venta</th>
                    <th scope="col">Código</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Detalle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table> 

    </div>
</div>