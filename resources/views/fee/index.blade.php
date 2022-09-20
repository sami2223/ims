@extends('layouts.admin')
@section('pageTitle')
    Fee Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class=" d-flex align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Fee - Details</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                {{-- <a href="fees/create" class="">
                    <i class="zmdi zmdi-plus"></i>Add New Fee</a> --}}
            </div>
        </div>
    </section>
    {{-- End Content Header --}}

    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="float-right">
                <form id="regForm2" action="{{ route('fees.feeSearchBySlipNo') }}" method="post" class="form-horizontal">
                    @csrf
                    
                        <div class="input-group">
                            
                                <input type="text" name="slip_no" id="slip_no" placeholder="Slip No..." class="form-control"
                                    data-error="#sh">
                                
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-success">Search</button>

                                </span>
                        </div>
                        <span id="sh"></span>
                    
                    <span id="errorA1" class="ml-4"></span>
                </form>
            </div>
        </div>
    </div>



    {{-- DataTable --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-body -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">
                            <div class="col-sm-12">
                                @if (count($fees) == 0)
                                    <p> No record found</p>
                                @else
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info">

                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    SNo
                                                </th>

                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Slip No
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Student Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Father Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Contact
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Course
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Reg.No
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Fee Amount
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Fee Type
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    Date
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($fees as $fee)
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{ ++$i }}</td>
                                                    <td>{{ $fee->slip_id }}</td>
                                                    <td>{{ $fee->Student->first_name . ' ' . $fee->Student->last_name }}
                                                    </td>
                                                    <td>{{ $fee->Student->father_name }}</td>
                                                    <td>{{ $fee->Student->mobile }}</td>
                                                    <td>{{ $fee->Student->Course->course }}</td>
                                                    <td>{{ $fee->Student->id }}</td>
                                                    <td>{{ $fee->total_amount }}</td>
                                                    <td>{{ $fee->fee_type }}</td>
                                                    <td>{{ $fee->created_at }}</td>
                                                    <td>
                                                        {{-- <!-- Delete functionality -->
                                                <form action="fees/{{ $fee->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE') --}}
                                                        <!-- Edit functionality -->
                                                        {{-- <a href="fees/{{ $fee->id }}/edit" class="btn btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a> --}}

                                                        <!-- Show Details -->
                                                        <a href="{{ route('fees.show', $fee->id) }}" class="btn btn-info">
                                                            {{-- <i class="fas fa-eye"></i> --}}
                                                            Details
                                                        </a>
                                                        {{-- <button type="submit" class="btn btn-danger delete-confirm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form> --}}
                                                        <!-- Delete functionality End -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>


    <script>
        // form validation
        $('#regForm').validate({
            rules: {
                selectCourse: {
                    required: true,
                },
            },
            messages: {
                selectCourse: {
                    required: "Please select a course",
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

        $('#regForm2').validate({
            rules: {
                slip_no: {
                    required: true,
                },
            },
            messages: {
                slip_no: {
                    required: "Please enter a Slip No.",
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

        $('#selectCourse').change(function() {
            //$().removeClass("d-none")
            $('#sessionD').show();
            // Course id
            var id = $(this).val();
            // Empty the dropdown
            $('#selectSession').find('option').not(':first').remove();
            // AJAX request 
            $.ajax({
                url: '/getSessions/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        // Read data and create <option >
                        for (var i = 0; i < len; i++) {

                            var id = response['data'][i].id;
                            var name = response['data'][i].session_name;

                            var option = '<option value="' + id + '">' + name + '</option>';

                            $("#selectSession").append(option);
                        }
                    }

                }
            });
        });
    </script>

@endsection
