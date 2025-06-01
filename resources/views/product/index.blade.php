@extends('layouts.master')
@section('title','Inventory Setting')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Inventory Setting</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item active">Product</li>
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
                <a href="{{route('product.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Product
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('product.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('product.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Self Position</th>
                            <th>Ingredient</th>
                            <th>Formation Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td colspan="7" class="table-active fw-bold">{{ $category->name }}</td>
                        </tr>
                        @forelse($category->products as $product)
                        <tr>
                            <td></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->buying_price }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->self_position }}</td>
                            <td>{{ $product->ingredient }}</td>
                            <td>{{ $product->formation_duration }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No products available under this category.</td>
                        </tr>
                        @endforelse
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No categories available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!--end /tableresponsive-->
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->

@endsection