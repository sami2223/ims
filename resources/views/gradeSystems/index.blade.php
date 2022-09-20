
@extends('layouts.app')

@section('pageTitle')
    Grade Systems
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Grade Systems</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="gradeSystems/create" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add new</a>
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
                                    Grade Systems
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
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Grade System</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($gradeSystems as $gradeSystem)

                            <tr class="tr-shadow">
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $gradeSystem->grade_system }}
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="gradeSystems/{{ $gradeSystem->id }}/edit" class="item" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <!-- Delete functionality -->
                                        <form action="gradeSystems/{{ $gradeSystem->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="item delete-confirm" data-name="{{ $gradeSystem->grade_system }}" data-toggle="tooltip" data-placement="top"
                                                data-original-title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                        <!-- Delete functionality End -->
                                    </div>
                                </td>

                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>

    <script>
        // for post method
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure to delete ${name}?`,
                    text: "This record will be permanantly deleted!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

@endsection

