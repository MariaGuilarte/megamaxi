<template>
  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Productos</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    
                                    <li class="breadcrumb-item">Lista de productos
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
                    <button class="btn btn-outline-primary" width="100" height="40"        @click="abrirModal('producto','registrar')"> <i class="feather icon-plus-circle"></i>&nbsp;  Agregar</button>
                    <button class="btn btn-outline-info" width="100" height="40"        @click="cargarPDF()"><i class="fa fa-clipboard"></i>&nbsp; Reporte</button>
                   <!--fin del button de modal--->



                     <!-- DataTable starts -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="example" border="1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoría</th>
                                    <th>CÓDIGO</th>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>STOCK</th>
                                    <th>DESCRIPCIÓN</th>
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
                                     <td v-text="producto.descripcion"></td>
                                     <td>
                                     <button type="button"class="btn btn-icon btn-sm" title="Editar Producto" @click="abrirModal('producto','actualizar',producto)" >
                                          <i class="feather icon-edit"></i>
                                        </button> &nbsp;
                                        <button type="button"  class="btn btn-icon btn-sm" title="Eliminar Producto" @click="BorrarProducto(producto.id)">
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
                                <label class=" col-md-3 col-form-label">Seleccione la categoría:</label>
                                 <div class="col-sm-9"> 
                                 <div v-if="idcategoria==0"> 
                                <select class="form-control custom-select is-invalid" v-model="idcategoria">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                </select>   
                                </div>  
                                <div v-else> 
                                <select class="custom-select is-valid" v-model="idcategoria">
                                            <option value="0" disabled>Seleccione la categoría:</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                </select>   
                                </div>  
                              </div>
                             </div>
            

                              <div class="form-group row">
                                <label  for="validationCustom01" class="col-md-3 col-form-label" >Código:</label>
                                <div class="col-sm-9 ">
                                <div v-if="!codigo">
                                <input type="text" 
                                  v-model="codigo"  class="form-control is-invalid"    @keypress="restrictChars($event)"  >
                                  <barcode :value="codigo" :options="{ format: 'EAN-13' }">
                                            Generando código de barras.    
                                        </barcode>
                                    </div>
                                <div v-else>
                                <input type="text"   v-model="codigo"   class="form-control is-valid" @keypress="restrictChars($event)"  >
                                <barcode :value="codigo" :options="{ format: 'EAN-13' }">
                                            Generando código de barras.    
                                        </barcode>
                                </div>
                              </div>
                             </div>
                          
                             

                              <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nombre:</label>
                                <div class="col-sm-9 ">
                                <div v-if="!nombre">   
                                <input type="text" v-model="nombre" class="form-control is-invalid" onkeypress="return !(event.charCode >= 48 && event.charCode <= 57)">
                                 </div>
                                <div v-else>
                                <input type="text" v-model="nombre" class="form-control is-valid" onkeypress="return !(event.charCode >= 48 && event.charCode <= 57)" >
                              </div>
                             </div>
                             </div>

                              <div class="form-group row">
                                <label class="col-md-3 col-form-label">Precio:</label>
                                <div class="col-sm-9 ">
                                <div v-if="!precio_venta">    
                                <input type = "number" step = "any" v-model="precio_venta" class="form-control is-invalid" >
                              </div>
                                <div v-else>
                                <input type = "number" step = "any" v-model="precio_venta" class="form-control is-valid" >
                                </div>
                               </div>
                             </div>

                              <div class="form-group row">
                                <label class="col-md-3 col-form-label">Stock:</label>
                                <div class="col-sm-9 ">
                                 <div v-if="!stock">     
                                <input type="text" v-model="stock" @keypress="restrictChars($event)" class="form-control is-invalid">
                                </div>
                                <div v-else>
                                <input type="text" @keypress="restrictChars($event)"  v-model="stock"  class="form-control is-valid"  >
                              </div>
                             </div>
                             </div>

                             <div class="form-group row">
                                <label class="col-md-3 col-form-label">Descripción:</label>
                                <div class="col-sm-9 ">
                                 <div v-if="!descripcion">     
                                <input type="text" v-model="descripcion" class="form-control is-invalid">
                                </div>
                                <div v-else>
                                <input type="text"  v-model="descripcion"  class="form-control is-valid"  >
                              </div>
                             </div>
                             </div>
                      

                             
                            </form>
                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>

                            
                            <button  :disabled="validarProducto" type="submit"  v-if="tipoAccion==1" class="btn btn-primary" id="btn_Validar" @click="registrarProducto()">Guardar</button>
                            <button  :disabled="validarProducto" type="button" v-if="tipoAccion==2"  class="btn btn-primary" @click="actualizarProducto()">Actualizar</button>
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
   

    import VueBarcode from 'vue-barcode';
    import datables from 'datatables'

    export default {
       
     
        data (){
            return {
                producto_id: 0,
                idcategoria :0,
                nombre_categoria:'',
                codigo : '',
                nombre : '',
                precio_venta : '',
                stock : '',
                descripcion:'',
                arrayProducto : [],
                arrayCategoria:[],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
            }
        },

        components: {
        'barcode': VueBarcode
            },
            
            computed:{
                 validarProducto(){

             return  this.idcategoria==0 || !this.codigo || !this.nombre || !this.precio_venta  || !this.stock || !this.descripcion; 
         
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
            //metodo listar Producto
            listarProducto(){
            
                let me=this;
                var url= '/producto';
              
                axios.get(url).then(function (response) {

                    var respuesta= response.data;

                    me.arrayProducto = respuesta.productos.data;
                    me.mytable()
                    $("#example").dataTable().fnDestroy();
                   // me.pagination= respuesta.pagination;
                    //me.arrayUsuario = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           //fin del metodo listar productos
//--------------------------------------------------------------------------
            //inicio de registar Productos
            registrarProducto(){
                 
                let me = this;

                axios.post('/producto/registrar',{
                    'idcategoria': this.idcategoria,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'precio_venta': this.precio_venta,
                    'stock': this.stock,
                    'descripcion': this.descripcion,
              
                }).then(function (response) {
                  
                    me.cerrarModal();
                    $("#example").dataTable().fnDestroy();
                    me.listarProducto();
                    swal(
                        'REGISTRADO!',
                        'El registro se ha guardado de forma exitosa.',
                        'success'
                        )
                      


                }).catch(function (error) {
                    console.log(error);
                });
            },
            //fin del registrar Productos

//-------------------------------------------------------------------------------
            //actualizar productos
              actualizarProducto(){
             
                
                let me = this;

                axios.put('/producto/actualizar',{
                    'idcategoria': this.idcategoria,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'precio_venta': this.precio_venta,
                    'stock': this.stock,
                    'descripcion': this.descripcion,
                    'id': this.producto_id
                }).then(function (response) {
                    me.cerrarModal();
                    $("#example").dataTable().fnDestroy();
                    me.listarProducto();
                    swal(
                        'Actualizado!',
                        'El registro se ha actualizado de forma exitosa.',
                        'success'
                        )
                }).catch(function (error) {
                    console.log(error);
                }); 
            },




          //fin del metodo actualizar productos
     //----------------------------------------------------------------------
            
            //Metodo seleccionar categoria
                selectCategoria(){
                let me=this;
                var url= '/categoria/selectcategoria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            //fin del metodo seleccionar categoria
  //--------------------------------------------------------------------------------
      //metodo cargar pdf
      cargarPDF(){
       window.open('http://localhost:8000/producto/listarproductopdf','_blank');
      },



//--------------------------------------------------------------------------------
            //metodo abrir modal
           abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "producto":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Productos';
                                this.idcategoria=0;
                                this.nombre_categoria='';
                                this.codigo='';
                                this.nombre= '';
                                this.precio_venta='';
                                this.stock='';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }//fin del case registrar
                            //inicio del case actualizar
                           case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Productos';
                                this.tipoAccion=2;
                                this.producto_id=data['id'];
                                this.idcategoria=data['idcategoria'];
                                this.codigo = data['codigo'];
                                this.nombre=data['nombre'];
                                this.precio_venta= data['precio_venta'];
                                this.stock=data['stock'];
                                this.descripcion=data['descripcion'];
                                break;
                            }//fin del case actualizar
                        }//fin del switch accion
                    }//fin del case usuario
                }//fin del switch modelo
               this.selectCategoria();
                
            },//fin del metodo abrir modal
//------------------------------------------------------------------------
            //metodo cerrar modal
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.idcategoria=0;
                this.nombre_categoria='';
                this.codigo='';
                this.nombre= '';
                this.precio_venta='';
                this.stock='';
                this.descripcion = '';
            },//fin del metodo cerrar modal

//----------------------------------------------------------------------
            // Metodo borrar producto
               BorrarProducto(id){
               swal({
                title: '¿Estás seguro que deseas eliminar este producto?',
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

                    axios.put('/producto/eliminar',{
                        'id': id
                    }).then(function (response) {
                        $("#example").dataTable().fnDestroy();
                        me.listarProducto();
                        swal(
                        'Eliminado!',
                        'El registro de este producto ha sido eliminado con éxito.',
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
      //fin del metodo borrar producto
//------------------------------------------------------------------------------------

        //inicio de mounted
        mounted() {
            this.listarProducto();
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
  
</style>
