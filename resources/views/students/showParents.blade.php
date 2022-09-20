@extends('layouts.admin')

@section('pageTitle')
    Student Gaurdians
@endsection

@section('content')

{{-- Content Header --}}
<section>
    
    <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Parents Profile</h4>
            </div>
                       
            <div class="d-flex align-items-center justify-content-center">
                <a class="btn btn-success" href="/students/{{ $student->id }}" style="margin-right: 5px;">Student Profile</a></li>                   
                <a class="btn btn-success" href="{{ route('students.createParent', [$student->id]) }}" style="margin-left: 5px;">Add Guardian</a>
            </div>           
    </div>
</section>
{{-- End Content Header --}}


    <div class="mt-4 d-flex justify-content-center flex-column align-items-center">

        <div class="col-md-10 flash-msg">
            <p>{{ $student->first_name }} <span class="mx-4"></span> Course & Batch:  {{  $student->batch->course->course.'...' }}   <span class="mx-4"></span>   {{  'Admission No. '. $student->id}}</p>
        </div>
        @foreach ($parents as $parent)

            <div class="d-flex d-flex flex-column justify-content-center align-items-center col-md-6">
                <div class="profile_info">
                    <h3 style="color: #ab0000">{{ $parent->first_name . ' ' . $parent->last_name }}</h3>

                </div>
                <div class="profile_picture_display">
                    <img class="profile_img" src="{{ URL($parent->image) }}" alt="">
                </div>

            </div>

            <div class="col-md-8">
                <!-- DATA TABLE -->
                <div class="top-campaign">
                    <div class="">
                        <table class="table table-top-campaign" style="padding: 20px;">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $parent->first_name . ' ' . $parent->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Relation</td>
                                    <td>{{ $parent->relation }}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>{{ $parent->dob }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $parent->address->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $parent->address->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Office Phone</td>
                                    <td>{{ $parent->address->officePhone }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>{{ $parent->address->mobile }}</td>
                                </tr>

                                <tr>
                                    <td>Office Address</td>
                                    <td>{{ $parent->address->address_one . ', ' . $parent->address->address_two }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{ $parent->address->city }}</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td>{{ $parent->address->state }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{ $parent->address->country }}</td>
                                </tr>
                                <tr>
                                    <td>Education</td>
                                    <td>{{ $parent->education }}</td>
                                </tr>
                                <tr>
                                    <td>Income</td>
                                    <td>{{ $parent->income }}</td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td>{{ $parent->occupation }}</td>
                                </tr>                            

                            </tbody>
                            
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ route('students.editParent', [$parent->id])  }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-edit"></i>edit this parent
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END DATA TABLE -->

                
            </div>
        @endforeach

    </div>

@endsection
