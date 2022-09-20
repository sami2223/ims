@extends('layouts.admin')

@section('pageTitle')
   Student Fee Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class=" d-flex align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Student Fee Details</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="{{ route('students.index') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}



    <div class="mt-4 d-flex flex-column justify-content-center align-items-center">

        <div class="col-lg-10 row m-b-30">
            <div class="col-lg-10">
                <p><strong>Form No : </strong>{{ $student->id }}</p>
                <p><strong>Student Name : </strong>{{ $student->first_name.' '.$student->last_name }}</p>
                <p><strong>Father Name : </strong>{{ $student->father_name }}</p>
                <p><strong>Student Contact : </strong>{{ $student->mobile }}</p>
                <p><strong>Father Contact : </strong>{{ $student->father_contact }}</p>
                <p><strong>Home Address : </strong>{{ $student->address }}</p>
            </div>
            <div class="col-lg-2">
                <div class="profile_picture_display">
                    <img class="profile_img" src="{{ URL($student->image) }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <!-- DATA TABLE -->
            
            <div class="d-flex justify-content-center">
                <table id="" class="table table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>S.No.</th>
                            {{-- <th>Slip No.</th> --}}
                            <th>Payment Date</th>
                            <th>Fee Type</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Balance</th>
                            <th>Month</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        
                        @php 
                            $i = 0;
                            $totalAmount = 0; 
                            $paidAmount = 0;
                            // $totalBalance = 0;
                        @endphp
                        @foreach ($fees as $fee)

                            <tr class="tr-shadow">
                                <td>{{ ++$i }}</td>
                                {{-- <td>
                                    {{ $fee->id }}
                                </td> --}}
                                <td>
                                    {{ $fee->created_at }}
                                </td>
                                <td>
                                    {{ $fee->fee_type }}
                                </td>
                                <td>
                                    {{ $fee->total_amount }}
                                    @php
                                        $totalAmount += $fee->total_amount
                                    @endphp
                                </td>
                                <td>
                                    {{ $fee->paid_amount }}
                                    @php
                                        $paidAmount += $fee->paid_amount
                                    @endphp
                                </td>
                                <td>
                                    {{ $fee->balance }}
                                </td>
                                <td>
                                    {{ $fee->for_month . '-'.  $fee->for_year }}
                                </td>
                                {{-- <td>
                                    <div class="table-data-feature">
                                        <a href="fees/{{ $fee->id }}/edit" class="item" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <!-- Delete functionality -->
                                        <form action="fees/{{ $fee->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="item delete-confirm"  data-toggle="tooltip" data-placement="top"
                                                data-original-title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                        <!-- Delete functionality End -->
                                    </div>
                                </td> --}}

                            </tr>
                            {{-- <tr class="spacer"></tr> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
            <div class="d-flex align-items-center justify-content-center">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th class="text-right">Total Amount</th><td>{{ $totalAmount }}</td>
                            
                        
                            <th class="text-right">Total Paid</th><td>{{ $paidAmount }}</td>
                    
                            <th class="text-right">Balance</th><td>{{ $totalAmount - $paidAmount  }}</td>
                        </tr>
                    </thead>
                </table>
                
            </div>
        </div>
    </div>

    <script>
        
    </script>

@endsection
