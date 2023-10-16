<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    private $userVerify;
    private $mail;

    private $sms;

    public function __construct()
    {
        $this->userVerify = new UserVerifyController();
        $this->mail = new EmailController();
        $this->sms = new SMSController();
    }

    public function forgotPassword(){
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('authentication.forgot');
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('authentication.login');
    }

    public function selectOptionsForgot(Request $request)
    {
        $emailCheck = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::Where('email' ,'=', $emailCheck['email'])->first();

        $email = $user->email;
        $phone = "+84".$user->phone;

        $lengthToHide = strlen($email) / 2;
        $hiddenEmail = substr_replace($email, str_repeat('*', $lengthToHide), 3, $lengthToHide);

        $lengthToHide = strlen($phone) / 2;
        $hiddenPhone = substr_replace($phone, str_repeat('*', $lengthToHide), 3, $lengthToHide);

        if($user && $user->password != null){
            $htmlView = '<input type="radio" name="option-forgot" value="1"><label for="option-forgot">Gửi mật khẩu mới đến địa chỉ email '.$hiddenEmail.'</label><br>';
            if($user->phone != null){
                $htmlView .= '<input type="radio" name="option-forgot" value="2"><label for="option-forgot">Gửi mật khẩu mới đến số điện thoại '.$hiddenPhone.'</label><br>';
            }
            $data['status'] = 'true';
            $data['content'] = $htmlView;
        }else{
            $data['status'] = 'false';
            $data['content'] = "Địa chỉ email không tồn tại";
        }
        return response()->json($data);
    }



    public function forgot(Request $request){
        $checkValue = $request->validate([
            'email' => ['required', 'email'],
            'value' => ['required', 'numeric'],
        ]);
        $data['status'] = 'true';
        $data['content'] = '';
        $user = User::Where('email' ,'=', $checkValue['email'])->first();
        $passwordNew = $this->generatorPassword();
        if($checkValue['value'] == 1){
            $user->update([
                'password' => bcrypt($passwordNew),
            ]);
            $this->mail->sendMailForgotPassword($user->name, $user->email, $passwordNew, "mail.forgot-password");
        }else if($checkValue['value'] == 2){
            $user->update([
                'password' => bcrypt($passwordNew),
            ]);
            $phone  = "+84".$user->phone;
            $content = "Mật khẩu mới của bạn là ".$passwordNew;
            $this->sms->sendSMS($phone, $content);
        }else{
            $data['status'] = 'false';
            $data['content'] = 'Lỗi dữ liệu! Vui lòng thử lại sau';
        }
        return response()->json($data);
    }

    private function generatorPassword(){
        return Str::random(15);
    }

    public function login(Request $request)
    {
        $data = [];

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $data['status'] = 'true';
            $data['content'] = 'Đăng nhập thành công';
        } else {
            $data['status'] = 'false';
            $data['content'] = 'Đăng nhập không thành công! Vui lòng kiểm tra lại thông tin!';
        }

        return response()->json($data);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth-login');
    }

    public function Error403()
    {
        return view('error.403');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('authentication.register');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            $user = Socialite::driver('google')->stateless()->user();
        }
        $finduser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();

        if ($finduser) {
            if($finduser->facebook_id == null){
                $finduser->update([
                    'google_id' => $user->id,
                ]);
            }

            Auth::login($finduser);
    return redirect()->route('index');
        } else {
            $message = "Kiểm tra hộp thư! Xác minh email của bạn trước khi đăng nhập!";
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'permission_id' => 1,
            ]);
            $urlVerify = $this->userVerify->createUserVerifyEmail($newUser->id);
            $this->mail->sendMailConfirm($user->name, $user->email, $urlVerify, "mail.confirm-email");
            Auth::login($newUser);

            return redirect()->route('auth-login')->with('message', $message);
        }
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (InvalidStateException $e) {
            $user = Socialite::driver('facebook')->stateless()->user();
        }
        $finduser = User::where('facebook_id', $user->id)->orWhere('email', $user->email)->first();

        if ($finduser) {
            if($finduser->facebook_id == null){
                $finduser->update([
                    'facebook_id' => $user->id,
                ]);
            }
            Auth::login($finduser);
            return redirect()->route('index');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id' => $user->id,
                'permission_id' => 1,
            ]);
            Auth::login($newUser);

            if(!is_null($user->email)){
                $message = "Kiểm tra hộp thư! Xác minh email của bạn trước khi đăng nhập!";
                $urlVerify = $this->userVerify->createUserVerifyEmail($newUser->id);
                $this->mail->sendMailConfirm($user->name, $user->email, $urlVerify, "mail.confirm-email");
                return redirect()->route('auth-login')->with('message', $message);
            }else{
                return redirect()->intended('/');
            }

        }
    }


}
