@extends('layouts.admin')
@section('pageTitle')
    Exam Type Management
@endsection

@section('content')


    {{-- Form --}}
    <div class="row">
        
        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="regForm" action="/examTypes" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">New Exam Type</span>
                    </div>
                    <div class="card-body card-block">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Exam Type<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <input type="text" id="examType" name="type" placeholder="" class="form-control" data-error="#errorAY">
                                        <span id="errorAY"></span>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="zmdi zmdi-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Exam Types List</h3>
                </div>
                <div class="card-body">
                    <!-- DATA TABLE -->
                    @if (count($examTypes) == 0)
                        <p>No record found</p>
                    @else
                        <div class="table-responsive">

                            <table id="example1" class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Exam Types</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $i = 0; ?>
                                    @foreach ($examTypes as $examType)

                                        <tr class="tr-shadow">
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $examType->type }}
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <form action="examTypes/{{ $examType->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="examTypes/{{ $examType->id }}/edit"
                                                            class="btn btn-primary">
                                                            <i class="zmdi zmdi-edit"></i>Edit
                                                        </a>
                                                        <!-- Delete functionality -->

                                                        <button type="submit" class="btn btn-danger delete-confirm"
                                                            data-name="{{ $examType->type }}" data-toggle="tooltip"
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
                        </div>
                    @endif

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>

    
    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    type: {
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
        });

    </script>

@endsection
