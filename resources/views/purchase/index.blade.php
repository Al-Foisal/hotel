@extends('layouts.master')
@section('title','Purchase')
@section('content')
<!-- Page-Title -->
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
<!-- end page title end breadcrumb -->
<div class="row">

    <div class="card">
        <div class="card-header row">
            <div class="col-md-6">
                <a href="{{route('purchase.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Purchase
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('purchase.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('purchase.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->

    </div><!--end card-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>

                    </thead>
                </table>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection