@extends('layouts.admin')
@section('pageTitle')
    Users Management
@endsection
@section('content')
    {{-- Content Header --}}
    <section>
        <div class="d-flex align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>User - Show</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a class="" href="{{ route('users.index') }}">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}

    <div class="mt-4 d-flex justify-content-center flex-column align-items-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Roles:</strong>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
