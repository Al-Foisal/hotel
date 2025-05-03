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
                        <li class="breadcrumb-item active">Floor</li>
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
                    Create new Floor
                </button>
            </div>
            <div class="col-md-6">
                <form action="{{route('resturant.menuItem.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('resturant.menuItem.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->
        @foreach($categories as $cat)
        <div class="card">
            <div class="card-body">
                <h4 style="text-decoration: underline;">
                    {{$cat->name}}
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 table-centered">
                        <thead>
                            <tr class="text-bolder">
                                <th>SL.</th>
                                <th>Image</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Formation Duration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cat->menuItems as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{asset($item->image)}}" style="height: 40px;width: 40px;" alt="Image" class="rounded-circle">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->formation_duration}}</td>
                                <td>
                                    @if($item->status == 'Active')
                                    <span class="badge bg-success">{{$item->status}}</span>
                                    @else
                                    <span class="badge bg-danger">{{$item->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <button class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">Edit</button>
                                        <form action="{{route('resturant.menuItem.delete',$item->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                        </form>
                                    </div>
                                    <div class="modal fade bd-example-modal" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title m-0" id="myLargeModalLabel">Edit existing item</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div><!--end modal-header-->
                                                <div class="modal-body">
                                                    <form action="{{route('resturant.menuItem.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="category">Category*</label>
                                                                <select class="form-control" name="resturant_menu_item_category_id" id="category" required>
                                                                    <option value="" disabled selected>Select a category</option>
                                                                    @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ $item->resturant_menu_item_category_id == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="status">Status*</label>
                                                                <select class="form-control" name="status" id="status" required>
                                                                    <option value="" disabled selected>Select option</option>
                                                                    <option value="Active" {{ $item->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                                    <option value="Inactive" {{ $item->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="exampleInputEmail1">Item Name*</label>
                                                                <input type="text" class="form-control" placeholder="Enter item name" name="name" required value="{{$item->name??''}}">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="exampleInputEmail1">Price*</label>
                                                                <input type="number" class="form-control" placeholder="Enter price" name="price" required value="{{$item->price??''}}">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="exampleInputEmail1">Formation Duration</label>
                                                                <input type="text" class="form-control" placeholder="Enter start floor number" name="formation_duration" value="{{$item->formation_duration??''}}">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="exampleInputEmail1">Image</label>
                                                                <input type="file" class="form-control" name="image">
                                                                @if($item->image)
                                                                <img src="{{asset($item->image)}}" style="height: 40px;width: 40px;" alt="Image" class="rounded-circle mt-2">
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
        </div>
        @endforeach
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
                <form action="{{route('resturant.menuItem.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="category">Category*</label>
                            <select class="form-control" name="resturant_menu_item_category_id" id="category" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status">Status*</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="" disabled selected>Select option</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Item Name*</label>
                            <input type="text" class="form-control" placeholder="Enter item name" name="name" required value="{{old('name')}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Price*</label>
                            <input type="number" class="form-control" placeholder="Enter price" name="price" required value="{{old('price')}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Formation Duration</label>
                            <input type="text" class="form-control" placeholder="Enter start floor number" name="formation_duration" value="{{old('formation_duration')}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Image</label>
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