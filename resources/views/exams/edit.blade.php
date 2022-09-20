@extends('layouts.app')

@section('pageTitle')
Exam Type Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Exams Management - Edit</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="{{ route('exams.index') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}} 
    
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="{{ URL('/') }}">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item active">
                                    <a href="{{ URL('/exams') }}">Exams</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item">
                                    Edit
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->

    {{-- Form --}}
    <div class="container-fluid d-flex justify-content-center">
        
        <div class="col-lg-6">
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
            <form id="regForm" action="/exams/{{ $exam->id }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <strong>Exam Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Exam Type<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <select name="exam_type" id="exam_type" class="form-control select2"
                                        data-error="#errorAY">
                                        @foreach ($examTypes as $examType)
                                        @if($exam->ExamType->id == $examType->id)
                                            <option value="{{ $examType->id }}" selected>{{ $examType->type }}</option>
                                            @continue
                                        @endif
                                            <option value="{{ $examType->id }}">{{ $examType->type }}</option>
                                        @endforeach
                                </select>
                                <span id="errorAY"></span>
                                
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Description</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="description" name="description" value="{{ $exam->description }}" class="form-control">
                                
                            </div>
                        </div>

                        <div class="row form-group">
                            @php
                            if($exam->exam_date!=null){
                                $day = date('d', strtotime($exam->exam_date));
                                $month = date('m', strtotime($exam->exam_date));
                                $year = date('Y', strtotime($exam->exam_date));
                            }
                            @endphp
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Exam Date</span></label>
                            </div>
                            <div class="col-12 col-md-2 mb-1">
                                <select name="selectDay" id="selectDay" class="form-control select2">
                                    @if($exam->exam_date!=null)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                    @else
                                    <option value="">Day</option>
                                    @endif
                                    @for ($i=1; $i<=31; $i++)
                                    @if($i<10)
                                        <?php  
                                            $i = '0' . $i;
                                        ?>
                                    @endif
                                    {{-- @if ($day==$i)
                                        @continue
                                    @endif --}}
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                 </select>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <select name="selectMonth" id="selectMonth" class="form-control select2">
                                    @if($exam->exam_date!=null)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                    @else
                                    <option value="">Month</option>
                                    @endif
                                    @for ($i=1; $i<=12; $i++)
                                    @if($i<10)
                                        <?php  
                                            $i = '0' . $i;
                                        ?>
                                    @endif
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                 </select>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <select name="selectYear" id="selectYear" class="form-control select2">
                                    @if($exam->exam_date!=null)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @else
                                    <option value="">Year</option>
                                    @endif
                                    @for ($i=2021; $i<=2099; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                 </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="zmdi zmdi-save"></i> Update
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
                    exam_type: {
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