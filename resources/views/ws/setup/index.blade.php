@extends('layouts.master')
@section('title','Website Management Area')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Website Management</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Website</li>
                        <li class="breadcrumb-item active">About</li>
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
            <form action="{{route('ws.setup.storeOrUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel name <small style="color: red">*</small></label>
                        <input type="text" class="form-control" placeholder="Enter hotel name" name="hotel_name" required value="{{$item->hotel_name??''}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel slogan</label>
                        <input type="text" class="form-control" placeholder="Enter hotel slogan" name="hotel_slogan" value="{{$item->hotel_slogan??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel phone <small style="color: red">*</small></label>
                        <input type="text" class="form-control" placeholder="Enter hotel phone" name="phone" required value="{{$item->phone??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel email</label>
                        <input type="text" class="form-control" placeholder="Enter hotel email" name="email" value="{{$item->email??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel data forwarding email </label>
                        <input type="text" class="form-control" placeholder="Enter hotel forwarding email" name="forwarding_email" value="{{$item->forwarding_email??''}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">About hotel (in a nutshell) <small style="color: red">*</small></label>
                        <textarea name="about_hotel" class="form-control" required>{{$item->about_hotel??''}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel address <small style="color: red">*</small></label>
                        <input type="text" class="form-control" placeholder="Enter hotel address" name="address" required value="{{$item->address??''}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel contact page breadcrumb <small style="color: red">*</small></label>
                        <input type="text" class="form-control" placeholder="Enter hotel contact page breadcrumb" name="contact_breadcrumb" value="{{$item->contact_breadcrumb??''}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel contact body <small style="color: red">*</small></label>
                        <input type="text" class="form-control" placeholder="Enter hotel contact body" name="contact_body" value="{{$item->contact_body??''}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Website Home video/image<small style="color: red">*</small></label>

                        <input type="file" class="form-control" name="home_theme">
                        @if($item && $item->home_theme)
                        <img src="{{asset($item->home_theme??'')}}" style="height: 100px;">
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Website Logo<small style="color: red">*</small></label>
                        <input type="file" class="form-control" name="logo">
                        @if($item && $item->logo)
                        <img src="{{asset($item->logo??'')}}" style="height: 100px;">
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Website favicon<small style="color: red">*</small></label>
                        <input type="file" class="form-control" name="favicon">
                        @if($item && $item->favicon)
                        <img src="{{asset($item->favicon??'')}}" style="height: 100px;">
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel facebook</label>
                        <input type="text" class="form-control" placeholder="Enter hotel facebook" name="facebook" value="{{$item->facebook??''}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel youtube</label>
                        <input type="text" class="form-control" placeholder="Enter hotel youtube" name="youtube" value="{{$item->youtube??''}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Hotel instagram</label>
                        <input type="text" class="form-control" placeholder="Enter hotel instagram" name="instagram" value="{{$item->instagram??''}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div><!--end row-->
            </form>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
@endsection