@extends('layouts.admin')

@section('pageTitle')
    Fee Management
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Fee Amount</h3>
                    <div class="float-right">

                    </div>
                </div>

                <div class="card-body">
                    <div class="">
                        <div class="col-12">
                            <form id="regForm" action="{{ route('feetypes.storeAddFee') }}" method="post"
                                class="form-horizontal">
                                @csrf

                                <div class="form-group">
                                    <div id="courseD" class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Course<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="selectCourse" id="selectCourse" class="form-control select2"
                                                data-error="#errorA1">
                                                <option value="">Please select</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                            <span id="errorA1"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div id="" class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Session<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="selectSession" id="session" class="form-control select2"
                                                data-error="#errorA3" required>
                                                <option value="">Please select</option>

                                            </select>
                                            <span id="errorA3"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Fee Type<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="selectFeetype" id="selectFeetype" class="form-control select2"
                                                data-error="#errorA2">
                                                <option value="">Please select</option>
                                                @foreach ($feetypes as $feetype)
                                                    <option value="{{ $feetype->id }}">{{ $feetype->fee_type }}</option>
                                                @endforeach
                                            </select>
                                            <span id="errorA2"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Amount<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="number" name="amount" class="form-control" data-error="#errorA33"
                                                required>
                                            <span id="errorA33"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-md-8">

                                        </div>
                                        <div class="col-12 col-md-4 ">
                                            <button type="submit" class="btn btn-primary btn-block float-right">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Fee Amount List</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Course</th>
                                    <th>Session</th>
                                    <th>FeeType</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php
                                    $i = 0;
                                    $addFeeAmount = App\Models\AddFee::all();
                                @endphp
        
                                @foreach ($addFeeAmount as $addfee)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $addfee->Course->CourseName->title}}</td>
                                        <td>{{ $addfee->Course->course}}</td>
                                        <td>{{ $addfee->FeeType->fee_type }}</td>
                                        <td>{{ $addfee->amount }}</td>
                                        <td>
                                            <div>
                                                <form action="{{ route('feetypes.deleteaddfee', $addfee->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Edit functionality -->
                                                    <a href="{{ route('feetypes.editaddfee', $addfee->id) }}"
                                                        class="btn btn-primary btn-block">
                                                        <i class="zmdi zmdi-edit"></i>Edit
                                                    </a>
                    
                                                    <!-- Delete functionality -->
                    
                                                    <button type="submit" class="btn btn-danger btn-block delete-confirm">
                                                        Delete
                                                    </button>
                                                </form>
                                                <!-- Delete functionality End -->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>

        $(document).ready(function() {

            $('#selectCourse').change(function() {
                
                // Course id
                var id = $(this).val();
                // Empty the dropdown
                $('#session').find('option').not(':first').remove();
                // AJAX request 
                $.ajax({
                    url: '/getSessions/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].course;

                                var option = '<option value="' + id + '">' + name + '</option>';

                                $("#session").append(option);
                            }
                        }

                    }
                });
            });

            // form validation
            $("#regForm").validate({
                rules: {
                    selectFeetype: {
                        required: true,
                    },
                    selectCourse: {
                        required: true,
                    },
                    session: {
                        required: true,
                    },
                    amount: {
                        required: true,
                        maxlength: 5,
                    },
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
        });
    </script>
@endsection
