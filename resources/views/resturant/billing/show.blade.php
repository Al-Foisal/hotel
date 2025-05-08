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

    <div class="col-lg-12"></div>
    <div class="card">
        <div class="card-body">
            <h4 class="text-center">{{ config('app.name') }}</h4>
            <p class="text-center">Resturant Billing Invoice</p>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div><strong>Customer Name:</strong> {{$billing->customer_name}}</div>
                    <div><strong>Customer Phone:</strong> {{$billing->customer_phone}}</div>
                    <div><strong>Invoice Number:</strong> {{$billing->invoice_number}}</div>
                </div>
                <div class="col-md-6 text-end">
                    <div><strong>Table:</strong>{{$billing->table->table_number??'-'}}</div>
                    <div><strong>Room:</strong>{{$billing->roomOrApartment->room_number??'-'}}</div>
                    <div><strong>Created:</strong>{{$billing->created_at->format('d-m-Y')}}</div>
                </div>
            </div>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Item Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billing->itemDetails as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->menu_item_name }}</td>
                        <td>{{ number_format($item->menu_item_price, 2) }}</td>
                        <td>{{ $item->menu_item_quantity }}</td>
                        <td>{{ number_format($item->menu_item_total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <div><strong>Total Amount:</strong>{{$billing->total}}</div>
                    <div><strong>Discount:</strong>{{$billing->discount_amount}}({{ $billing->discount_type }})</div>
                </div>
                <div class="col-md-6 text-end">
                    <div><strong>Subtotal:</strong>{{$billing->subtotal}}</div>
                    <div><strong>Paid Amount:</strong>{{$billing->paid_amount}}</div>
                    <div><strong>Done By:</strong>{{$billing->createdBy->name??'-'}}</div>
                </div>
            </div>
            <div class="mt-4 text-center">
                <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
            </div>
        </div>
    </div>
</div>
</div> <!-- end row -->
<!-- create new modal -->
@endsection