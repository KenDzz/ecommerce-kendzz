@extends('layouts.authentication.default')

@section('title', 'Đăng nhập')

@section('content')
<input type="hidden" id="message" value="{{ session('message') }}">
<img class="wave" src="{{ url('images/login/wave.svg') }}">
<div class="container">
    <div class="img">
        <img src="{{ url('images/login/authentication.svg') }}">
    </div>
    <div class="login-container">
        <form id="form-login">
            <h2>Đăng nhập</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5>Tài Khoản</h5>
                    <input class="input" type="text" id="email">
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-key"></i>
                </div>
                <div>
                    <h5>Mật Khẩu</h5>
                    <input class="input" type="password" id="password">
                </div>
            </div>
            <button id="btn-login" class="btn" type="button">Đăng nhập</button>
            <a class="forgot" href="{{ route('auth-forgot-password') }}">Quên mật khẩu ?</a>
            <div class="others">
                <hr>
                <p>Or</p>
                <hr>
            </div>
            <div class="social">
                <div class="social-icons facebook">
                    <a href="{{ route('auth-facebook') }}"><img src="{{ url('images/login/facebook.png') }}">Đăng nhập bằng Facebook</a>
                </div>
                <div class="social-icons google">
                    <a href="{{ route('auth-google') }}"><img src="{{ url('images/login/google.png') }}">Đăng nhập bằng Google</a>
                </div>
            </div>
            <div class="account">
                <p>Bạn vẫn chưa có tài khoản ?</p>
                <a href="{{ route('auth-register') }}">Đăng ký</a>
            </div>
        </form>
    </div>
</div>
