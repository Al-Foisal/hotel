<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}} - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">

    <!-- App css -->

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />
    @yield('css')
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #7081b9;
            content: ">";
        }

        .table-search-box {
            width: 40%;
            float: right;
        }

        .table.table-bordered thead {
            background-color: #9ba7ca;
        }

        .table th {
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Left Sidenav -->
    <div class="left-sidenav">
        @include('layouts.sidebar')
    </div>
    <!-- end left-sidenav-->


    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- Navbar -->
            @include('layouts.header')
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                @yield('content')
                <!-- end page title end breadcrumb -->


            </div><!-- container -->

            @include('layouts.footer')
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->




    <!-- jQuery  -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/metismenu.min.js')}}"></script>
    <script src="{{asset('js/waves.js')}}"></script>
    <script src="{{asset('js/feather.min.js')}}"></script>
    <script src="{{asset('js/simplebar.min.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    @include('sweetalert::alert')

    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('pages/jquery.forms-advanced.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('js/app.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('js')
</body>

</html>