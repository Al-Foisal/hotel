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
                        <li class="breadcrumb-item active">Index</li>
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
                <a href="{{route('customer.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Customer
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('customer.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('customer.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->

    </div><!--end card-->
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Info</th>
                            <th>Customer Location</th>
                            <th>Identity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <b>Name: </b>{{$item->name}}, <br>
                                <b>Email: </b>{{$item->email}},<br>
                                <b>Phone: </b>{{$item->phone}},<br>
                                <b>Gender: </b>{{$item->gender}},<br>
                                <b>Age: </b>{{$item->age??'-'}} Y
                            </td>
                            <td>
                                <b>Country: </b>{{$item->country}}, <br>
                                <b>State: </b>{{$item->state}}, <br>
                                <b>City: </b>{{$item->city}}, <br>
                                <b>Address: </b>{{$item->address}}, <br>
                            </td>
                            <td>
                                <b>Type: </b>{{$item->identity_type}}, <br>
                                <b>Number: </b>{{$item->identity_number??'-'}}, <br>
                                <b>Image: </b>
                                <a href="{{asset($item->identity_image)}}"><img src="{{asset($item->identity_image)}}" alt="#" style="height: 40px;"></a>, <br>
                            </td>

                            <td>
                                <a href="{{route('customer.edit',$item->id)}}" class="btn btn-primary btn-sm mb-1">Edit</a> <br>

                                <form action="{{route('customer.delete',$item->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No data exists.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-2">
                    {{$items->links()}}
                </div>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection