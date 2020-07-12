<template>
   <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Roles</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    
                                    <li class="breadcrumb-item">Lista de Roles
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
            <div class="content-body">
                <!-- Data list view starts -->
                <section id="data-list-view" class="data-list-view-header">
                   
                         
                    <!-- DataTable starts -->
                     <hr>    
           
      
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRES</th>
                                    <th>DESCRIPCION</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rol in arrayRol" :key="rol.id">
                                  
                                    <td  v-text="rol.id"></td>
                                    <td  v-text="rol.nombre"></td>
                                    <td v-text="rol.descripcion"></td>
                         
                                </tr>
                                
                            </tbody>
                        </table>
                 
                         
                  </div>
              </section>
               </div>
            </div>
        </div>
 
</template>

<script>
    export default {
        data (){
            return {
                id:'',     
                nombre : '',
                descripcion : '',
                arrayRol : []
               
              
            }
        },
        
        methods : {
            listarRol (){
                let me=this;
                axios.get('/rol').then(function (response) {
                    me.arrayRol = response.data;
             
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
          
        },
        mounted() {
            this.listarRol();
        }
    }
</script>
