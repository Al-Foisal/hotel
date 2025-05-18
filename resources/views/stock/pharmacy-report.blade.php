@extends('newLayouts.master')
@section('title', 'Pharmacy Stock')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Pharmacy Stock</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Pharmacy</li>
                    <li class="breadcrumb-item">Stock</li>
                    <li class="breadcrumb-item active">Supplier</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            @if (session('success'))
                <x-alert type="success" message="{{ session('success') }}"></x-alert>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert type="danger" message="{{ $error }}"></x-alert>
                @endforeach
            @endif
            <div class="text-center">
                <h4>***This buying and selling price are avaerage calculation.</h4>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card card-table b-r-5">

                    <div class="card-header card-table">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-primary btn-table del f-16"
                                    onclick="printContent('printed_invoice_area');">Print
                                    Report</button>
                            </div>
                            <div>
                                <b>Product: </b> {{ number_format($total_product) }} |
                                <b>Product Quantity: </b> {{ number_format($total_quantity) }} |
                                <b>Stock Value: </b> {{ number_format($total_purchase_amount, 2) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-table" id="printed_invoice_area">

                        <div class="table-responsive theme-scrollbar">
                            @foreach ($data as $key => $item)
                                @php
                                    $s_total_quantity = 0;
                                    $purchase_amount = 0;
                                    $sell_amount = 0;
                                @endphp
                                Company Name:  <b>{{ $item->first()->suplier->name ?? 'N/A' }}</b>
                                <table class="table table-bordered mb-4">

                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Category</th>
                                            <th>Quantity</th>
                                            <th>Buying Price</th>
                                            <th>Total Buying Price</th>
                                            <th>Sell Price</th>
                                            <th>Total Sell Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item as $s_product)
                                            @php
                                                $s_total_quantity += $s_product->product_quantity ?? 0;

                                                $purchase_amount += $s_product->s_b * $s_product->product_quantity;

                                                $sell_amount += $s_product->s_s * $s_product->product_quantity;
                                            @endphp
                                            <tr>
                                                <td>{{ $s_product->product->dosage->name ?? 'N/A' }}:
                                                    {{ $s_product->product->name ?? 'N/A' }} : 
                                                    {{ $s_product->product->strength ?? 'N/A' }}
                                                </td>
                                                <td>{{ $s_product->product->category->name ?? 'N/A' }}</td>
                                                <td>{{ $s_product->product_quantity }}</td>
                                                <td>{{ number_format($s_product->s_b, 2) ?? 'N/A' }} </td>
                                                <td>{{ number_format($s_product->s_b * $s_product->product_quantity, 2) }}
                                                </td>
                                                <td>{{ number_format($s_product->s_s, 2) ?? 'N/A' }} </td>

                                                <td>{{ number_format($s_product->s_s * $s_product->product_quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><b>Total</b></td>
                                            <td><b>{{ number_format($s_total_quantity, 2) }}</b></td>
                                            <td></td>
                                            <td><b>{{ number_format($purchase_amount, 2) }} BDT</b></td>
                                            <td></td>
                                            <td><b>{{ number_format($sell_amount, 2) }} BDT</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function printContent(el) {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }
    </script>
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page, productId = '', startDate = '', endDate = '', suplierId = '');
                }
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
                getData(page, productId = '', startDate = '', endDate = '', suplierId = '');
            });
        });

        function getData(page, productId = '', startDate = '', endDate = '', suplierId = '') {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                data: {
                    productId: productId,
                    startDate: startDate,
                    endDate: endDate,
                    suplierId: suplierId,
                },
                datatype: "html"
            }).done(function(data) {
                $("#tag_container").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

        $('#filter').click(function() {
            var productId = $('#productId').val();
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var suplierId = $('#suplierId').val();
            if ((startDate != '' && endDate != '') || suplierId != '' || productId != '') {
                getData(1, productId, startDate, endDate, suplierId);
            } else {
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function() {
            $('#productId').append('<option value="" selected></option>');
            $('#startDate').val('');
            $('#endDate').val('');
            $('#suplierId').append('<option value="" selected></option>');
            $('#laravel_datatable').DataTable().destroy();
            loadDatatable();
        });
    </script>
@endpush
