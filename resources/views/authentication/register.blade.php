@extends('layouts.authentication.default')

@section('title', 'Đăng ký')

@section('content')
<img class="wave" src="{{ url('images/login/wave.svg') }}">
<div class="container">
    <div class="img">
        <img src="{{ url('images/login/login-mobile.svg') }}">
    </div>
    <div class="login-container">
        <form id="form-reg">
            <h2>Đăng ký</h2>
            <p>Đăng nhập bằng:</p>
            <div class="social">
                <div class="social-icons facebook">
                    <a href="{{ route('auth-facebook') }}"><img src="{{ url('images/login/facebook.png') }}">Đăng nhập bằng Facebook</a>
                </div>
                <div class="social-icons google">
                    <a href="{{ route('auth-google') }}"><img src="{{ url('images/login/google.png') }}">Đăng nhập bằng Google</a>
                </div>
            </div>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5>Họ và Tên</h5>
                    <input class="input" id="name" type="text" required>
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h5>E-mail</h5>
                    <input class="input" id="email" type="email" required>
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h5>Số điện thoại</h5>
                    <input class="input" id="phone" type="email" required>
                </div>
            </div>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-key"></i>
                </div>
                <div>
                    <h5>Mật Khẩu</h5>
                    <input class="input" id="password" type="password" required>
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-key"></i>
                </div>
                <div>
                    <h5>Nhập lại mật khẩu</h5>
                    <input class="input" name="repassword"  type="password" required>
                </div>
            </div>
            <div class="terms">
                <input type="checkbox" id="check-terms">
                <label>Tôi đã đọc và đồng ý với </label><a id="action-modal">điều khoản dịch vụ.</a>
            </div>
            <div class="btn-container">
                <button class="btn-action"  type='button' id="btn-reg">Đăng ký</button>
            </div>
            <div class="account">
                <p>Bạn đã có tài khoản ?</p>
                <a href="{{ route('auth-login') }}">Đăng nhập</a>
            </div>
            <!-- The Modal -->
            <div id="modal-terms" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <main>
                        <section>
                            <h2>1. Tài Khoản Người Dùng</h2>
                            <p>
                                Bằng cách sử dụng dịch vụ của chúng tôi, bạn đồng ý tuân theo các điều khoản và điều kiện sau đây. Bạn chịu trách nhiệm duy trì tính bảo mật của tài khoản của mình và thông báo ngay lập tức cho chúng tôi nếu có bất kỳ hoạt động không được ủy quyền nào trên tài khoản của bạn.
                            </p>
                        </section>

                        <section>
                            <h2>2. Sản Phẩm và Dịch Vụ</h2>
                            <p>
                                Chúng tôi cung cấp một nền tảng để bạn có thể mua sắm các sản phẩm và dịch vụ. Chúng tôi cam kết cung cấp thông tin chính xác và chi tiết về các sản phẩm và dịch vụ, và bạn chịu trách nhiệm xem xét kỹ trước khi đặt hàng.
                            </p>
                        </section>
                        <section>
                            <h2>3. Thanh Toán</h2>
                            <p>
                                Khi bạn thực hiện một giao dịch trên trang web của chúng tôi, bạn đồng ý thanh toán số tiền tương ứng với đơn hàng của bạn. Chúng tôi hỗ trợ các phương thức thanh toán an toàn và bảo mật.                            </p>
                        </section>
                        <section>
                            <h2>4. Bảo Mật Thông Tin</h2>
                            <p>
                                Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn và sử dụng nó chỉ cho các mục đích quản lý tài khoản và giao dịch. Xem chi tiết trong Chính Sách Bảo Mật của chúng tôi.                            </p>
                        </section>
                        <section>
                            <h2>5. Chính Sách Hoàn Trả và Đổi Trả</h2>
                            <p>
                                Vui lòng đọc và hiểu rõ Chính Sách Hoàn Trả và Đổi Trả của chúng tôi trước khi thực hiện các yêu cầu liên quan đến hoàn trả hoặc đổi trả sản phẩm.
                            </p>
                        </section>

                        <!-- Thêm các phần khác tùy theo nhu cầu -->
                    </main>
                </div>
            </div>
        </form>
    </div>
</div>
