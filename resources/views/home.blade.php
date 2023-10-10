@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @auth
                        <h4>Hello, {{ Auth::user()->name }}</h4>
                        <p>Welcome to task manager!</p>
                    @endauth

                    @guest
                        <h4>Login</h4>
                        <p><a href="{{ route('login') }}">Signin on youe account.</a></p>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
