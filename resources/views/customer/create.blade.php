@extends('layouts.master')
@section('title','Customer area')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Customer area</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Customer</li>
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
                <a href="{{route('customer.index')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Back
                </a>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Customer Full Name*</label>
                        <input type="text" class="form-control" placeholder="Enter full name" name="name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Email*</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Phone*</label>
                        <input type="text" class="form-control" placeholder="Enter phone" name="phone" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Country*</label>
                        <input type="text" class="form-control" placeholder="Enter country" name="country" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">State*</label>
                        <input type="text" class="form-control" placeholder="Enter state" name="state" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">City*</label>
                        <input type="text" class="form-control" placeholder="Enter city" name="city" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Address*</label>
                        <input type="text" class="form-control" placeholder="Enter address" name="address" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Gender*</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Age(Y)</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter age" name="age">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Identity Type</label>
                        <select name="identity_type" class="form-control">
                            <option value="Passport">Passport</option>
                            <option value="Driving License">Driving License</option>
                            <option value="Birth Certificate">Birth Certificate</option>
                            <option value="NID">NID</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Identity Number</label>
                        <input type="text" class="form-control" placeholder="Enter identity number" name="identity_number">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Identity Image</label>
                        <input type="file" class="form-control" placeholder="Enter room capacity" name="identity_image">
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-end">
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
<script>
   
</script>
@endsection