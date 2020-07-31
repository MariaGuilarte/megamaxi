<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Proveedor</h2>
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">Lista de proveedores
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
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
      <section id="data-list-view" class="data-list-view-header">
        <!--button de modal--->
        <button class="btn btn-outline-primary" width="100" height="40"        @click="abrirModal('proveedor','registrar')"> + Agregar</button>
        <!--fin del button de modal--->
        <!-- DataTable starts -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered" style="width:100%" id="example" border="1">
            <thead>
              <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>RUC</th>
                <th>DIRECCION</th>
                <th>TELEFONO</th>
                <th>CORREO</th>
                <th>OPCIONES</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="proveedor in arrayProveedor" :key="proveedor.id">
                <td v-text="proveedor.id"></td>
                <td v-text="proveedor.nombre"></td>
                <td v-text="proveedor.ruc"></td>
                <td v-text="proveedor.direccion"></td>
                <td v-text="proveedor.telefono"></td>
                <td v-text="proveedor.email"></td>
                <td>
                  <button type="button"class="btn btn-icon btn-sm" title="Editar Proveedor" @click="abrirModal('proveedor','actualizar',proveedor)" >
                    <i class="feather icon-edit"></i>
                  </button> &nbsp;
                  <button type="button"  class="btn btn-icon btn-sm" title="Eliminar Proveedor" @click="BorrarProveedor(proveedor.id)">
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!--fin datatable-->
        <!-- Inicio de modal-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document" >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-text="tituloModal"></h5>
                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post">
                  <div class="form-group row">
                    <label  for="validationCustom01" class="col-md-3 col-form-label" >Nombre:</label>
                    <div class="col-sm-9 ">
                      <div v-if="!nombre">
                        <input type="text" 
                        v-model="nombre"  class="form-control is-invalid" onkeypress="return !(event.charCode >= 48 && event.charCode <= 57)"  >
                      </div>
                      <div v-else>
                        <input type="text"   v-model="nombre"   class="form-control is-valid" onkeypress="return !(event.charCode >= 48 && event.charCode <= 57)" >
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Ruc:</label>
                    <div class="col-sm-9 ">
                      <div v-if="!ruc">   
                        <input type="text" v-model="ruc" class="form-control is-invalid" @keypress="restrictChars($event)" >
                      </div>
                      <div v-else>
                        <input type="text" v-model="ruc" class="form-control is-valid" @keypress="restrictChars($event)"  >
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Dirección:</label>
                    <div class="col-sm-9 ">
                      <div v-if="!direccion">    
                        <input type="text" v-model="direccion" class="form-control is-invalid">
                      </div>
                      <div v-else>
                        <input type="text" v-model="direccion" id="direccion"  class="form-control is-valid"  >
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Teléfono:</label>
                    <div class="col-sm-9 ">
                      <div v-if="!telefono">     
                        <input type="text" v-model="telefono" @keypress="restrictChars($event)" class="form-control is-invalid">
                      </div>
                      <div v-else>
                        <input type="text" @keypress="restrictChars($event)"  v-model="telefono" id="telefono"  class="form-control is-valid"  >
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Correo:</label>
                    <div class="col-sm-9 ">
                      <input ref="emailInput" type="email" v-model="email" class="form-control" :class="{'is-invalid':invalidEmail, 'is-valid':!invalidEmail}">
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                <button  :disabled="validarProveedor" type="submit"  v-if="tipoAccion==1" class="btn btn-primary" id="btn_Validar" @click="registrarProveedor()">Guardar</button>
                <button  :disabled="validarProveedor" type="button" v-if="tipoAccion==2"  class="btn btn-primary" @click="actualizarProveedor()">Actualizar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- fin de modal -->
      </section>
      <!-- Data list view end -->
    </div>
    <!--</div>-->
    <!-- fin del div de posicion!!!-->
  </div>
</div>
</template>
<script>
import datables from 'datatables'
export default {
  data (){
    return {
      proveedor_id: 0,
      nombre : '',
      ruc : '',
      direccion : '',
      telefono : '',
      email : '',
      arrayProveedor : [],
      modal : 0,
      tituloModal : '',
      tipoAccion : 0,
    }
  },
  computed:{
    invalidEmail(){
      return !(this.email && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email))
    },
    validarProveedor(){
      return  this.invalidEmail || !this.nombre || !this.ruc || !this.direccion
      || !this.telefono || !this.email; 
    },
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
            "info":                 "Del _START_ al _END_ de _TOTAL_ ",
            "infoEmpty":            "Mostrando 0 registros de un total de 0.",
            "infoFiltered":         "(filtrados de un total de _MAX_ registros)",
            "infoPostFix":          "(actualizados)",
            "lengthMenu":           "Mostrar _MENU_ registros",
            "loadingRecords":       "Cargando...",
            "processing":           "Procesando...",
            "search":               "Buscar:",
            "searchPlaceholder":    "Dato para buscar",
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
    //metodo listar Proveedor
    listarProveedor(){
      let me=this;
      var url= '/proveedor';
      axios.get(url).then(function (response) {
        var respuesta= response.data;
        me.arrayProveedor = respuesta.proveedores.data;
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
    //inicio de registar Usuario
    registrarProveedor(){
      let me = this;
      axios.post('/proveedor/registrar',{
        'nombre': this.nombre,
        'ruc': this.ruc,
        'direccion': this.direccion,
        'telefono': this.telefono,
        'email': this.email,
      }).then(function (response) {
        me.cerrarModal();
        $("#example").dataTable().fnDestroy();
        me.listarProveedor();
        swal(
          'REGISTRADO!',
          'El registro se ha guardado de forma exitosa.',
          'success'
        )
      }).catch(function (error) {
        console.log(error);
      });
    },
    //fin del registrar Proveedor
    //-------------------------------------------------------------------------------
    actualizarProveedor(){
      let me = this;
      axios.put('/proveedor/actualizar',{
        'nombre': this.nombre,
        'ruc': this.ruc,
        'direccion': this.direccion,
        'telefono': this.telefono,
        'email': this.email,
        'id': this.proveedor_id
      }).then(function (response) {
        me.cerrarModal();
        $("#example").dataTable().fnDestroy();
        me.listarProveedor();
        swal(
          'Actualizado!',
          'El registro se ha actualizado de forma exitosa.',
          'success'
        )
      }).catch(function (error) {
        console.log(error);
      }); 
    },
    //--------------------------------------------------------------------------------
    //metodo abrir modal
    abrirModal(modelo, accion, data = []){
      switch(modelo){
        case "proveedor":
        {
          switch(accion){
            case 'registrar':
            {
              this.modal = 1;
              this.tituloModal = 'Registrar Proveedor';
              this.nombre='';
              this.ruc= '';
              this.direccion='';
              this.telefono='';
              this.email = '';
              this.tipoAccion = 1;
              break;
            }//fin del case registrar
            //inicio del case actualizar
            case 'actualizar':
            {
              //console.log(data);
              this.modal=1;
              this.tituloModal='Actualizar Proveedor';
              this.tipoAccion=2;
              this.proveedor_id=data['id'];
              this.nombre = data['nombre'];
              this.ruc=data['ruc'];
              this.direccion= data['direccion'];
              this.telefono=data['telefono'];
              this.email=data['email'];
              break;
            }//fin del case actualizar
          }//fin del switch accion
        }//fin del case usuario
      }//fin del switch modelo
    },//fin del metodo abrir modal
    //------------------------------------------------------------------------
    //metodo cerrar modal
    cerrarModal(){
      this.modal = 0;
      this.tituloModal = '';
      this.nombre='';
      this.ruc= '';
      this.direccion='';
      this.telefono='';
      this.email = '';
    },//fin del metodo cerrar modal
    //----------------------------------------------------------------------
    // Metodo Desactivar Usuario
    BorrarProveedor(id){
      swal({
        title: '¿Estás seguro que deseas eliminar este proveedor?',
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
          axios.put('/proveedor/eliminar',{
            'id': id
          }).then(function (response) {
            $("#example").dataTable().fnDestroy();
            me.listarProveedor();
            swal(
              'Eliminado!',
              'El registro de este proveedor ha sido eliminado con éxito.',
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
  },
  //fin del metodo desactivar usuario
  //------------------------------------------------------------------------------------
  //inicio de mounted
  mounted() {
    this.listarProveedor();
  }
  //fin de mounted
}//fin de export default
// Example starter JavaScript for disabling form submissions if there are invalid fields
</script>
<style type="text/css">
  .modal-content{
    width: 100% !important;
    width: 400px;
    height:400px;
  }
  .mostrar{
    display: list-item !important;
    opacity: 1 !important;
    background-color: #3c29297a !important;
  }
</style>
