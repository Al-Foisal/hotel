@extends('layouts.master')
@section('title','Room Reservation Setting')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Room Reservation Setting</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Promo Code</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<!-- end page title end breadcrumb -->
<div class="row">

    <div class="card">
        <div class="card-header row">
            <div class="col-md-6">
                <a href="{{route('promoCode.index')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Back
                </a>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <form action="{{route('promoCode.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Start Date*</label>
                        <input type="date" class="form-control" name="start_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">End Date*</label>
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Promo Code*</label>
                        <input type="text" class="form-control" placeholder="Enter promo code here" name="promo_code" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Discounted By*</label>
                        <select name="discounted_by" class="form-control" required>
                            <option value="Authority">Authority</option>
                            <option value="Providers">Providers</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Discount*</label>
                        <input type="number" class="form-control" placeholder="Enter discount" name="discount" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Discount Type*</label>
                        <select name="discount_type" class="form-control" required>
                            <option value="Percentage">Percentage</option>
                            <option value="Taka">Taka</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Status*</label>
                        <select name="status" class="form-control" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Note</label>
                        <input type="text" class="form-control" placeholder="Note" name="note">
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                Submit</button>
                        </div>
                    </div>
                </div><!--end row-->
            </form>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection

@section('js')

@endsection