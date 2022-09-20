@extends('layouts.admin')

@section('pageTitle')
    Batches
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class=" d-flex align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Batches - New</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="{{ route('batches.index') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}


    {{-- Form --}}
    <div class="mt-4 d-flex justify-content-center">

        <div class="col-lg-6">
            <form id="regForm" action="/batches" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Batch Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Course Name<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <select name="selectCourse" id="selectCourse" class="form-control select2"
                                    data-error="#errorCourse">
                                    <option value="">Please select</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text danger" id="errorCourse"></span>
                                {{-- @error('selectCourse')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="selectBatch" class="form-control-label">Session<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <select name="selectSession" id="selectSession" class="form-control select2"
                                    data-error="#errorSession">
                                    <option value="">Please select</option>
                                </select>
                                <span class="text danger" id="errorSession"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="selectShift" class="form-control-label">Shift<span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col-12 col-md-8">
                                <select name="selectShift" id="selectShift" class="form-control select2"
                                    data-error="#errorShift">
                                    <option value="">Please select</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text danger" id="errorShift"></span>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Batch Name<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="batch_name" name="batch_name" placeholder="" class="form-control"
                                    data-error="#errorAY">
                                <span id="errorAY"></span>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="zmdi zmdi-save"></i> Save
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        $("#selectShift").prop("disabled", true);
        $("#selectSession").prop("disabled", true);

        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    batch_name: {
                        required: true,
                    },
                    selectSession: {
                        required: true,
                    },
                    selectCourse: {
                        required: true,
                    },
                    selectShift: {
                        required: true,
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
                $("#selectSession").prop("disabled", false);
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
                                var name = response['data'][i].course;

                                var option = '<option value="' + id + '">' + name + '</option>';

                                $("#selectSession").append(option);
                            }
                        }

                    }
                });
            });

            $('#selectSession').change(function() {
                $("#selectShift").prop("disabled", false);
            })

        });
    </script>

@endsection
