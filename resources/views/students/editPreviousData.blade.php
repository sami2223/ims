@extends('layouts.admin')

@section('pageTitle')
    Update Student Previous Data
@endsection

@section('content')

{{-- Content Header --}}
<section>
    <div class=" d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
        <div class="">
            <h4>Studen Previous Data - Edit</h4>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <a class="btn btn-success mx-1" href="/students/{{ $student->id }}">Student Profile</a>
        </div>
    </div>
</section>
{{-- End Content Header --}}    


    {{-- Form --}}
    <div class="mt-4 d-flex justify-content-center">

        <div class="col-lg-8">
            <form id="regForm" action="/students/updatePreviousData/{{ $student->id }}" method="post"
                class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <strong>Update - Previous Educational Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Education<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                {{-- <input type="text" id="education" name="education" value="{{ $preData->education }}" class="form-control" data-erroe="#errorEducation"> --}}
                                <select name="education" id="" class="form-control select2">
                                    @php
                                        $educationList = App\Models\Education::all();
                                    @endphp
                                    @foreach ($educationList as $education)
                                    @if($preData->education == $education->education)
                                        <option value="{{ $education->education }}" selected>{{ $education->education }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $education->education }}">{{ $education->education }}</option>
                                    @endforeach
                                </select>
                                <span id="errorEducation"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Computer Knowledge<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="computer_knowledge" name="computer_knowledge" value="{{ $preData->computer_knowledge }}" class="form-control" data-erroe="#errorCourse">
                                <span id="errorCourse"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <a href="{{ URL('students/' . $student->id) }}" class="btn btn-success btn-sm">
                                <i class="zmdi zmdi-cancel"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="zmdi zmdi-update"></i> Update
                            </button>
                        </div>
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
                    institution: {
                        required: true,
                        maxlength: 90,
                    },
                    course: {
                        required: true,
                        maxlength: 50,
                    },
                    year: {
                        required: true,
                        number: true,
                    },
                    totalMarks: {
                        required: true,
                        number: true,
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
