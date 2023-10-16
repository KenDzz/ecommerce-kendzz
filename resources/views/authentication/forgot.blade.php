@extends('layouts.authentication.default')

@section('title', 'Quên mật khẩu')

@section('content')
<img class="wave" src="{{ url('images/login/wave.svg') }}">
<div class="container">
    <div class="img">
        <img src="{{ url('images/login/personalization.svg') }}">
    </div>
    <div class="confirm-container">
        <div class="content">
            <h2>Lấy lại mật khẩu thành công!</h2>
            <i class="far fa-check-circle"></i>
            <div class="btn-container">
                <a href="{{ route('auth-login') }}">Đăng nhập</a>
            </div>
        </div>
    </div>
    <div class="login-container">
        <form id="forgot-password">
            <h2>Quên mật khẩu</h2>
            <p class="title-forget">Nhập email của bạn vào trường bên dưới</p>
            <div class="input-div one form-forgot-password-email">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h5>E-mail</h5>
                    <input class="input" type="email" id="email-forgot-password">
                </div>
            </div>
            <div class="form-forgot-password-select">
                <div>
                    <h5>Chọn một tùy chọn để đặt lại mật khẩu</h5>
                    <div class="select-forget-password">

                    </div>
                </div>
            </div>

            <button id="btn-forget-password" class="btn" type="button">Tiếp tục</button>
            <button id="btn-forget-password-pass" class="btn" type="button">Quên mật khẩu</button>
            <div class="account">
                <p>Đã nhớ mật khẩu?</p>
                <a href="{{ route('auth-login') }}">Đăng nhập</a>
            </div>
        </form>
    </div>
</div>
