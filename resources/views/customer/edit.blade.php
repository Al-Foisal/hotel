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
                <a href="{{route('customer.index')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Back
                </a>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <form action="{{route('customer.update',$item->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Customer Full Name*</label>
                        <input type="text" class="form-control" placeholder="Enter full name" name="name" required value="{{$item->name}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Email*</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email" required value="{{$item->email??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Phone*</label>
                        <input type="text" class="form-control" placeholder="Enter phone" name="phone" required value="{{$item->phone??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Country*</label>
                        <input type="text" class="form-control" placeholder="Enter country" name="country" required value="{{$item->country??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">State*</label>
                        <input type="text" class="form-control" placeholder="Enter state" name="state" required value="{{$item->state??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">City*</label>
                        <input type="text" class="form-control" placeholder="Enter city" name="city" required value="{{$item->city??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Address*</label>
                        <input type="text" class="form-control" placeholder="Enter address" name="address" required value="{{$item->address??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Gender*</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male" {{$item->gender === 'Male'?'selected':''}}>Male</option>
                            <option value="Female" {{$item->gender === 'Female'?'selected':''}}>Female</option>
                            <option value="Others" {{$item->gender === 'Others'?'selected':''}}>Others</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Age(Y)</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter age" name="age" value="{{$item->age??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Identity Type</label>
                        <select name="identity_type" class="form-control">
                            <option value="Passport" {{$item->identity_type==='Passport'?'selected':''}}>Passport</option>
                            <option value="Driving License" {{$item->identity_type==='Driving License'?'selected':''}}>Driving License</option>
                            <option value="Birth Certificate" {{$item->identity_type==='Birth Certificate'?'selected':''}}>Birth Certificate</option>
                            <option value="NID" {{$item->identity_type==='NID'?'selected':''}}>NID</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Identity Number</label>
                        <input type="text" class="form-control" placeholder="Enter identity number" name="identity_number" value="{{$item->identity_number??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Identity Image</label>
                        <input type="file" class="form-control" placeholder="Enter room capacity" name="identity_image">
                        @if($item->identity_image)
                        <a href="{{asset($item->identity_image)}}">
                            <img src="{{asset($item->identity_image)}}" alt="#" style="height: 40px;">
                        </a>
                        @endif
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