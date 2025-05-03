@extends('admin.layouts.auth')

@section('title', 'Đặt lại mật khẩu')

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
        .btn-reset {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            border: none;
        }
        .btn-reset:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="login-container">
        <div class="login-header">
            <h2>Đặt lại mật khẩu</h2>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Địa chỉ Email</label>
                <input type="email" class="form-control" name="email" id="email" required value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="password">Mật khẩu mới</label>
                <input type="password" class="form-control" name="password" id="password" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary btn-reset mt-3">Đặt lại mật khẩu</button>
        </form>
    </div>
</div>
@endsection
