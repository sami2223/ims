@extends('layouts.admin')
@section('pageTitle')
    Salaries Management
@endsection

@section('content')

    <div class="row">
        {{-- Table --}}
        <div class="col-md-12">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Salary - Details</h3>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Employee</th>
                                    <th>Salary Type</th>
                                    <th>Amount</th>
                                    <th>Security</th>
                                    <th>Advance</th>
                                    <th>Month</th>
                                    <th>No.of Classes</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                    
                                @endphp
                                <tr>
                                    <td>{{ $salary->id }}</td>
                                    <td>
                                        {{ $salary->Employee->employee_name }}
                                    </td>
                                    <td>{{ $salary->Employee->sal_type }}</td>
                                    <td>{{ $salary->net_salary }}</td>
                                    <td>{{ $salary->security }}</td>
                                    <td>
                                        @if ($salary->advance == 1)
                                            Yes
                                        @elseif($salary->advance == 0)
                                            No
                                        @endif

                                    </td>
                                    <td>
                                        @if ($salary->Employee->sal_type == 'Monthly')
                                            {{ $salary->sal_month }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($salary->Employee->sal_type == 'Classwise')
                                            {{ $salary->no_of_classes }}
                                        @endif
                                    </td>
                                    <td>{{ $salary->sal_date }}</td>

                                    <td>
                                        <div>
                                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <!-- Edit functionality -->
                                                <a href="{{ route('salaries.edit', $salary->id) }}"
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
                            </tbody>
                        </table>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
