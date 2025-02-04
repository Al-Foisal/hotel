@extends('layouts.master')
@section('title','Room Reservation')
@section('css')
<style>
    .input-group-text-monetary {
        font-size: .8125rem;
        /* background-color: #9ba7ca;
        border: 1px solid #9ba7ca; */
        color: white;
        width: 15%;
        padding: 7px 0 0px 7px;
        font-weight: bolder;
        border-radius: 5px;
    }
</style>
@endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Room Reservation</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Room reservation</li>
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
            <div class="col-12">
                <b>Reservation Details</b>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Check In*</label>
                    <input type="date" class="form-control" id="rCheckIn">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Check Out*</label>
                    <input type="date" class="form-control" id="rCheckOut">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Arival From</label>
                    <input type="text" class="form-control" id="rArivalFrom">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Booking Type</label>
                    <select id="rBookingType" class="select2">
                        <option value="">select option</option>
                        <option value="Group">Group</option>
                        <option value="Business Seminar">Business Seminar</option>
                        <option value="Single Allocation">Single Allocation</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Booking Reference</label>
                    <input type="text" class="form-control" id="rBookingReference" placeholder="Enter booking reference">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Booking Reference Number</label>
                    <input type="text" class="form-control" id="rBookingReferenceNumber" placeholder="Enter booking reference number">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Purpose of Visit</label>
                    <input type="text" class="form-control" id="rPurposeOfVisit" placeholder="Purpose of visit">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Remarks</label>
                    <input type="text" class="form-control" id="rRemarks" placeholder="Remarks">
                </div>
            </div>
        </div><!--end card-body-->
    </div>
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <b>Room/Apartment Details</b>
            </div>
        </div><!--end card-header-->
        <div class="card-body" id="multipleSelectedAreaRoom">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Type</label>
                    <select class="select2 rRoomOrApartmentType" style="width: 100%;" onchange="getROAByType(this)" data-url="{{route('roomReservation.getROAByType')}}">
                        <option value="">select option</option>
                        <option value="Room">Room</option>
                        <option value="Apartment">Apartment</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Room/Apartment Number</label>
                    <select class="select2 rRoomOrApartmentNumber" style="width: 100%;" onchange="getSingleRoomDetails(this)" data-url="{{route('roomReservation.getSingleRoomDetails')}}">
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Adult</label>
                    <input type="number" class="form-control rAdult" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Child</label>
                    <input type="number" class="form-control rChild" placeholder="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Amount</label>
                    <input type="number" class="form-control rPrice" placeholder="0" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="btn btn-info" onclick="addAnotherRoom(this)" style="margin-top: 1.7rem;">+</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <b>Customer Info</b>
            </div>
        </div><!--end card-header-->
        <div class="card-body" id="multipleSelectedCustomerInfo">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Name*</label>
                    <input type="text" class="form-control rcName" placeholder="Enter name">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Email*</label>
                    <input type="text" class="form-control rcEmail" placeholder="Enter email">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Phone*</label>
                    <input type="text" class="form-control rcPhone" placeholder="Enter phone">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Country*</label>
                    <input type="text" class="form-control rcCountry" placeholder="Enter Country">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">State*</label>
                    <input type="text" class="form-control rcState" placeholder="Enter State">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">City*</label>
                    <input type="text" class="form-control rcCity" placeholder="Enter City">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Gender</label>
                    <select class="form-control rcGender">
                        <option value="">select option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Age</label>
                    <input type="text" class="form-control rcAge" placeholder="Age">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control rcAddress" placeholder="Address">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Type of ID</label>
                    <select class="form-control rcTypeID">
                        <option value="">select option</option>
                        <option value="Passport">Passport</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Birth Certificate">Birth Certificate</option>
                        <option value="NID">NID</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">ID Number</label>
                    <input type="text" class="form-control rcIDNumber" placeholder="ID Number">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <b>Others Person Information</b>
            </div>
        </div><!--end card-header-->
        <div class="card-body" id="multipleSelectedOtherPersonInfo">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control rOPName" placeholder="Enter name">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Gender</label>
                    <select class="form-control rOPGender">
                        <option value="">select option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Age</label>
                    <input type="text" class="form-control rOPAge" placeholder="Age">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control rOPAddress" placeholder="Address">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Type of ID</label>
                    <select class="form-control rOPTypeID">
                        <option value="">select option</option>
                        <option value="Passport">Passport</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Birth Certificate">Birth Certificate</option>
                        <option value="NID">NID</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">ID Number</label>
                    <input type="text" class="form-control rOPIDNumber" placeholder="ID Number">
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="btn btn-info" onclick="addOtherPerson(this)" style="margin-top: 1.7rem;">+</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="row m-3">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="" style="background: #9ba7ca;">
                    <h3 class="text-center text-white fw-bolder">Monetary Calculation Area (BDT)</h3>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-primary" id="basic-addon1">
                            Total Amount
                        </span>
                        <input type="number" class="form-control" id="totalBillingAmount" readonly aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-secondary" id="basic-addon1">
                            Vat (%)
                        </span>
                        <input type="number" class="form-control" id="totalBillingVat" aria-describedby="basic-addon1" onkeyup="calculateTotalBillingAmount()">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-secondary" id="basic-addon1">
                            Discount
                        </span>
                        <input type="number" class="form-control" id="totalBillingDiscount" aria-describedby="basic-addon1" onkeyup="calculateTotalBillingAmount()">
                        <select id="totalBillingDiscountType" class="bg-warning" onchange="calculateTotalBillingAmount()">
                            <option value="Flat">Flat</option>
                            <option value="Percentage">Percentage</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-info" id="basic-addon1">
                            Subtotal
                        </span>
                        <input type="number" class="form-control" id="totalBillingSubtotal" readonly aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-success" id="basic-addon1">
                            Paid Amount
                        </span>
                        <input type="number" class="form-control" id="totalBillingPaidAmount" aria-describedby="basic-addon1" onkeyup="calculateTotalBillingAmount()">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-danger" id="basic-addon1">
                            Due
                        </span>
                        <input type="number" class="form-control" id="totalBillingDue" readonly aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-warning" id="basic-addon1">
                            Changes
                        </span>
                        <input type="number" class="form-control" id="totalBillingChanges" readonly aria-describedby="basic-addon1">
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="m-3">
            <button type="button" class="btn btn-primary" style="float: right;" onclick="submitBill(this)" data-url="" id="submitBill" data-bs-toggle="modal" data-bs-target="#billFullScreenModal">Submit</button>
        </div>
    </div>
</div> <!-- end row -->
<!-- create new modal -->
@endsection

@section('js')
<script>
    var aaRoom = 1;

    function addAnotherRoom() {

        aaRoom++;
        var newRow = "";
        var cols = "";

        cols += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Type</label>
                    <select class="select2 rRoomOrApartmentType" style="width: 100%;" onchange="getROAByType(this)" data-url="{{route('roomReservation.getROAByType')}}">
                        <option value="">select option</option>
                        <option value="Room">Room</option>
                        <option value="Apartment">Apartment</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Room/Apartment Number</label>
                    <select class="select2 rRoomOrApartmentNumber" style="width: 100%;" onchange="getSingleRoomDetails(this)" data-url="{{route('roomReservation.getSingleRoomDetails')}}">
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Adult</label>
                    <input type="number" class="form-control rAdult" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Child</label>
                    <input type="number" class="form-control rChild" placeholder="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Amount</label>
                    <input type="number" class="form-control rPrice" placeholder="0" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="ibtnDel btn btn-danger del" style="margin-top: 1.8rem;">X</button>
                </div>
            </div>
        `;
        // newRow.append(cols);
        $("#multipleSelectedAreaRoom").append(cols);
        $(".select2").select2();
    }
    $("#multipleSelectedAreaRoom").on("click", ".ibtnDel", function(event) {
        $(this).closest(".row").remove();
    });

    var aaOtherPerson = 1;

    function addOtherPerson() {

        aaOtherPerson++;
        var newRow = "";
        var cols = "";

        cols += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control rOPName" placeholder="Enter name">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Gender</label>
                    <select class="form-control rOPGender">
                        <option value="">select option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Age</label>
                    <input type="text" class="form-control rOPAge" placeholder="Age">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control rOPAddress" placeholder="Address">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Type of ID</label>
                    <select class="form-control rOPTypeID">
                        <option value="">select option</option>
                        <option value="Passport">Passport</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Birth Certificate">Birth Certificate</option>
                        <option value="NID">NID</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">ID Number</label>
                    <input type="text" class="form-control rOPIDNumber" placeholder="ID Number">
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="ibtnDel btn btn-danger del" style="margin-top: 1.8rem;">X</button>
                </div>
            </div>
        `;
        // newRow.append(cols);
        $("#multipleSelectedOtherPersonInfo").append(cols);
        $(".select2").select2();
    }
    $("#multipleSelectedOtherPersonInfo").on("click", ".ibtnDel", function(event) {
        $(this).closest(".row").remove();
    });

    function getROAByType(e) {

        var url = $(e).data('url');
        var type = $(e).val();

        $.ajax({
            url: url,
            type: "POST",
            data: {
                type: type,
            },
            dataType: "json",
            success: function(data) {
                $(e).parent().parent().find(".rRoomOrApartmentNumber").empty();
                var result = '<option value="">=select option=</option>';

                $.each(data, function(index, value) {
                    result += '<option value="' + value.id + '">' + value.room_number + '(' + value.room_type.name + ')' + '</option>';
                })
                console.log($(e).parent().parent().find(".rRoomOrApartmentNumber"));

                $(e).parent().parent().find(".rRoomOrApartmentNumber").html(result);
            },
        });
    };

    function getSingleRoomDetails(e) {

        var url = $(e).data('url');
        var roomId = $(e).val();

        $.ajax({
            url: url,
            type: "POST",
            data: {
                roomId: roomId,
            },
            dataType: "json",
            success: function(data) {
                $(e).parent().parent().find(".rAdult").val(data.adult ?? 0);
                $(e).parent().parent().find(".rChild").val(data.child ?? 0);
                $(e).parent().parent().find(".rPrice").val(data.price ?? 0);
            },
        });
    };
</script>
@endsection