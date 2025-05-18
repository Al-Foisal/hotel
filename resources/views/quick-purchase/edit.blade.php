@extends('newLayouts.master')
@section('title', 'Edit Purchase')
@push('customCss')
    <style>
        .hide {
            display: none;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox input */
        [type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Edit Purchase</h3>
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

                    <li class="breadcrumb-item active">Edit</li>

                </ol>
            </div>
        </div>
    </div>
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
                    <div class="card-header">

                        <x-back-button link="{{ route('p_quick-purchase.index') }}"></x-back-button>


                    </div>
                    <div class="card-body">
                        <form id="" class="form form-vertical"
                            action="{{ route('p_quick-purchase.update', $invoice->uuid) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="invoice_date" class="form-label"><span class="required"> * </span>
                                                Purchase Date</label>
                                            <input type="date" class="form-control" name="invoice_date" id="invoice_date"
                                                value="{{ $invoice->invoice_date->format('Y-m-d') }}" placeholder="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('invoice_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="suplier_id" class="form-label"><span class="required"> * </span>
                                                Company Name:</label>
                                            <select name="suplier_id" class="js-example-basic-single form-select" disabled>
                                                <option value="">select option</option>
                                                @foreach ($suplier as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $invoice->suplier_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="suplier_id" value="{{ $invoice->suplier_id }}">
                                        </div>
                                        <span class="text-danger">
                                            @error('suplier_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="invoice_number" class="form-label"><span class="required"> * </span>
                                                Invoice Number</label>
                                            <input type="text" class="form-control" name="invoice_number"
                                                id="invoice_number" value="{{ $invoice->invoice_number }}" placeholder="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('invoice_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="invoice_image" class="form-label">
                                                Invoice Copy</label>
                                            <input type="file" class="form-control" name="invoice_image"
                                                id="invoice_image">
                                            @if ($invoice->invoice_image)
                                                <a href="{{ asset($invoice->invoice_image) }}" target="_blank">View
                                                    Invoice</a>
                                            @else
                                                No invoice
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('invoice_image')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">
                                                Notes</label>
                                            <textarea class="form-control" id="note" name="note" rows="1">{{ $invoice->note }}</textarea>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('note')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="divider">
                                <div class="divider-text">Invoice Product Information</div>
                            </div>
                            <div class="">
                                @foreach ($invoice->invoiceDetails as $details)
                                    <div>
                                        <input type="hidden" name="details_id[]" value="{{ $details->id }}">
                                        <div class="hdtuto lst row" style="margin-top:10px">
                                            <div class="col-sm-12 col-md-2">
                                                <div class="form-group mb-3">
                                                    <label for="product_id" class="mb-2 d-flex align-items-center">P.Name
                                                    </label>

                                                    <div class="SP">
                                                        <select disabled class="form-control"
                                                            onchange="getProductBuyingprice(this)"
                                                            data-url="{{ route('getPrice') }}">
                                                            <option value="">select option</option>
                                                            @foreach ($product as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == $details->product_id ? 'selected' : '' }}>
                                                                    {{ $item->dosage->name ?? '' }}{{ ': ' . $item->name . ' ' . $item->strength }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="update_product_id[]"
                                                            value="{{ $details->product_id }}">
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('product_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="d-flex justify-content-between">
                                                    <div class="me-1">
                                                        <div class="form-group mb-3">
                                                            <label for="qty_per_box"
                                                                class="mb-2 d-flex align-items-center">
                                                                Qty per box</label>
                                                            <input type="number" min="0"
                                                                class="form-control qty_per_box" id="qty_per_box"
                                                                name="update_qty_per_box[]"
                                                                value="{{ $details->qty_per_box ?? 0 }}"
                                                                onkeyup="calculateTotalPrice(this)">
                                                        </div>
                                                    </div>
                                                    <div class="me-1">
                                                        <div class="form-group mb-3">
                                                            <label for="box_qty" class="mb-2 d-flex align-items-center">
                                                                Box qty</label>
                                                            <input type="number" min="0"
                                                                class="form-control box_qty" id="box_qty"
                                                                name="update_box_qty[]"
                                                                value="{{ $details->box_qty ?? 0 }}"
                                                                onkeyup="calculateTotalPrice(this)">
                                                            <input type="hidden" name="update_quantity[]"
                                                                class="quantity"
                                                                value="{{ $details->qty_per_box * $details->box_qty }}">
                                                        </div>
                                                    </div>
                                                    <div class="me-1">
                                                        <div class="form-group mb-3">
                                                            <label for="free_qty" class="mb-2 d-flex align-items-center">
                                                                Free qty</label>
                                                            <input type="number" min="0"
                                                                class="form-control free_qty" id="free_qty"
                                                                name="update_free_qty[]"
                                                                value="{{ $details->free_qty ?? 0 }}">
                                                        </div>
                                                    </div>
                                                    <div class="me-1">
                                                        <div class="form-group mb-3">
                                                            <label for="buying_price"
                                                                class="mb-2 d-flex align-items-center">BP</label>
                                                            <input type="number" min="0" step="0.0001"
                                                                class="form-control buying_price" id="buying_price"
                                                                name="update_buying_price[]"
                                                                value="{{ $details->buying_price ?? 0 }}"
                                                                placeholder="Buying price"
                                                                onkeyup="calculateTotalPrice(this)">
                                                        </div>
                                                    </div>
                                                    <div class="me-1">
                                                        <div class="form-group mb-3">
                                                            <label for="unit_price"
                                                                class="mb-2 d-flex align-items-center">UP</label>
                                                            <input type="number" min="0" step="0.01"
                                                                class="form-control unit_price" id="unit_price"
                                                                name="update_unit_price[]"
                                                                value="{{ $details->unit_price ?? 0 }}"
                                                                placeholder="Unit price"
                                                                onkeyup="calculateTotalPrice(this)">
                                                        </div>
                                                    </div>
                                                    <div class="me-1">
                                                        <div class="form-group mb-3">
                                                            <label for="vat"
                                                                class="mb-2 d-flex align-items-center">Vat(%)
                                                            </label>
                                                            {{-- <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input vat_type"
                                                                        id="exampleCheck1" name="update_vat_type[]">
                                                                    <label class="form-check-label"
                                                                        for="exampleCheck1">%</label>
                                                                </div> --}}

                                                            <input type="number" min="0" step="0.01"
                                                                class="form-control vat" id="vat"
                                                                name="update_vat[]" value="{{ $details->vat ?? 0 }}"
                                                                placeholder="vat price"
                                                                onkeyup="calculateTotalPrice(this)">
                                                        </div>
                                                    </div>
                                                    <div class="me-1">
                                                        <div class="form-group mb-3">
                                                            <label for="discount"
                                                                class="mb-2 d-flex align-items-center">DST(%)
                                                            </label>
                                                            {{-- <div class="form-check">
                                                                    <input type="checkbox"
                                                                        class="form-check-input discount_type"
                                                                        id="exampleCheck1" name="update_discount_type[]">
                                                                    <label class="form-check-label"
                                                                        for="exampleCheck1">%</label>
                                                                </div> --}}

                                                            <input type="number" min="0" step="0.01"
                                                                class="form-control discount" id="discount"
                                                                name="update_discount[]"
                                                                value="{{ $details->discount ?? 0 }}"
                                                                placeholder="Discount price"
                                                                onkeyup="calculateTotalPrice(this)">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-1">
                                                <div class="form-group mb-3">
                                                    <label for="date" class="mb-2 d-flex align-items-center">Exp.
                                                        Date
                                                    </label>
                                                    <input type="date" class="form-control date" id="date"
                                                        name="update_expired_date[]" value="{{ $details->expired_date }}"
                                                        placeholder="date Number">
                                                </div>
                                            </div>


                                            <div class="col-sm-12 col-md-1">
                                                <div class="form-group mb-3">
                                                    <label for="total_price" class="mb-2 d-flex align-items-center">Total
                                                    </label>
                                                    <input type="number" min="0" step="0.01"
                                                        class="form-control total_price" id="total_price"
                                                        name="update_total_price[]"
                                                        value="{{ $details->total_price ?? 0 }}" readonly
                                                        placeholder="Total price">
                                                </div>
                                                <span class="text-danger">
                                                    @error('total_price')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
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
                                @endforeach
                                <div id="increment"></div>

                                <div class="text-right">
                                    <label for="###"></label>
                                    <button class="btn btn-success-link bg-success text-white del mt-4" type="button"><i
                                            class="fa fa-plus-circle"></i> Add more product</button>

                                </div>
                                <div class="clone hide">
                                    <div class="hdtuto lst row" style="margin-top:10px">
                                        <div class="col-sm-12 col-md-2">
                                            <div class="form-group mb-3">
                                                <label for="product_id" class="mb-2 d-flex align-items-center">P.Name
                                                </label>

                                                <div class="SP">
                                                    <select name="product_id[]" class="form-control"
                                                        onchange="getProductBuyingprice(this)"
                                                        data-url="{{ route('getPrice') }}">
                                                        <option value="">select option</option>
                                                        @foreach ($product as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->dosage->name ?? '' }}{{ ': ' . $item->name . ' ' . $item->strength }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="text-danger">
                                                @error('product_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="d-flex justify-content-between">
                                                <div class="me-1">
                                                    <div class="form-group mb-3">
                                                        <label for="qty_per_box" class="mb-2 d-flex align-items-center">
                                                            Qty per box</label>
                                                        <input type="number" min="0"
                                                            class="form-control qty_per_box" id="qty_per_box"
                                                            name="qty_per_box[]" value="0"
                                                            onkeyup="calculateTotalPrice(this)">
                                                    </div>
                                                </div>
                                                <div class="me-1">
                                                    <div class="form-group mb-3">
                                                        <label for="box_qty" class="mb-2 d-flex align-items-center">
                                                            Box qty</label>
                                                        <input type="number" min="0" class="form-control box_qty"
                                                            id="box_qty" name="box_qty[]" value="0"
                                                            onkeyup="calculateTotalPrice(this)">
                                                        <input type="hidden" name="quantity[]" class="quantity">
                                                    </div>
                                                </div>
                                                <div class="me-1">
                                                    <div class="form-group mb-3">
                                                        <label for="free_qty" class="mb-2 d-flex align-items-center">
                                                            Free qty</label>
                                                        <input type="number" min="0"
                                                            class="form-control free_qty" id="free_qty"
                                                            name="free_qty[]" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="me-1">
                                                    <div class="form-group mb-3">
                                                        <label for="buying_price"
                                                            class="mb-2 d-flex align-items-center">BP</label>
                                                        <input type="number" min="0" step="0.0001"
                                                            class="form-control buying_price" id="buying_price"
                                                            name="buying_price[]" value=""
                                                            placeholder="Buying price"
                                                            onkeyup="calculateTotalPrice(this)">
                                                    </div>
                                                </div>
                                                <div class="me-1">
                                                    <div class="form-group mb-3">
                                                        <label for="unit_price"
                                                            class="mb-2 d-flex align-items-center">UP</label>
                                                        <input type="number" min="0" step="0.01"
                                                            class="form-control unit_price" id="unit_price"
                                                            name="unit_price[]" value="" placeholder="Unit price"
                                                            onkeyup="calculateTotalPrice(this)">
                                                    </div>
                                                </div>
                                                <div class="me-1">
                                                    <div class="form-group mb-3">
                                                        <label for="vat"
                                                            class="mb-2 d-flex align-items-center">Vat(%)
                                                        </label>
                                                        {{-- <div class="form-check">
                                                                <input type="checkbox" class="form-check-input vat_type"
                                                                    id="exampleCheck1" name="vat_type[]">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">%</label>
                                                            </div> --}}

                                                        <input type="number" min="0" step="0.01"
                                                            class="form-control vat" id="vat" name="vat[]"
                                                            value="{{ old('vat') }}" placeholder="vat price"
                                                            onkeyup="calculateTotalPrice(this)">
                                                    </div>
                                                </div>
                                                <div class="me-1">
                                                    <div class="form-group mb-3">
                                                        <label for="discount"
                                                            class="mb-2 d-flex align-items-center">DST(%)
                                                        </label>
                                                        {{-- <div class="form-check">
                                                                <input type="checkbox"
                                                                    class="form-check-input discount_type"
                                                                    id="exampleCheck1" name="discount_type[]">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">%</label>
                                                            </div> --}}

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
                                            <span class="text-danger">
                                                @error('total_price')
                                                    {{ $message }}
                                                @enderror
                                            </span>
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


                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-2">
                                    <label for="" class="col-form-label">Total Amount: </label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="0" id="all_total" readonly
                                        name="total_amount" value="{{ $invoice->grand_total }}">
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
                                        name="grand_total" value="{{ $invoice->grand_total }}">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit"
                                        onclick="return confirm('Are your sure to update! Please re-check QTY PER BOX & BOX QTY carefull.')"
                                        class="btn btn-primary"><i class="fa fa-save"></i>
                                        Save</button>
                                </div>
                            </div>
                        </form>
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
            $(".btn-success-link").click(function(e) {
                e.preventDefault();

                // Clone the first form group
                var newElement = $('.clone .hdtuto:first').clone();

                // Find the select element in the new element and make any necessary modifications
                var select = newElement.find('select');
                select.val('').trigger('change'); // Reset selected value
                newElement.find('#quantity').val();
                newElement.find('#unit_price').val();
                newElement.find('#discount').val();
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
            var qty_per_box = 0;
            var box_qty = 0;
            var quantity = 0;
            var unit_price = 0;
            var buying_price = 0;
            var discount = 0;
            var discount_type = false;
            var discount_amount = 0;
            var vat = 0;
            var vat_type = false;
            var vat_amount = 0;

            qty_per_box = Number($(e).parent().parent().parent().parent().parent().find('.qty_per_box').val());
            box_qty = Number($(e).parent().parent().parent().parent().parent().find('.box_qty').val());

            quantity = Number(qty_per_box * box_qty);

            buying_price = Number($(e).parent().parent().parent().parent().parent().find('.buying_price').val());
            unit_price = Number($(e).parent().parent().parent().parent().parent().find('.unit_price').val());

            discount = Number($(e).parent().parent().parent().parent().parent().find('.discount').val());
            // discount_type = $(e).parent().parent().parent().parent().parent().parent().find('.discount_type').is(
            //     ":checked");

            // if (discount_type) {
            discount_amount = (((quantity * buying_price) * discount) / 100);
            // } else {

            //     discount_amount = ((quantity * buying_price) - discount);
            // }

            vat = Number($(e).parent().parent().parent().parent().parent().find('.vat').val());
            // vat_type = $(e).parent().parent().parent().parent().parent().parent().find('.vat_type').is(
            //     ":checked");

            // if (vat_type) {
            vat_amount = (((quantity * buying_price) * vat) / 100);
            // } else {

            //     vat_amount = ((quantity * buying_price) - vat);
            // }

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
    <script>
        function getProductBuyingprice(e) {
            var product_id = $(e).val();
            var url = $(e).data('url');

            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: {
                    product_id: product_id,
                },
                success: function(data) {
                    if (data.product && data.product.product_details !== null) {
                        var details = data.product.product_details;
                        $(e).parent().parent().parent().parent().find('.qty_per_box').val(details.qty_per_box);
                        $(e).parent().parent().parent().parent().find('.buying_price').val(details
                            .buying_price);
                        $(e).parent().parent().parent().parent().find('.unit_price').val(details.sell_price);
                        $(e).parent().parent().parent().parent().find('.vat').val(details.vat);
                    } else {
                        $(e).parent().parent().parent().parent().find('.qty_per_box').val(0);
                        $(e).parent().parent().parent().parent().find('.buying_price').val(0);
                        $(e).parent().parent().parent().parent().find('.unit_price').val(0);
                        $(e).parent().parent().parent().parent().find('.vat').val(0);
                    }
                },
            });

        }
    </script>
@endpush
