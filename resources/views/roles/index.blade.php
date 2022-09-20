@extends('layouts.admin')
@section('content')
{{-- Content Header --}}
<section>
    <div class=" d-flex align-items-center justify-content-between p-t-30 p-b-30">
        <div class="">
            <h4>Roles Management</h4>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan
        </div>
    </div>
</section>
{{-- End Content Header --}}


{{-- <div class="container-fluid d-flex justify-content-center flex-column align-items-center"> --}}
        
    <div class="col-md-12 mt-4">    

    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                    @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {!! $roles->render() !!}
    </div>
{{-- </div> --}}
@endsection
