@extends('layouts.master')
@section('title','Purchase')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Purchase</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Purchase</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<div class="row">

    <div class="card">
        <div class="card-header row">
            <div class="col-md-6">
                <a href="{{route('purchase.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Purchase
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('purchase.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('purchase.index')}}" title="Reset">
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Invoice Number</th>
                            <th>Supplier</th>
                            <th>Purchase Date</th>
                            <th>Total Item</th>
                            <th>Total Amount</th>
                            <th>Created By</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$purchase->invoice_number}}</td>
                            <td>{{$purchase->supplier->name??'-'}}</td>
                            <td>{{date('d-m-Y', strtotime($purchase->purchase_date))}}</td>
                            <td>{{$purchase->item_details_count}}</td>
                            <td>{{number_format($purchase->total,2)}}</td>
                            <td>{{$purchase->createdBy->name??'-'}}</td>
                            <td>{{$purchase->created_at->format('d-m-Y')}}</td>
                            <td>
                                <a href="{{route('purchase.show', $purchase->id)}}" class="btn btn-info btn-sm">View</a>
                                <form action="{{route('purchase.delete', $purchase->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                {{ $purchases->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
@endsection
@push('customScripts')

@endpush