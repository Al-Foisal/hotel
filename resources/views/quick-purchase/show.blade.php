@extends('layouts.master')
@section('title', 'Purchase details')
@section('css')
<style>
    table tr td:nth-child(1),
    table tr td:nth-child(3) {
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h3>Purchase details</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                    </a>
                </li>

                <li class="breadcrumb-item ">Purchase</li>
                <li class="breadcrumb-item ">Details</li>


            </ol>
        </div>
    </div>
</div>
<div class="row">


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Details</th>
                <th>Title</th>
                <th>Details</th>
            </tr>
        </thead>
        <tr>
            <td>Invoice Number</td>
            <td>{{ $data->invoice_number }}</td>
            <td>Supplier Name</td>
            <td>{{ $data->supplier->name ?? '' }}</td>
        </tr>
        <tr>
            <td>Invoice Date</td>
            <td>{{ date('d-m-Y', strtotime($data->purchase_date)) }}</td>
            <td>Invoice Image</td>
            <td>
                @if ($data->invoice_image)
                <a href="{{ asset($data->invoice_image) }}" target="_blank">View Invoice
                    Image</a>
                @else
                No Invoice Image
                @endif
            </td>
        </tr>
        <tr>
            <td>Discount</td>
            <td>{{ $data->discount ?? 0 }}
                {{ $data->discount_type == 1 ? '%' : 'tk' }}
            </td>
            <td>Total</td>
            <td>{{ number_format($data->total,2) }}</td>
        </tr>
        <tr>
            <td>Subtotal</td>
            <td>{{ number_format($data->subtotal,2) }}</td>
            <td>Invoice Created</td>
            <td>{{ $data->created_at->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Created At</td>
            <td>{{ $data->created_at->format('d-m-Y') }}</td>
            <td>Updated At</td>
            <td>{{ $data->updated_at->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Created By</td>
            <td>{{ $data->createdBy->name ?? 'N/A' }}</td>
            <td>Updated By</td>
            <td>{{ $data->updatedBy->name ?? 'N/A' }}</td>
        </tr>

        <tr>
            <td>Invoice Note</td>
            <td>{{ $data->note ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Buying Price</th>
                    <th>Vat</th>
                    <th>Discount</th>
                    <th>Expired Date</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->itemDetails as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name ?? '' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->buying_price,2) }}</td>
                    <td>{{ number_format($item->vat,2) }}</td>
                    <td>{{ number_format($item->discount,2) }}</td>
                    <td>{{ $item->expired_date ? date('d-m-Y', strtotime($item->expired_date)) : 'N/A' }}
                    </td>
                    <td>{{ number_format($item->total_price,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</div>
@endsection
@push('customScripts')
<script>
    function print() {
        const printContents = document.getElementById('prescription').innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endpush