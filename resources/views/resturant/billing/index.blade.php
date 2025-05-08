@extends('layouts.master')
@section('title','Resturant billing')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Resturant billing</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
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
                <a href="{{route('resturantBilling.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Item
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('resturantBilling.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('resturantBilling.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Invoice Number</th>
                            <th>Table Number</th>
                            <th>TIC/TQ</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Subtotal</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($billings as $key => $billing)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $billing->invoice_number }}</td>
                            <td>{{ $billing->table->table_number??'-' }}</td>
                            <td>
                                <div class="badge badge-soft-primary fw-bolder" title="Total Item Count">
                                    {{ $billing->itemDetails->count() }}
                                </div>
                                /
                                <div class="badge badge-soft-warning fw-bolder" title="Total Quantity">
                                    {{ $billing->itemDetails->sum('menu_item_quantity') }}
                                </div>
                            </td>
                            <td>{{ number_format($billing->total,2) }}</td>
                            <td>{{ number_format($billing->discount_amount,2) }}({{ $billing->discount_type }})</td>
                            <td>{{ number_format($billing->subtotal,2) }}</td>
                            <td>{{ $billing->createdBy->name??'Operator' }}</td>
                            <td>{{ $billing->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('resturantBilling.show', $billing->id) }}" class="btn btn-info btn-sm" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('resturantBilling.edit', $billing->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('resturantBilling.delete', $billing->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $billings->links() }}
                </div>
            </div>
        </div>
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection