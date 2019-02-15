<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use Sentinel;
use App\Models\User;
use App\Models\Profile;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Support\Facades\Hash;
use Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
            if ($user->getEmail()==null) {
                return redirect()->route('admin.login')->with('null_mail_face','Tài khoản'.$provider.' của bạn chưa kích hoạt Email!');
            }else{
                if($this->findOrCreateUser($user,$provider)){
                    $credentials    = ['email'=>$user->email];
                    $userModel      = Sentinel::findByCredentials($credentials);
                    if($userModel->hasAnyAccess($this->getRole())){
                        Sentinel::loginAndRemember($userModel);
                        return redirect()->route('admin.index');
                    }else{
                        return redirect(route('admin.login')) ->with('null_mail_face','Tài khoản'.$provider.' của bạn không thể đăng nhập!');
                    }
                }
            }
        } catch (Exception $e) {
            return redirect(route('admin.login'));
        }
    }

    /**
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->email)->first();
        //đã có tài khoản
        if ($authUser) {
            return $authUser;
        }
        return $this->createInfoFacebook($user,$provider);
    }
     /**
     * get info facebook
     * */
     public function createInfoFacebook($user, $provider) {
        // Đang mặc định là nhân viên sau khi login face
        $credentials = [
            'email'         => $user->email,
            'password'      =>Hash::make('123456'),
            'permissions'   =>[
                "employee"  =>true
            ],
        ];
        //Save login data
        $user_lg                = Sentinel::registerAndActivate($credentials);
        $role_users             = Sentinel::findRoleBySlug('employee');
        $role_users->users()->attach($user_lg);
        $path                   = $user->avatar;
        $contents               = file_get_contents($path);
        $name_avatar            = time().$user->id.'.jpg';
        file_put_contents('img/'.$name_avatar, $contents);
        $user_id = User::where('email', $user->email)->first()->id;
        $profile = new Profile();
        $profile->user_id       = $user_id;
        $profile->provider_id   = $user->id;
        $profile->provider_name = $user->name;
        $profile->avatar        = $name_avatar;
        $profile->save();
        return $user;
    }
    /**
     * get index login
     * */

    public function index(){
        return view('admin.layout.login');
    }
    /**
     * Logout
     * */

    public function logoutAction(){
        Sentinel::logout();
        return redirect(route('admin.login'));
    }

    /**
     * Get and Set Role
     * @param
     * 
     * */

    public function getRole(){
    // get all role
        $role = EloquentRole::all();
        foreach ($role as $key => $value) {
            $role_pers[] = $value->slug;
        }
    //set role=>true/false
        foreach ($role_pers as $key => $value) {
            if ($value != 'user') {
                $arr_pers[] = $value;
            }
        }
        return $arr_pers;
    }
    /**
     * Get and Set Role
     * @param   $paramname description
     * */
    public function postLoginAction(LoginRequest $request) {
        try {
            $role =  EloquentRole::all();
            $credentials=['email'=>$request->email];
            if ($request->remember) {
                $remember = (bool) $request->get('remember', true);
            }else{
                $remember = (bool) $request->get('remember', false);
            }

            $user = Sentinel::findByCredentials($credentials);
            // lấy array role true
            $arr_pers = $this->getRole();
            // nếu tồn tại tài khoản
            if($user && $user->permissions != null){
                if($user->hasAnyAccess($arr_pers)){
                    if (Sentinel::forceAuthenticate($request->all(),$remember) ) {
                        return  redirect()->route('admin.index');
                    }else{
                        $err = 'Mật khẩu không chính xác!';
                    }
                }else{
                    $err = 'Tài khoản của bạn không thể đăng nhập!';
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
}
