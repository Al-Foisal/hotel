@extends('layouts.master')
@section('title','Room Reservation Show')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Room Reservation</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Room Reservation</li>
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
                            <div class="dastone-profile-main-pic">
                                <img src="{{ asset('profile.png') }}" alt="" height="110" class="rounded-circle">
                            </div>
                            <div class="dastone-profile_user-detail">
                                <h5 class="dastone-user-name">{{ $item->customer->name??'-' }}</h5>
                                <p class="mb-0 dastone-user-name-post">{{ $item->customer->city??'-' }}, {{ $item->customer->state??'-' }}, {{ $item->customer->country??'-' }}</p>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-4 ms-auto align-self-center">
                        <ul class="list-unstyled personal-detail mb-0">
                            <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> phone </b> : {{ $item->customer->phone??'-' }}</li>
                            <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : {{ $item->customer->email??'-' }}</li>
                            <li class="mt-2"><i class="ti ti-world text-secondary font-16 align-middle me-2"></i> <b> Address </b> : {{ $item->customer->address??'-' }}
                            </li>
                        </ul>

                    </div><!--end col-->
                    <div class="col-lg-4 align-self-center">
                        <ul class="list-unstyled personal-detail mb-0">
                            <li class=""><i class="ti-layout-column4-alt me-2 text-secondary font-16 align-middle"></i> <b> Gender </b> : {{ $item->customer->gender??'-' }}</li>
                            <li class="mt-2"><i class="ti-layout-grid2-alt text-secondary font-16 align-middle me-2"></i> <b> Age </b> : {{ $item->customer->age??'-' }}Y</li>
                            <li class="mt-2"><i class="ti-layout-grid3-alt text-secondary font-16 align-middle me-2"></i> <b> Identity </b> : {{ $item->customer->identity_type??'-' }}({{ $item->customer->identity_number??'-' }})
                            </li>
                        </ul>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end f_profile-->
        </div><!--end card-body-->
    </div>
</div>

<div class="pb-4">
    <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="reservation_general_information" data-bs-toggle="pill" href="#rgi">General Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="reservation_monetary_information" data-bs-toggle="pill" href="#rmi">Monetary Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="room_or_apartment" data-bs-toggle="pill" href="#roa">Room or Apartments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="other_person_details" data-bs-toggle="pill" href="#opd">Other Persons</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings_detail_tab" data-bs-toggle="pill" href="#Profile_Settings">Settings</a>
        </li>
    </ul>
</div><!--end card-body-->
<div class="row">
    <div class="col-12">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="rgi" role="tabpanel" aria-labelledby="reservation_general_information">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reservation general information</h4>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled faq-qa">
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Invoice Number
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->invoice_number }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Check-in & Check-out date
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->check_in->format('d-m-Y') }} <b>To</b> {{ $item->check_out->format('d-m-Y') }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Arival from
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->arival_from??'Not set yet!' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Booking type
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->booking_type??'Not set yet!' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Created by
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->createdBy->name??'Booked from website.' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Updated by
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->updatedBy->name??'Not set yet!' }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled faq-qa">
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Booking reference
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->booking_reference??'Not set yet!' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Booking reference number
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->booking_reference_number??'Not set yet!' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Purpose of visits
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->purpose_of_visite??'Not set yet!' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Remarks
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->remarks??'Not set yet!' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Reservation date & time
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->created_at->format('d-m-Y h:i:s A') }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Reservation last updated
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->updated_at->format('d-m-Y h:i:s A') }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end tab-pane-->
            <div class="tab-pane fade " id="rmi" role="tabpanel" aria-labelledby="reservation_monetary_information">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reservation monetary information</h4>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled faq-qa">
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fas fa-paragraph"></i> Payment status
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->status }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fas fa-paragraph"></i> Belonging days
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->belonging_days??'0' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fas fa-paragraph"></i> Payment Method
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->card_issuer??'Cash Payment' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fas fa-paragraph"></i> Transaction number
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->transaction_id??'Cash Payment' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fas fa-paragraph"></i> Currency
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->currency??'Cash Payment' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fas fa-paragraph"></i> Customer Name
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->customer->name??'Not set yet!' }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Reservation date & time
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->created_at->format('d-m-Y h:i:s A') }}
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="far fa-circle"></i> Reservation last updated
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ $item->updated_at->format('d-m-Y h:i:s A') }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled faq-qa">
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Total
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->total)??'0' }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Vat
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->vat)??'0' }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Vat Amount
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->vat_amount)??'0' }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Discount
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->discount)??'0' }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Discount type
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->discount_type) }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Discount amount
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->discount_amount) }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Subtotal
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->subtotal)??'0' }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Paid amount
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->paid_amount)??'0' }} BDT
                                                </p>
                                            </li>
                                            <li class="mb-4">
                                                <h6 class="fw-bolder">
                                                    <i class="fab fa-paypal"></i> Due
                                                </h6>
                                                <p class="font-14 text-muted ms-3">
                                                    {{ number_format($item->due)??0 }} BDT
                                                </p>
                                            </li>
                                        </ul>
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end tab-pane-->
            <div class="tab-pane fade" id="roa" role="tabpanel" aria-labelledby="room_or_apartment">
                <div class="row">
                    @if($item->rooms->count()>0)
                    @foreach($item->rooms as $rpd)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="ribbon1 rib1-warning">
                                    <span class="text-white text-center rib1-warning">
                                        <b><i>Room Number: </i>{{$rpd->singleRoom->room_number??''}}</b>
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-auto">
                                        <img src="{{ asset($rpd->singleRoom->image??'') }}" alt="user" height="150" class="align-self-center mb-3 mb-lg-0">
                                    </div><!--end col-->

                                    <div class="col align-self-center">
                                        <p class="font-18 fw-semibold mb-2">{{ $rpd->singleRoom->floor->name??'' }} - {{$rpd->singleRoom->roomCategory->name??''}} ({{ $rpd->room_type }})</p>
                                        <p class="text-muted">
                                            {{$rpd->singleRoom->note??''}}
                                        </p>
                                        <a href="#" class="btn btn-soft-primary btn-sm">Adult: <i>{{$rpd->adult}}</i></a>
                                        <a href="#" class="btn btn-soft-success btn-sm">Child: <i>{{$rpd->adult}}</i></a>
                                        <a href="#" class="btn btn-soft-info btn-sm">Belong: <i>{{$rpd->belonging_days}} days</i></a>
                                        <a href="#" class="btn btn-soft-danger btn-sm">Price: <i>{{$rpd->price}} BDT</i></a>
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                    @endforeach
                    @endif
                </div><!--end row-->
            </div>
            <div class="tab-pane fade  show active" id="opd" role="tabpanel" aria-labelledby="other_person_details">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <tr>
                                        <td>Sl.</td>
                                        <td>Name</td>
                                        <td>Gender</td>
                                        <td>Age</td>
                                        <td>Address</td>
                                        <td>Identity Type</td>
                                        <td>Identity Number</td>
                                    </tr>
                                    @if($item->roomPersonDetails->count()>0)
                                    @foreach($item->roomPersonDetails as $r)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$r->name}}</td>
                                        <td>{{$r->gender}}</td>
                                        <td>{{$r->age}} Y</td>
                                        <td>{{$r->address}}</td>
                                        <td>{{$r->type_id}}</td>
                                        <td>{{$r->id_number}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div> <!--end row-->
            </div>
            <div class="tab-pane fade" id="Profile_Settings" role="tabpanel" aria-labelledby="settings_detail_tab">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Personal Information</h4>
                                    </div><!--end col-->
                                </div> <!--end row-->
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">First Name</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" type="text" value="Rosa">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Last Name</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" type="text" value="Dodson">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Company Name</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" type="text" value="MannatThemes">
                                        <span class="form-text text-muted font-12">We'll never share your email with anyone else.</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Contact Phone</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="las la-phone"></i></span>
                                            <input type="text" class="form-control" value="+123456789" placeholder="Phone" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Email Address</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="las la-at"></i></span>
                                            <input type="text" class="form-control" value="rosa.dodson@demo.com" placeholder="Email" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Website Link</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="la la-globe"></i></span>
                                            <input type="text" class="form-control" value=" https://mannatthemes.com/" placeholder="Email" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">USA</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <select class="form-select">
                                            <option>London</option>
                                            <option>India</option>
                                            <option>USA</option>
                                            <option>Canada</option>
                                            <option>Thailand</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 offset-lg-3">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!--end col-->
                    <div class="col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Change Password</h4>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Current Password</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" type="password" placeholder="Password">
                                        <a href="#" class="text-primary font-12">Forgot password ?</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">New Password</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" type="password" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Confirm Password</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" type="password" placeholder="Re-Password">
                                        <span class="form-text text-muted font-12">Never share your password.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 offset-lg-3">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Change Password</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Other Settings</h4>
                            </div><!--end card-header-->
                            <div class="card-body">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="Email_Notifications" checked>
                                    <label class="form-check-label" for="Email_Notifications">
                                        Email Notifications
                                    </label>
                                    <span class="form-text text-muted font-12 mt-0">Do you need them?</span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="API_Access">
                                    <label class="form-check-label" for="API_Access">
                                        API Access
                                    </label>
                                    <span class="form-text text-muted font-12 mt-0">Enable/Disable access</span>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                </div><!--end row-->
            </div><!--end tab-pane-->
        </div><!--end tab-content-->
    </div><!--end col-->
</div><!--end row-->
<!-- create new modal -->
@endsection