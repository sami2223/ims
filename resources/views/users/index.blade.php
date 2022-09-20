@extends('layouts.admin')

@section('pageTitle')
    Users Management
@endsection

@section('content')
    {{-- Content Header --}}
    {{-- <section>
        <div class="d-flex align-items-center justify-content-between p-t-30 p-b-30"
            >
            <div class="">
                <h4>Users Management</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                @endcan
            </div>
        </div>
    </section> --}}
    {{-- End Content Header --}}


    <div class="mt-4 d-flex justify-content-center flex-column align-items-center">

        <div class="col-md-10">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_admin == 0)
                                    <label class="badge badge-success">Student</label>
                                @elseif ($user->is_admin == 1)
                                    <label class="badge badge-success">Admin</label>
                                @elseif ($user->is_admin == 2)
                                    <label class="badge badge-success">Teacher</label>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                @can('user-edit')
                                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                @endcan
                                @can('user-delete')
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{-- {!! $data->render() !!} --}}
        </div>
    </div>
@endsection
