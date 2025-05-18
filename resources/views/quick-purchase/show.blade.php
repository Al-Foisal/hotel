@extends('newLayouts.master')
@section('title', 'Purchase details')

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

                    <li class="breadcrumb-item ">Pharmachy</li>
                    <li class="breadcrumb-item ">Purchase</li>
                    <li class="breadcrumb-item ">Details</li>


                </ol>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <x-back-button link="{{ route('p_quick-purchase.index') }}"></x-back-button>
                        </div>
                        <div class="card-body" id="prescription">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Supplier Name</label></b>
                                    <p class="mb-3">{{ $data->suplier->name ?? '' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Invoice Date</label></b>
                                    <p class="mb-3">{{ $data->invoice_date->format('d-m-Y') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Invoice Number</label></b>
                                    <p class="mb-3">{{ $data->invoice_number }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Invoice Image</label></b>
                                    <br>
                                    @if ($data->invoice_image)
                                        <a href="{{ asset($data->invoice_image) }}" target="_blank">View Invoice
                                            Image</a>
                                    @else
                                        <p class="mb-3">No Invoice Image</p>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Discount</label></b>
                                    <p class="mb-3">{{ $data->discount ?? 0 }}
                                        {{ $data->discount_type == 1 ? '%' : 'tk' }}
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Total</label></b>
                                    <p class="mb-3">{{ $data->total }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Invoice Status</label></b>
                                    <p class="mb-3">{{ $data->is_closed == 1 ? 'Closed' : 'Open' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Invoice Created</label></b>
                                    <p class="mb-3">{{ $data->created_at->format('d-m-Y') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Done By</label></b>
                                    <p class="mb-3">{{ $data->done_by }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="first_name" class="mb-3">Invoice Note</label></b>
                                    <p class="mb-3">{{ $data->note ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <h4>Invoice Product Information</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty Per Box</th>
                                            <th>Box Qty</th>
                                            <th>Quantity</th>
                                            <th>Buying Price</th>
                                            <th>Selling Price</th>
                                            <th>Vat</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>Expired Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->invoiceDetails as $details)
                                            <tr>
                                                <td>{{ $details->product->name ?? 'N/A' }}</td>
                                                <td>{{ $details->qty_per_box }}</td>
                                                <td>{{ $details->box_qty }}</td>
                                                <td>{{ $details->quantity }}</td>
                                                <td>{{ $details->buying_price }}</td>
                                                <td>{{ $details->unit_price }}</td>
                                                <td>{{ $details->vat ?? 0 }}%</td>
                                                <td>{{ $details->discount ?? 0 }}%</td>
                                                <td>{{ $details->total_price }}</td>
                                                <td>{{ \Carbon\Carbon::parse($details->expired_date)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
