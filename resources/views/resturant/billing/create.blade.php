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
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<!-- end page title end breadcrumb -->
<div class="row">

    <div class="card">
        <div class="card-header row">
            <div class="col-md-6">
                Resturant billing section
            </div>

        </div><!--end card-header-->
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" placeholder="Search">
                </div>

                <div id="menuItem"></div>
            </div>
            <div class="col-md-6">
                <div>
                    <div class="alert alert-secondary p-2">
                        Listed cart items
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="tableSelect" class="form-label">Select Table</label>
                            <select class="form-control" id="tableSelect">
                                <option value="">select</option>
                                @foreach($tables as $table)
                                <option value="{{ $table->id }}">{{ $table->table_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="roomSelect" class="form-label">Select Room</label>
                            <select class="form-control" id="roomSelect">
                                <option value="">select</option>
                                @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" placeholder="Enter customer name">
                        </div>
                        <div class="col-md-3">
                            <label for="customerPhone" class="form-label">Customer Phone</label>
                            <input type="text" class="form-control" id="customerPhone" placeholder="Enter customer phone">
                        </div>
                    </div>
                    <table class="table table-bordered" id="cartTable">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                    <div>
                        <div class="mt-3">
                            <div class="form-group row">
                                <label for="totalAmount" class="col-sm-4 col-form-label">Total Amount</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="totalAmount" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discountType" class="col-sm-4 col-form-label">Discount Type</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="discountType">
                                        <option value="Flat">Flat</option>
                                        <option value="Percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discountValue" class="col-sm-4 col-form-label">Discount</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="discountValue" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subTotal" class="col-sm-4 col-form-label">Subtotal</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="subTotal" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="paidAmount" class="col-sm-4 col-form-label">Paid Amount</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="paidAmount" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="changeAmount" class="col-sm-4 col-form-label">Change</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="changeAmount" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-end">
                                    <button class="btn btn-success" id="checkoutButton">Checkout</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Invoice Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="invoiceContent">
                        <h4 class="text-center">{{ config('app.name') }}</h4>
                        <p class="text-center">Resturant Billing Invoice</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Customer Name:</strong> <span id="invoiceCustomerName"></span></p>
                                <p><strong>Customer Phone:</strong> <span id="invoiceCustomerPhone"></span></p>
                                <p><strong>Invoice Number:</strong> <span id="invoiceInvoiceNumber"></span></p>
                            </div>
                            <div class="col-md-6 text-end">
                                <p><strong>Table:</strong> <span id="invoiceTable"></span></p>
                                <p><strong>Room:</strong> <span id="invoiceRoom"></span></p>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceItems">
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Total Amount:</strong> <span id="invoiceTotalAmount"></span></p>
                                <p><strong>Discount:</strong> <span id="invoiceDiscount"></span></p>
                            </div>
                            <div class="col-md-6 text-end">
                                <p><strong>Subtotal:</strong> <span id="invoiceSubTotal"></span></p>
                                <p><strong>Paid Amount:</strong> <span id="invoicePaidAmount"></span></p>
                                <p><strong>Done By:</strong> <span id="invoiceDoneBy"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printInvoice()">Print</button>
                </div>
            </div>
        </div>
    </div>

</div><!--end card-->
<!-- create new modal -->
@endsection

@section('js')
<script>
    document.addEventListener("keydown", function(e) {
        // Check if Ctrl + Q is pressed
        if (e.ctrlKey && e.key.toLowerCase() === "q") {
            e.preventDefault(); // Prevent default browser behavior
            document.getElementById("search").focus(); // Focus the input
        }
    });

    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            if (value.length > 2) {
                loadMenuItems();
            } else if (value.length == 0) {
                loadMenuItems();
            }
        });
    });

    loadMenuItems();

    function loadMenuItems() {

        $.ajax({
            url: "{{ route('resturantBilling.getMenuItem') }}",
            type: "post",
            data: {
                search: $('#search').val()
            },
            dataType: "html",
            success: function(data) {
                $('#menuItem').html(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    let cart = [];

    // Function to add item to cart
    function addToCart(e) {
        let itemId = $(e).data('item_id');
        let itemName = $(e).data('item_name');
        let itemUnitPrice = parseFloat($(e).data('item_price'));

        // Check if item already exists in cart
        let existingItem = cart.find(item => item.itemId === itemId);

        if (existingItem) {
            existingItem.itemQuantity += 1;
            existingItem.itemTotalPrice = existingItem.itemQuantity * existingItem.itemUnitPrice;
        } else {
            cart.push({
                itemId: itemId,
                itemName: itemName,
                itemQuantity: 1,
                itemUnitPrice: itemUnitPrice,
                itemTotalPrice: itemUnitPrice
            });
        }

        renderCart();
    }

    // Function to increment quantity
    function incrementQuantity(itemId) {
        let item = cart.find(item => item.itemId === itemId);
        if (item) {
            item.itemQuantity += 1;
            item.itemTotalPrice = item.itemQuantity * item.itemUnitPrice;
        }
        renderCart();
    }

    // Function to decrement quantity
    function decrementQuantity(itemId) {
        let item = cart.find(item => item.itemId === itemId);
        if (item && item.itemQuantity > 1) {
            item.itemQuantity -= 1;
            item.itemTotalPrice = item.itemQuantity * item.itemUnitPrice;
        }
        renderCart();
    }

    // Function to remove item from cart
    function removeFromCart(itemId) {
        cart = cart.filter(item => item.itemId !== itemId);
        renderCart();
    }

    // Function to render cart table
    function renderCart() {
        let cartTableBody = $('#cartTable tbody');
        cartTableBody.empty();

        cart.forEach(item => {
            cartTableBody.append(`
                <tr>
                    <td>${item.itemName}</td>
                    <td>${item.itemUnitPrice.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="decrementQuantity(${item.itemId})">-</button>
                        ${item.itemQuantity}
                        <button class="btn btn-sm btn-primary" onclick="incrementQuantity(${item.itemId})">+</button>
                    </td>
                    <td>${item.itemTotalPrice.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.itemId})">X</button>
                    </td>
                </tr>
            `);
        });

        updateMonetaryValues();
    }

    function updateMonetaryValues() {
        let totalAmount = cart.reduce((sum, item) => sum + item.itemTotalPrice, 0);
        let discountType = $('#discountType').val();
        let discountValue = parseFloat($('#discountValue').val()) || 0;
        let discount = discountType === 'Percentage' ? (totalAmount * discountValue / 100) : discountValue;
        let subTotal = totalAmount - discount;
        let paidAmount = parseFloat($('#paidAmount').val()) || 0;
        let changeAmount = paidAmount - subTotal;

        $('#totalAmount').val(totalAmount.toFixed(2));
        $('#subTotal').val(subTotal.toFixed(2));
        $('#changeAmount').val(changeAmount.toFixed(2));
    }

    $('#discountType, #discountValue, #paidAmount').on('input change', updateMonetaryValues);

    $('#checkoutButton').on('click', function() {
        if (cart.length === 0) {
            alert('Cart is empty. Please add items to the cart before checking out.');
            return;
        }

        let totalAmount = parseFloat($('#totalAmount').val());
        let discountType = $('#discountType').val();
        let discountValue = parseFloat($('#discountValue').val()) || 0;
        let subTotal = parseFloat($('#subTotal').val());
        let paidAmount = parseFloat($('#paidAmount').val()) || 0;
        let changeAmount = parseFloat($('#changeAmount').val());
        let tableSelect = $('#tableSelect').val();
        let roomSelect = $('#roomSelect').val();
        let customerName = $('#customerName').val();
        let customerPhone = $('#customerPhone').val();

        if (paidAmount < subTotal) {
            alert('Paid amount is less than the subtotal. Please enter the correct amount.');
            return;
        }

        $.ajax({
            url: "{{ route('resturantBilling.store') }}",
            type: "POST",
            data: {
                tableSelect: tableSelect,
                roomSelect: roomSelect,
                customerName: customerName,
                customerPhone: customerPhone,

                cart: cart,
                totalAmount: totalAmount,
                discountType: discountType,
                discountValue: discountValue,
                subTotal: subTotal,
                paidAmount: paidAmount,
                changeAmount: changeAmount,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            beforeSend: function() {
                $('#checkoutButton').prop('disabled', true).text('Processing...');
            },
            success: function(response) {
                //alert('Checkout successful!');
                cart = [];
                renderCart();
                $('#paidAmount').val(0);
                $('#discountValue').val(0);
                $('#changeAmount').val('');
                $('#subTotal').val('');
                $('#totalAmount').val('');
                showInvoiceModal(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred during checkout. Please try again.');
            }
        });
    });

    function showInvoiceModal(response) {
        $('#invoiceCustomerName').text(response.customer_name || 'N/A');
        $('#invoiceCustomerPhone').text(response.customer_phone || 'N/A');
        $('#invoiceTable').text(response.table_id || 'N/A');
        $('#invoiceRoom').text(response.room_or_apartment_id || 'N/A');
        $('#invoiceInvoiceNumber').text(response.invoice_number || 'N/A');
        $('#invoiceTotalAmount').text(response.total.toFixed(2));
        $('#invoiceDiscount').text(response.discount_amount + ' (' + response.discount_type + ')');
        $('#invoiceSubTotal').text(response.subtotal.toFixed(2));
        $('#invoicePaidAmount').text(response.paid_amount.toFixed(2));
        $('#invoiceDoneBy').text(response.created_by?.name || 'Operator');

        let invoiceItems = '';
        response.item_details.forEach(item => {
            invoiceItems += `
                    <tr>
                        <td>${item.menu_item_name}</td>
                        <td>${item.menu_item_price.toFixed(2)}</td>
                        <td>${item.menu_item_quantity}</td>
                        <td>${item.menu_item_total.toFixed(2)}</td>
                    </tr>
                `;
        });
        $('#invoiceItems').html(invoiceItems);

        $('#invoiceModal').modal('show');
    }

    function printInvoice() {
        let printContent = document.getElementById('invoiceContent').innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>
@endsection