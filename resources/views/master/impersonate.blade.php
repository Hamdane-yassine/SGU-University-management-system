@extends('layouts.prof')

@section('title', __('Impersonate'))

@section('content')
<div class="container">
    <div class="panel panel-default">
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($other_users as $other_user)
                <form method="POST" action="{{ url('/user/impersonate') }}">
                    @csrf
                    <tr>
                        <td>{{ $other_user->id }}</td>
                        <td>{{ $other_user->name }}</td>
                        <td>{{ $other_user->role }}</td>
                        <td>
                            <input type="hidden" name="id" value="{{ $other_user->id }}" />
                            <button class="btn btn-default">Impersonate</button>
                        </td>
                    </tr>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
