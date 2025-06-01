@extends('layouts.master')
@section('title', 'Create Purchase')
@section('css')
<style>
    .hide {
        display: none;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox  */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection

@section('content')
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
<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="" class="form form-vertical" action="{{ route('purchase.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="invoice_date" class="form-label"><span class="required"> * </span>
                                            Purchase Date</label>
                                        <input type="date" class="form-control" name="invoice_date" id="invoice_date"
                                            value="{{ date('Y-m-d') }}" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="suplier_id" class="form-label"><span class="required"> * </span>
                                            Company Name:</label>
                                        <select name="supplier_id" class="js-example-basic-single form-select" required>
                                            <option value="">select option</option>
                                            @foreach ($suppliers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="invoice_number" class="form-label">Invoice Number</label>
                                        <input type="text" class="form-control" name="invoice_number"
                                            id="invoice_number" value="{{ old('invoice_number') }}" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="invoice_image" class="form-label">
                                            Invoice Copy</label>
                                        <input type="file" class="form-control" name="invoice_image"
                                            id="invoice_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="note" class="form-label">
                                            Notes</label>
                                        <textarea class="form-control" id="note" name="note" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider">
                            <div class="divider-text">Invoice Product Information</div>
                        </div>
                        <div class="">
                            <div id="increment"></div>

                            <div class="text-right">
                                <label for="###"></label>
                                <button class="btn btn-success-link bg-success text-white del mt-4" type="button"><i
                                        class="fa fa-plus-circle"></i> Add more product</button>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-2">
                                <label for="" class="col-form-label">Total Amount: </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" placeholder="0" id="all_total" readonly
                                    name="total_amount">
                            </div>
                            <div class="col-sm-6"></div>
                            <div class="col-sm-2 mt-2">

                                <div class="d-flex justify-content-between mt-2">
                                    <label for="discount" class="mb-2 d-flex align-items-center">Discount
                                    </label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input total_discount_type"
                                            id="total_discount_type" name="total_discount_type">
                                        <label class="form-check-label" for="total_discount_type">%</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-2">
                                <input type="text" class="form-control" placeholder="0" id="total_discount"
                                    name="total_discount" onkeyup="totalDiscountValue(this)">
                            </div>
                            <div class="col-sm-6 mt-2"></div>
                            <div class="col-sm-2 mt-2">
                                <label for="" class="col-form-label">Grand Total: </label>
                            </div>
                            <div class="col-sm-4 mt-2">
                                <input type="text" class="form-control" placeholder="0" id="total" readonly
                                    name="grand_total">
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                    <div class="clone hide">
                        <div class="hdtuto lst row" style="margin-top:10px">
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group mb-3">
                                    <label for="product_id" class="mb-2 d-flex align-items-center">Product Name
                                    </label>

                                    <!-- <div class="SP"></div> -->
                                    <select name="product_id[]" class="form-control select2 product_id" required id="product_id" style="width: 100%;">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="d-flex justify-content-between">
                                    <div class="me-1">
                                        <div class="form-group mb-3">
                                            <label for="quantity" class="mb-2 d-flex align-items-center">
                                                Quantity</label>
                                            <input type="number" min="1"
                                                class="form-control quantity" id="quantity"
                                                name="quantity[]" value="1"
                                                onkeyup="calculateTotalPrice(this)">
                                        </div>
                                    </div>
                                    <div class="me-1">
                                        <div class="form-group mb-3">
                                            <label for="buying_price"
                                                class="mb-2 d-flex align-items-center">Buying Price</label>
                                            <input type="number" min="0" step="0.0001"
                                                class="form-control buying_price" id="buying_price"
                                                name="buying_price[]" value=""
                                                placeholder="Buying price"
                                                onkeyup="calculateTotalPrice(this)">
                                        </div>
                                    </div>
                                    <div class="me-1">
                                        <div class="form-group mb-3">
                                            <label for="vat"
                                                class="mb-2 d-flex align-items-center">Vat(%)
                                            </label>

                                            <input type="number" min="0" step="0.01"
                                                class="form-control vat" id="vat" name="vat[]"
                                                value="{{ old('vat') }}" placeholder="vat price"
                                                onkeyup="calculateTotalPrice(this)">
                                        </div>
                                    </div>
                                    <div class="me-1">
                                        <div class="form-group mb-3">
                                            <label for="discount"
                                                class="mb-2 d-flex align-items-center">Discount(%)
                                            </label>

                                            <input type="number" min="0" step="0.01"
                                                class="form-control discount" id="discount"
                                                name="discount[]" value="{{ old('discount') }}"
                                                placeholder="Discount price"
                                                onkeyup="calculateTotalPrice(this)">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-1">
                                <div class="form-group mb-3">
                                    <label for="date" class="mb-2 d-flex align-items-center">Exp. Date
                                    </label>
                                    <input type="date" class="form-control date" id="date"
                                        name="expired_date[]" value="{{ old('date') }}"
                                        placeholder="date Number">
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-1">
                                <div class="form-group mb-3">
                                    <label for="total_price" class="mb-2 d-flex align-items-center">Total
                                    </label>
                                    <input type="number" min="0" step="0.01"
                                        class="form-control total_price" id="total_price"
                                        name="total_price[]" value="{{ old('total_price') }}" readonly
                                        placeholder="Total price">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label for=""></label>
                                <div style="text-align: right;">
                                    <button class="btn btn-danger-link del f-16 bg-danger text-white mt-3"
                                        type="button">
                                        <i class="fa fa-minus-circle"></i> </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('js')
{{-- for multiple education insertion --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-success-link").click(function(e) {
            e.preventDefault();

            // Clone the first form group
            var newElement = $('.clone .hdtuto:first').clone();

            // Find the select element in the new element and make any necessary modifications
            var select = newElement.find('select');
            select.val('').trigger('change'); // Reset selected value
            newElement.find('#quantity').val();
            newElement.find('#discount').val();

            // IMPORTANT: Remove the old select2 container before initializing
            newElement.find('.select2-container').remove();

            // Append the new element to the container
            $('#increment').append(newElement);

            // Reinitialize Select2 on the newly added select element
            select.select2();
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
        var buying_price = 0;
        var discount = 0;
        var discount_type = false;
        var discount_amount = 0;
        var vat = 0;
        var vat_type = false;
        var vat_amount = 0;

        quantity = Number($(e).parent().parent().parent().parent().parent().find('.quantity').val());

        buying_price = Number($(e).parent().parent().parent().parent().parent().find('.buying_price').val());

        discount = Number($(e).parent().parent().parent().parent().parent().find('.discount').val());
        discount_amount = (((quantity * buying_price) * discount) / 100);

        vat = Number($(e).parent().parent().parent().parent().parent().find('.vat').val());
        vat_amount = ((((quantity * buying_price) - discount_amount) * vat) / 100);

        product_total = ((quantity * buying_price) + vat_amount - discount_amount);

        $(e).parent().parent().parent().parent().parent().find('.total_price').val(product_total.toFixed(2));
        $(e).parent().parent().parent().parent().parent().find('.quantity').val(quantity);

        var sum = 0;
        var total_discount = Number($("#total_discount").val());
        var total_discount_type = document.querySelector('#total_discount_type:checked');
        var total_discount_value = 0;

        $(".total_price").each(function() {
            sum += +$(this).val();
        });

        $("#all_total").val(sum.toFixed(2));

        if (total_discount_type) {
            total_discount_value = (sum - ((sum * total_discount) / 100));
        } else {
            total_discount_value = (sum - total_discount);
        }
        $("#total").val(total_discount_value.toFixed(2));

    }

    function totalDiscountValue(e) {
        var discount = Number($(e).val());
        var total_discount_type = document.querySelector('#total_discount_type:checked');
        var total_discount_value = 0;
        var sum = 0;

        $(".total_price").each(function() {
            sum += +$(this).val();
        });

        $("#all_total").val(sum.toFixed(2));

        if (total_discount_type) {
            total_discount_value = (sum - ((sum * discount) / 100));
        } else {
            total_discount_value = (sum - discount);
        }
        $("#total").val(total_discount_value.toFixed(2));
    }
</script>
@endsection