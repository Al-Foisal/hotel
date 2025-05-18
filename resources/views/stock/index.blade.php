@extends('newLayouts.master')
@section('title', 'Stock List')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h3>Stock List</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                    </a>
                </li>
                
                <li class="breadcrumb-item ">Pharmacy</li>
                <li class="breadcrumb-item ">Stock</li>
                <li class="breadcrumb-item active">Index</li>
        
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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        
                        {{-- <div class="row align-items-start">
                            <x-button link="{{ route('p_invoice.create') }}" icon="plus-circle"
                                title="Create New Invoice"></x-button>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-1">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <select id="productId" class="js-example-basic-single form-select productId"
                                            data-placeholder="Select product">
                                            <option value="">select product</option>
                                            @foreach ($product as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-1">
                                <input type="date" class="form-control input-daterange" id="startDate">
                            </div>
                            <div class="col-md-2 mb-1">
                                <input type="date" class="form-control input-daterange" id="endDate">
                            </div>
                            <div class="col-md-3 mb-1">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <select id="suplierId" class="js-example-basic-single form-select suplierId"
                                            data-placeholder="Select suplier">
                                            <option value="">select suplier</option>
                                            @foreach ($suplier as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-1">
                                <div class="d-flex justify-content-around">
                                    <button class="btn btn-primary btn-sm" type="button" id="filter">Filter</button>
                                    <button class="btn btn-primary btn-sm" type="button" id="refresh">Refresh</button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="table-responsive">
                            <table id="laravel_datatable" class="table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>{{ 'Product Name' }}</th>
                                        <th>{{ 'Quantity' }}</th>
                                        <th>{{ 'Batch No' }}</th>
                                        <th>{{ 'Expiry Date' }}</th>
                                        <th>{{ 'Supplier Name' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> --}}
                        <div id="tag_container">
                            @include('pharmacy.stock.presult')
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
