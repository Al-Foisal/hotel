<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from mannatthemes.com/dastone/default/apps-project-projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 Nov 2024 04:39:18 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Dastone - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
                            <a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createNewBranchModal">
                                Create Branch
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
                    @forelse($branches as $item)
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-3">
                                    <img src="{{asset($item->image)}}" alt="" class="thumb-md rounded-circle">
                                    <div class="media-body align-self-center text-truncate ms-3">
                                        <h4 class="m-0 fw-semibold text-dark font-15">{{$item->name}}</h4>
                                    </div><!--end media-body-->
                                </div>
                                <hr class="hr-dashed">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="fw-semibold m-0">Start Date: <span class="text-muted fw-normal"> {{$item->created_at->format('d F, Y')}}</span></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="fw-semibold m-0">Phone: <span class="text-muted fw-normal"> {{$item->phone}}</span></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="fw-semibold m-0">Status: <span class="text-{{$item->status==1?'success':'danger'}} fw-normal"> {{$item->status==1?'Active':'Inactive'}}</span></h6>
                                </div>

                                <div>
                                    <p class="text-muted mt-2 mb-1">
                                        {{$item->address}}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-semibold">Subscription deadline : <span class="text-muted fw-normal"> {{$item->deadline->format('d F, Y')}}</span><span class="badge badge-soft-pink fw-semibold ms-2"><i class="far fa-fw fa-clock"></i>
                                                @php
                                                $interval = round((strtotime($item->deadline) - strtotime(date('Y-m-d')))/ 86400);
                                                @endphp
                                                {{$interval>0?$interval.' days left':'Expired'}} </span></h6>
                                    </div>
                                    <div class="progress mb-4" style="height: 4px;">
                                        <div class="progress-bar bg-purple" role="progressbar" style="width: 100%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBranchModal">Edit</button>
                                        <form action="{{route('branch.status',$item->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-{{$item->status==1?'danger':'success'}}" onclick="return confirm('Are you sure want {{$item->status==1?'Inactive':'Active'}} this branch?')">{{$item->status==1?'Inactive':'Active'}}</button>
                                        </form>
                                        <button class="btn btn-info btn-sm"
                                            data-url="{{ route('gotoDashboard') }}"
                                            data-go_url="{{ route('dashboard') }}"
                                            data-branch_id="{{ $item->id }}"
                                            onclick="gotoDashboard(this)" style="width: 5rem">Enter</button>
                                    </div>
                                </div><!--end task-box-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                    <!-- edit branch modal -->
                    <div class="modal fade bd-example-modal-lg" id="editBranchModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title m-0" id="myLargeModalLabel">Create new branch</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div><!--end modal-header-->
                                <div class="modal-body">
                                    <div class="row">
                                        <form action="{{route('branch.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleInputEmail1">Branch Name</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{$item->name}}" placeholder="Enter name" name="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleInputPassword1">Phone</label>
                                                <input type="text" class="form-control" name="phone" placeholder="0147xxxxxx, 0148xxxxxxxx(Emergency), 01596xxxxxxx(Serial)" value="{{$item->phone}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="text" class="form-control" value="{{$item->address}}" aria-describedby="address" placeholder="Enter address" name="address" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="address">Branch Logo</label>
                                                <input type="file" class="form-control" name="image">
                                                @if($item->image)
                                                <img src="{{asset($item->image)}}" style="height:40px;">
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div><!--end row-->

                                </div><!--end modal-body-->
                            </div><!--end modal-content-->
                        </div><!--end modal-dialog-->
                    </div><!--end modal-->
                    @empty
                    <h1>No branches are listed.</h1>
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



    <!-- create new branch modal -->
    <div class="modal fade bd-example-modal-lg" id="createNewBranchModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Create new branch</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="row">
                        <form action="{{route('branch.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputEmail1">Branch Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputPassword1">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="0147xxxxxx, 0148xxxxxxxx(Emergency), 01596xxxxxxx(Serial)" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" aria-describedby="address" placeholder="Enter address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Branch Logo</label>
                                <input type="file" class="form-control" name="image" required>
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

    <script>
        function gotoDashboard(e) {
            var branch_id = $(e).data('branch_id');
            var url = $(e).data('url');
            var go_url = $(e).data('go_url');

            $.ajax({
                url: url,
                type: "get",
                dataType: "json",
                data: {
                    branch_id: branch_id
                },
                success: function(data) {
                    window.location.replace(data.url)
                },
            });
        }
    </script>
</body>

</html>