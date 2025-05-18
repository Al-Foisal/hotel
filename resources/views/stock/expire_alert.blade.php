@extends('newLayouts.master')
@section('title', 'Pharmacy Expiry Alert')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Pharmacy Expiry Alert</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Pharmacy</li>
                    <li class="breadcrumb-item">Expiry</li>
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
                <div class="card card-table b-r-5">
                    <div class="card-header card-table">
                        <button class="btn btn-primary btn-table f-16 del"
                            onclick="printContent('printed_invoice_area');">Print
                            Report</button>
                    </div>
                    <div class="card-body card-table" id="printed_invoice_area">

                        <div class="table-responsive theme-scrollbar">

                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr class="bg-info">
                                        <th class="fw-bolder">Product Name</th>
                                        <th class="fw-bolder">Shelf Position</th>
                                        <th class="fw-bolder">Suplier</th>
                                        <th class="fw-bolder">Expiry Date</th>
                                        <th class="fw-bolder">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $ls_product)
                                        <tr class="fw-bold">
                                            <td>
                                                {{ $ls_product->product->dosage->name ?? 'N/A' }} :
                                                {{ $ls_product->product->name ?? 'N/A' }} :
                                                {{ $ls_product->product->strength ?? 'N/A' }}
                                            </td>
                                            <td>{{ $ls_product->product->productDetails->self_position ?? 'N/A' }}</td>
                                            <td>{{ $ls_product->suplier->name ?? 'N/A' }}</td>
                                            <td>{{ $ls_product->expired_date->format('d F, Y') }}</td>
                                            <td>{{ $ls_product->total_quantity }}
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
