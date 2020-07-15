<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="user" content="{{Auth::user()}}">
  <meta name="userId" content="{{Auth::check() ? Auth::user()->id : ''}}">
  <title>Megamaxi</title>
  <link rel="apple-touch-icon" href="recursos/app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="recursos/app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/vendors/css/forms/select/select2.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
  <!-- BEGIN: Vendor CSS-->
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/vendors/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/vendors/css/file-uploaders/dropzone.min.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
  
  <!-- END: Vendor CSS-->
  
  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/bootstrap-extended.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/colors.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/themes/dark-layout.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/themes/semi-dark-layout.css">
  
  <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/plugins/file-uploaders/dropzone.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/pages/data-list-view.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/pages/dashboard-ecommerce.css">
  
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/pages/dashboard-analytics.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/pages/card-analytics.css">
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/css/plugins/tour/tour.css">
  <!-- END: Page CSS-->
  
  <link rel="stylesheet" type="text/css" href="recursos/app-assets/vendors/css/pickers/pickadate/pickadate.css">
  
  <!-- BEGIN: Custom CSS-->
  <link rel="stylesheet" type="text/css" href="recursos/assets/css/style.css">
  
  
  <!-- END: Custom CSS-->
  
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">
  <div id="app">
    
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="navbar-collapse" id="navbar-mobile">
            <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
              <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
              </ul>
              <ul class="nav navbar-nav bookmark-icons">
                <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->
                <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->
                <!--     i.ficon.feather.icon-menu-->
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon feather icon-check-square"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon feather icon-message-square"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon feather icon-mail"></i></a></li>
                <li @click="menu=14" data-original-title="#charts-menu-item" id="charts-nav-item" class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Graficos"><i class="ficon feather icon-bar-chart-2"></i></a></li>
              </ul>
              
            </div>
            <ul class="nav navbar-nav float-right">
              <notification :notifications="notifications" @notificationread="markAsRead"></notification>
              <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
              @if( Auth::check() )
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <div class="user-nav d-sm-flex d-none"><span id="navbar-username" class="user-name text-bold-600">{{Auth::user()->nombre }} {{Auth::user()->apellido }} </span></div>
                <span onclick="document.getElementById('user-dropdown-menu').classList.toggle('show')">
                  <img id="navbar-user-profile-img" class="round" src="recursos/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" id="user-dropdown-menu">
                <a class="dropdown-item" href="page-user-profile.html">
                  <i class="feather icon-user"></i> 
                  Edit Profile
                </a>
                <a class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> My Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="feather icon-check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="auth-login.html"><i class="feather icon-power"></i> Logout</a>
              </div>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </nav>
  
  <ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer">
      <a class="d-flex align-items-center justify-content-between w-100 py-50">
        <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
      </a>
    </li>
  </ul>
  <!-- END: Header-->
  
  
  <!-- BEGIN: Main Menu-->
  <!---menu----->
  @include('menu.sidebaradmin')
  <!-- END: Main Menu-->
  @yield('contenido')
  <!-- BEGIN: Content-->
  
  <!-- END: Content-->
  
  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>
</div>
</body>
<!-- BEGIN: Footer-->
<!--
<footer class="footer footer-static footer-light">
<p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">ANKE</a>Todos los derechos reservados</span><span class="float-md-right d-none d-md-block">Creado por Kevin Cruz<i class="feather icon-heart pink"></i></span>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
</p>
</footer>
--->
<!-- END: Footer-->

<script src="js/app.js"></script>
<script type="text/javascript">
$('.menu-content li').click(function(e){
  $('.menu-content li, .menu-content li a').removeClass('active');
  $('#main-menu-navigation li, #main-menu-navigation li a').removeClass('active');
  $(this).addClass('active');
  $(this).find('a').addClass('active');
});

$('#main-menu-navigation .nav-item').click(function(e){
  $('#main-menu-navigation li, #main-menu-navigation li a').removeClass('active');
  $(this).addClass('active');
});




$('.dropdown-user a span').click(function(e){
  var rightMenu = $('.dropdown-user .dropdown-menu-right');
  rightMenu.toggleClass('show');
});

$('.dropdown-notification  a span').click(function(e){
  var rightMenu = $('.dropdown-notification .dropdown-menu-right  ');
  rightMenu.toggleClass('show');
});
</script>
<script src="recursos/app-assets/js/validacion.js"></script>
<script src="recursos/app-assets/js/scripts/sweetalert2.all.js"></script>
<!-- BEGIN: Vendor JS-->
<script src="recursos/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="recursos/app-assets/vendors/js/extensions/dropzone.min.js"></script>
<script src="recursos/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="recursos/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="recursos/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="recursos/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="recursos/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="recursos/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
<script src="recursos/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="recursos/app-assets/vendors/js/extensions/tether.min.js"></script>
<script src="recursos/app-assets/vendors/js/extensions/shepherd.min.js"></script>
<script src="recursos/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<script src="recursos/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="recursos/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>

<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="recursos/app-assets/js/core/app-menu.js"></script>
<script src="recursos/app-assets/js/core/app.js"></script>
<script src="recursos/app-assets/js/scripts/components.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="recursos/app-assets/js/scripts/ui/data-list-view.js"></script>
<script src="recursos/app-assets/js/scripts/forms/select/form-select2.js"></script>

<script src="recursos/app-assets/vendors/js/charts/chart.min.js"></script>
<script src="recursos/app-assets/js/scripts/charts/chart-chartjs.js"></script>
<script src="recursos/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>

<script src="recursos/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
<script src="recursos/app-assets/js/scripts/pages/account-setting.js"></script>
</body>
<!-- END: Body-->

</html>