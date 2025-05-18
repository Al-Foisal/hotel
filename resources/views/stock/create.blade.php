@extends('newLayouts.master')
@section('title', 'Create Invoive')
@push('customCss')
    <style>
        .hide {
            display: none;
        }
    </style>
@endpush
@section('content')

    <div class="page-content">
        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}"></x-alert>
        @endif
        @if (session('danger'))
            <x-alert type="danger" message="{{ session('danger') }}"></x-alert>
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="table-responsive">
                        <table id="laravel_datatable" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Stock details</th>
                                    <th>{{ 'Total Quantity' }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            @foreach ($item->details as $details)
                                                <div class="row">
                                                    <div class="col-md-3">{{ $details->product->name ?? 'N/A' }}</div>
                                                    <div class="col-md-3">{{ $details->suplier->name ?? 'N/A' }}</div>
                                                    <div class="col-md-2">{{ $details->batch_no }}</div>
                                                    <div class="col-md-2">{{ $details->expired_date }}</div>
                                                    <div class="col-md-2">{{ $details->quantity }}</div>
                                                </div>
                                                @if (!$loop->last)
                                                    <hr>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $item->total_quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('customScripts')
    {{-- for multiple education insertion --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success-link").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".btn-danger-link", function() {
                $(this).parents(".hdtuto").remove();
            });
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
    {{-- for multiple org insertion --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(".org_btn-success").click(function() {
                var lsthmtl = $(".org_clone").html();
                $(".org_increment").after(lsthmtl);
            });
            $("body").on("click", ".org_btn-danger", function() {
                $(this).parents(".org_hdtuto").remove();
            });
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
    <script>
        var total = 0;

        function calculateTotalPrice(e) {

            var product_total = 0;
            var quantity = 0;
            var unit_price = 0;
            var discount = 0;
            var quantity = Number($(e).parent().parent().parent().find('.quantity').val());
            var unit_price = Number($(e).parent().parent().parent().find('.unit_price').val());
            var discount = Number($(e).parent().parent().parent().find('.discount').val());

            product_total = (quantity * unit_price) - discount;
            $(e).parent().parent().parent().find('.total_price').val(product_total)

            var sum = 0;
            var total_discount = Number($("#total_discount").val());

            $(".total_price").each(function() {
                sum += +$(this).val();
            });

            $("#total").val(sum - total_discount);

        }

        function totalDiscountValue(e) {
            var discount = Number($(e).val());
            var sum = 0;
            $(".total_price").each(function() {
                sum += +$(this).val();
            });

            $("#total").val(sum - discount);
        }
    </script>
@endpush
