@extends('layouts.master')
@section('title','Employee')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Payroll Details</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Payroll</li>
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
        <div class="card-body p-4 mt-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h5 class="d-flex align-items-center">
                        <i class="fa-solid fa-receipt mr-2"></i> Pay Slip
                        <small class="ml-auto"><b>Salary Date:</b> 
                            <span style="color: green">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span>
                        </small>
                    </h5>
                </div>
            </div>
            <hr>
            <!-- info row -->
            <form id="payrollForm">
                <div class="row invoice-info">
                    <div class="col-md-6 col-sm-12 invoice-col">
                        <label>Employee Name</label>
                        <select class="form-control select2" id="employee" name="employee">
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->full_name}}</option> 
                            @endforeach                                               
                        </select>
                        <br>
                        <br>
                        <b>Joining Date:</b> <span id="member_joining_date"></span><br>
                        <b>Designation:</b> <span id="member_designation"></span><br>
                    </div>
                    <div class="col-md-6 col-sm-12 invoice-col">
                        
                    </div>  
                </div>
                <hr>
                <!-- Payment Calculation -->
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                      <h4>Payment Calculation</h4>
                      <input type="hidden" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="salary_date">
                      <div class="table-responsive">
                          <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                      <td style="width: 150px;">Joining Date</td>
                                      <td><input type="date" readonly id="joining_date" style="background-color: #b7f3fd; width: 100%;" name="joining_date" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Total Working days</td>
                                      <td><input type="number" readonly style="-webkit-appearance: none; -moz-appearance: textfield; background-color: #b7f3fd; pointer-events: none;" id="total_working_day" name="total_working_day" value="26" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Total Leave</td>
                                      <td><input type="number" id="total_leave" name="total_leave" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Total Number of Payable Days</td>
                                      <td><input type="number" readonly style="-webkit-appearance: none; -moz-appearance: textfield; background-color: #b7f3fd; pointer-events: none;" id="total_number_of_pay_day" name="total_number_of_pay_day" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Per Day Salary</td>
                                      <td><input type="number" step="0.01" id="per_day_salary" name="per_day_salary" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Monthly Payable Salary</td>
                                      <td><input type="number" readonly style="-webkit-appearance: none; -moz-appearance: textfield; background-color: #b7f3fd; pointer-events: none;" step="0.01" id="monthly_salary" name="monthly_salary" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Total Daily Allowance</td>
                                      <td><input type="number" step="0.01" id="total_daily_allowance" name="total_daily_allowance" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Total Travel Allowance</td>
                                      <td><input type="number" step="0.01" id="total_travel_allowance" name="total_travel_allowance" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Rental Cost Allowance</td>
                                      <td><input type="number" step="0.01" id="rental_cost_allowance" name="rental_cost_allowance" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Hospital Bill Allowance</td>
                                      <td><input type="number" step="0.01" id="hospital_bill_allowance" name="hospital_bill_allowance" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Insurance Allowance</td>
                                      <td><input type="number" step="0.01" id="insurance_allowance" name="insurance_allowance" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Sales Commission</td>
                                      <td><input type="number" step="0.01" id="sales_commission" name="sales_commission" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Retail Commission</td>
                                      <td><input type="number" step="0.01" id="retail_commission" name="retail_commission" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td><span style="color: blue;">Total Others</span></td>
                                      <td><input type="number" readonly style="-webkit-appearance: none; -moz-appearance: textfield; background-color: #b7f3fd; pointer-events: none;" id="total_others" name="total_others" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td><span style="color: green;">Total Salary</span></td>
                                      <td><input type="number" readonly style="-webkit-appearance: none; -moz-appearance: textfield; background-color: #b7f3fd; pointer-events: none;" id="total_salary" name="total_salary" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Yearly Bonus</td>
                                      <td><input type="number" step="0.01" id="yearly_bonus" name="yearly_bonus" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Total Payable Salary</td>
                                      <td><input type="number" readonly style="-webkit-appearance: none; -moz-appearance: textfield; background-color: #b7f3fd; pointer-events: none;" id="total_payable_salary" name="total_payable_salary" class="form-control"></td>
                                  </tr>
                                  {{-- <tr>
                                      <td>Advance Less</td>
                                      <td><input type="number" step="0.01" id="advance_less" name="advance_less" class="form-control"></td>
                                  </tr> --}}
                                  <tr>
                                      <td>Any Deduction</td>
                                      <td><input type="number" step="0.01" id="any_deduction" name="any_deduction" class="form-control"></td>
                                  </tr>
                                  <tr>
                                      <td>Final Pay Amount</td>
                                      <td><input type="number" style="-webkit-appearance: none; -moz-appearance: textfield; background-color: #b7f3fd; pointer-events: none;" id="final_pay_amount" name="final_pay_amount" class="form-control"></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <br>
                <!-- /.row -->
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success float-right">
                            <i class="far fa-credit-card"></i> Submit Payment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
@endsection

@section('js')

<script>
    $(".select2").selecte2();
    $('#employee').on('change',function(event){
    
      event.preventDefault();
      var selectedMember = $('#employee').val();
      $('#total_leave').val('0');
      $('#total_number_of_pay_day').val('');
      $('#monthly_salary').val('');
      $('#yearly_bonus').val('');
    
       // Function to get CSRF token from meta tag
       function getCsrfToken() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
    
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();
    
    // axios.get('sanctum/csrf-cookie').then(response=>{
     axios.post('/member_details_dependancy',{
            data: selectedMember
          }).then(response=>{
            console.log('my response');
            console.log(response.data.employee_monthly_salary);
            console.log(response.data.per_day_salary);
            console.log(response.data.total_leave_day);
            console.log(response.data.member_designation);
    
          $('#joining_date').val(response.data.joining_date);
          $('#per_day_salary').val(response.data.per_day_salary);
          $('#total_leave').val(response.data.total_leave_day);
          $('#monthly_salary').val(response.data.employee_monthly_salary);
    
        //number of pay day set based on total approved leave (start)
        // $('#total_working_day').val('26');
        var total_working_day = $('#total_working_day').val(); // Retrieve the value
        var total_leave = parseFloat($('#total_leave').val());
        var total_number_of_pay_day = total_working_day-total_leave;
        $('#total_number_of_pay_day').val(total_number_of_pay_day);
        //number of pay day set based on total approved leave (end)
    
          var member_joining_date_from_response = response.data.joining_date;
          var dateParts = member_joining_date_from_response.split("-");
          var jsDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
    
          // Format the date using toLocaleDateString with the Bangladeshi locale
          var options = { year: 'numeric', month: 'long', day: 'numeric' };
          var formattedDate = jsDate.toLocaleDateString('en-BD', options);
    
          // Display the formatted date in the HTML element
          $('#member_joining_date').html(formattedDate);
          $('#member_designation').html(response.data.member_designation);
    
        if((response.data.per_day_salary) != ''){
          $('#total_number_of_pay_day').val();
            $('#total_daily_allowance').val(0);
            $('#total_travel_allowance').val(0);
            $('#rental_cost_allowance').val(0);
            $('#hospital_bill_allowance').val(0);
            $('#insurance_allowance').val(0);
            $('#sales_commission').val(0);
            $('#retail_commission').val(0);
            // $('#advance_less').val(0);
            $('#any_deduction').val(0);
    
            var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
            var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
            var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
            var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
            var insurance_allowance = parseFloat($('#insurance_allowance').val());
            var sales_commission = parseFloat($('#sales_commission').val());
            var retail_commission = parseFloat($('#retail_commission').val());
            // var advance_less = parseFloat($('#advance_less').val());
            var any_deduction = parseFloat($('#any_deduction').val());
    
            var total_number_of_pay_day = parseFloat($('#total_number_of_pay_day').val());
            // var per_day_salary = parseFloat(response.data.per_day_salary);
            var per_day_salary = parseFloat($('#per_day_salary').val());
            // var monthly_salary = total_number_of_pay_day*per_day_salary;
            var monthly_salary = parseFloat($('#monthly_salary').val());
    
            $('#monthly_salary').val(monthly_salary);
           
            //total others result
            var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
            $('#total_others').val(total_others);
            
            //total salary result
            var total_salary = (monthly_salary+total_others);
            $('#total_salary').val(total_salary);
    
            //total payable salary result
            var yearly_bonus = parseFloat($('#yearly_bonus').val());
            var total_payable_salary = (total_salary+yearly_bonus);
            $('#total_payable_salary').val(total_payable_salary);
    
            //final pay amount result
            var final_pay_amount = (total_payable_salary-(any_deduction));
            $('#final_pay_amount').val(final_pay_amount);
        }
    
        
        var total_leave = $('#total_leave').val();
           if(total_leave == '0'){
            $('#total_number_of_pay_day').val('26');
            $('#total_daily_allowance').val(0);
            $('#total_travel_allowance').val(0);
            $('#rental_cost_allowance').val(0);
            $('#hospital_bill_allowance').val(0);
            $('#insurance_allowance').val(0);
            $('#sales_commission').val(0);
            $('#retail_commission').val(0);
            // $('#advance_less').val(0);
            $('#any_deduction').val(0);
            $('#yearly_bonus').val(0);
           
            var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
            var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
            var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
            var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
            var insurance_allowance = parseFloat($('#insurance_allowance').val());
            var sales_commission = parseFloat($('#sales_commission').val());
            var retail_commission = parseFloat($('#retail_commission').val());
            // var advance_less = parseFloat($('#advance_less').val());
            var any_deduction = parseFloat($('#any_deduction').val());
    
            var total_number_of_pay_day = parseFloat($('#total_number_of_pay_day').val());
            // var per_day_salary = parseFloat($('#per_day_salary').val(response.data.per_day_salary));
            var per_day_salary = parseFloat($('#per_day_salary').val());
            // var monthly_salary = total_number_of_pay_day*per_day_salary;
            var monthly_salary = parseFloat($('#monthly_salary').val());
            
            $('#monthly_salary').val(monthly_salary);
           
            //total others result
            var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
            $('#total_others').val(total_others);
            
            //total salary result
            var total_salary = (monthly_salary+total_others);
            $('#total_salary').val(total_salary);
    
    
            //total payable salary result
            var yearly_bonus = parseFloat($('#yearly_bonus').val());
            var total_payable_salary = (total_salary+yearly_bonus);
            $('#total_payable_salary').val(total_payable_salary);
    
            //final pay amount result
            var final_pay_amount = (total_payable_salary-(any_deduction));
            $('#final_pay_amount').val(final_pay_amount);     
            
           }    
    
          });
    //  });
    });
    
    
    
    //total leave calculation
    $('#total_leave').on('keyup', function(){
        var total_working_day = parseFloat($('#total_working_day').val());
        var total_leave = parseFloat($('#total_leave').val());
        var per_day_salary = parseFloat($('#per_day_salary').val());
          
        var total_number_of_pay_day = total_working_day-total_leave;
        var monthly_salary = total_number_of_pay_day*per_day_salary;
    
        $('#total_number_of_pay_day').val(total_number_of_pay_day);
        $('#monthly_salary').val(monthly_salary);
      
        $('#total_daily_allowance').val(0);
        $('#total_travel_allowance').val(0);
        $('#rental_cost_allowance').val(0);
        $('#hospital_bill_allowance').val(0);
        $('#insurance_allowance').val(0);
        $('#sales_commission').val(0);
        $('#retail_commission').val(0);
        // $('#advance_less').val(0);
        $('#any_deduction').val(0);
        $('#yearly_bonus').val(0);
        var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
        var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
        var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
        var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
        var insurance_allowance = parseFloat($('#insurance_allowance').val());
        var sales_commission = parseFloat($('#sales_commission').val());
        var retail_commission = parseFloat($('#retail_commission').val());
        var monthly_salary = parseFloat($('#monthly_salary').val());
        // var advance_less = parseFloat($('#advance_less').val());
        var any_deduction = parseFloat($('#any_deduction').val());
    
        //total others result
        var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
        $('#total_others').val(total_others);
        
        //total salary result
        var total_salary = (monthly_salary+total_others);
        $('#total_salary').val(total_salary);
    
        //total payable salary result
        var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
            $('#final_pay_amount').val(final_pay_amount);
    
        });
    
    
     //per day salary
    $('#per_day_salary').on('keyup', function(){
        var total_working_day = parseFloat($('#total_working_day').val());
        var total_leave = parseFloat($('#total_leave').val());
        var per_day_salary = parseFloat($('#per_day_salary').val());
          
        var total_number_of_pay_day = total_working_day-total_leave;
        var monthly_salary = total_number_of_pay_day*per_day_salary;
    
        $('#total_number_of_pay_day').val(total_number_of_pay_day);
        $('#monthly_salary').val(monthly_salary);
        
        $('#total_daily_allowance').val(0);
        $('#total_travel_allowance').val(0);
        $('#rental_cost_allowance').val(0);
        $('#hospital_bill_allowance').val(0);
        $('#insurance_allowance').val(0);
        $('#sales_commission').val(0);
        $('#retail_commission').val(0);
        // $('#advance_less').val(0);
        $('#any_deduction').val(0);
        $('#yearly_bonus').val(0);
        var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
        var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
        var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
        var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
        var insurance_allowance = parseFloat($('#insurance_allowance').val());
        var sales_commission = parseFloat($('#sales_commission').val());
        var retail_commission = parseFloat($('#retail_commission').val());
        var monthly_salary = parseFloat($('#monthly_salary').val());
       
        // var advance_less = parseFloat($('#advance_less').val());
        var any_deduction = parseFloat($('#any_deduction').val());
    
        //total others result
        var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
        $('#total_others').val(total_others);
        
        //total salary result
        var total_salary = (monthly_salary+total_others);
        $('#total_salary').val(total_salary);
    
        //total payable salary result
        var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
            $('#final_pay_amount').val(final_pay_amount);
    
        });
    
    
    //total daily allowannce calculation
    $('#total_daily_allowance').on('keyup',function(){
      $('#total_travel_allowance').val(0);
      $('#rental_cost_allowance').val(0);
      $('#hospital_bill_allowance').val(0);
      $('#insurance_allowance').val(0);
      $('#sales_commission').val(0);
      $('#retail_commission').val(0);
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
        $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    //total travel allowannce calculation
    $('#total_travel_allowance').on('keyup',function(){
      $('#rental_cost_allowance').val(0);
      $('#hospital_bill_allowance').val(0);
      $('#insurance_allowance').val(0);
      $('#sales_commission').val(0);
      $('#retail_commission').val(0);
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
          $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    //rental allowance calculation
    $('#rental_cost_allowance').on('keyup',function(){
      $('#hospital_bill_allowance').val(0);
      $('#insurance_allowance').val(0);
      $('#sales_commission').val(0);
      $('#retail_commission').val(0);
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
        $('#final_pay_amount').val(final_pay_amount);
    });
    
    //hospital bill allowance calculation
    $('#hospital_bill_allowance').on('keyup',function(){
      $('#insurance_allowance').val(0);
      $('#sales_commission').val(0);
      $('#retail_commission').val(0);
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
        $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    //insurance allowance calculation
    $('#insurance_allowance').on('keyup',function(){
      $('#sales_commission').val(0);
      $('#retail_commission').val(0);
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
       //final pay amount result
       var final_pay_amount = (total_payable_salary-(any_deduction));
       $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    //sales commission calculation
    $('#sales_commission').on('keyup',function(){
      $('#retail_commission').val(0);
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
        $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    //retail commission calculation
    $('#retail_commission').on('keyup',function(){
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
        $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    //Extra (yearly) Bonus calculation
    $('#yearly_bonus').on('keyup',function(){
    //   $('#advance_less').val(0);
      $('#any_deduction').val(0);
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
        $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    
    //advance less calculation
    // $('#advance_less').on('keyup',function(){
    //   $('#any_deduction').val(0);
    //   var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
    //   var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
    //   var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
    //   var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
    //   var insurance_allowance = parseFloat($('#insurance_allowance').val());
    //   var sales_commission = parseFloat($('#sales_commission').val());
    //   var retail_commission = parseFloat($('#retail_commission').val());
    //   var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
    //   var any_deduction = parseFloat($('#any_deduction').val());
    
    //   //total others result
    //   var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
    //   $('#total_others').val(total_others);
      
    //   //total salary result
    //   var total_salary = (monthly_salary+total_others);
    //    $('#total_salary').val(total_salary);
    
    //    //total payable salary result
    //    var yearly_bonus = parseFloat($('#yearly_bonus').val());
    //     var total_payable_salary = (total_salary+yearly_bonus);
    //     $('#total_payable_salary').val(total_payable_salary);
    
    //     //final pay amount result
    //     var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    //     $('#final_pay_amount').val(final_pay_amount);
    // });
    
    
    //any deduction calculation
    $('#any_deduction').on('keyup',function(){
      var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
      var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
      var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
      var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
      var insurance_allowance = parseFloat($('#insurance_allowance').val());
      var sales_commission = parseFloat($('#sales_commission').val());
      var retail_commission = parseFloat($('#retail_commission').val());
      var monthly_salary = parseFloat($('#monthly_salary').val());
     
    //   var advance_less = parseFloat($('#advance_less').val());
      var any_deduction = parseFloat($('#any_deduction').val());
    
      //total others result
      var total_others = (total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
      $('#total_others').val(total_others);
      
      //total salary result
      var total_salary = (monthly_salary+total_others);
       $('#total_salary').val(total_salary);
    
       //total payable salary result
       var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);
    
        //final pay amount result
        var final_pay_amount = (total_payable_salary-(any_deduction));
        $('#final_pay_amount').val(final_pay_amount);
    });
    
    
    
    //..............Payroll submit start................
        document.getElementById('payrollForm').addEventListener('submit',function(event){
        event.preventDefault();
        var payrollFormData = new FormData(this);
    
        // Function to get CSRF token from meta tag
        function getCsrfToken() {
          return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          }
    
        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();
    
        axios.post('/payrolls',payrollFormData).then(response=>{
          console.log(response);
          setTimeout(function() {
                // window.location.reload();
                window.location.href = "{{ route('payroll_show_data', ':id') }}".replace(':id', response.data.payroll_id);
              }, 2000);
          Swal.fire({
                      icon: "success",
                      title: ''+ response.data.message,
                    });
                return false;
                
          }).catch(error => Swal.fire({
                      icon: "error",
                      title: error.response.data,
                      }))
    
    
        });
    //................Payroll submit end.................
    
      </script>
@endsection