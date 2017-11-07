<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sako Holidays | @yield('title')</title>
    <meta http-equiv="refresh" content="300">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-green.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/DataTables/media/css/dataTables.bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Theme Browser Mobile -->
    <meta name="theme-color" content="#12B58A">
    <meta name="msapplication-navbutton-color" content="#12B58A">
    <meta name="msapplication-Tilecolor" content="#12B58A">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#12B58A">
    <!-- Icon -->
    <link type="image/x-icon" rel="icon" href="{{ asset('favicon.ico')}}">
    <link type="image/x-icon" rel="shortcut icon" href="{{ asset('favicon.ico')}}">
    <meta http-equiv="expires" content="{{ date('l, d-F-Y, H:i:s, T', strtotime('next day')) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--Pace loading bar-->
    <script src="{{ asset('js/pace.js') }}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/pace.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>

  <body class="hold-transition skin-green sidebar-mini">

    <!-- Wrapper Start -->
    <div class="wrapper">

      <!-- Main Header Start -->
      <header class="main-header">
        @if (Auth::user()->hasRole('admin'))
          <!-- Logo Start -->
          <a href="{{ route('dashboard.admin') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{ asset('img/logo sako holidays.png') }}" alt="LOGO" style="height: 35px; width: 35px;"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Sako </b>Holidays</span>
          </a>
          <!-- Logo End -->
        @elseif (Auth::user()->hasRole('operator'))
          <!-- Logo Start -->
          <a href="{{ route('dashboard.operator') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{ asset('img/logo sako holidays.png') }}" alt="LOGO" style="height: 35px; width: 35px;"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Sako </b>Holidays</span>
          </a>
          <!-- Logo End -->
        @else
          <!-- Logo Start -->
          <a href="{{ route('dashboard.company') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{ asset('img/logo sako holidays.png') }}" alt="LOGO" style="height: 35px; width: 35px;"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Sako </b>Holidays</span>
          </a>
          <!-- Logo End -->
        @endif

        <!-- Header Navbar Start -->
        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button Start -->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Siderbar toggle button End -->

          <!-- Navbar Right Menu Start -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li><a href="{{ route('beranda') }}" target="_blank">View Website</a></li>
              <!-- User Account Menu Start -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin: 0 15px">
                  @if (Auth::user()->hasSex('Male'))
                    <!-- The user image in the navbar-->
                    <img src="{{ asset('dist/img/avatar5.png') }}" class="user-image" alt="User Image">
                  @else
                    <!-- The user image in the navbar-->
                    <img src="{{ asset('dist/img/avatar2.png') }}" class="user-image" alt="User Image">
                  @endif
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{ Auth::user()->name }} &nbsp; <i class="fa fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    @if (Auth::user()->hasSex('Male'))
                      <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
                    @else
                      <img src="{{ asset('dist/img/avatar2.png') }}" class="img-circle" alt="User Image">
                    @endif
                    <p>
                      {{ config('app.name') }}
                      @if (Auth::user()->hasRole('admin'))
                        <small>Level : Administrator</small>
                      @elseif (Auth::user()->hasRole('operator'))
                        <small>Level : Operator</small>
                      @else
                        <small>Level : Perusahaan</small>
                      @endif
                      <small>Nama : {{ Auth::user()->name }}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('dashboard.admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                      @elseif (Auth::user()->hasRole('operator'))
                        <a href="{{ route('dashboard.operator.profile') }}" class="btn btn-default btn-flat">Profile</a>
                      @else
                        <a href="{{ route('dashboard.company.profile') }}" class="btn btn-default btn-flat">Profile</a>
                      @endif
                    </div>
                    <div class="pull-right">
                      <a id="logout" href="#" class="btn btn-default btn-flat">Sign out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="post">
                        {{ csrf_field() }}
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- User Account Menu End -->

            </ul>
          </div>
          <!-- Navbar Right Menu End-->

        </nav>
        <!-- Header Navbar End -->

      </header>
      <!-- Main Header End -->

      <!-- Left side column. contains the logo and sidebar Start -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less Start -->
        <section class="sidebar">

          <div style="height:15px;"></div>
          <!-- Sidebar user panel (optional) Start -->
          <div class="user-panel">
            <div class="pull-left image">
              @if (Auth::user()->hasSex('Male'))
                <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
              @else
                <img src="{{ asset('dist/img/avatar2.png') }}" class="img-circle" alt="User Image">
              @endif
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-primary"></i> Online</a>
            </div>
          </div>
          <!-- Sidebar user panel (optional) End -->

          <div style="height:15px;"></div>
          @if (Auth::user()->hasRole('admin'))
            <!-- Sidebar Menu First Start -->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MANAGEMENT WEBSITE</li>
              <!-- Optionally, you can add icons to the links -->
              <!-- Dashboard -->
              <li class="{{ set_active('dashboard.admin') }}">
                <a href="{{ route('dashboard.admin')}}"><i class="fa fa-dashboard"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <!-- Tour -->
              <li class="treeview">
                <a href="#"><i class="fa fa-globe"></i> <span>Tour</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ set_active('tour.index') }}"><a href="{{ route('tour.index') }}">Daftar Paket Tour</a></li>
                  <li class="{{ set_active('tour.pemesanan') }}"><a href="{{ route('tour.pemesanan') }}">Daftar Pemesanan Tour</a></li>
                  <li class="{{ set_active('tour.permintaan') }}"><a href="{{ route('tour.permintaan') }}">Daftar Permintaan Tour</a></li>
                </ul>
              </li>
              <!-- Umroh -->
              <li class="treeview">
                <a href="#"><i class="fa fa-cube"></i> <span>Umroh</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ set_active('umroh.index') }}"><a href="{{ route('umroh.index') }}">Daftar Paket Umroh</a></li>
                  <li class="{{ set_active('umroh.pemesanan') }}"><a href="{{ route('umroh.pemesanan')}}">Daftar Pemesanan Umroh</a></li>
                </ul>
              </li>
              <!-- Blog -->
              <li class="{{ set_active('blog.index') }}">
                <a href="{{ route('blog.index')}}">
                  <i class="fa fa-sticky-note"></i>
                  <span>Artikel</span>
                </a>
              </li>
              <!-- Slideshow -->
              <li class="{{ set_active('slideshow.index') }}">
                <a href="{{ route('slideshow.index') }}">
                  <i class="ion ion-images"></i>
                  <span>Slideshow</span>
                </a>
              </li>
            </ul>
            <!-- Sidebar Menu First End -->
          @elseif (Auth::user()->hasRole('operator'))
            <!-- Sidebar Menu First Start -->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MANAGEMENT WEBSITE</li>
              <!-- Optionally, you can add icons to the links -->
              <!-- Dashboard -->
              <li class="{{ set_active('dashboard.operator') }}">
                <a href="{{ route('dashboard.operator')}}"><i class="fa fa-dashboard"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <!-- Tour -->
              <li class="treeview">
                <a href="#"><i class="fa fa-globe"></i> <span>Tour</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ set_active('operator.tour.index') }}"><a href="{{ route('operator.tour.index') }}">Daftar Paket Tour</a></li>
                  <li class="{{ set_active('operator.tour.pemesanan') }}"><a href="{{ route('operator.tour.pemesanan') }}">Daftar Pemesanan Tour</a></li>
                  <li class="{{ set_active('operator.tour.permintaan') }}"><a href="{{ route('operator.tour.permintaan') }}">Daftar Permintaan Tour</a></li>
                </ul>
              </li>
              <!-- Umroh -->
              <li class="treeview">
                <a href="#"><i class="fa fa-cube"></i> <span>Umroh</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ set_active('operator.umroh.index') }}"><a href="{{ route('operator.umroh.index') }}">Daftar Paket Umroh</a></li>
                  <li class="{{ set_active('operator.umroh.pemesanan') }}"><a href="{{ route('operator.umroh.pemesanan')}}">Daftar Pemesanan Umroh</a></li>
                </ul>
              </li>
              <!-- Blog -->
              <li class="{{ set_active('opertor.blog.index') }}">
                <a href="{{ route('operator.blog.index')}}">
                  <i class="fa fa-sticky-note"></i>
                  <span>Artikel</span>
                </a>
              </li>
            </ul>
            <!-- Sidebar Menu First End -->
          @else
            <!-- Sidebar Menu First Start -->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MANAGEMENT WEBSITE</li>
              <!-- Optionally, you can add icons to the links -->
              <!-- Dashboard -->
              <li class="{{ set_active('dashboard.company') }}">
                <a href="{{ route('dashboard.company')}}"><i class="fa fa-dashboard"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <!-- Tour -->
              <li class="treeview">
                <a href="#"><i class="fa fa-globe"></i> <span>Tour</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ set_active('company.tour.index') }}"><a href="{{ route('company.tour.index') }}">Daftar Paket Tour</a></li>
                  <li class="{{ set_active('company.tour.pemesanan') }}"><a href="{{ route('company.tour.pemesanan') }}">Daftar Pemesanan Tour</a></li>
                  <li class="{{ set_active('company.tour.permintaan') }}"><a href="{{ route('company.tour.permintaan') }}">Daftar Permintaan Tour</a></li>
                </ul>
              </li>
              <!-- Umroh -->
              <li class="treeview">
                <a href="#"><i class="fa fa-cube"></i> <span>Umroh</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ set_active('company.umroh.index') }}"><a href="{{ route('company.umroh.index') }}">Daftar Paket Umroh</a></li>
                  <li class="{{ set_active('company.umroh.pemesanan') }}"><a href="{{ route('company.umroh.pemesanan')}}">Daftar Pemesanan Umroh</a></li>
                </ul>
              </li>
              <!-- Blog -->
              <li class="{{ set_active('company.blog.index') }}">
                <a href="{{ route('company.blog.index')}}">
                  <i class="fa fa-sticky-note"></i>
                  <span>Artikel</span>
                </a>
              </li>
            </ul>
            <!-- Sidebar Menu First End -->
          @endif

          <div style="height:15px;"></div>
          @if (Auth::user()->hasRole('admin'))
            <!-- Sidebar Menu Second Start -->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MANAGEMENT SYSTEM</li>
              <!-- Optionally, you can add icons to the links -->
              <!-- Users -->
              <li class="{{ set_active('users.index') }}">
                <a href="{{ route('users.index') }}"><i class="fa fa-user"></i>
                  <span>Users</span>
                </a>
              </li>
              <!-- Role User -->
              <li class="{{ set_active('role.index') }}">
                <a href="{{ route('role.index') }}"><i class="fa fa-gear"></i>
                  <span>Role User</span>
                </a>
              </li>
              <li class="{{ set_active('dashboard.admin.file') }}">
                <a href="{{ route('dashboard.admin.file') }}"><i class="fa fa-file-o"></i>
                  <span>File Manager</span>
                </a>
              </li>
              <!-- Role User -->
              <li class="{{ set_active('dashboard.admin.photos') }}">
                <a href="{{ route('dashboard.admin.photos') }}"><i class="fa fa-picture-o"></i>
                  <span>Photos Manager</span>
                </a>
              </li>
            </ul>
            <!-- Sidebar Menu Second Start -->
          @endif
          <div style="height:150px;"></div>
        </section>
        <!-- sidebar style can be found in sidebar.less End-->

      </aside>
      <!-- Left side column. contains the logo and sidebar End -->

      <!-- Content Wrapper. Contains page content Start -->
      <div class="content-wrapper">

        <!-- Content Header (Page header) Start -->
        <section class="content-header">
          <h1>
            Dashboard
            <small><b>Day : </b>{!! date('l') !!} &nbsp;<b>Date : </b> {!! date('d - F - Y')!!}&nbsp;&nbsp;<b>Clock : </b><span id="output-clock"></span></small>
          </h1>
          <ol class="breadcrumb">
            @yield('breadcrumb')
          </ol>
        </section>
        <!-- Content Header (Page header) End -->

        <!-- Main content Start -->
        <section class="content container-fluid">

          @yield('content')

        </section>
        <!-- Main content End -->

      </div>
      <!-- content-wrapper. Contains page content End  -->

      <!-- Main Footer Start -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Version 1.0 By {{ config('app.name') }}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php $thn = "2017"; $dat = date('Y'); if($dat == $thn) { echo $dat; } else { echo $thn.'-'.$dat; }?>
          <a href="{{ url('/') }}" target="_blank">sakoholidays.com</a>.
        </strong> All rights reserved.
      </footer>
      <!-- Main Footer End -->

    </div>
    <!-- Wrapper End -->

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('assets/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- Tinymce -->
    <script src="{{ asset('assets/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('assets/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/fastclick/lib/fastclick.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ asset('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <!-- Date and Time Script -->
    <script type="text/javascript">
      $(function() {
        $('#lfm').filemanager('image');
        var editor_config = {
          path_absolute : "/",
          selector: "#itinerary, #terms_conditions, #description",
          plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
          relative_urls: false,
          file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
              cmsURL = cmsURL + "&type=Images";
            } else {
              cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
              file : cmsURL,
              title : 'Filemanager',
              width : x * 0.8,
              height : y * 0.8,
              resizable : "yes",
              close_previous : "no"
            });
          }
        };

        tinymce.init(editor_config);

        $('#start_period').datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          startDate: '+1d'
        });
        $('#end_period').datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          startDate: '+3d'
        });

        $('#date_of_birth').datepicker({
          format: 'yyyy-mm-dd',
          maxViewMode: 2,
          language: "id",
          autoclose: true,
          todayHighlight: true,
          toggleActive: true
        });
        $('#logout').click(function(e) {
          e.preventDefault();
          $('#logout-form').submit();
        });
        // Show Time realtime
        setInterval(function() {
          var currentTime = new Date();
          var hours = currentTime.getHours();
          var minutes = currentTime.getMinutes();
          var seconds = currentTime.getSeconds();
          var timezone = currentTime.getTimezoneOffset(),o = Math.abs(timezone);

          // Add leading zeros
          hours = (hours < 10 ? "0" : "") + hours;
          minutes = (minutes < 10 ? "0" : "") + minutes;
          seconds = (seconds < 10 ? "0" : "") + seconds;
          timezone = (timezone < 0 ? "+" : "-") + ("00" + Math.floor(o / 60)).slice(-2) + ":" + ("00" + (o % 60)).slice(-2);
          if (timezone == "+07:00") {
            var zone = 'Asia/Jakarta';
          } else if (timezone == "+08:00") {
            var zone = 'Asia/Makasar';
          } else if (timezone == "+09:00") {
            var zone = 'Asia/Jayapura';
          }
          var currentTimeString = hours + ":" + minutes + ":" + seconds + " &nbsp; <b>Zone : </b>" + zone;
          $("#output-clock").html(currentTimeString);
        }, 1000);
      });
      $(document).ready(function() {
        $("input:radio[name=\'status\']").change(function() {
          if(this.value == 'Rejected' && this.checked){
            $("#reason").css({'display':'block'});
            $("#reason").show();
          } else {
            $("#reason").css({'display':'none'});
            $("#reason").hide();
          }
        });
      });
    </script>
    @yield('scripts')
   </body>
</html>
