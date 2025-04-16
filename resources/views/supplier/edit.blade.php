@extends('layouts.master')
@section('title','Inventory Setting')
@section('css')
<style>
    .input-group-text-monetary {
        font-size: .8125rem;
        /* background-color: #9ba7ca;
        border: 1px solid #9ba7ca; */
        color: white;
        width: 15%;
        padding: 7px 0 0px 7px;
        font-weight: bolder;
        border-radius: 5px;
    }

    /*preloader css */
    .xloader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid blue;
        border-right: 16px solid green;
        border-bottom: 16px solid red;
        border-left: 16px solid pink;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-1">
        <a href="{{route('is.supplier.index')}}" class="btn btn-primary" style="margin-top: 20px;">Back</a>
    </div>
    <div class="col-sm-11">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Inventory Setting</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Supplier</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="alert alert-danger" id="em" style="display: none;">
        <span id="displayErrorMessage"></span>
    </div>
    <form action="{{route('is.supplier.update',$item->id)}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="col-12">
                    <b>Supplier Details</b>
                </div>
            </div><!--end card-header-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Name*</label>
                        <input type="text" class="form-control" name="name" value="{{$item->name}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Phone*</label>
                        <input type="text" class="form-control" name="phone" value="{{$item->phone}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Contact Person Name*</label>
                        <input type="text" class="form-control" name="contact_person_name" value="{{$item->contact_person_name}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Contact Person Phone*</label>
                        <input type="text" class="form-control" name="contact_person_phone" value="{{$item->contact_person_phone}}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" value="{{$item->address}}" placeholder="Supplier address">
                    </div>
                </div>
            </div><!--end card-body-->
        </div>
        <div class="card">
            <div class="card-header">
                <div class="col-12">
                    <b>Payment Details</b>
                </div>
            </div><!--end card-header-->
            <div class="card-body" id="multiplePaymentType">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Payment Type</label>
                        <select class="select2" style="width: 100%;" name="payment_type[]">
                            <option value="">select option</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Mobile Banking">Mobile Banking</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Account Name</label>
                        <input type="text" class="form-control" name="account_name[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Branch</label>
                        <input type="text" class="form-control" name="branch[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Account Number</label>
                        <input type="text" class="form-control" name="account_number[]">
                    </div>
                    <div class="col-md-1 mb-3">
                        <button type="button" class="btn btn-info" onclick="addAnotherRoom(this)" style="margin-top: 1.7rem;">+</button>
                    </div>
                </div>
                @foreach($item->supplierPayments as $type)

                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Payment Type</label>
                        <select class="select2" style="width: 100%;" name="payment_type[]">
                            <option value="">select option</option>
                            <option value="Cash" {{ $type->payment_type=='Cash'?'selected':'' }}>Cash</option>
                            <option value="Bank Transfer" {{ $type->payment_type=='Bank Transfer'?'selected':'' }}>Bank Transfer</option>
                            <option value="Mobile Banking" {{ $type->payment_type=='Mobile Banking'?'selected':'' }}>Mobile Banking</option>
                            <option value="Other" {{ $type->payment_type=='Other'?'selected':'' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Account Name</label>
                        <input type="text" class="form-control" name="account_name[]" value="{{$type->account_name}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Branch</label>
                        <input type="text" class="form-control" name="branch[]" value="{{$type->branch}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Account Number</label>
                        <input type="text" class="form-control" name="account_number[]" value="{{$type->account_number}}">
                    </div>
                    <div class="col-md-1 mb-3">
                        <button type="button" class="ibtnDel btn btn-danger del" style="margin-top: 1.8rem;">X</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="m-3">
            <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
        </div>
    </form>
</div> <!-- end row -->
<!-- create new modal -->
@endsection

@section('js')
<script>
    var aaRoom = 1;

    function addAnotherRoom() {

        aaRoom++; 
        var newRow = "";
        var cols = "";

        cols += `
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Payment Type</label>
                    <select class="select2" style="width: 100%;" name="payment_type[]">
                        <option value="">select option</option>
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Mobile Banking">Mobile Banking</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Account Name</label>
                    <input type="text" class="form-control" name="account_name[]">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Branch</label>
                    <input type="text" class="form-control" name="branch[]">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Account Number</label>
                    <input type="text" class="form-control" name="account_number[]">
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="ibtnDel btn btn-danger del" style="margin-top: 1.8rem;">X</button>
                </div>
            </div>
        `;
        // newRow.append(cols);
        $("#multiplePaymentType").append(cols);
        $(".select2").select2();
    }
    $("#multiplePaymentType").on("click", ".ibtnDel", function(event) {
        $(this).closest(".row").remove();
    });
</script>
@endsection