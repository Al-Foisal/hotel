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
                </div>
            </div>
        </div>
    </div><!--end card-->
</div> <!-- end row -->
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
</script>
@endsection