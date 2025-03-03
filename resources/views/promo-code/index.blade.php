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
                        <li class="breadcrumb-item">Promo Code</li>
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
                <a href="{{route('promoCode.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Promo Code
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('promoCode.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('promoCode.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div><!--end card-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Promo Code</th>
                            <th>Start & End Date</th>
                            <th>Discount</th>
                            <th>Discounted By</th>
                            <th>Status</th>
                            <th>Timestamps</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->promo_code}}</td>
                            <td>{{$item->start_date->format('d-m-Y').' - '.$item->end_date->format('d-m-Y')}}</td>
                            <td>{{$item->discount.' '.$item->discount_type}}
                            <td><b>By: </b> {{$item->discounted_by}}, <br> <b>Note: </b>{{$item->note}}</td>
                            <td><b>Creator: </b>{{$item->createdBy->name??'-'}},<br><b>Status: </b>{{$item->status}}</td>
                            <td><b>Created: </b>{{$item->created_at->format('d-m-Y')}},<br><b>Updated: </b>{{$item->updated_at->format('d-m-Y')}}</td>
                            <td>
                                <a href="{{route('promoCode.edit',$item->id)}}" class="btn btn-primary btn-sm mb-1">Edit</a> <br>
                                <form action="{{route('promoCode.status',$item->id)}}" method="post">
                                    @csrf 
                                    <button type="submit" class="btn btn-{{$item->status=='Active'?'danger':'success'}} btn-sm mb-1" onclick="return confirm('Are you sure want {{$item->status=='Active'?'Inactive':'Active'}} this item?')">{{$item->status=='Active'?'Inactive':'Active'}}</button>
                                </form>
                                <form action="{{route('promoCode.delete',$item->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection