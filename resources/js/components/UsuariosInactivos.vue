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
                                    
                                    <li class="breadcrumb-item">Lista de usuarios Inactivos
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
                                     <button type="button"class="btn btn-icon btn-sm" title="Activar Usuario" @click="activarUsuario(user.id)">
                                          <i class="feather icon-check"></i>
                                        </button> &nbsp;
                                        <button type="button"  class="btn btn-icon btn-sm" title=" Borrar Usuario" @click="desactivarUsuario(user.id)">
                                          <i class="feather icon-trash-2"></i>
                                        </button>
                                 </td>
                                </tr>
                            </tbody>
                        </table>
                  
                    </div>
                    <!--fin datatable-->
      
                   
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
         
      
  
                arrayRol :[]
            }
        },
            
            
    
        methods : {
             
           
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
                var url= '/usuarioinactivos';
              
                axios.get(url).then(function (response) {

                    var respuesta= response.data;

                    me.arrayUsuario = respuesta.usuarios.data;
                    me.mytable()
                    $("#example").dataTable().fnDestroy();
                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           //fin del metodo listar usuario


            // Metodo Desactivar Usuario
          desactivarUsuario(id){
               swal({
                title: '¿Estás seguro que deseas borrar este usuario?',
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

                    axios.put('/usuarioinactivos/borrar',{
                        'id': id
                    }).then(function (response) {
                        $("#example").dataTable().fnDestroy();
                        me.listarUsuario();
                        swal(
                        'Borrado!',
                        'El registro de este usuario ha sido borrado con éxito.',
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
           
           
     
      //fin del metodo desactivar usuario
//----------------------------------------------------------------------------
       // Metodo Activar Usuario
          activarUsuario(id){
               swal({
                title: '¿Estás seguro que deseas Activar este usuario?',
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

                    axios.put('/usuarioinactivos/activar',{
                        'id': id
                    }).then(function (response) {
                        $("#example").dataTable().fnDestroy();
                        me.listarUsuario();
                        swal(
                        'Activado!',
                        'Este usuario se ha activado con éxito, lo puedes revisar en la lista de usuarios activos',
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
             //fin del metodo activar usuario
     //------------------------------------------------------------------------------------

      },//fin de methods
    

        //inicio de mounted
        mounted() {
            this.listarUsuario();
        }
        //fin de mounted
    }//fin de export default



// Example starter JavaScript for disabling form submissions if there are invalid fields





</script>


