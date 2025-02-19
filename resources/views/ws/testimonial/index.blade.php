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
                        <li class="breadcrumb-item active">Testimonial</li>
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
                <button type="button" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed" data-bs-toggle="modal" data-bs-target="#createNewModal">
                    Create new Testimonial
                </button>
            </div>
            <div class="col-md-6">
                <form action="{{route('ws.testimonial.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('ws.testimonial.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr class="text-bolder">
                            <th>SL.</th>
                            <th>Image</th>
                            <th>Person Name</th>
                            <th>Person Designation</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <img src="{{asset($item->image)}}" style="height: 80px;">
                            </td>
                            <td><b>Name: </b>{{$item->person_name}}, <br>
                                <h6 class="fw-semibold m-0">Status: <span class="text-{{$item->status==1?'success':'danger'}} fw-normal"> {{$item->status==1?'Active':'Inactive'}}</span></h6>
                            </td>
                            <td>{{$item->person_designation}}</td>
                            <td>{{$item->details}}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">Edit</button>
                                    <form action="{{route('ws.testimonial.status',$item->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-{{$item->status==1?'danger':'success'}} btn-sm me-1" onclick="return confirm('Are you sure want {{$item->status==1?'Inactive':'Active'}} this item?')">{{$item->status==1?'Inactive':'Active'}}</button>
                                    </form>
                                    <form action="{{route('ws.testimonial.delete',$item->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                    </form>
                                </div>
                                <div class="modal fade bd-example-modal" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="myLargeModalLabel">Edit Designation</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <form action="{{route('ws.testimonial.storeOrUpdate',$item->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Person Name <small style="color: red">*</small></label>
                                                            <input type="text" class="form-control" placeholder="Enter person name" name="person_name" required value="{{$item->person_name??''}}">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Person designation <small style="color: red">*</small></label>
                                                            <input type="text" class="form-control" placeholder="Enter person designation" name="person_designation" required value="{{$item->person_designation??''}}">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Testimonial Details <small style="color: red">*</small></label>
                                                            <textarea name="details" class="form-control">{{$item->details??''}}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Image (100x100)px<small style="color: red">*</small></label>
                                                            <input type="file" class="form-control" name="image">
                                                            @if($item->image)
                                                            <img src="{{asset($item->image)}}" style="height: 100px;">
                                                            @endif
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div><!--end row-->
                                                </form>

                                            </div><!--end modal-body-->
                                        </div><!--end modal-content-->
                                    </div><!--end modal-dialog-->
                                </div><!--end modal-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!--end /table-->
            </div><!--end /tableresponsive-->
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->

<!-- create new modal -->
<div class="modal fade modal-fullscreen-down" id="createNewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myLargeModalLabel">Create new item</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form action="{{route('ws.testimonial.storeOrUpdate')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Person Name <small style="color: red">*</small></label>
                            <input type="text" class="form-control" placeholder="Enter person name" name="person_name" required >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Person designation <small style="color: red">*</small></label>
                            <input type="text" class="form-control" placeholder="Enter person designation" name="person_designation" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Details <small style="color: red">*</small></label>
                            <textarea name="details" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Image (100x100)px<small style="color: red">*</small></label>
                            <input type="file" class="form-control" name="image">

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div><!--end row-->
                </form>

            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
@endsection