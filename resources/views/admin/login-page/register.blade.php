@extends('admin.layouts.auth')

@section('title')
    Login
@endsection
@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            border: none;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="login-container">
        <div class="login-header">
            <h2>Register</h2>
        </div>
        @if(session('message'))
            <p class="text-danger"> {{session('message')}} </p>
        
        @endif
        @if(session('messageLogout'))
            <p class="text-success"> {{session('messageLogout')}} </p>
        @endif
        <form method="POST" action="{{route('postRegister')}}">
            @csrf
            <div class="form-group mb-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>
            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="form-group mb-2">
                <label for="password">Password</label>
                <input type="password" class="form-control "  id="password" name="password" >
            </div>
            
            <button type="submit" class="btn btn-primary btn-login">Register</button>
            <div class="forgot-password">
                <a href="{{route('login')}}">Login</a>
            </div>
            
        </form>
    </div>
</div>

@endsection

@push('scripts')
    
@endpush