@extends('layouts.app')

@section('pageTitle')
    Student Gaurdian Details
@endsection

@section('content')    

{{-- Content Header --}}
<section>
    <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
        <div class="float-left">
            <h4>Student - Parent/Gaurdian Details</h4>
        </div>

        <div class="float-right">
            {{-- <a class="btn btn-success mx-1" href="/students/{{ $student->id }}">View Profile</a> --}}
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
                                    <a href="{{ URL('/students') }}">Students</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item active">
                                    <a href="/students/{{ $student->id }}">{{ $student->first_name }}</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item active">
                                    Parent/Guardian details
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->

    <div class="container-fluid d-flex justify-content-center flex-column align-items-center">
        <div class="text-center mb-4 col-md-10">
            <p>The following guardians have been saved for {{ $student->first_name }}</p>
        </div>

        <div class="col-md-10">
            <!-- DATA TABLE -->

            <div class="table table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Parent/Gaurdian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($parents as $parent)

                            <tr class="tr-shadow">
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $parent->first_name . ' ' . $parent->last_name }}
                                </td>


                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->

            <div class="d-flex justify-content-center mt-4">

                <a href="{{ route('students.createParent', [$student->id]) }}"
                    class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add anotehr guardian</a>
                <a href="{{ route('students.emergencyContact', [$student->id]) }}"
                    class="au-btn au-btn-icon au-btn--green au-btn--small" style="margin-left: 10px;">
                    <i class="zmdi zmdi-check"></i>finish</a>

            </div>
        </div>

    </div>

@endsection
