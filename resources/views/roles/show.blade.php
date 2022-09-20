@extends('layouts.admin')

@section('pageTitle')
    Roles Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="d-flex mb-4 align-items-center justify-content-between p-t-30 p-b-30"
            >
            <div class="">
                <h4>Role Details</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a class="btn btn-success" href="{{ route('roles.index') }}">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}

    <div class="">

        <div class="col-md-12 top-campaign">
            <table class="table table-top-campaign">

                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{ $role->name }}</td>
                </tr>

                <tr>
                    <td><strong>Permissions</strong></td>
                    <td>
                        @if (!empty($rolePermissions))
                            @foreach ($rolePermissions as $v)
                                {{ $v->name }},
                            @endforeach
                        @endif
                    </td>
                </tr>

            </table>
            
        </div>
    </div>
@endsection
