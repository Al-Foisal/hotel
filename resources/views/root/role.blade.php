<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}} - Roles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .page-wrapper {
            flex: 1;
            padding: 0;
            display: block;
            margin-left: 100px;
            margin-right: 100px;
        }
    </style>
</head>

<body>


    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <div class="page-wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- Navbar -->
            <nav class="navbar-custom">
                @include('root.navbar')

                <ul class="list-unstyled topbar-nav mb-0">
                    <li class="creat-btn">
                        <div class="nav-link">
                            <a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createNewRoleModal">
                                Create Role
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid mb-5">

                <div class="row mt-5">
                    @forelse($roles as $item)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-3">
                                    <div class="media-body align-self-center text-truncate ms-3">
                                        <h4 class="m-0 fw-semibold text-dark font-15">{{$item->name}}</h4>
                                    </div><!--end media-body-->
                                </div>
                                
                                    <div class="progress mb-4" style="height: 4px;">
                                        <div class="progress-bar bg-purple" role="progressbar" style="width: 100%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editRoleModal">Edit</button>
                                    </div>
                                </div><!--end task-box-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                    <!-- edit role modal -->
                    <div class="modal fade bd-example-modal-lg" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title m-0" id="myLargeModalLabel">Edit role</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div><!--end modal-header-->
                                <div class="modal-body">
                                    <div class="row">
                                        <form action="{{route('role.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleInputEmail1">Role Name</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{$item->name}}" placeholder="Enter name" name="name" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div><!--end row-->

                                </div><!--end modal-body-->
                            </div><!--end modal-content-->
                        </div><!--end modal-dialog-->
                    </div><!--end modal-->
                    @empty
                    <h1>No Roles are listed.</h1>
                    @endforelse
                </div><!--end row-->

            </div><!-- container -->

            <footer class="footer text-center text-sm-start">
                &copy; <script>
                    document.write(new Date().getFullYear())
                </script> Dastone <span class="text-muted d-none d-sm-inline-block float-end">Crafted with <i
                        class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
            </footer><!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->



    <!-- create new role modal -->
    <div class="modal fade bd-example-modal-lg" id="createNewRoleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Create new role</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="row">
                        <form action="{{route('role.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputEmail1">Role Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!--end row-->

                </div><!--end modal-body-->
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->

    <!-- jQuery  -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/metismenu.min.js')}}"></script>
    <script src="{{asset('js/waves.js')}}"></script>
    <script src="{{asset('js/feather.min.js')}}"></script>
    <script src="{{asset('js/simplebar.min.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('js/app.js')}}"></script>

</body>

</html>