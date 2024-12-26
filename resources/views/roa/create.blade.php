@extends('layouts.master')
@section('title','Room Reservation Setting')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Room Reservation Setting</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Room or Apartment</li>
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
                <a href="{{route('rrs.roa.index')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Back
                </a>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <form action="{{route('rrs.roa.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Type*</label>
                        <select name="type" class="form-control" required>
                            <option value="Room">Room</option>
                            <option value="Apartment">Apartment</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room/Apartment Type*</label>
                        <select name="room_type_id" class="form-control select2" required>
                            <option value="" selected>select option</option>
                            @foreach($room_type as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Floor*</label>
                        <select name="floor_id" class="form-control select2" required>
                            <option value="" selected>select option</option>
                            @foreach($floor as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Number*</label>
                        <input type="text" class="form-control" placeholder="Enter room number" name="room_number" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Capacity</label>
                        <input type="text" class="form-control" placeholder="Enter room capacity" name="capacity">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Diameter(m<sup>2</sup>)</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter room diameter" name="diameter">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Price per day</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter room price" name="price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Wifi Password</label>
                        <input type="text" class="form-control" placeholder="Enter wifi password" name="wifi_password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Image</label>
                        <input type="file" class="form-control" placeholder="Enter room image" name="image">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Note</label>
                        <input type="text" class="form-control" placeholder="Enter note" name="note">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered mb-0 table-centered">
                                <thead>
                                    <tr>
                                        <th>Facilities</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="facility_id[]"
                                                id="" class="select2 form-control"
                                                style="width: 100%;" required>
                                                <option value="">select option</option>
                                                @foreach ($facility as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                            <button type="button" onclick="add_more(this)" class="btn btn-success"> + Add More Facility</button>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                Submit</button>
                        </div>
                    </div>
                </div><!--end row-->
            </form>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection

@section('js')
<script>
    $("#testItemId_1").change("select", function() {
        var testItemId = $(this).val();
        getStock(testItemId, 1);

    });
    var tempo = 1;

    function add_more() {

        tempo++;
        var newRow = "";
        var cols = "";
        cols += '<tr><td><select name="facility_id[]" id="testItemId_' + tempo + '" class="form-control select2" style="width: 100%;" required><option value="">Select test item</option>@foreach ($facility as $item)<option value="{{ $item->id }}">{{ $item->name }}</option>@endforeach</select></td>';
        cols += '<td><button type="button" class="ibtnDel btn btn-danger del">X</button></td></tr>';
        // newRow.append(cols);
        $("table tbody").append(cols);
        $(".select2").selecte2();
        $('#testItemId_' + tempo + '').change("select", function() {
            var testItemId = $(this).val();
            getStock(testItemId, tempo);

        });
    }
    $("table tbody").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        tempo--;
    });
</script>
@endsection