@extends('layouts.admin')
@section('pageTitle')
    Events Management
@endsection

@section('content')

    <div class="row">
        {{-- Form --}}
        <div class="col-md-4">
            <form id="regForm" action="{{ route('events.store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">New Event</span>
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
                                    <option value="Seminar">Seminar</option>
                                    <option value="Workshop">Workshop</option>
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
                                <input type="text" id="title" name="title" value=""
                                    class="form-control" data-error="#errorAX" required>
                                <span id="errorAX"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class="form-control-label">Description</label>
                            </div>
                            <div class="col-12">
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class="form-control-label">Event Date <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectDay" id="selectDay" class="form-control select2"
                                            data-error="#d" required>
                                            <option value="">Day</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10)
                                                    <?php
                                                    $i = '0' . $i;
                                                    ?>
                                                @endif
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span id="d"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMonth" id="selectMonth" class="form-control select2"
                                            data-error="#m" required>
                                            <option value="">Month</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10)
                                                    @php
                                                        $i = '0' . $i;
                                                    @endphp
                                                @endif
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span id="m"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYear" id="selectYear" class="form-control select2"
                                            data-error="#y" required>
                                            <option value="">Year</option>
                                            @for ($i = 2021; $i <= 2099; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
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
                                Save
                                {{-- <i class="ml-2 fas fa-arrow-right"></i> --}}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        {{-- Table --}}
        <div class="col-md-8">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Events List</h3>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Event Type</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                    $events = App\Models\Event::all();
                                @endphp
                                @foreach ($events as $event)

                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            {{ $event->event_type }}
                                        </td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->description }}</td>
                                        
                                        <td>{{ $event->start_date }}</td>
                                        
                                        <td>
                                            <div>
                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Edit functionality -->
                                                    <a href="{{ route('events.edit', $event->id) }}"
                                                        class="btn btn-primary btn-block">
                                                        <i class="zmdi zmdi-edit"></i>Edit
                                                    </a>
                    
                                                    <!-- Delete functionality -->
                    
                                                    <button type="submit" class="btn btn-danger btn-block delete-confirm">
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
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
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
