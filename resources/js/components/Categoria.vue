<template>
  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Categoria</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    
                                    <li class="breadcrumb-item">Lista de categorias
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
                    <button class="btn btn-outline-primary" width="100" height="40"        @click="abrirModal('categoria','registrar')"> + Agregar</button>
                   <!--fin del button de modal--->



                     <!-- DataTable starts -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="example" border="1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                     <td v-text="categoria.id"></td>
                                     <td v-text="categoria.nombre"></td>
                                     <td v-text="categoria.descripcion"></td>
                                     <td>
                                     <button type="button"class="btn btn-icon btn-sm" title="Editar Categoria" @click="abrirModal('categoria','actualizar',categoria)" >
                                          <i class="feather icon-edit"></i>
                                        </button> &nbsp;
                                        <button type="button"  class="btn btn-icon btn-sm" title="Eliminar Categoria" @click="BorrarCategoria(categoria.id)">
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
                                <label  for="validationCustom01" class="col-md-3 col-form-label" >Descripción:</label>
                                <div class="col-sm-9 ">
                                <div v-if="!descripcion">
                                <input type="text" 
                                  v-model="descripcion"  class="form-control is-invalid">
                                    </div>
                                <div v-else>
                                <input type="text"   v-model="descripcion"   class="form-control is-valid" >
                                </div>
                              </div>
                             </div>
                          
                             

                             
                            </form>
                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>

                            
                            <button  :disabled="validarCategoria" type="submit"  v-if="tipoAccion==1" class="btn btn-primary" id="btn_Validar" @click="registrarCategoria()">Guardar</button>
                            <button  :disabled="validarCategoria" type="button" v-if="tipoAccion==2"  class="btn btn-primary" @click="actualizarCategoria()">Actualizar</button>
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
                categoria_id: 0,
                nombre : '',
                descripcion : '',
                arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
            }
        },
            
            computed:{
                 validarCategoria(){

             return  !this.nombre || !this.descripcion 
         
             },

            

            },
    
        methods : {
             
       

           
            

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
            //metodo listar categoria
            listarCategoria(){
            
                let me=this;
                var url= '/categoria';
              
                axios.get(url).then(function (response) {

                    var respuesta= response.data;

                    me.arrayCategoria = respuesta.categorias.data;
                    me.mytable()
                    $("#example").dataTable().fnDestroy();
                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           //fin del metodo listar categoria
//--------------------------------------------------------------------------
            //inicio de registar categoria
            registrarCategoria(){
                 
                let me = this;

                axios.post('/categoria/registrar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion
                }).then(function (response) {
                  
                    me.cerrarModal();
                    $("#example").dataTable().fnDestroy();
                    me.listarCategoria();
                    swal(
                        'REGISTRADO!',
                        'El registro se ha guardado de forma exitosa.',
                        'success'
                        )
                      


                }).catch(function (error) {
                    console.log(error);
                });
            },
            //fin del registrar categoria

//-------------------------------------------------------------------------------
             //inicio metodo actualizar categoria
              actualizarCategoria(){
             
                
                let me = this;

                axios.put('/categoria/actualizar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id': this.categoria_id
                }).then(function (response) {
                    me.cerrarModal();
                    $("#example").dataTable().fnDestroy();
                    me.listarCategoria();
                    swal(
                        'Actualizado!',
                        'El registro se ha actualizado de forma exitosa.',
                        'success'
                        )
                }).catch(function (error) {
                    console.log(error);
                }); 
            },


          //fin del metodo actualizar categoria
//--------------------------------------------------------------------------------
            //metodo abrir modal
           abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Categoria';
                                this.nombre='';
                                this.descripcion= '';
                                this.tipoAccion = 1;
                                break;
                            }//fin del case registrar
                            //inicio del case actualizar
                           case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Cliente';
                                this.tipoAccion=2;
                                this.categoria_id=data['id'];
                                this.nombre = data['nombre'];
                                this.descripcion=data['descripcion'];
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
                this.descripcion= '';
            },//fin del metodo cerrar modal

//----------------------------------------------------------------------
            // Metodo eliminar categoria
               BorrarCategoria(id){
               swal({
                title: '¿Estás seguro que deseas eliminar esta categoria?',
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

                    axios.put('/categoria/eliminar',{
                        'id': id
                    }).then(function (response) {
                        $("#example").dataTable().fnDestroy();
                        me.listarCategoria();
                        swal(
                        'Eliminado!',
                        'El registro de esta categoria ha sido eliminado con éxito.',
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
      //fin del metodo eliminar categoria
//------------------------------------------------------------------------------------

        //inicio de mounted
        mounted() {
            this.listarCategoria();
        }
        //fin de mounted
    }//fin de export default



// Example starter JavaScript for disabling form submissions if there are invalid fields





</script>




<style type="text/css">
    .modal-content{
        width: 100% !important;
        width: 300px;
        height:300px;
     
       
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        background-color: #3c29297a !important;
    }
  
</style>
