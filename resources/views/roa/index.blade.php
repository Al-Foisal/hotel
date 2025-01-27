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
                        <li class="breadcrumb-item">Room or Apartment</li>
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
                <a href="{{route('rrs.roa.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Room or Apartment
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('rrs.roa.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('rrs.roa.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->

    </div><!--end card-->
    @foreach($roa as $item)
    <div class="card">
        <div class="card-body">
            <h4 style="text-decoration: underline;">
                {{$item->name}}
            </h4>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Status&Image</th>
                            <th>Room Details</th>
                            <th>Room Facility</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($item->roa as $detail)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                            <b>Status:</b> <span class="text-{{$detail->status==1?'success':'danger'}} fw-normal"> {{$detail->status==1?'Active':'Inactive'}}</span>, <br> <br>
                                <img src="{{asset($detail->image??'hotel.png')}}" style="height:60px ">
                            </td>
                            <td>
                                <b>Type: </b>{{$detail->type}}, <br>
                                <b>Room Type: </b>{{$detail->roomType->name??'-'}}, <br>
                                <b>Room Number: </b>{{$detail->room_number}}, <br>
                                <b>Price Per Day: </b> {{$detail->price}}, <br>
                                <b>Capacity: </b> {{$detail->capacity}} Persons, <br>
                                <b>Diameter: </b> {{$detail->diameter}} m<sup>2</sup>, <br>
                                <b>Wifi-Password: </b>{{$detail->wifi_password}}, <br>
                                <b>Note: </b> {{$detail->note??'-'}}
                            </td>
                            <td style="vertical-align: super;">
                                <ol>

                                    @forelse($detail->facilities as $f)
                                    <li>{{$f->facility->name??'-'}}</li>
                                    @empty
                                    No facility exists
                                    @endforelse
                                </ol>
                            </td>
                            <td>
                                <a href="{{route('rrs.roa.edit',$detail->id)}}" class="btn btn-primary btn-sm mb-1">Edit</a> <br>
                                <form action="{{route('rrs.roa.status',$detail->id)}}" method="post">
                                    @csrf 
                                    <button type="submit" class="btn btn-{{$detail->status==1?'danger':'success'}} btn-sm mb-1" onclick="return confirm('Are you sure want {{$detail->status==1?'Inactive':'Active'}} this item?')">{{$detail->status==1?'Inactive':'Active'}}</button>
                                </form>
                                <form action="{{route('rrs.roa.delete',$detail->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No room exists.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
    @endforeach
</div> <!-- end row -->
<!-- create new modal -->
@endsection