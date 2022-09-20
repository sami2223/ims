@extends('layouts.admin')

@section('pageTitle')
    Courses Management
@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Edit Course</span>
                        <div class=" float-right">
                            <a class="btn btn-success" href="{{ route('courseNames.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="card-body card-block">
                        <div>
                            <form id="regForm" action="{{ route('courseNames.update', $course_name->id) }}" method="post"
                                class="form-horizontal">
                                @csrf
                                @method('put')
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
                                    <div class="">
                                        <div class="col">
                                            <label for="text-input" class=" form-control-label">Code<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" id="code" name="code" value="{{ old('code', $course_name->code) }}"
                                                class="form-control" data-error="#errorAz" required>
                                            <span id="errorAz"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="">
                                        <div class="col">
                                            <label for="text-input" class=" form-control-label">Title<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" id="title" name="title" value="{{ old('title', $course_name->title) }}"
                                                class="form-control" data-error="#errorAY" required>
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
                                                Update
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

    </div>

    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 90,
                        minlength: 2,
                    },
                    code: {
                        required: true,
                        maxlength: 9,
                        
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
