<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <link href="{{ asset('img/apple-icon.png') }}" rel="apple-touch-icon" sizes="76x76"/>
        <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
        <title>
            SIM LARA
        </title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
        <meta content="width=device-width" name="viewport"/>
        <!-- CSRF Token -->
        <meta content="{{ csrf_token() }}" name="csrf-token">
            <!-- Bootstrap core CSS     -->
            <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
            <!--  Material Dashboard CSS    -->
            <link href="{{ asset('css/material-dashboard.css?v=1.2.0') }}" rel="stylesheet"/>
            <!--  CSS for Demo Purpose, don't include it in your project     -->
            <link href="{{ asset('css/demo.css') }}" rel="stylesheet"/>
            <link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">
                <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
                    <!--     Fonts and icons     -->
                    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet" type="text/css"/>
                        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                        </link>
                    </link>
                </link>
            </link>
        </meta>
    </head>
    <body>
        <div class="wrapper" id="app">
            <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="{{ asset('img/sidebar-1.jpg') }}">
                <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
                <div class="logo">
                    <a class="simple-text logo-mini" href="https://war-mart.id">
                        WM
                    </a>
                    <a class="simple-text logo-normal" href="https://war-mart.id">
                        WARMART.ID
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li>
                            <a data-toggle="collapse" href="#logout">
                                <i class="material-icons">
                                    person
                                </i>
                                <p>
                                    {{ Auth::user()->name }}
                                    <b class="caret">
                                    </b>
                                </p>
                            </a>
                            <div class="collapse" id="logout">
                                <ul class="nav">
                                    <li>
                                        <a href="{{ url('/ubah-password') }}">
                                            Ubah Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form action="{{ url('/logout') }}" id="logout-form" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="active">
                            <a href="{{ url('/')}}">
                                <i class="material-icons">
                                    dashboard
                                </i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('pembelian.index')}}">
                                <i class="material-icons">
                                    dollar
                                </i>
                                <p>
                                    Pembelian
                                </p>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#transaksiKas">
                                <i class="material-icons">
                                    image
                                </i>
                                <p>
                                    Transaksi Kas
                                    <b class="caret">
                                    </b>
                                </p>
                            </a>
                            <div class="collapse" id="transaksiKas">
                                <ul class="nav">
                                    <li>
                                        <a href="{{ route('kas_masuk.index') }}">
                                            <span class="sidebar-mini">
                                                KM
                                            </span>
                                            <span class="sidebar-normal">
                                                Kas Masuk
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kas_keluar.index') }}">
                                            <span class="sidebar-mini">
                                                KK
                                            </span>
                                            <span class="sidebar-normal">
                                                Kas Keluar
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kas_mutasi.index') }}">
                                            <span class="sidebar-mini">
                                                KMT
                                            </span>
                                            <span class="sidebar-normal">
                                                Kas Mutasi
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#persediaan">
                                <i class="material-icons">
                                    image
                                </i>
                                <p>
                                    Persediaan
                                    <b class="caret">
                                    </b>
                                </p>
                            </a>
                            <div class="collapse" id="persediaan">
                                <ul class="nav">
                                    <li>
                                        <a href="{{ route('item-masuk.index') }}">
                                            <span class="sidebar-mini">
                                                IM
                                            </span>
                                            <span class="sidebar-normal">
                                                Item Masuk
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('item-keluar.index') }}">
                                            <span class="sidebar-mini">
                                                IK
                                            </span>
                                            <span class="sidebar-normal">
                                                Item Keluar
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#pagesExamples">
                                <i class="material-icons">
                                    image
                                </i>
                                <p>
                                    Master Data
                                    <b class="caret">
                                    </b>
                                </p>
                            </a>
                            <div class="collapse" id="pagesExamples">
                                <ul class="nav">
                                    <li>
                                        <a href="{{ route('user.index') }}">
                                            <span class="sidebar-mini">
                                                U
                                            </span>
                                            <span class="sidebar-normal">
                                                User
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('satuan.index') }}">
                                            <span class="sidebar-mini">
                                                S
                                            </span>
                                            <span class="sidebar-normal">
                                                Satuan
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kategori.index') }}">
                                            <span class="sidebar-mini">
                                                K
                                            </span>
                                            <span class="sidebar-normal">
                                                Kategori
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kategori_transaksi.index') }}">
                                            <span class="sidebar-mini">
                                                K
                                            </span>
                                            <span class="sidebar-normal">
                                                Kategori  Transaksi
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kas.index') }}">
                                            <span class="sidebar-mini">
                                                KS
                                            </span>
                                            <span class="sidebar-normal">
                                                Kas
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <router-link :to="{name: 'indexPoli'}">
                                            <span class="sidebar-mini">
                                                P
                                            </span>
                                            <span class="sidebar-normal">
                                                Poli
                                            </span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{name: 'indexSuplier'}">
                                            <span class="sidebar-mini">
                                                SP
                                            </span>
                                            <span class="sidebar-normal">
                                                Suplier
                                            </span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <a href="{{ route('gudang.index') }}">
                                            <span class="sidebar-mini">
                                                GD
                                            </span>
                                            <span class="sidebar-normal">
                                                Gudang
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('penjamin.index') }}">
                                            <span class="sidebar-mini">
                                                PJ
                                            </span>
                                            <span class="sidebar-normal">
                                                Penjamin
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('pasien.index') }}">
                                            <span class="sidebar-mini">
                                                PS
                                            </span>
                                            <span class="sidebar-normal">
                                                Pasien
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('produk.index') }}">
                                            <span class="sidebar-mini">
                                                PR
                                            </span>
                                            <span class="sidebar-normal">
                                                produk
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('komisi.index') }}">
                                            <span class="sidebar-mini">
                                                KP
                                            </span>
                                            <span class="sidebar-normal">
                                                Komisi Produk
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container-fluid">
                        <div class="navbar-minimize">
                            <button class="btn btn-round btn-white btn-fill btn-just-icon" id="minimizeSidebar">
                                <i class="material-icons visible-on-sidebar-regular">
                                    more_vert
                                </i>
                                <i class="material-icons visible-on-sidebar-mini">
                                    view_list
                                </i>
                            </button>
                        </div>
                        <div class="navbar-header">
                            <button class="navbar-toggle" data-toggle="collapse" type="button">
                                <span class="sr-only">
                                    Toggle navigation
                                </span>
                                <span class="icon-bar">
                                </span>
                                <span class="icon-bar">
                                </span>
                                <span class="icon-bar">
                                </span>
                            </button>
                            <a class="navbar-brand" href="#">
                                Dashboard
                            </a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            @include('layouts._flash')
            @yield('content')
                        </div>
                    </div>
                    <!-- end container fluid -->
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                        </nav>
                        <p class="copyright pull-right">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="https://andaglos.id">
                                PT Andaglos Global Teknologi
                            </a>
                            , made with love for a better web
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </body>
    <!--   Core JS Files   -->
    {{-- vue Js --}}
    <script src="{{ asset('js/app.js') }}">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('js/material.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}">
    </script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript">
    </script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('js/arrive.min.js') }}" type="text/javascript">
    </script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('js/jquery.validate.min.js') }}">
    </script>
    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="{{ asset('js/es6-promise-auto.min.js') }}">
    </script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="{{ asset('js/moment.min.js') }}">
    </script>
    <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
    <script src="{{ asset('js/chartist.min.js') }}">
    </script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('js/jquery.bootstrap-wizard.js') }}">
    </script>
    <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
    <script src="{{ asset('js/bootstrap-notify.js') }}">
    </script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}">
    </script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('js/jquery-jvectormap.js') }}">
    </script>
    <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
    <script src="{{ asset('js/nouislider.min.js') }}">
    </script>
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('js/jquery.select-bootstrap.js') }}">
    </script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/jquery.dataTables.js') }}">
    </script>
    <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
    <script src="{{ asset('js/sweetalert2.js') }}">
    </script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}">
    </script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('js/fullcalendar.min.js') }}">
    </script>
    <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('js/jquery.tagsinput.js') }}">
    </script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('js/material-dashboard.js?v=1.2.0') }}">
    </script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('js/demo.js') }}">
    </script>
    <script src="{{ asset('js/selectize.min.js') }}">
    </script>
    <script src="{{ asset('js/custom.js') }}">
    </script>
    <!-- SHORTCUT JS -->
    <script src="{{ asset('js/shortcut.js') }}">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

        // $.fn.dataTable.ext.errMode = 'throw';
    });
    </script>
    @yield('scripts')
</html>
