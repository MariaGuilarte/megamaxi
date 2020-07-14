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
        <li class="scrollable-container media-list" v-for="item in notifications" :key="item.id">
          <a class="d-flex justify-content-between" href="javascript:void(0)">
            <div class="media d-flex align-items-start">
              <div class="media-left">
                <i class="feather icon-plus-square font-medium-5 primary" v-if="item.data.datos.type=='ingresos'"></i>
                <i class="feather icon-download-cloud font-medium-5 success" v-else></i>
              </div>
              <div class="media-body">
                <h6 class="primary media-heading" v-if="item.data.datos.type=='ingresos'">{{item.data.datos.type}}!</h6>
                <h6 class="success media-heading red darken-1" v-else>{{item.data.datos.type}}!</h6>
                <span v-if="item.data.datos.usuario" class="username">{{ item.data.datos.usuario.nombre + ' ' + item.data.datos.usuario.apellido}}</span>
                <small class="notification-text"> Se ha registrado {{item.data.datos.numero}} ingresos</small>
              </div>
              <small>
                <span class="time-ago">{{ item.time_ago }}</span>
                <span @click="$emit('notificationread',item.id)" class="mark-as-read">Marcar como leído</span>
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
      props: ['notifications'],
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