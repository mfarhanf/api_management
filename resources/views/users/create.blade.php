@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
    <h1 class="m-0 text-dark">Create User</h1>
@stop

@section('content')
    <form action="store" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Username" name="name" value="{{old('name')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Email" name="email" value="{{old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" name="password">
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password Confirmation</label>
                        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password Confirmation" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/users" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
