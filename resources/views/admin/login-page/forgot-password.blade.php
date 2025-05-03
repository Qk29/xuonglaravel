@extends('admin.layouts.auth')

@section('title', 'Quên mật khẩu')

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
        .btn-send {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            border: none;
        }
        .btn-send:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="login-container">
        <div class="login-header">
            <h2>Quên mật khẩu</h2>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Nhập địa chỉ Email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-send mt-3">Gửi liên kết đặt lại mật khẩu</button>
        </form>
    </div>
</div>
@endsection
