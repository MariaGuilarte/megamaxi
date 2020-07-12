<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-analytics">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
              <div class="card bg-analytics text-white">
                <div class="card-content">
                  <div class="card-body text-center">
                    <img src="recursos/app-assets/images/elements/decore-left.png" class="img-left" alt="
                    card-img-left">
                    <img src="recursos/app-assets/images/elements/decore-right.png" class="img-right" alt="card-img-right">
                    <div class="avatar avatar-xl bg-primary shadow mt-0">
                      <div class="avatar-content">
                        <i class="feather icon-award white font-large-1"></i>
                      </div>
                    </div>
                    <div class="text-center">
                      <h1 class="mb-2 text-white" >
                        Bienvenido
                      </h1>
                      <h1><strong v-text="user.nombre"></strong>&nbsp;<strong v-text="user.apellido"></strong></h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                  <div class="avatar bg-rgba-success p-50 m-0">
                    <div class="avatar-content">
                      <i class="feather icon-users text-success font-medium-5"></i>
                    </div>
                  </div>
                  <h2 class="text-bold-700 mt-1 mb-25" v-text="cliente"></h2>
                  <p class="mb-0">Cantidad de Clientes registrados en el sistema</p>
                </div>
                <div class="card-content">
                  <div id="subscribe-gain-chart"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                  <div class="avatar bg-rgba-warning p-50 m-0">
                    <div class="avatar-content">
                      <i class="feather icon-user text-warning font-medium-5"></i>
                    </div>
                  </div>
                  <h2 class="text-bold-700 mt-1 mb-25" v-text="proveedor"></h2>
                  <p class="mb-0">Cantidad de proveedores registrados</p>
                </div>
                <div class="card-content">
                  <div id="orders-received-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section id="dashboard-ecommerce">
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                  <div class="avatar bg-rgba-success p-50 m-0">
                    <div class="avatar-content">
                      <i class="fa fa-credit-card text-success font-medium-5"></i>
                    </div>
                  </div>
                  <h2 class="text-bold-700 mt-1" v-text="ventas"></h2>
                  <p class="mb-0">Cantidad de Ventas registradas</p>
                </div>
                <div class="card-content">
                  <div id="line-area-chart-1"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                  <div class="avatar bg-rgba-danger p-50 m-0">
                    <div class="avatar-content">
                      <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                    </div>
                  </div>
                  <h2 class="text-bold-700 mt-1" v-text="ingresos"></h2>
                  <p class="mb-0">Cantidad de Compras registradas</p>
                </div>
                <div class="card-content">
                  <div id="line-area-chart-2"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                  <div class="avatar bg-rgba-info p-50 m-0">
                    <div class="avatar-content">
                      <i class="fa fa-briefcase text-info font-medium-5"></i>
                    </div>
                  </div>
                  <h2 class="text-bold-700 mt-1" v-text="categoria"></h2>
                  <p class="mb-0">Cantidad de Categorias registradas</p>
                </div>
                <div class="card-content">
                  <div id="line-area-chart-3"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                  <div class="avatar bg-rgba-info p-50 m-0">
                    <div class="avatar-content">
                      <i class="fa fa-tasks text-info font-medium-5"></i>
                    </div>
                  </div>
                  <h2 class="text-bold-700 mt-1" v-text="producto"></h2>
                  <p class="mb-0">Cantidad de Productos registrados</p>
                </div>
                <div class="card-content">
                  <div id="line-area-chart-4"></div>
                </div>
              </div>
            </div>
          </div>


        </section>
        <!-- Dashboard Ecommerce ends -->

      </div>
    </div>
  </div>
</template>
<script >
  let user = document.head.querySelector('meta[name="user"]');

  export default {
    data(){
      return{
       producto:0,
       categoria:0,
       proveedor:0,
       cliente:0,
       ingresos:0,
       ventas:0
     }
   },
   computed:{
    user(){
     return JSON.parse(user.content);
   }
 },
 methods : {

  conteoProducto(){

    let me=this;
    var url= '/producto/productostotales';

    axios.get(url).then(function (response) {

     me.producto=response.data;

                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                  })
    .catch(function (error) {
      console.log(error);
    });
  },

  conteoCategoria(){

    let me=this;
    var url= '/categoria/categoriatotales';

    axios.get(url).then(function (response) {

     me.categoria=response.data;

                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                  })
    .catch(function (error) {
      console.log(error);
    });
  },


  conteoProveedor(){

    let me=this;
    var url= '/proveedor/proveedortotales';

    axios.get(url).then(function (response) {

     me.proveedor=response.data;

                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                  })
    .catch(function (error) {
      console.log(error);
    });
  },

  conteoCliente(){

    let me=this;
    var url= '/cliente/clienteTotales';

    axios.get(url).then(function (response) {

     me.cliente=response.data;

                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                  })
    .catch(function (error) {
      console.log(error);
    });
  },

  conteoIngresos(){

    let me=this;
    var url= '/ingreso/conteoingresos';

    axios.get(url).then(function (response) {

     me.ingresos=response.data;

                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                  })
    .catch(function (error) {
      console.log(error);
    });
  },

  conteoVentas(){

    let me=this;
    var url= '/venta/ventastotales';

    axios.get(url).then(function (response) {

     me.ventas=response.data;

                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                  })
    .catch(function (error) {
      console.log(error);
    });
  }

},


mounted() {
  this.conteoProducto();
  this.conteoCategoria();
  this.conteoProveedor();
  this.conteoCliente();
  this.conteoIngresos();
  this.conteoVentas();
}
}

</script>