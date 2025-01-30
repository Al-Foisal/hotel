@extends('layouts.master')
@section('title','Designation')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Designation</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item active">Designation</li>
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
                    Create new Designation
                </button>
            </div>
            <div class="col-md-6">
                <form action="{{route('rrs.desg.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('rrs.desg.index')}}" title="Reset">
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
                            <th>Designation</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">Edit</button>
                                    <form action="{{route('rrs.desg.delete',$item->id)}}" method="post">
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
                                                <form action="{{route('rrs.desg.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Designation Name <small style="color: red">*</small></label>
                                                            <input type="text" class="form-control" placeholder="Enter Designation" name="name" required value="{{$item->name??''}}">
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
                <form action="{{route('rrs.desg.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="">Designation Name <small style="color: red">*</small></label>
                            <input type="text" class="form-control" placeholder="Enter Designation" name="name" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div><!--end row-->
                </form>

            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
@endsection