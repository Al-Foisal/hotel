@extends('layouts.master')
@section('title','Dashboard')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Dashboard</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="col-12 col-lg-6 col-xl">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <span class="h4">{{ number_format($total_customers,2) }}</span>
                        <h6 class="text-uppercase text-muted mt-2 m-0">Total Customer</h6>
                    </div><!--end col-->
                </div> <!-- end row -->
            </div><!--end card-body-->
        </div> <!--end card-body-->
    </div><!--end col-->
    <div class="col-12 col-lg-6 col-xl">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <span class="h4">{{ number_format($total_rooms,2) }}</span>
                        <h6 class="text-uppercase text-muted mt-2 m-0">Total Room or Apartments</h6>
                    </div><!--end col-->
                </div> <!-- end row -->
            </div><!--end card-body-->
        </div> <!--end card-body-->
    </div><!--end col-->
    <div class="col-12 col-lg-6 col-xl">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <span class="h4">{{ number_format($total_system_users,2) }}</span>
                        <h6 class="text-uppercase text-muted mt-2 m-0">Total System User</h6>
                    </div><!--end col-->
                </div> <!-- end row -->
            </div><!--end card-body-->
        </div> <!--end card-body-->
    </div><!--end col-->
    <div class="col-12 col-lg-6 col-xl">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <span class="h4">{{number_format($todays_reservations,2)}}</span>
                        <h6 class="text-uppercase text-muted mt-2 m-0">Today Reservation</h6>
                    </div><!--end col-->
                </div> <!-- end row -->
            </div><!--end card-body-->
        </div> <!--end card-->
    </div><!--end col-->
    <div class="col-12 col-lg-6 col-xl">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <span class="h4">{{number_format($todays_checkouts,2)}}</span>
                        <h6 class="text-uppercase text-muted mt-2 m-0">Today Checkout</h6>
                    </div><!--end col-->
                </div> <!-- end row -->
            </div><!--end card-body-->
        </div> <!--end card-->
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Bed Types</h4>
                    </div><!--end col-->
                </div> <!--end row-->
            </div><!--end card-header-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="">
                            <tr>
                                <th class="border-top-0">Sl.</th>
                                <th class="border-top-0">Bed Types</th>
                            </tr><!--end tr-->
                        </thead>
                        <tbody>
                            @foreach($bed_types as $key => $bed_type)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $bed_type->name }}</td>
                            </tr><!--end tr-->
                            @endforeach
                        </tbody>
                    </table> <!--end table-->
                </div><!--end /div-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->
    
</div><!--end row-->
<!-- create new modal -->
@endsection