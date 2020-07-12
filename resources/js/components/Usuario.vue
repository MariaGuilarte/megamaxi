<template>
  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Usuarios</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    
                                    <li class="breadcrumb-item">Lista de usuarios activos
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
                    <button class="btn btn-outline-primary" width="100" height="40"        @click="abrirModal('usuario','registrar')"> + Agregar</button>
                   <!--fin del button de modal--->



                     <!-- DataTable starts -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="example" border="1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <th>TELEFONO</th>
                                    <th>DIRECCION</th>
                                    <th>USUARIO</th>
                                    <th>ROL</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in arrayUsuario" :key="user.id">
                                     <td v-text="user.id"></td>
                                     <td v-text="user.nombre"></td>
                                     <td v-text="user.apellido"></td>
                                     <td v-text="user.telefono"></td>
                                     <td v-text="user.direccion"></td>
                                     <td v-text="user.usuario"></td>
                                     <td v-text="user.nombre_roles"></td>
                                     <td>
                                     <button type="button"class="btn btn-icon btn-sm" title="Editar Usuario" @click="abrirModal('usuario','actualizar',user)" >
                                          <i class="feather icon-edit"></i>
                                        </button> &nbsp;
                                        <button type="button"  class="btn btn-icon btn-sm" title="Desactivar Usuario" @click="desactivarUsuario(user.id)">
                                          <i class="fa fa-ban"></i>
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
                                <label class=" col-md-3 col-form-label">Seleccione el Rol:</label>
                                 <div class="col-sm-9"> 
                                 <div v-if="idrol==0"> 
                                <select class="form-control custom-select is-invalid" v-model="idrol">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                </select>   
                                </div>  
                                <div v-else> 
                                <select class="custom-select is-valid" v-model="idrol">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                </select>   
                                </div>  
                              </div>
                             </div>
                          


                              <div class="form-group row">
                                <label  for="validationCustom01" class="col-md-3 col-form-label" >Nombres:</label>
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
                                <label class="col-md-3 col-form-label">Apellidos:</label>
                                <div class="col-sm-9 ">
                                <div v-if="!apellido">   
                                <input type="text" v-model="apellido" class="form-control is-invalid" onkeypress="return !(event.charCode >= 48 && event.charCode <= 57)">
                                 </div>
                                <div v-else>
                                <input type="text" v-model="apellido" id="apellido"  class="form-control is-valid" onkeypress="return !(event.charCode >= 48 && event.charCode <= 57)" >
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
                                <label class="col-md-3 col-form-label">Usuario:</label>
                                <div class="col-sm-9 ">
                                <div v-if="!usuario">
                                <input type="text" v-model="usuario" class="form-control is-invalid">
                                 </div>
                                <div v-else>
                                <input type="text" v-model="usuario" id="usuario"  class="form-control is-valid"  >
                              </div>
                             </div>
                             </div>

                              <div class="form-group row">
                                <label class="col-md-3 col-form-label">Contraseña:</label>
                                <div class="col-sm-9 ">
                                 <div v-if="!password">   
                                <input type="password" v-model="password" class="form-control is-invalid">
                               </div>
                                <div v-else>
                                <input type="password" v-model="password" id="password"  class="form-control is-valid"  >
                              </div>
                             </div>
                             </div>

                             
                            </form>
                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>

                            
                            <button  :disabled="validarUsuario" type="submit"  v-if="tipoAccion==1" class="btn btn-primary" id="btn_Validar" @click="registrarUsuario()">Guardar</button>
                            <button  :disabled="validarUsuario" type="button" v-if="tipoAccion==2"  class="btn btn-primary" @click="actualizarUsuario()">Actualizar</button>
                          </div>

                        </div>
                      </div>
                    </div>
                    <!-- fin de modal -->
                </section>
                <!-- Data list view end -->

            </div>
       <!--</div>---->
        <!--- fin del div de posicion!!!-->
        </div>
    </div>
 
</template>

<script>
   


    import datables from 'datatables'

    export default {
       
     
        data (){
            return {
                usuario_id: 0,
                idrol : 0,
                nombre_rol:'',
                nombre : '',
                apellido : '',
                telefono : '',
                direccion : '',
                usuario : '',
                password : '',
                arrayUsuario : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorUsuario:0,
                errorMostrarMsjUsuario : [],
      
  
                arrayRol :[]
            }
        },
            
            computed:{
                 validarUsuario(){

             return  this.idrol==0 || !this.nombre || !this.apellido || !this.telefono
             || !this.direccion || !this.usuario || !this.password; 
         
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
        
            //metodo listar usuario

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
            listarUsuario (){
            
                let me=this;
                var url= '/usuario';
              
                axios.get(url).then(function (response) {

                    var respuesta= response.data;

                    me.arrayUsuario = respuesta.usuarios.data;
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
            registrarUsuario(){
                 
                let me = this;

                axios.post('/usuario/registrar',{
                    'idrol': this.idrol,
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'telefono': this.telefono,
                    'direccion': this.direccion,
                    'usuario': this.usuario,
                    'password': this.password
                }).then(function (response) {
                  
                    me.cerrarModal();
                    $("#example").dataTable().fnDestroy();
                    me.listarUsuario();
                    swal(
                        'REGISTRADO!',
                        'El registro se ha guardado de forma exitosa.',
                        'success'
                        )
                      


                }).catch(function (error) {
                    console.log(error);
                });
            },
            //fin del registrar Usuario

//-------------------------------------------------------------------------------

              actualizarUsuario(){
             
                
                let me = this;

                axios.put('/usuario/actualizar',{
                    'idrol': this.idrol,
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'telefono': this.telefono,
                    'direccion': this.direccion,
                    'usuario': this.usuario,
                    'password': this.password,
                    'id': this.usuario_id
                }).then(function (response) {
                    me.cerrarModal();
                    $("#example").dataTable().fnDestroy();
                    me.listarUsuario();
                    swal(
                        'Actualizado!',
                        'El registro se ha actualizado de forma exitosa.',
                        'success'
                        )
                }).catch(function (error) {
                    console.log(error);
                }); 
            },




//----------------------------------------------------------------------
            
            //Metodo seleccionar rol
                selectRol(){
                let me=this;
                var url= '/rol/selectrol';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            //fin del metodo seleccionar rol
  //-----------------------------------------------------------------------------------
            //metodo abrir modal
           abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "usuario":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Usuario';
                                this.idrol=0;
                                this.nombre_rol='';
                                this.nombre='';
                                this.apellido= '';
                                this.telefono='';
                                this.direccion='';
                                this.usuario = '';
                                this.password = '';
                                this.tipoAccion = 1;
                                break;
                            }//fin del case registrar
                            //inicio del case actualizar
                           case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Usuario';
                                this.tipoAccion=2;
                                this.usuario_id=data['id'];
                                this.idrol=data['idrol'];
                                this.nombre = data['nombre'];
                                this.apellido=data['apellido'];
                                this.telefono=data['telefono'];
                                this.direccion= data['direccion'];
                                this.usuario=data['usuario'];
                                this.password= data['password'];
                                break;
                            }//fin del case actualizar
                        }//fin del switch accion
                    }//fin del case usuario
                }//fin del switch modelo
                 this.selectRol();
                
            },//fin del metodo abrir modal
//------------------------------------------------------------------------
            //metodo cerrar modal
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.idrol=0;
                this.nombre_rol='';
                this.nombre='';
                this.apellido= '';
                this.telefono='';
                this.direccion='';
                this.usuario = '';
                this.password = '';
                this.errorUsuario=0;
            },//fin del metodo cerrar modal

//----------------------------------------------------------------------
            // Metodo Desactivar Usuario
          desactivarUsuario(id){
               swal({
                title: '¿Estás seguro que deseas desactivar este usuario?',
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

                    axios.put('/usuario/desactivar',{
                        'id': id
                    }).then(function (response) {
                        $("#example").dataTable().fnDestroy();
                        me.listarUsuario();
                        swal(
                        'Desactivado!',
                        'El registro de este usuario ha sido desactivado con éxito.',
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
            this.listarUsuario();
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
    .caja {
   margin:20px auto 40px auto;
   border-radius: 15px;  
   border:solid #d9d9d9;
   height:50px;
   overflow: hidden;

   width: 100px;
   position:relative;
}
select {
   background: #10163A;
   border-radius: 15px;
   border: 1px solid #d9d9d9;
   font-size: 20px;
   color:white;
   height: 50px;
   padding: 5px;
   width: 120px;
}
select:focus{ outline: none;}

.caja::after{
    content:"\025be";
    display:table-cell;
    padding-top:7px;
    text-align:center;
    width:40px;
    height:50px;
    background-color:#10163A;
    position:absolute;
    top:0;
    right:0px;  
    pointer-events: none;
}
.redondeado {
   background-color: #10163A;
   border-radius: 15px;
   border: 1px solid #39c;
   height: 50px;
   padding: 10px;
   width: 250px;

 }



</style>
