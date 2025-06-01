@extends('layouts.master')
@section('title','Voucher list')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Voucher list</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Account</li>
                        <li class="breadcrumb-item">Voucher</li>
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
                <a href="{{route('account.voucher.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Item
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('account.voucher.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('account.voucher.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->

    </div><!--end card-->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Account Name</th>
                        <th>Voucher Number</th>
                        <th>Voucher Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$voucher->accountCategory->name}}</td>
                        <td>{{$voucher->voucher_number}}</td>
                        <td>{{date('d-m-Y', strtotime($voucher->voucher_date))}}</td>
                        <td>{{$voucher->amount}}</td>
                        <td>{{$voucher->description}}, <br>Image: @if($voucher->image) <a href="{{asset($voucher->image)}}" class="btn btn-link" target="_blank">View Voucher</a>@else Empty Voucher @endif</td>
                        <td>
                            <a href="{{route('account.voucher.edit', $voucher->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{route('account.voucher.delete', $voucher->id)}}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $vouchers->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div> <!-- end row -->
<!-- create new modal -->
@endsection