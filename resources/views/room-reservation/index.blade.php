@extends('layouts.master')
@section('title','Room Reservation')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Room Reservation</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Room Reservation</li>
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
                <a href="{{route('roomReservation.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Room or Apartment
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('roomReservation.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('roomReservation.index')}}" title="Reset">
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
                            <th>Reservation Duration</th>
                            <th>Room Info</th>
                            <th>Persons</th>
                            <th>Total</th>
                            <th>Vat</th>
                            <th>Discount</th>
                            <th>Subotal</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rr as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {!!$item->check_in->format('d-m-Y').' to <br>'.$item->check_out->format('d-m-Y')!!}
                            </td>
                            <td>
                                Room: {{$item->rooms?$item->rooms->count():0}}, <br>
                                Adult: {{$item->rooms?$item->rooms->sum('adult'):0}}, <br>
                                Child: {{$item->rooms?$item->rooms->sum('child'):0}},
                            </td>
                            <td>
                                {{$item->roomOtherPersonDetails?(int)$item->roomOtherPersonDetails->count()+1:1}}
                            </td>
                            <td>{{number_format($item->total)}}</td>
                            <td>{{number_format($item->vat_amount)}}</td>
                            <td>{{number_format($item->discount_amount)}}</td>
                            <td>{{number_format($item->subtotal)}}</td>
                            <td>{{number_format($item->paid_amount)}}</td>
                            <td>{{number_format($item->due)}}</td>
                            <td>{{$item->created_at->format('d-m-Y h:i:s A')}}</td>
                            <td>
                                <a href="{{route('roomReservation.edit',$item->id)}}" class="btn btn-primary btn-sm mb-1">Edit</a> <br>
                                {{--<form action="{{route('roomReservation.status',$item->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-{{$item->status==1?'danger':'success'}} btn-sm mb-1" onclick="return confirm('Are you sure want {{$item->status==1?'Inactive':'Active'}} this item?')">{{$item->status==1?'Inactive':'Active'}}</button>
                                </form>
                                <form action="{{route('roomReservation.delete',$item->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                </form>--}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No room exists.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-2">
                    {{$item->links()}}
                </div>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection