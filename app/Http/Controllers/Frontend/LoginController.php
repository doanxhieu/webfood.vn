<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Sentinel;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\PasswordReset;
use Hash;
use Cartalyst\Sentinel\Roles\EloquentRole;

class LoginController extends Controller
{
    public function getLogin() {
        return view('frontend.page.login');
    }
    public function getLogout(){
        Sentinel::logout();
        return redirect(route('dang-nhap'));
    }
    public function registerAction(){
        return view('frontend.page.register');
    }
    public function resetpassword(Request $request){
        if ($request->ajax()) {
            $email = $request->email;
            $checkmail = [
                'login' => $request->email
            ]; 
            if(Sentinel::findByCredentials($checkmail)){
                $err = "Email chưa được đăng ký hệ thống!";
            }else{
                $reset = new PasswordReset;
                Mail::send('mail.mailCart', $checkmail, function($msg) use($data){
                    $msg->from(config('mail.mailresetpassword'), 'ADMIN_COLORSHOP');
                    $msg->to($checkmail['login'])->subject('Cập nhật lại mật khẩu cá nhân');
                });
            }
            $output = array('email'=>$email);
            return json_encode($output);
        }
    }
    public function postLogin(LoginRequest $request) {
        try {
            $role =  EloquentRole::all();
            $credentials=['email'=>$request->email];
            if ($request->remember) {
                $remember = (bool) $request->get('remember', true);
            }else{
                $remember = (bool) $request->get('remember', false);
            }
            $user = Sentinel::findByCredentials($credentials);

            foreach ($user->permissions as $key => $value) {
                $arr_pers[] =$key;
            }

            // lấy array role true
            // nếu tồn tại tài khoản
            
            if($user){
                if (Sentinel::forceAuthenticate($request->all(),$remember) ) {
                    return  redirect()->route('frontend.index');
                }else{
                    $err = 'Mật khẩu không chính xác!';
                }
            }else{
                $err = 'Email chưa được đăng ký tài khoản hệ thống!';
            }
            
        }catch (NotActivatedException $e) {
            $err ="Tài khoản chưa được kích hoạt";
        }catch (ThrottlingException $e) {
            $delay = $e->getDelay(1000);
            $err = "Tài khoản của bạn bị tạm khóa trong vòng {$delay} sec";
        }
        return redirect()->back()
        ->withInput()
        ->with('err', $err);
    }
    /**
     * 
     * */
    public function registerUser(RegisterRequest $request){
        $credentials = [
            'login' => $request->email
        ]; 
        $data=[
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>$request->password,
            'first_name'=>$request->firstname,
            'last_name'=>$request->lastname
        ]; 
        // nếu tồn tại email 
        if(Sentinel::findByCredentials($credentials)){
            return redirect()->back()->with('register','Email đã tồn tại');
        }else{
            $user=Sentinel::registerAndActivate($data);
            $role = Sentinel::findRoleBySlug('user');
            $role ->users()->attach($user);
            return redirect()->back()->with('register','Đăng ký thành công');
        }
    }

}
