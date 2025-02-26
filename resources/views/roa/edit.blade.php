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
                        <li class="breadcrumb-item active">Edit</li>
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
            <form action="{{route('rrs.roa.update',$item->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="roa_id" value="{{$item->id}}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Type*</label>
                        <select name="type" class="form-control" required>
                            <option value="Room" {{$item->type === 'Room'?'selected':''}}>Room</option>
                            <option value="Apartment" {{$item->type === 'Apartment'?'selected':''}}>Apartment</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room/Apartment Type*</label>
                        <select name="room_type_id" class="form-control select2" required>
                            <option value="" selected>select option</option>
                            @foreach($room_type as $type)
                            <option value="{{$type->id}}" {{$item->room_type_id == $type->id ?'selected':''}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Floor*</label>
                        <select name="floor_id" class="form-control select2" required>
                            <option value="" selected>select option</option>
                            @foreach($floor as $type)
                            <option value="{{$type->id}}" {{$item->floor_id == $type->id ?'selected':''}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Number*</label>
                        <input type="text" class="form-control" placeholder="Enter room number" name="room_number" value="{{$item->room_number}}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Adult*</label>
                        <input type="text" class="form-control" placeholder="Enter adult" name="adult" required value="{{$item->adult}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Child*</label>
                        <input type="text" class="form-control" placeholder="Enter child" name="child" required value="{{$item->child}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Capacity*</label>
                        <input type="text" class="form-control" placeholder="Enter room capacity" name="capacity" required value="{{$item->capacity}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Bed*</label>
                        <input type="text" class="form-control" placeholder="Enter bed" name="bed" required value="{{$item->bed}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Bath*</label>
                        <input type="text" class="form-control" placeholder="Enter bath" name="bath" required value="{{$item->bath}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Diameter(m<sup>2</sup>)*</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter room diameter" name="diameter" required value="{{$item->diameter}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Price per day*</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Enter room price" name="price" required value="{{$item->price}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Wifi Password</label>
                        <input type="text" class="form-control" placeholder="Enter wifi password" name="wifi_password" value="{{$item->wifi_password}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Room Image (437x417) px</label>
                        <input type="file" class="form-control" placeholder="Enter room image" name="image">
                        @if($item->image)
                        <img src="{{asset($item->image)}}" style="height: 40px;">
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Note</label>
                        <input type="text" class="form-control" placeholder="Enter note" name="note" value="{{$item->note}}">
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
                                    @if($item->facilities !=null)
                                    @foreach($item->facilities as $if)
                                    <tr>
                                        <td>
                                            <select name="facility_id[]"
                                                id="" class="select2 form-control"
                                                style="width: 100%;" required>
                                                <option value="">select option</option>
                                                @foreach ($facility as $f_item)
                                                <option value="{{ $f_item->id }}" {{$if->facility_id == $f_item->id?'selected':''}}>
                                                    {{ $f_item->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="ibtnDel btn btn-danger del">X</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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
    var tempo = '{{$item->facilities->count()>0?$item->facilities->count():1}}';

    function add_more() {

        tempo++;
        var newRow = "";
        var cols = "";
        cols += '<tr><td><select name="facility_id[]" id="testItemId_' + tempo + '" class="form-control select2" style="width: 100%;" required><option value="">Select test item</option>@foreach ($facility as $f_item)<option value="{{ $f_item->id }}">{{ $f_item->name }}</option>@endforeach</select></td>';
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