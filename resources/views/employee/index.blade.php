@extends('layouts.master')
@section('title','Employee Details')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Employee Details</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Employee</li>
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
                <a href="{{route('rrs.emp.create')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Create new Employee
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{route('rrs.emp.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        {{-- <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}"> --}}
                        <select name="q" class="form-control select2">
                            <option value="" selected>select</option>
                            @foreach($employee_list as $emp_list)
                            <option value="{{$emp_list->full_name}}">{{$emp_list->full_name}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('rrs.emp.index')}}" title="Reset">
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
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image & Name</th>
                            <th>Official Details</th>
                            <th>Personal Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <img src="{{asset($item->profile_pic??'user.jpg')}}" alt="image" style="height:60px "><br>
                                <b>{{$item->full_name}}</b><br>
                            </td>
                            <td>
                                <b>Designation: </b>{{$item->designation}}, <br>
                                <b>Joining Date: </b>{{$item->joining_date}}, <br>
                                <b>Monthly Salary: </b>{{$item->monthly_salary}}, <br>
                            </td>

                            <td>
                                <b>Father Name: </b>{{$item->father_name}}, <br>
                                <b>Mother Name: </b>{{$item->mother_name}}, <br>
                                <b>Mobile No.: </b>{{$item->mobile_number}}, <br>
                                <b>NID Number: </b>{{$item->nid_number}}, <br>
                                <b>Date of Birth: </b>{{$item->birth_date}}, <br>
                                <b>Blood Group: </b>{{$item->blood_group}}, <br>
                                <b>Gender: </b>{{$item->gender}}, <br>
                                <b>Religion: </b>{{$item->religion}}, <br>                         
                                <b>Present Address: </b>{{$item->present_address}}, <br>                         
                                <b>Permanent Address: </b>{{$item->permanent_address}} <br>                         
                            </td>

            
                            <td>
                                <a href="{{route('rrs.emp.edit',$item->id)}}" class="btn btn-primary btn-sm mb-1">Edit</a> <br>
                                
                                <form action="{{route('rrs.emp.delete',$item->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No employee exists.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection

@section('js')
<script>    
    $(".select2").selecte2();     
</script>
@endsection