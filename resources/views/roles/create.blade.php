@extends('layouts.admin')

@section('pageTitle')
    Roles Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="d-flex mb-4 align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>New Role</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                
            </div>
        </div>
    </section>
    {{-- End Content Header --}}

    {{-- Form --}}
    <div class="d-flex justify-content-center">

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
            {{-- <form id="regForm" action="/roles" method="post" class="form-horizontal"> --}}
                {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'regForm' ],) !!}
                @csrf
                <div class="card">
                    
                    <div class="card-body card-block">

                        <div class="row form-group">
                            {{-- <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Role Name<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="role" name="role" placeholder="" class="form-control"
                                    data-error="#error">
                                <span id="error"></span>
                            </div> --}}
                            <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Role Name<span
                                class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div id="checkboxes" class="form-group">
                            <strong>Permissions:</strong>
                            <input type="checkbox" id="checkall" />
                            <label for="checkall">Check all</label>
                            <br />
                            @foreach ($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                    {{ $value->name }}</label>
                                <br />
                            @endforeach
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
                    role: {
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

        // Checkbox select all or none
        $(document).ready(function() {
            $('#checkall').click(function() {
                var checked = $(this).prop('checked');
                $('#checkboxes').find('input:checkbox').prop('checked', checked);
            });
        });
    </script>
    <script>

    </script>


@endsection
