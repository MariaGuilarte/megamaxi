/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 window.$ = window.jQuery = require('jquery');
 window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('usuario', require('./components/Usuario.vue').default);
Vue.component('usuarioinactivo', require('./components/UsuariosInactivos.vue').default);
Vue.component('proveedor', require('./components/Proveedor.vue').default);
Vue.component('cliente', require('./components/Cliente.vue').default);
Vue.component('categoria', require('./components/Categoria.vue').default);
Vue.component('producto', require('./components/Producto.vue').default);
Vue.component('ingreso', require('./components/Ingreso.vue').default);
Vue.component('venta', require('./components/Venta.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('notification', require('./components/Notification.vue').default);
Vue.component('inicio', require('./components/Inicio.vue').default);
Vue.component('configuracion', require('./components/Configuracion.vue').default);
import Vue from 'vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const app = new Vue({
  el: '#app',
  data :{
    menu : 0,
    notifications: []
  },
  methods:{
    fetchNotifications(){
      let me = this
      axios.post('notification/get').then(function(response){
        me.notifications = response.data;	
      }).catch(function(error){
        console.log(error);
      });
    },
    markAsRead(id){
      axios.post(`/notifications/${id}/markAsRead`).then(response=>{
        this.notifications = this.notifications.filter(f=>f.id != id)
      })
    }
  },
  created(){
    let me = this;
    me.fetchNotifications()

    var userId = $('meta[name="userId"]').attr('content');
    Echo.private('App.User'+userId).notification((notification)=>{
      me.notifications.unshift(notification);
    });
  }

});

$('#main-menu-navigation .nav-item, .bookmark-icons li').click(function(e){
  $('#main-menu-navigation li, #main-menu-navigation li a').removeClass('active');
  $(this).addClass('active');
});

$('#charts-nav-item').click(function(e){
  $( $(this).data('original-title') ).addClass('active');
});