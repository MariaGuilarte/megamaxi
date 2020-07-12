<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <template v-if="listado==1">
          <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Ingresos</h2>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Lista de Ingresos
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else-if="listado==0">
          <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Detalles de Ingresos</h2>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Registrar Ingresos
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else-if="listado==2">
          <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Detalles de Ingresos</h2>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Visualizar Detalle de este ingreso
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </template>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrum-right">
            <div class="dropdown">
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <!-- <div style="position: relative; padding: 10px;  top:-60px; left: -10px;">--->
      <div class="content-body">
      <!-- Data list view starts -->
      <template v-if="listado==1">
        <section id="data-list-view" class="data-list-view-header">
          <!--button de modal--->
          <button class="btn btn-outline-primary" width="100" height="40"             @click="mostrarDetalle()"> Registrar Ingresos</button>
          <!--fin del button de modal--->
          <!-- DataTable starts -->
          <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%" id="example" border="1">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>USUARIO</th>
                  <th>PROVEEDOR</th>
                  <th>COMPROBANTE</th>
                  <th>SERIE</th>
                  <th>NUMERO</th>
                  <th>FECHA/HORA</th>
                  <th>IMPUESTO</th>
                  <th>TOTAL</th>
                  <th>ESTADO</th>
                  <th>OPCIONES</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="ingreso in arrayIngreso" :key="ingreso.id">
                  <td v-text="ingreso.id"></td>
                  <td v-text="ingreso.apellido"></td>
                  <td v-text="ingreso.nombre_proveedores"></td>
                  <td v-text="ingreso.tipo_comprobante"></td>
                  <td v-text="ingreso.serie_comprobante"></td>
                  <td v-text="ingreso.num_comprobante"></td>
                  <td v-text="ingreso.fecha_hora"></td>
                  <td v-text="ingreso.impuesto"></td>
                  <td v-text="ingreso.total"></td>
                  <td v-text="ingreso.estado"></td>
                  <td>
                    <button type="button"class="btn btn-icon btn-sm" title="Mostrar Detalle de Ingreso" @click="mostrarIngreso(ingreso.id)" >
                      <i class="feather icon-eye"></i>
                    </button> 
                    <button type="button"  class="btn btn-icon btn-sm" title="Anular Ingreso" @click="desactivarIngreso(ingreso.id)">
                      <i class="fa fa-ban"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--fin datatable-->
        </section>
      </template>
      <!-- Data list view end -->
      <!--inicio de section formularios---->
      <template v-else-if="listado==0">
        <section>
          <div class="form-group row border">
            <div class="col-md-9">
              <div class="form-group select2-border data-border-colo">
                <label for="">Proveedor(*)</label><br>
                <!--  <select class=" form-control" style="background-color:#0B1044" v-model="idproveedor">
                <option value="0" disabled>Seleccione</option>
                <option v-for="proveedor in arrayProveedor" :key="proveedor.id" :value="proveedor.id"></option>
              </select>   ---->
              <div v-if="idproveedor==0 || !idproveedor ">
                <v-select
                label="nombre"
                :options="arrayProveedor"
                v-model="idproveedor"
                class=" form-control is-invalid"
                style="background-color:#0B1044; font-size: 12pt; color: green;"
                >
              </v-select>
            </div>
            <div v-else>
              <v-select
              label="nombre"
              :options="arrayProveedor"
              v-model="idproveedor"
              class=" form-control is-valid "
              style="background-color:#0B1044; font-size: 12pt; color: green;"
              >    
            </v-select>
          </div> 
        </div>
      </div>


      
      <div class="col-md-3">
        <label for="">Impuestos(*)</label>
         <div v-if="impuesto==0 || !impuesto ">
        <input type="number" step = "any" class="form-control is-invalid" style="background-color:#0B1044" placeholder="0.18" v-model="impuesto" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">      
      </div>
      <div v-else>
        <input type="number" step = "any" class="form-control is-valid" style="background-color:#0B1044"  v-model="impuesto" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
      </div>
    </div>
    


      <div class="col-md-4">
        <div class="form-group">
          <label>Tipo Comprobante(*)</label>

          <div v-if="tipo_comprobante==0 || !tipo_comprobante " >
          <select class="custom-select is-invalid" v-model="tipo_comprobante" style="background-color:#0B1044">
            <option value="0" disabled>Seleccione</option>
            <option value="BOLETA">boleta</option>
            <option value="FACTURA">factura</option>
            <option value="TICKET">ticket</option>
          </select>
          </div>

           <div v-else>
             <select class=" custom-select is-valid" v-model="tipo_comprobante" style="background-color:#0B1044">
            <option value="0" disabled>Seleccione</option>
            <option value="BOLETA">boleta</option>
            <option value="FACTURA">factura</option>
            <option value="TICKET">ticket</option>
          </select>
           </div>
        </div>  
      </div>


      <div class="col-md-4">
        <div class="form-group">
          <label>Serie Comprobante(*)</label>
          <div v-if="serie_comprobante==0 || !serie_comprobante " >
          <input type="number" class="form-control is-invalid" style="background-color:#0B1044" v-model="serie_comprobante" step = "any" placeholder="000x" maxlength="7" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" @keypress="restrictChars($event)">
        </div>
        <div v-else>
          <input type="number" class="form-control is-valid" style="background-color:#0B1044" v-model="serie_comprobante" step = "any" placeholder="000x" maxlength="7" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" @keypress="restrictChars($event)">
        </div>
        </div>  
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Numero Comprobante(*)</label>
          <div v-if="num_comprobante==0 || !num_comprobante " >
          <input type="number" class="form-control is-invalid" step = "any" style="background-color:#0B1044" v-model="num_comprobante" placeholder="000x" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" @keypress="restrictChars($event)">
        </div>
        <div v-else>
          <input type="number" class="form-control is-valid" step = "any" style="background-color:#0B1044" v-model="num_comprobante" placeholder="000x" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" @keypress="restrictChars($event)">
        </div>
        </div>  
      </div>
    </div>
    <div class="form-group row border">
      <div class="col-md-6">
        <div class="form-group">
          <label>Productos<span style="color:red;" v-show="idproducto==0">(*seleccione)</span> </label>
          <div class="form-inline">
            <input type="text" class="form-control" @keyup.enter="buscarProducto()" style="background-color:#0B1044" v-model="codigo" placeholder="busqueda de productos">
            <button @click="abrirModal()" class="btn btn-primary">....</button>
            <input type="text" readonly class="form-control" v-model="producto" style="background-color:#0B1044">
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Precio<span style="color:red;" v-show="precio==0">(*ingrese)</span></label>
          <input type="number"  step="any" placeholder="0.0" class="form-control"  style="background-color:#0B1044" v-model="precio">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Cantidad <span style="color:red;" v-show="cantidad==0">(*ingrese)</span></label>
          <input type="number"  placeholder="2" class="form-control" style="background-color:#0B1044"  v-model="cantidad" @keypress="restrictChars($event)">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <button @click="agregarDetalle()" class="btn btn-success btnagregar">
            <i class="feather icon-plus-circle"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="form-group row border">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
          <thead> 
            <tr>
              <th>Opciones</th>
              <th>Productos</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody v-if="arrayDetalle.length">
            <tr  v-for="(detalle,index) in arrayDetalle" :key="detalle.id" style="background-color: #0B1044;">
              <td>
                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td v-text="detalle.producto"></td>
              <td>
                <input v-model="detalle.precio" type="number"  class="form-control"  >
              </td>
              <td>
                <input v-model="detalle.cantidad" type="number"   class="form-control" 
                >
              </td>
              <td>
                {{(detalle.precio*detalle.cantidad).toFixed(2)}}
              </td>
            </tr>
            <tr style="background-color:#4E54A0">
              <td colspan="4" align="right"><strong> Total Parcial:</strong></td>
              <td>$ {{total=calcularTotal.toFixed(2)}}</td>
            </tr>
            <tr style="background-color:#4E54A0">
              <td colspan="4" align="right"><strong> Total Impuesto:</strong></td>
              <td>$ {{totalimpuesto=(total*impuesto).toFixed(2)}}</td>
            </tr>
            <tr style="background-color:#4E54A0">
              <td colspan="4" align="right"><strong> Total Neto:</strong></td>
              <td>$ {{totalparcial=calcularTotalneto.toFixed(2)}}</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="5" align="center">
                No hay articulos agregados
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="form-group row ">
      <div class="col-md-12">
        <button type="button" class="btn btn-secondary" @click="ocultarDetalle">Cerrar</button>
        <button type="button" class="btn btn-primary" :disabled="validaringreso" @click="registrarIngreso()">Registrar Compra</button>
      </div>
    </div>
  </section>
</template>
<!---fin de section formularios----->


  <!--inicio de section formularios---->
  <template v-else-if="listado==2">
        <section>
          <div class="form-group row border">
            <div class="col-md-9">
              <div class="form-group select2-border data-border-colo">
                <label for="">Proveedor</label><br>
                <p v-text="nombre_proveedores"></p>
        </div>
      </div>
      <div class="col-md-3">
        <label for="">Impuestos</label>
        <p v-text="impuesto"></p>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Tipo Comprobante</label>
          <p v-text="tipo_comprobante"></p>
        </div>  
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Serie Comprobante</label>
         <p v-text="serie_comprobante"></p>
        </div>  
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Numero Comprobante</label>
          <p v-text="num_comprobante"></p>
        </div>  
      </div>
    </div>
    
    <div class="form-group row border">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
          <thead> 
            <tr>
              <th>Productos</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody v-if="arrayDetalle.length">
            <tr  v-for="detalle in arrayDetalle" :key="detalle.id" style="background-color: #0B1044;">
             
              <td v-text="detalle.producto"></td>
              <td v-text="detalle.precio"></td>
              <td v-text="detalle.cantidad"></td>
              <td>
                {{(detalle.precio*detalle.cantidad).toFixed(2)}}
              </td>
            </tr>
            <tr style="background-color:#4E54A0">
              <td colspan="3" align="right"><strong> Total Parcial:</strong></td>
              <td>$ {{total}}</td>
            </tr>
            <tr style="background-color:#4E54A0">
              <td colspan="3" align="right"><strong> Total Impuesto:</strong></td>
              <td>$ {{totalimpuesto=(total*impuesto).toFixed(2)}}</td>
            </tr>
            <tr style="background-color:#4E54A0">
              <td colspan="3" align="right"><strong> Total Neto:</strong></td>
              <td>$ {{totalparcial=calcularTotalneto.toFixed(2)}}</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="5" align="center">
                No hay articulos agregados
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="form-group row ">
      <div class="col-md-12">
        <button type="button" class="btn btn-secondary" @click="ocultarDetalle">Cerrar</button>
        
      </div>
    </div>
  </section>
</template>
<!-----fin template------>
</div>
<!--</div>---->
<!--- fin del div de posicion!!!-->
<!-- Inicio de modal-->
<div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-text="tituloModal"></h5>
        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--fomulario de busqueda---->
        <div class="form-group row">
          <div class="col-md-6">
            <div class="input-group">
              <template v-if="arrayProducto==0">
                <input type="text" @keyup.enter="listarProducto()" class="form-control" placeholder="Dar enter para visualizar el listado de productos">&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" disabled="true"> .....</button>
              </template>
              <template v-else>
                <input type="text" @keyup.enter="listarProducto()" class="form-control" placeholder="Enter realizado ya podrás visualizar el listado de productos" disabled="true">&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" disabled="true"> .....</button>
              </template>
            </div>
          </div>
        </div>
        <!--table responsive---->
        <div class="table-responsive">
          <table class="table table-striped table-bordered" style="width:100%" id="example2" border="1">
            <thead>
              <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>CÓDIGO</th>
                <th>PRODUCTO</th>
                <th>PRECIO</th>
                <th>STOCK</th>
                <th>OPCIONES</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="producto in arrayProducto" :key="producto.id">
                <td v-text="producto.id"></td>
                <td v-text="producto.nombre_categoria"></td>
                <td v-text="producto.codigo"></td>
                <td v-text="producto.nombre"></td>
                <td v-text="producto.precio_venta"></td>
                <td v-text="producto.stock"></td>
                <td>
                  <button type="button"class="btn btn-icon btn-sm" title="Agregar Producto" @click="agregarDetalleModal(producto)" >
                    <i class="feather icon-plus-circle"></i>
                  </button> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin de modal ingreso -->
</div>
</div>
</template>
<script>
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import datables from 'datatables'
export default {
  data (){
    return {
      ingreso_id: 0,
      idproveedor: 0,
      nombre_proveedores:'',
      tipo_comprobante : '0',
      serie_comprobante : '',
      num_comprobante : '',
      impuesto : 0.18,
      total : 0.0,
      totalimpuesto:0.0,
      totalparcial:0.0,
      arrayIngreso : [],
      arrayDetalle:[],
      listado: 1,
      modal : 0,
      tituloModal : '',
      tipoAccion : 0,
      arrayProveedor:[],
      arrayProducto:[],
      idproducto:0,
      codigo:'',
      producto:'',
      precio:0,
      cantidad:0
    }
  },
  components:{
    vSelect
  },
  computed:{
     validaringreso(){
    return  this.idproveedor==0 || !this.impuesto || this.impuesto==0 ||        !this.serie_comprobante || !this.num_comprobante || this.arrayDetalle.length<=0 ; 
  },
  calcularTotal: function(){
    var resultado=0.0;
    for(var i=0;i<this.arrayDetalle.length;i++){
      resultado=resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad);
    }
    return resultado;
  },
  calcularTotalneto: function(){
    var resultado1=0.0;
    var resultado2=0.0;
    for(var i=0;i<this.arrayDetalle.length;i++){
      resultado1=resultado1+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad);
    }
    resultado2=resultado2+(resultado1+(resultado1*this.impuesto));
    return resultado2;
  }
},
methods : {
  //Validar solo numeros
  restrictChars: function($event) {
    if ($event.charCode === 0 || /\d/.test(String.fromCharCode($event.charCode))) {
      return true
    } else {
      $event.preventDefault();
    }
  },
  //fin de validar solo numeros
  mytable(){
    $(function () {
      $('#example').DataTable({
        "language": {
          "emptyTable":           "No hay datos disponibles en la tabla.",
          "info":             "Del _START_ al _END_ de _TOTAL_ ",
          "infoEmpty":            "Mostrando 0 registros de un total de 0.",
          "infoFiltered":         "(filtrados de un total de _MAX_ registros)",
          "infoPostFix":          "(actualizados)",
          "lengthMenu":           "Mostrar _MENU_ registros",
          "loadingRecords":       "Cargando...",
          "processing":           "Procesando...",
          "search":           "Buscar:",
          "searchPlaceholder":        "Dato para buscar",
          "zeroRecords":          "No se han encontrado coincidencias.",
          "paginate": {
            "first":            "Primera",
            "last":             "Última",
            "next":             "Siguiente",
            "previous":         "Anterior"
          },
          "aria": {
            "sortAscending":    "Ordenación ascendente",
            "sortDescending":   "Ordenación descendente"
          }
        },//fin de lenguaje
        "lengthMenu":       [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "order": [[0, "desc"]]
      });//fin del metodo datatable
    });//fin de llave y parentesis funcion
  },//fin del metodo table
  //--------------------------------------------------------------------
  mytable2(){
    $(function () {
      $('#example2').DataTable({
        "language": {
          "emptyTable":           "No hay datos disponibles en la tabla.",
          "info":             "Del _START_ al _END_ de _TOTAL_ ",
          "infoEmpty":            "Mostrando 0 registros de un total de 0.",
          "infoFiltered":         "(filtrados de un total de _MAX_ registros)",
          "infoPostFix":          "(actualizados)",
          "lengthMenu":           "Mostrar _MENU_ registros",
          "loadingRecords":       "Cargando...",
          "processing":           "Procesando...",
          "search":           "Buscar:",
          "searchPlaceholder":        "Dato para buscar",
          "zeroRecords":          "No se han encontrado coincidencias.",
          "paginate": {
            "first":            "Primera",
            "last":             "Última",
            "next":             "Siguiente",
            "previous":         "Anterior"
          },
          "aria": {
            "sortAscending":    "Ordenación ascendente",
            "sortDescending":   "Ordenación descendente"
          }
        },//fin de lenguaje
        "lengthMenu":       [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "order": [[0, "desc"]]
      });//fin del metodo datatable
    });//fin de llave y parentesis funcion
  },//fin del metodo table2


  //--------------------------------------------------------------------
  //metodo listar ingreso
  listarIngreso(){
    let me=this;
    var url= '/ingreso';
    axios.get(url).then(function (response) {
      var respuesta= response.data;
      me.arrayIngreso = respuesta.ingresos.data;
      $("#example").dataTable().fnDestroy();
      me.mytable()
      // me.pagination= respuesta.pagination;
      //me.arrayUsuario = response.data;
    })
    .catch(function (error) {
      console.log(error);
    });
  },
  //fin del metodo listar usuario
  //--------------------------------------------------------------------------
  //Metodo seleccionar categoria
  selectProveedor(){
    let me=this;
    var url= '/proveedor/selectproveedor';
    axios.get(url).then(function (response) {
      var respuesta = response.data;
      me.arrayProveedor=respuesta.proveedores;
    })
    .catch(function (error) {
      console.log(error);
    });
  },
  //--------------------------------------------------------------------------
  //Metodo buscar producto
  buscarProducto(){
    let me=this;
    var url= '/producto/buscarproducto?filtro='+me.codigo;
    axios.get(url).then(function (response) {
      var respuesta = response.data;
      me.arrayProducto=respuesta.productos;
      if(me.arrayProducto.length>0){
        me.producto=me.arrayProducto[0]['nombre'];
        me.idproducto=me.arrayProducto[0]['id'];
      }else{
        me.producto='No existe Producto';
        me.idproducto=0;
      }
    })
    .catch(function (error) {
      console.log(error);
    });
  },
  //--------------------------------------------------------------------------
  //eliminar detalle
  eliminarDetalle(index){
    let me = this;
    me.arrayDetalle.splice(index, 1); 
  },
  //Metodo agregar detalle
  agregarDetalle(){
    let me=this;

 if(me.idproducto==0 || me.cantidad==0 || me.precio==0){

    }else{
    if(me.encuentra(me.idproducto)) {
      swal({
        type: 'error',
        title: 'Error',
        text: 'Este producto ya se encuentra agregado!',
      })
    }else
    {
      me.arrayDetalle.push({
        idproducto: me.idproducto,
        producto: me.producto,
        cantidad: me.cantidad,
        precio: me.precio
      });
      me.codigo="";
      me.idproducto=0;
      me.producto="";
      me.cantidad=0;
      me.precio=0;
    }}
  },
  //inicio metodo encuentra
  encuentra(id){
    var sw=0;
    for(var i=0; i<this.arrayDetalle.length; i++){
      if(this.arrayDetalle[i].idproducto==id){
        sw=true;
      }
    }
    return sw;
  },
  //-----------------------------------------------------------------------------------
  //inicio de registar Ingreso
  registrarIngreso(){
    let me = this;
    axios.post('/ingreso/registrar',{
      'idproveedor': this.idproveedor.id,
      'impuesto': this.impuesto,
      'tipo_comprobante': this.tipo_comprobante,
      'serie_comprobante': this.serie_comprobante,
      'num_comprobante': this.num_comprobante,
      'total': this.total,
      'data': this.arrayDetalle
    }).then(function (response) {
      
      me.listarIngreso();
      me.ocultarDetalle();
      me.idproveedor=0;
      me.tipo_comprobante='BOLETA';
      me.serie_comprobante='';
      me.num_comprobante='';
      me.impuesto=0.18;
      me.total=0.0;
      me.idproducto=0;
      me.producto='';
      me.cantidad=0;
      me.precio=0;
      me.arrayDetalle=[];
      swal(
      'Registrado!',
      'El registro de este ingreso se ha guardado con éxito.',
      'success'
        )
      
    }).catch(function (error) {
      console.log(error);
    });
  },
  //fin del registrar ingreso

  //----------------------------------------------------------------------
            // Metodo Desasctivar Ingresos
               desactivarIngreso(id){
               swal({
                title: '¿Estás seguro que deseas anular este ingreso?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/ingreso/desactivar',{
                        'id': id
                    }).then(function (response) {
                        $("#example").dataTable().fnDestroy();
                        me.listarIngreso();
                        swal(
                        'Anulado!',
                        'El registro de este ingreso ha sido anulado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
          
      //fin del metodo anular ingreso
  //--------------------------------------------------------------------
  //metodo listar Producto
  listarProducto(){
    let me=this;
    var url= '/producto/listarproducto';
    axios.get(url).then(function (response) {
      var respuesta= response.data;
      me.arrayProducto = respuesta.productos.data;
      me.mytable2()
      // me.pagination= respuesta.pagination;
      //me.arrayUsuario = response.data;
    })
    .catch(function (error) {
      console.log(error);
    });
  },
  //-----------------------------------------------------------------------------------
  //metodo agregar detalle modal
  agregarDetalleModal(data=[]){
    let me=this;

    if(me.encuentra(data['id'])) {
      swal({
        type: 'error',
        title: 'Error',
        text: 'Este producto ya se encuentra agregado!',
      })
    }else
    {
      me.arrayDetalle.push({
        idproducto: data['id'],
        producto: data['nombre'],
        cantidad: 1,
        precio: 1
      });
        me.idproducto=0;
        me.producto='';
        me.cantidad=0;
        me.precio=0;
    }
  },
  //metodo abrir modal
  abrirModal(){
    this.arrayProducto=[]; 
    this.modal = 1;
    this.tituloModal = 'Seleccione uno o mas productos';
    $("#example2").dataTable().fnDestroy();

  },//fin del metodo abrir modal
  //------------------------------------------------------------------------
  //mostrar detalle
  mostrarDetalle(){
    let me = this;
    me.listado=0;
    me.idproveedor=0;
    me.tipo_comprobante='0';
    me.serie_comprobante='';
    me.num_comprobante='';
    me.impuesto=0.18;
    me.total=0.0;
    me.idproducto=0;
    me.producto='';
    me.cantidad=0;
    me.precio=0;
    me.arrayDetalle=[];
    
  },
  //fin de mostrar detalle
  //inicio de ocultar detale
  ocultarDetalle(){
    this.listado=1;
    var refreshedDataFromTheServer = this.listarIngreso();
    var myTable = $('#example').DataTable();
    myTable.clear().rows.add(refreshedDataFromTheServer).draw();


  },
  //fin de ocultar detalle
  //inicio de mostrar ingreso
  mostrarIngreso(id){
    let me=this;
    me.listado=2;


    //Obtener datos de ingresos
    var arrayIngresoT=[];
    var url= '/ingreso/obtenerCabeceras?id='+id;
    axios.get(url).then(function (response) {
      var respuesta= response.data;
      arrayIngresoT = respuesta.ingreso;
      me.nombre_proveedores = arrayIngresoT[0]['nombre_proveedores'];
      me.tipo_comprobante = arrayIngresoT[0]['tipo_comprobante'];
      me.serie_comprobante = arrayIngresoT[0]['serie_comprobante'];
      me.num_comprobante = arrayIngresoT[0]['num_comprobante'];
      me.impuesto = arrayIngresoT[0]['impuesto'];
      me.total = arrayIngresoT[0]['total'];
   

    })
    .catch(function (error) {
      console.log(error);
    });


    //Obtener datos de detalles
    var urld= '/ingreso/obtenerDetalles?id='+id;
    axios.get(urld).then(function (response) {
      var respuesta= response.data;
      me.arrayDetalle = respuesta.detalles;

   

    })
    .catch(function (error) {
      console.log(error);
    });
  },
  //fin de mostrar ingreso
  //-----------------------------------------------------------------------------
  //metodo cerrar modal
  cerrarModal(){
    this.modal = 0;
    this.tituloModal = '';
  },//fin del metodo cerrar modal
},//fin de metodos
//------------------------------------------------------------------------------------
//inicio de mounted
created(){
  this.listarIngreso();
},
mounted() {
  //this.listarIngreso();
  this.selectProveedor();
}
//fin de mounted
}//fin de export default
// Example starter JavaScript for disabling form submissions if there are invalid fields
</script>
<style type="text/css">
  .modal-content{
    width: 100% !important;
    width: 500px;
    height:500px;
  }
  .mostrar{
    display: list-item !important;
    opacity: 1 !important;
    background-color: #3c29297a !important;
  }
  @media(min-width: 600px){
    .btnagregar{
      margin-top: 2rem;   
    }
  }
</style>
