<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto"><a class="navbar-brand" >
        <div class="brand-logo"></div>
        <h2 class="brand-text mb-0">Megamaxi</h2>
      </a></li>
      <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" nav-item"><a href=""><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Escritorio</span></a>
        <ul class="menu-content">
          <li   @click="menu=1" ><a href="#" ><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Usuarios Activos</span></a>
          </li>
          <li @click="menu=2"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Roles de Usuario</span></a>
          </li>
          <li @click="menu=3"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Usuarios Inactivos</span></a>
          </li>
        </ul>
      </li>
      <li class=" navigation-header"><span>Gestión</span>
      </li>
      <li class=" nav-item"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">Compras</span></a>
        <ul class="menu-content">
          <li @click="menu=4"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Proveedores</span></a>
          </li>
          <li @click="menu=5"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Ingresos</span></a>
          </li>
        </ul>
      </li>
      <li class=" nav-item"><a href="#"><i class="fa fa-wpforms"></i><span class="menu-title" data-i18n="User">Salidas</span></a>
        <ul class="menu-content">
          <li @click="menu=8"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Clientes</span></a>
          </li>
          <li @click="menu=9"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">Ventas</span></a>
          </li>
        </ul>
      </li>
      <li class=" navigation-header"><span>Mercadería</span>
      </li>
      <li @click="menu=11" class=" nav-item"><a href="#"><i class="fa fa-bandcamp"></i><span class="menu-title" data-i18n="Email">Categoría</span></a>
      </li>
      <li @click="menu=12" class=" nav-item"><a href="#"><i class="fa fa-eercast"></i><span class="menu-title" data-i18n="Todo">Productos</span></a>
      </li>
      <li @click="menu=14" id="charts-menu-item" class="nav-item"><a href="#"><i class="feather icon-bar-chart-2"></i><span class="menu-title" data-i18n="Calender">Gráficos</span></a>
      </li>
      <li class=" navigation-header"><span>Soporte</span>
      </li>
      <li @click="menu=15" class=" nav-item"><a href="#"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Documentation">Configuración</span></a>
      </li>
      <li class=" nav-item"><a href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Documentation">Documentación</span></a>
      </li>
      <li class=" nav-item"><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather icon-life-buoy"></i><span class="menu-title" data-i18n="Raise Support">Cerrar Sesion</span></a>
        <form id="logout-form" action="{{route('logout')}}" method="Post" style="display: none;"> 
          {{csrf_field()}}
        </form>
      </li>
    </ul>
  </div>
</div>
