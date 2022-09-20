@extends('layouts.admin')
@section('pageTitle')
Fee Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class=" d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Fee Management</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="fees/create" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add new Fee</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}



    <div class="mt-4 d-flex justify-content-center flex-column align-items-center">
        
        <div class="col-md-10">
            <!-- DATA TABLE -->
            
            <div class="d-flex justify-content-center">
                @if (count($fees) == 0)
                    <p>No record found</p>
                @else
                <table class="table table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>S.No.</th>
                            <th>Fees</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $i = 0; ?>
                        @foreach ($fees as $fee)

                            <tr class="tr-shadow">
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $fee->due_amount }}
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="fees/{{ $fee->id }}/edit" class="item" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <!-- Delete functionality -->
                                        <form action="fees/{{ $fee->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="item delete-confirm" data-name="{{ $fee->fee }}" data-toggle="tooltip" data-placement="top"
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
                @endif
                
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
