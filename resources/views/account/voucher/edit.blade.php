@extends('layouts.master')
@section('title','Voucher Operation')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Voucher Operation</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Account</li>
                        <li class="breadcrumb-item">Voucher</li>
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
                <a href="{{route('account.voucher.index')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Back
                </a>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <form action="{{route('account.voucher.update',$item->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Account Category*</label>
                        <select name="account_category_id" class="form-control" required>
                            <option value="" selected>select option</option>
                            @foreach($categories as $category)
                            @if($category->type == 'Expense')
                            <option value="{{$category->id}}" {{ $category->id===$item->account_category_id?'selected':'' }} style="color:red;">{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}" {{ $category->id===$item->account_category_id?'selected':'' }} style="color:greeen;">{{$category->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Voucher Number*</label>
                        <input type="text" class="form-control" placeholder="Enter voucher number" name="voucher_number" value="{{$item->voucher_number}}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Voucher date*</label>
                        <input type="date" class="form-control" placeholder="Enter voucher date" name="voucher_date" value="{{date('Y-m-d',strtotime($item->voucher_date))}}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Amount*</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter amount" name="amount" value="{{$item->amount}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Voucher Image</label>
                        <input type="file" class="form-control" placeholder="Enter room image" name="image">
                        @if($item->image)
                        <img src="{{asset($item->image)}}" alt="Voucher Image" class="img-fluid mt-2" style="max-width: 200px;">
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" placeholder="Enter description" name="description" value="{{$item->description}}">
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