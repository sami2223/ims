@extends('layouts.admin')
@section('pageTitle')
    Batches Management
@endsection

@section('content')

    {{-- Form --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">New Batch</span>
                </div>
                <div class="card-body card-block">
                    <div>
                        <form id="regForm" action="/batches" method="post" class="form-horizontal">
                            @csrf
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
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Batch Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="batch_name" name="batch_name" placeholder="Enter bacth name..."
                                        class="form-control" data-error="#errorAY">
                                        <span id="errorAY"></span>
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

        <div class="col-md-8">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Batches List</h3>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($batches) == 0)
                            <p>No record found</p>
                        @else
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Batch</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($batches as $batch)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $batch->batch_name }}
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <form action="batches/{{ $batch->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="batches/{{ $batch->id }}/edit" class="btn btn-primary">
                                                            Edit
                                                        </a>
                                                        <!-- Delete functionality -->

                                                        <button type="submit" class="btn btn-danger delete-confirm"
                                                            data-name="{{ $batch->batch_name }}" data-toggle="tooltip"
                                                            data-placement="top" data-original-title="Delete">
                                                            
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // $("#selectShift").prop("disabled", true);
        // $("#selectSession").prop("disabled", true);

        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    batch_name: {
                        required: true,
                    },
                    // selectSession: {
                    //     required: true,
                    // },
                    // selectCourse: {
                    //     required: true,
                    // },
                    // selectShift: {
                    //     required: true,
                    // },
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

            // $('#selectCourse').change(function() {
            //     $("#selectSession").prop("disabled", false);
            //     // Course id
            //     var id = $(this).val();
            //     // Empty the dropdown
            //     $('#selectSession').find('option').not(':first').remove();
            //     // AJAX request 
            //     $.ajax({
            //         url: '/getSessions/' + id,
            //         type: 'get',
            //         dataType: 'json',
            //         success: function(response) {
            //             console.log(response);
            //             var len = 0;
            //             if (response['data'] != null) {
            //                 len = response['data'].length;
            //             }

            //             if (len > 0) {
            //                 // Read data and create <option >
            //                 for (var i = 0; i < len; i++) {

            //                     var id = response['data'][i].id;
            //                     var name = response['data'][i].course;

            //                     var option = '<option value="' + id + '">' + name + '</option>';

            //                     $("#selectSession").append(option);
            //                 }
            //             }

            //         }
            //     });
            // });

            // $('#selectSession').change(function() {
            //     $("#selectShift").prop("disabled", false);
            // })

        });
    </script>

@endsection
