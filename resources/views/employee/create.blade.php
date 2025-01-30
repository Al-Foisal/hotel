@extends('layouts.master')
@section('title','Employee')
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
                <a href="{{route('rrs.emp.index')}}" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed">
                    Back
                </a>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <form action="{{route('rrs.roa.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Employee Image</label>
                        <input type="file" class="form-control" placeholder="Enter room image" name="image">
                    </div>

                    <div class="col-md-12 mb-3">
                       <label class="form-label" >Full Name <small style="color: red">*</small></label>
                       <input type="text"  placeholder="Enter Full Name" required class="form-control" id="full_name" name="full_name">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="exampleInputEmail1">Designation <small style="color: red">*</small></label>
                        <select name="designation_id" class="form-control select2" required>
                            <option value="" selected>Select</option>
                            @foreach($designations as $designation)
                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label" >Joining Date <small style="color: red">*</small></label>
                        <input type="date" required class="form-control" id="joining_date" name="joining_date" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" >Monthly Salary <small style="color: red">*</small></label>
                        <input type="number" required class="form-control" id="monthly_salary" name="monthly_salary" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" >Father's Name</label>
                        <input type="text" placeholder="Enter Father Name"  class="form-control" id="father_name" name="father_name" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" >Mother's Name</label>
                        <input type="text" placeholder="Enter Mother Name"  class="form-control" id="mother_name" name="mother_name" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" >Contact Number</label>
                        <input type="text" placeholder="ex. 01713480xxx" class="form-control" id="mobile_number" name="mobile_number" >
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="form-label" >NID Number </label>
                          <input type="text"  class="form-control" id="nid_number" name="nid_number" >
                        </div>
                    </div>

                </div><!--end row-->

                <div class="form-group">
                    <label class="form-label" >Present Address </label><br>
                    <textarea  name="present_address" class="form-control" id="present_address"></textarea>
                  </div>

                  <div class="form-group">
                    <label class="form-label" >Permanent Address </label><br>
                    <textarea  name="permanent_address" class="form-control" id="permanent_address" ></textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label class="form-label" >Date of Birth</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" >
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label class="form-label" >Blood Group</label>
                        <select class="form-control select2"  name="blood_group" style="width: 100%;">                                  
                            <option value="" selected>Select</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>                                
                            <option value="AB+">AB+</option>                                
                            <option value="O+">O+</option>                            
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>                                
                            <option value="AB-">AB-</option>                                
                            <option value="O-">O-</option>                              
                        </select>
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label class="form-label" >Nationality</label>
                        <input type="text" class="form-control" id="nationality" name="nationality">
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label class="form-label" >Marital Status</label>
                        <select class="form-control select2"  name="marital_status" style="width: 100%;">                                  
                            <option value="" selected>Select</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                      </div>

                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label class="form-label" >Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label class="form-label" >Gender</label>
                        <select class="form-control select2" id="gender" name="gender" style="width: 100%;">                                  
                            <option value="" selected>Select</option>
                            <option value="Male"> Male</option>
                            <option value="Female">Female</option>                             
                        </select>
                      </div>
                    </div>
                  </div>

                  <br>
                              <div class="card"> <!--card starts -->
                                <div class="card-header">
                                  Emergency Contact Person Information
                                </div>
                              <div class="card-body">
                                <div class="row">
                                  <h2>1.</h2>
                                </div>
                                <div class="row">
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                      <label class="form-label" >Name </label>
                                      <input type="text"   class="form-control" id="emergency_contact_name_one" name="emergency_contact_name_one">
                                    </div>
                                  </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label class="form-label" >Number </label>
                                    <input type="text"  class="form-control" id="emergency_contact_number_one" name="emergency_contact_number_one">
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label class="form-label" >Relation </label>
                                    <input type="text"  class="form-control" id="emergency_contact_relation_one" name="emergency_contact_relation_one">
                                  </div>
                                </div>
                               </div>
                               <div class="row">
                                <h2>2.</h2>
                              </div>
                               <div class="row">
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label class="form-label" >Name </label>
                                    <input type="text"   class="form-control" id="emergency_contact_name_two" name="emergency_contact_name_two">
                                  </div>
                                </div>
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label class="form-label" >Number </label>
                                  <input type="text"  class="form-control" id="emergency_contact_number_two" name="emergency_contact_number_two">
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label class="form-label" >Relation</label>
                                  <input type="text" class="form-control" id="emergency_contact_relation_two" name="emergency_contact_relation_two">
                                </div>
                              </div>
                             </div>
                             <div class="row">
                              <h2>3.</h2>
                            </div>
                             <div class="row">
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label class="form-label" >Name</label>
                                  <input type="text"  class="form-control" id="emergency_contact_name_three" name="emergency_contact_name_three">
                                </div>
                              </div>
                            <div class="col-md-4 col-sm-12">
                              <div class="form-group">
                                <label class="form-label" >Number</label>
                                <input type="text" class="form-control" id="emergency_contact_number_three" name="emergency_contact_number_three">
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                              <div class="form-group">
                                <label class="form-label" >Relation</label>
                                <input type="text" class="form-control" id="emergency_contact_relation_three" name="emergency_contact_relation_three">
                              </div>
                            </div>
                           </div>

                              </div>
                              </div> <!-- card ends -->


                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                Submit</button>
                        </div>
                    </div>
               
            </form>
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