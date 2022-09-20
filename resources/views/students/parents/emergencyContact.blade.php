<?php
    use App\Models\EmergencyContact;
    $hasEmergency = EmergencyContact::where('std_id', $student->id)->first();
    // dd($hasEmergency);
?>
@extends('layouts.app')

@section('pageTitle')
    Student Emergency Contact
@endsection

@section('content')    

{{-- Content Header --}}
<section>
    <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
        <div class="float-left">
            <h4>Student - Emergency Contact</h4>
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
                                    <a href="{{ URL('/students') }}">Student</a>
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
                                    Emergency Contact
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

        <div class="col-md-10">
            <!-- DATA TABLE -->
            <div class="d-flex justify-content-center mb-4">
                <div class="table-data__tool-left">
                    <span>
                        <h3 class="title-5">Select one of the parents/guardians as emergency contact</h3>
                    </span>
                </div>

            </div>

            

            @if (!empty($hasEmergency) && $hasEmergency->id > 0)
                <form action="/students/updateEmergencyContact/{{ $student->id }}" method="POST"
                    enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive table-responsive-data2">
                        <table class="table">
                            <tbody>
                                @foreach ($parents as $parent)

                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            @if ($parent->id == $hasEmergency->parent_id)
                                                <input type="radio" id="radio1" name="emergencyContact"
                                                value="{{ $parent->id }}" class="form-check-input" checked>
                                            @else
                                                <input type="radio" id="radio1" name="emergencyContact"
                                                value="{{ $parent->id }}" class="form-check-input">
                                            @endif
                                            
                                        </td>
                                        <td>
                                            {{ $parent->first_name . ' ' . $parent->last_name.'  ('. $parent->relation.')' }}
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-check"></i>finish
                        </button>
                    </div>
                </form>
            @else
                <form action="/students/storeEmergencyContact/{{ $student->id }}" method="POST"
                    enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <div class="table-responsive table-responsive-data2">
                        <table class="table">
                            <tbody>
                                @foreach ($parents as $parent)

                                    <tr class="tr-shadow">
                                        <td> </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="radio" id="radio1" name="emergencyContact"
                                                value="{{ $parent->id }}" class="form-check-input" checked>
                                        </td>
                                        <td>
                                            {{ $parent->first_name . ' ' . $parent->last_name.'  ('. $parent->relation.')' }}
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-check"></i>finish
                        </button>
                    </div>
                </form>
            @endif
            <!-- END DATA TABLE -->
        </div>

    </div>

@endsection
