@extends('layouts.prof')

@section('title', __('Impersonate'))

@section('content')
<div class="main-container">

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <h4 class="text-blue h4">Table des utilisateurs</h4>
                    <p class="mb-26"></p>
                </div>
        <table class="data-table table stripe hover nowrap">
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
                            <button class="btn btn-success">Impersonate</button>
                        </td>
                    </tr>
                </form>
            @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>

@endsection
