<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Role;
use Sentinel;
use App\Models\User;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\RoleRequest;
use DB;
use Activation;

class UserController extends Controller
{
    private $users;
    public function __construct(){
        return $this->users = User::leftJoin('role_users as r', 'r.user_id', '=', 'users.id')
        ->leftJoin('roles', 'roles.id', '=', 'r.role_id')
        ->select('users.*','roles.name')
        ->get();
    }

    /**
     * Show view profile
     * @param   $request 
     * @return  view
     * */
    public function profile(Request $request) {
        $id= $request->id;
        // $profile = User::findOrFail((int)$id);
        $profile = User::with('profile')->find($id);
        return view('admin.user.profile',compact('profile'));
        
    }

    /**
     * @param   $request description
     * @return   description
     * */
    public function index(Request $request){
        $role = Role::all();
        $user = Sentinel::getUser();
        $id = $user->id;
        if ($user->hasAccess('admin')) {
            $users = User::with('roles')->get();
        }else{
            $users = $this->users->where('id',$id);
        }
        
        return view('admin.user.index',compact('users','role'));
    }

    public function getInsert() {
        $role = Role::all();
        return view('admin.user.insert',compact('role'));
    }
    /**
     * lấy ra mảng permistions
     * return bool
     * */
    public function getPermission($request) {
        $per = config('app.permissions');
        if ($request->permissions!=null) {
            $permissions = $request->permissions;
            if (is_array($permissions)) {
                foreach ($permissions as $key => $value) {
                    if ($value=='on') {
                        $per[$key] = true;
                    }
                }
            }            
            return $per;
        }else{
            return null;
        }
    }

    /**
   * store user
   * 
   * */

    public function saveInsertUser(UserRequest $request){
        DB::beginTransaction();
        try {
            $role = new Role();
            $permissions = $request->permissions;
            $arr_role = $role->getAllRole(Role::all(), $permissions);
            $credentials = [
                'email'      => $request->email,
                'password'   => $request->password,
                'permissions'=> $arr_role,
                'first_name' => ($request->firstname)?$request->firstname:null,
                'last_name'  => ($request->lastname)?$request->lastname:null,
            ];
            DB::commit();
            if ($user = Sentinel::registerAndActivate($credentials)) {
                $role_users = Sentinel::findRoleBySlug($permissions);
                $role_users->users()->attach($user);
                return redirect(route('admin.user.create'))->with('success',__('message.Created successfully!'));
            }else{
                return redirect(route('admin.user.create'))->with('not_success',__('message.Created fail!'));
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect(route('admin.user.create'))->with('err_update',$e->getMessage());
        }
    }



    /**
     * method save change user role
     * */
    public function changeRole(Request $request) {
        $role = new Role();
        $input = $request->all();
        $permissions = $input['permissions'];
        
        $arr_pers = $role->getAllRole(Role::all(),$permissions);
        $id = $input['id'];
        $user = Sentinel::findById($id);
        $user->permissions = $arr_pers;
        $user->save();
        //xóa role cũ
        $role_hist = $input['role_hist'];
        $role_detach = Sentinel::findRoleBySlug($role_hist);
        $role_detach->users()->detach($user);
        //attach role mới
        $role_attach = Sentinel::findRoleBySlug($permissions);
        $role_attach->users()->attach($user);

        return redirect()->back()->with('success','Cập nhật thành công!');
    }

    /**
     * Delete user 
     * @param   int $int
     * @return  json
     **/
    public function deleteUser(Request $request) {
        try{
            $id = $request->id;
            $user=Sentinel::findById($id);
            $user->delete();
            if ($user) {
                $success = __('message.Deleted successfully!');
                return response()->json([
                    'data_obj'=>$user,
                    'success'=>$success
                ]);
            }else{
                $not_success = __('message.Deleted fail!');
                return response()->json([
                    'error'=>$not_success
                ]);
            }
        } catch (\Exception $e) {
            return back()
            ->withInput()
            ->with('err_del_exception', $e->getMessage());
        }
    }
}
