@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form class="col-md-8" method="post" action="">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" placeholder="Enter pass" name="password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">re-password</label>
                    <input type="password" class="form-control" placeholder="re-Enter pass" name="confirm_password">
                </div>

                <select class="form-control" style="margin-bottom: 20px;" name="roles[]" multiple="multiple">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach

                </select>


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection

