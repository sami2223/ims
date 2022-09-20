@extends('layouts.admin')

@section('pageTitle')
    Users Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="d-flex align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>User - New</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a class="" href="{{ route('users.index') }}">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}


    {{-- Form --}}
    <div class="mt-4 d-flex justify-content-center">

        <div class="col-lg-6">
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
            {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'regForm']) !!}
            @csrf
            <div class="card">
                <div class="card-header">
                    <strong>New User</strong>
                </div>
                <div class="card-body card-block">

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">User Name<span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 col-md-8">
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Email<span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 col-md-8">
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!} </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Password<span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 col-md-8">
                            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Confirm Password<span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 col-md-8">
                            {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Select Role<span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 col-md-8">
                            {!! Form::select('roles', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-md">
                        <i class="zmdi zmdi-save"></i> Save
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
            {{-- </form> --}}
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    password: {
                        required: true,
                        maxlength: 20,
                    },
                    confirm-password: {
                        required: true,
                        maxlength: 20,
                    },
                    roles: {
                        required: true,
                        maxlength: 50,
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

