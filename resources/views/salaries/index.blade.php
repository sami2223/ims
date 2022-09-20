@extends('layouts.admin')
@section('pageTitle')
    Salaries Management
@endsection

@section('content')

    <div class="row">
        {{-- Form --}}
        <div class="col-md-4">
            <form id="regForm" action="{{ route('salaries.store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Salary - New</span>
                    </div>
                    <div class="card-body card-block">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Employee Name<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                @php
                                    $employees = App\Models\Employee::all();
                                @endphp
                                <select name="selectEmployee" id="selectEmployee" class="form-control select2"
                                    data-error="#errorAY" required>
                                    <option value="">Please select</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                    @endforeach
                                </select>
                                <span id="errorAY"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Salary Type</label>
                            </div>
                            <div class="col-12">
                                <select name="salType" id="salType" class="form-control select2">
                                    <option value="">Please select</option>
                                </select>
                            </div>
                        </div>

                        <div id="cws" class="form-group">
                            {{-- for classwise salary --}}
                            <div  class="d-flex">
                                <div class="col-md-6 mb-1">
                                    <div>
                                        <label for="text-input" class=" form-control-label">No. of Classes<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <input type="text" id="classes" name="classes" value=""
                                            placeholder="" class="form-control" data-error="#errorAXc" required>
                                        <span id="errorAXc"></span>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div>
                                        <label for="text-input" class=" form-control-label">Charges/Class<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <input type="text" id="charges" name="charges" value=""
                                            placeholder="" class="form-control" data-error="#errorAXd">
                                        <span id="errorAXd"></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="ms" class="form-group">
                            {{-- for monthly salary --}}
                            <div class="d-flex">
                                <div class="col-md-6 mb-1">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Salary Month<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <select name="month" id="month" class="form-control select2" data-error="#salmonth"
                                            required>
                                            <option value="">Month</option>
                                            <option value="Jan">Jan (01)</option>
                                            <option value="Feb">Feb (02)</option>
                                            <option value="Mar">Mar (03)</option>
                                            <option value="Apr">Apr (04)</option>
                                            <option value="May">May (05)</option>
                                            <option value="Jun">Jun (06)</option>
                                            <option value="Jul">Jul (07)</option>
                                            <option value="Aug">Aug (08)</option>
                                            <option value="Sep">Sep (09)</option>
                                            <option value="Oct">Oct (10)</option>
                                            <option value="Nov">Nov (11)</option>
                                            <option value="Dec">Dec (12)</option>
                                        </select>
                                        <span id="salmonth"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Year<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <select name="year" id="year" class="form-control select2" data-error="#yr"
                                            required>
                                            <option value="">Year</option>
                                            @for ($i = 2021; $i <= 2099; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span id="yr"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Salary Amount<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="amount" name="amount" value=""
                                    class="form-control" data-error="#errorAX">
                                <span id="errorAX"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Security</label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="security" name="security" value="{{ old('security') }}"
                                    placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Net Salary</label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="netSalary" name="netSalary" value=""
                                    class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Advance</label>
                            </div>
                            <div class="col-12">
                                <select name="advance" id="advance" class="form-control select2">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class="form-control-label">Payment Date</label>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectDay" id="selectDay" class="form-control select2"
                                            data-error="#d" required>
                                            <option value="">Day</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10)
                                                    <?php
                                                    $i = '0' . $i;
                                                    ?>
                                                @endif
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span id="d"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMonth" id="selectMonth" class="form-control select2"
                                            data-error="#m" required>
                                            <option value="">Month</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10)
                                                    @php
                                                        $i = '0' . $i;
                                                    @endphp
                                                @endif
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span id="m"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYear" id="selectYear" class="form-control select2"
                                            data-error="#y" required>
                                            <option value="">Year</option>
                                            @for ($i = 2021; $i <= 2099; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span id="y"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Save
                                {{-- <i class="ml-2 fas fa-arrow-right"></i> --}}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        {{-- Table --}}
        <div class="col-md-8">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Salaries - List</h3>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Employee</th>
                                    {{-- <th>Salary Type</th> --}}
                                    <th>Amount</th>
                                    {{-- <th>Security</th>
                                    <th>Advance</th> --}}
                                    {{-- <th>Month/Classes</th> --}}
                                    {{-- <th>No.of Classes</th> --}}
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                    $salaries = App\Models\Salary::all();
                                @endphp
                                @foreach ($salaries as $salary)

                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            {{ $salary->Employee->employee_name }}
                                        </td>
                                        {{-- <td>{{ $salary->Employee->sal_type }}</td> --}}
                                        <td>{{ $salary->net_salary }}</td>
                                        {{-- <td>{{ $salary->security }}</td>
                                        <td>
                                            @if($salary->advance == 1)
                                                Yes
                                            @elseif($salary->advance == 0)
                                                No
                                            @endif
                                            
                                        </td> --}}
                                        {{-- <td>
                                            @if($salary->Employee->sal_type == 'Monthly')
                                                {{ $salary->sal_month }}
                                            @elseif($salary->Employee->sal_type == 'Classwise')
                                            No. of Classes = {{ $salary->no_of_classes }} 
                                            @endif
                                        </td> --}}
                                        {{-- <td>
                                            @if($salary->Employee->sal_type == 'Classwise')
                                            {{ $salary->no_of_classes }}
                                            @endif
                                        </td> --}}
                                        <td>{{ $salary->sal_date }}</td>
                                        
                                        <td>
                                            <div>
                                                <a href="{{ route('salaries.show', [$salary->id]) }}"
                                                    class="btn btn-info btn-block">
                                                    <i class="zmdi zmdi-edit"></i>Details
                                                </a>
                                                
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#cws').hide();
            $('#ms').hide();

            // form validation
            $("#regForm").validate({
                rules: {
                    amount: {
                        required: true,
                        maxlength: 8,
                        // digits: true,
                    },
                    message: {
                        required: 'This field is required'
                    }

                },

                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            // get employee data
            $("#selectEmployee").change(function() {
                $('#netSalary').val('');
                $('#security').val('');

                // employee id
                var employee_id = $(this).val();
                
                // Empty the dropdown
                $('#salType').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: '/getEmployee/' + employee_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response['data']);
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            for (var i = 0; i < len; i++)
                            {
                                var option = '<option value="' + response['data'][i].sal_type + '" selected>' + response['data'][i].sal_type + '</option>';
                                $("#salType").append(option);
                                if(response['data'][i].sal_type == 'Monthly'){
                                    $("#ms").show();
                                    $('#cws').hide();
                                    $('#amount').val(response['data'][i].sal_amount);
                                    $('#netSalary').val($('#amount').val());
                                }
                                if(response['data'][i].sal_type == 'Classwise'){
                                    $("#cws").show();
                                    $('#ms').hide();
                                    $('#charges').val(response['data'][i].sal_amount);
                                    $('#classes').val(1);
                                    $('#amount').val(response['data'][i].sal_amount);
                                    $('#netSalary').val($('#amount').val());
                                }
                            }
                        }
                    }
                });
            });


            $('#classes').change(function() {
                $('#amount').val(parseFloat("0" + $('#classes').val()) * parseFloat("0" + $('#charges')
                .val()));

                $('#netSalary').val($('#amount').val());
            });

            $('#security').change(function() {
                $('#netSalary').val(parseFloat("0" + $('#amount').val()) - parseFloat("0" + $('#security')
                .val()));
            });
        });
    </script>

@endsection
