<template>
  <li class="dropdown dropdown-notification nav-item">
    <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
      <i class="ficon feather icon-bell"></i>
      <span class="badge badge-pill badge-primary badge-up">{{notifications.length}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
      <div v-if="notifications.length">
        <li class="dropdown-menu-header">
          <div class="dropdown-header m-0 p-2">
            <h3 class="white">{{notifications.length}} Nuevas </h3>
            <span class="notification-title"> Notificaciones</span>
          </div>
        </li>
      </div>
      <div v-else>
        <li class="dropdown-menu-header">
          <div class="dropdown-header m-0 p-2">
            <h3 class="white"> No hay notifiaciones </h3>
          </div>
        </li>
      </div>

      <div v-if="notifications.length">
        <li class="scrollable-container media-list" v-for="item in listar" :key="item.id">
          <a class="d-flex justify-content-between" href="javascript:void(0)">
            <div class="media d-flex align-items-start">
              <div class="media-left">
                <i class="feather icon-plus-square font-medium-5 primary"></i>
              </div>
              <div class="media-body" v-if="item.ingresos">
                <h6 class="primary media-heading">{{item.ingresos.msj}}!</h6>
                <span class="username">{{ item.usuario.nombre + ' ' + item.usuario.apellido}}</span>
                <small class="notification-text"> Se ha registrado {{item.ingresos.numero}} ingresos</small>
              </div>
              <small>
                <span class="time-ago">{{ timeAgo }}</span>
                <span @click="markAsRead(notifications[0].id)" class="mark-as-read">Marcar como leído</span>
              </small>
              </div>
            </a>
            <a class="d-flex justify-content-between" href="javascript:void(0)">
              <div class="media d-flex align-items-start">
                <div class="media-left">
                  <i class="feather icon-download-cloud font-medium-5 success"></i>
                </div>

                <div class="media-body">
                  <h6 class="success media-heading red darken-1">{{item.ventas.msj}}!</h6>
                  <span class="username">{{ item.usuario.nombre + ' ' + item.usuario.apellido}}</span>
                  <small class="notification-text">Se ha registrado {{item.ventas.numero}} ventas.</small>
                </div>

                <small>
                  <span class="time-ago">{{ timeAgo }}</span>
                  <span @click="markAsRead(notifications[0].id)" class="mark-as-read">Marcar como leído</span>
                </small>
                </div>
              </a>
            </li>
          </div>
          <div v-else>
            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">No tiene notificaciones</a></li>
          </div>
        </ul>
      </li>
    </template>

    <script>
     export default{
      props : ['notifications'],
      computed:{
        listar: function(){
          return this.notifications.map(n => n.data.datos)
        },
        timeAgo(){
          return this.notifications.length ? this.notifications[0].time_ago : ''
        }
      },
      methods : {
        markAsRead(id){
          axios.post(`/notifications/${id}/markAsRead`).then(response=>{
            this.notifications = this.notifications.filter(f=>f.id != id)
          })
        }
      }
    }
  </script>
  <style lang="scss">
    .mark-as-read {
      display: block;
      opacity: .5;
      &:hover {
        opacity: 1;
      }
    }
    .username {
      display: block;
      font-weight: 500;
      font-size: .9em;
    }
    .time-ago {
      display: block;
      font-size: .8em;
      margin: 5px 0;
    }
  </style>