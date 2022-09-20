@extends('layouts.admin')
@section('pageTitle')
    Events Management
@endsection

@section('content')

    <div class="row">
        {{-- Form --}}
        <div class="col-md-4">
            <form id="regForm" action="{{ route('events.update', $event->id) }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Event - Edit</span>
                    </div>
                    <div class="card-body card-block">
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
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Event Type<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                <select name="event_type" id="event_type" class="form-control select2"
                                    data-error="#errorAY" required>
                                    <option value="">Please select</option>
                                    @if($event->event_type == 'Seminar')
                                    <option value="Seminar" selected>Seminar</option>
                                    <option value="Workshop">Workshop</option>     
                                    @elseif($event->event_type == 'Workshop')
                                    <option value="Seminar">Seminar</option>
                                    <option value="Workshop" selected>Workshop</option>
                                    @endif
                                </select>
                                <span id="errorAY"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Title<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="title" name="title" value="{{ $event->title }}"
                                    class="form-control" data-error="#errorAX" required>
                                <span id="errorAX"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class="form-control-label">Description</label>
                            </div>
                            <div class="col-12">
                                <textarea name="description" id="description" cols="30" rows="3" value="{{ $event->description }}" class="form-control"></textarea>
                            </div>
                        </div>

                        @php
                            $day = date('d', strtotime($event->start_date));
                            $month = date('m', strtotime($event->start_date));
                            $year = date('Y', strtotime($event->start_date));
                        @endphp
                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class="form-control-label">Event Date <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectDay" id="selectDay" class="form-control select2"
                                            data-error="#d" required>
                                            <option value="{{ $day }}">{{ $day }}</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span id="d"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMonth" id="selectMonth" class="form-control select2"
                                            data-error="#m" required>
                                            <option value="{{ $month }}">{{ $month }}</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span id="m"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYear" id="selectYear" class="form-control select2"
                                            data-error="#y" required>
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @for ($i = 2021; $i <= 2099; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span id="y"></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Update
                                {{-- <i class="ml-2 fas fa-arrow-right"></i> --}}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#cws').hide();
            $('#ms').hide();

            // form validation
            $("#regForm").validate({
                rules: {
                    title: {
                        required: true,
                    },
                    message: {
                        required: 'This field is required'
                    }

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
