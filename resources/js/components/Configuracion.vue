<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Configuración de perfil</h2>
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <div v-if="listado==0">
                    <li class="breadcrumb-item active"> Configuración General
                    </li>
                  </div>
                  <div v-else-if="listado==1">
                    <li class="breadcrumb-item active"> Configuración de contraseña
                    </li>
                  </div>
                  <div v-else-if="listado==2">
                    <li class="breadcrumb-item active"> Configuración de Información adicional
                    </li>
                  </div>
                  <div v-else="listado==3">
                    <li class="breadcrumb-item active"> Configuración de Redes Sociales
                    </li>
                  </div>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
          <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
              <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                <li class="nav-item">
                  <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" @click="cambiarGeneral()" aria-expanded="true">
                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                    General
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" @click="cambiarpassword()" aria-expanded="false">
                    <i class="feather icon-lock mr-50 font-medium-3"></i>
                    Cambiar Contraseña
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" @click="cambiarinfo()" aria-expanded="false">
                    <i class="feather icon-info mr-50 font-medium-3"></i>
                    Información Adicional
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex py-75" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" @click="cambiarredes()" aria-expanded="false">
                    <i class="feather icon-camera mr-50 font-medium-3"></i>
                    Redes Sociales
                  </a>
                </li>
              </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9" >
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="tab-content">
                      <!-- inicio de configuracion general -->
                      <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true" v-for="userg in general" :key="userg.id">
                        <div class="media">
                          <a href="javascript: void(0);">
                            <img :src="avatarUrl" class="rounded mr-75" alt="profile image" height="64" width="64">
                          </a>
                          <div class="media-body mt-75">
                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                              <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                              <input type="file" id="account-upload" @change="changePicture" ref="profilePictureInput" hidden>
                              <button class="btn btn-sm btn-outline-warning ml-50">Reset</button>
                            </div>
                            <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                              size of
                              800kB</small></p>
                            </div>
                          </div>
                          <hr>
                          <form novalidate>
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <input type="hidden"  v-model="userg.idrol">
                                    <label for="account-username">Nombre</label>
                                    <input type="text" class="form-control"  placeholder="Escriba sus nombres" v-model="userg.nombre">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <label for="account-name">Apellido</label>
                                    <input type="text" class="form-control" placeholder="Escriba sus apellidos" v-model="userg.apellido">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <label for="account-e-mail">Telefono</label>
                                    <input type="text" class="form-control"  placeholder="Escriba su telefono" v-model="userg.telefono">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="account-company">Dirección</label>
                                  <input type="text" class="form-control"  placeholder="Escriba su dirección de domicilio" v-model="userg.direccion">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <input type="hidden"  v-model="userg.password">
                                  <label for="account-company">Nombre de Usuario</label>
                                  <input type="text" class="form-control"  placeholder="Escriba su nombre de usuario" v-model="userg.usuario">
                                </div>
                              </div>
                              <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                <button type="button" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0" @click="actualizargeneral()">Guardar Cambios</button>
                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!--fin de configuracion general----->
                        <!--inicio de configuracion de contraseña---->
                        <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                          <form novalidate>
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <label for="account-old-password">Contraseña Anterior</label>
                                    <input type="password" class="form-control" placeholder="Escriba la contraseña anterior" >
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <label for="account-new-password">Nueva Contraseña</label>
                                    <input type="password" class="form-control" placeholder="Escriba su nueva contraseña" minlength="6">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <label for="account-retype-new-password">Repita su nueva contraseña
                                    </label>
                                    <input type="password" class="form-control" placeholder="Repita la nueva contraseña" minlength="6">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Guardar Cambios</button>
                                <button type="reset" class="btn btn-outline-warning">Cancelar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!--fin de configuracion de contraseña-->
                        <!--inicio de configuracion de informacion adicional-->
                        <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                          <form novalidate>
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="accountTextarea">Bio</label>
                                  <textarea class="form-control" id="accountTextarea" rows="3" placeholder="Your Bio data here..."></textarea>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <label for="account-birth-date">Birth date</label>
                                    <input type="text" class="form-control birthdate-picker" required placeholder="Birth date" id="account-birth-date" data-validation-required-message="This birthdate field is required">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="accountSelect">Country</label>
                                  <select class="form-control" id="accountSelect">
                                    <option>USA</option>
                                    <option>India</option>
                                    <option>Canada</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="languageselect2">Languages</label>
                                  <select class="form-control" id="languageselect2" multiple="multiple">
                                    <option value="English" selected>English</option>
                                    <option value="Spanish">Spanish</option>
                                    <option value="French">French</option>
                                    <option value="Russian">Russian</option>
                                    <option value="German">German</option>
                                    <option value="Arabic" selected>Arabic</option>
                                    <option value="Sanskrit">Sanskrit</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="controls">
                                    <label for="account-phone">Phone</label>
                                    <input type="text" class="form-control" id="account-phone" required placeholder="Phone number" value="(+656) 254 2568" data-validation-required-message="This phone number field is required">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="account-website">Website</label>
                                  <input type="text" class="form-control" id="account-website" placeholder="Website address">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="musicselect2">Favourite Music</label>
                                  <select class="form-control" id="musicselect2" multiple="multiple">
                                    <option value="Rock">Rock</option>
                                    <option value="Jazz" selected>Jazz</option>
                                    <option value="Disco">Disco</option>
                                    <option value="Pop">Pop</option>
                                    <option value="Techno">Techno</option>
                                    <option value="Folk" selected>Folk</option>
                                    <option value="Hip hop">Hip hop</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="moviesselect2">Favourite movies</label>
                                  <select class="form-control" id="moviesselect2" multiple="multiple">
                                    <option value="The Dark Knight" selected>The Dark Knight
                                    </option>
                                    <option value="Harry Potter" selected>Harry Potter</option>
                                    <option value="Airplane!">Airplane!</option>
                                    <option value="Perl Harbour">Perl Harbour</option>
                                    <option value="Spider Man">Spider Man</option>
                                    <option value="Iron Man" selected>Iron Man</option>
                                    <option value="Avatar">Avatar</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                  changes</button>
                                  <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <!-- fin de configuracion de informacion adicional--->
                          <!--inicio de configuracion de redes----->
                          <div class="tab-pane fade " id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                          <form>
                          <div class="row">
                          <div class="col-12">
                          <div class="form-group">
                          <label for="account-twitter">Twitter</label>
                          <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com">
                        </div>
                      </div>
                      <div class="col-12">
                      <div class="form-group">
                      <label for="account-facebook">Facebook</label>
                      <input type="text" id="account-facebook" class="form-control" placeholder="Add link">
                    </div>
                  </div>
                  <div class="col-12">
                  <div class="form-group">
                  <label for="account-google">Google+</label>
                  <input type="text" id="account-google" class="form-control" placeholder="Add link">
                </div>
              </div>
              <div class="col-12">
              <div class="form-group">
              <label for="account-linkedin">LinkedIn</label>
              <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com">
            </div>
          </div>
          <div class="col-12">
          <div class="form-group">
          <label for="account-instagram">Instagram</label>
          <input type="text" id="account-instagram" class="form-control" placeholder="Add link">
        </div>
      </div>
      <div class="col-12">
      <div class="form-group">
      <label for="account-quora">Quora</label>
      <input type="text" id="account-quora" class="form-control" placeholder="Add link">
    </div>
  </div>
  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
  <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
  changes</button>
  <button type="reset" class="btn btn-outline-warning">Cancel</button>
</div>
</div>
</form>
</div>
<!--fin de configuracion de redes sociales------->
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- account setting page end -->
</div>
</div>
</div>
</template>
<script >
export default {
  data(){
    return{
      general:[],
      listado:0,
      nombre:'',
      apellido:'',
      telefono:'',
      direccion:'',
      usuario:'',
      idusuario:0,
      idrol:0,
      password:'',
      profilePicture: null
    }
  },
  computed:{
    avatarUrl(){
      if(this.general.length){
        return this.general[0].profile_picture.url ? this.general[0].profile_picture.url : '/img/avatar-default.png'
      }
      return this.general.usuarios.profile_picture.url ? this.general.usuarios.profile_picture.url : '/img/avatar-default.png'
    }
  },
  methods : {
    changePicture(){
      this.profilePicture = this.$refs.profilePictureInput[0].files[0]
    },
    listargeneral(){
      let me  = this;
      var url = '/usuario/cambiosgeneral';
      axios.get(url).then(function (response) {
        var respuesta = response.data;
        me.general = respuesta.usuarios;
        // me.pagination= respuesta.pagination;
        //me.arrayUsuario = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    //---------------------------------------------------------------------------------------------------------------------------------------------------------
    actualizargeneral(){
      let me = this;
      let data = new FormData();
      data.set('nombre', me.general[0].nombre)
      data.set('apellido', me.general[0].apellido)
      data.set('telefono', me.general[0].telefono)
      data.set('direccion', me.general[0].direccion)
      data.set('usuario', me.general[0].usuario)
      data.set('idrol', me.general[0].idrol)
      data.set('id', me.general[0].id)
      data.set('password', me.password)
      data.set('_method', 'PUT')
      data.append('profile_picture', me.profilePicture)
      
      axios.post('/usuario/actualizarcambiosgeneral',data).then(function (response) {
        me.general = response.data
        document.querySelector('#navbar-user-profile-img').setAttribute('src', me.avatarUrl);
        
        document.querySelector('#navbar-username').innerText = me.general[0].nombre + " " + me.general[0].apellido;
        swal(
          'Actualizado!',
          'El registro se ha actualizado de forma exitosa.',
          'success'
        )
      }).catch(function (error) {
        console.log(error);
      }); 
    },
    cambiarGeneral(){
      this.listado=0;
    },
    cambiarpassword(){
      this.listado=1;
    },
    cambiarinfo(){
      this.listado=2;
    },
    cambiarredes(){
      this.listado=3;
    }
  },
  mounted() {
    this.listargeneral();
  }
}
</script>