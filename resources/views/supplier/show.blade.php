@extends('layouts.master')
@section('title','Supplier Show')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Inventory Setting</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Inventory Setting</li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="dastone-profile">
                <div class="row">
                    <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                        <div class="dastone-profile-main">

                            <div class="dastone-profile_user-detail">
                                <h5 class="dastone-user-name">{{ $item->name??'-' }}</h5>
                                <p class="mb-0 dastone-user-name-post">{{ $item->phone }}</p>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-4 ms-auto align-self-center">
                        <ul class="list-unstyled personal-detail mb-0">
                            <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> phone </b> : {{ $item->phone??'-' }}</li>
                            <li class="mt-2"><i class="ti ti-world text-secondary font-16 align-middle me-2"></i> <b> Address </b> : {{ $item->address??'-' }}
                            </li>
                        </ul>

                    </div><!--end col-->
                    <div class="col-lg-4 ms-auto align-self-center">
                        <ul class="list-unstyled personal-detail mb-0">
                            <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Contact Person Name </b> : {{ $item->contact_person_name??'-' }}</li>
                            <li class="mt-2"><i class="ti ti-world text-secondary font-16 align-middle me-2"></i> <b> Contact Person Phine </b> : {{ $item->contact_person_phone??'-' }}
                            </li>
                        </ul>

                    </div><!--end col-->

                </div><!--end row-->

                <div class="card">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Payment Type</th>
                                    <th>Account Name</th>
                                    <th>Branch</th>
                                    <th>Account Number</th>
                                </tr>
                            </thead>
                            @foreach($item->supplierPayments as $pay)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$pay->payment_type}}</td>
                                <td>{{$pay->account_name}}</td>
                                <td>{{$pay->branch}}</td>
                                <td>{{$pay->account_number}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div><!--end f_profile-->
        </div><!--end card-body-->
    </div>
</div>

<!-- create new modal -->
@endsection