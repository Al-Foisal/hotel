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
                        <li class="breadcrumb-item active">Edit</li>
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
            <form action="{{route('promoCode.update',$item->id??'')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="roa_id" value="{{$item->id??''}}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Start Date*</label>
                        <input type="date" class="form-control" value="{{$item->start_date->format('Y-m-d')}}" name="start_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">End Date*</label>
                        <input type="date" class="form-control" value="{{$item->end_date->format('Y-m-d')}}" name="end_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Promo Code*</label>
                        <input type="text" class="form-control" placeholder="Enter promo code here" name="promo_code" required value="{{$item->promo_code}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Discounted By*</label>
                        <select name="discounted_by" class="form-control" required>
                            <option value="Authority" {{$item->discounted_by == 'Authority'?'selected':''}}>Authority</option>
                            <option value="Providers" {{$item->discounted_by == 'Providers'?'selected':''}}>Providers</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Discount*</label>
                        <input type="number" class="form-control" placeholder="Enter discount" name="discount" value="{{$item->discount}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Discount Type*</label>
                        <select name="discount_type" class="form-control" required>
                            <option value="Percentage" {{$item->discount_type == 'Percentage'?'selected':''}}>Percentage</option>
                            <option value="Taka" {{$item->discount_type == 'Taka'?'selected':''}}>Taka</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Status*</label>
                        <select name="status" class="form-control" required>
                            <option value="Active" {{$item->status == 'Active'?'selected':''}}>Active</option>
                            <option value="Inactive" {{$item->status == 'Inactive'?'selected':''}}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Note</label>
                        <input type="text" class="form-control" placeholder="Note" value="{{$item->note}}" name="note">
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