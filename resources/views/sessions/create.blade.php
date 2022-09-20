@extends('layouts.admin')

@section('pageTitle')
    Sessions
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class=" d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Sessions - New</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="{{ route('sessions.index') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </section> 
    {{-- End Content Header --}} 
    

    {{-- Form --}}
    <div class="mt-4 d-flex justify-content-center">
        
        <div class="col-lg-6">
            <form id="regForm" action="/sessions" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Session Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Course Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <select name="selectCourse" id="selectCourse" class="form-control select2"
                                        data-error="#errorCourse">
                                        <option value="">Please select</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->course }}</option>
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
                                <label for="text-input" class=" form-control-label">Session Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="session_name" name="session_name" placeholder="" class="form-control" data-error="#errorAY">
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
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    session_name: {
                        required: true,
                    },
                    selectCourse: {
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

            // course change
            // $('#selectCourse').change(function() {
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
            //                     var name = response['data'][i].session_name;

            //                     var option = '<option value="' + id + '">' + name + '</option>';

            //                     $("#selectSession").append(option);
            //                 }
            //             }

            //         }
            //     });
            // });
        });

    </script>

@endsection