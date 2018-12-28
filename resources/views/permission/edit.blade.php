@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form class="col-md-8" method="post" action="">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name"
                           value="{{ $permission->name }}">
                </div>

                <div class="form-group">
                    <label for="Display_name">Display_name</label>
                    <input type="text" class="form-control" placeholder="Display_name" name="display_name"
                           value="{{ $permission->display_name }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection

