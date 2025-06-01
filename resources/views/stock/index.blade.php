@extends('layouts.master')
@section('title', 'Stock List')
@section('content')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Central Stock List</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Stock</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<div class="page-content">
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <form action="{{route('stock.index')}}" class="me-1">
                <div class="input-group mb-3 table-search-box">
                    <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                    <button class="btn btn-secondary" title="Search" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <a class="btn btn-danger" href="{{route('stock.index')}}" title="Reset">
                        <i class="fas fa-redo-alt"></i>
                    </a>
                </div>
            </form>


        </div><!--end card-->
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">



                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>{{ 'Product Name' }}</th>
                                    <th>{{ 'Quantity' }}</th>
                                    <th>{{ 'Expiry Date' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->product->name ?? '-' }}</td>
                                    <td>{{ $stock->total_quantity }}</td>
                                    <td>{{ date('d-m-Y', strtotime($stock->expired_date)) }}</td>
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