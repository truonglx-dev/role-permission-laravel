@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('permission.add') }}">Add</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">display_name</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($listPermission as $permission)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->display_name }}</td>
                        <td>
                            <a class="btn btn-primary" href={{ route('permission.edit', ['id' => $permission->id]) }}>Edit</a>
                            <a class="btn btn-danger" href="{{ route('permission.delete', ['id' => $permission->id]) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection




























