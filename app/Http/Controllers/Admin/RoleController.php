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

class RoleController extends Controller
{

    /**
     * return array
     * */
    public function getListRole () {
        $role = Role::all();
        
        return view('admin.user.role',compact('role'));
    }

    public function getPermissons($permissions,$input){
        foreach ($permissions as $key_permissions => $value_permissions) {
            $arrr = $value_permissions;
            if (isset($input[$key_permissions])) {
                $arr = $input[$key_permissions];
                foreach ($input[$key_permissions] as $key => $value) {
                    if ($value=='on') {
                        $permissions[$key_permissions][$key] = true;
                    }else{
                        $permissions[$key_permissions][$key] = false;
                    }
                }
            }
        }
        return $permissions;
    }

    public function saveInsertRole(RoleRequest $request) {
        $id= $request->id;
        $input = $request->all();
        $permissions = config('app.role_permission');
        $per = ($this->getPermissons($permissions, $input));
        $role =  new Role();
        if ($request->id==null) {

            $role->slug = strtolower($request->name);
            $role->name = $request->name;
            $role->permissions = $role->getRolePermissions($per);
            if ($role->save()) {
                return redirect(route('admin.role.view'))->with('success_role',__('message.Created successfully!'));
            }else{
                return redirect(route('admin.role.view'))->with('not_success_role',__('message.Created fail!'));
            }
        }else{

            $role= Role::findOrFail($id);
            $role->name = $request->name;
            $role->permissions = $role->getRolePermissions($per);
            $role->updated_at=now();
            if ($role->save()) {
                return redirect(route('admin.role.view'))->with('success_role',__('message.Updated successfully!'));
            }else{
                return redirect(route('admin.role.view'))->with('not_success_role',__('message.Updated fail!'));
            }
        }

    }
    public function saveUpdatetRole(Request $request) {
        $id= $request->id;
        $input = $request->all();
        $permissions = config('app.role_permission');
        $per = ($this->getPermissons($permissions, $input));

        $role= Role::findOrFail($id);
        $role->permissions = $role->getRolePermissions($per);
        $role->updated_at=now();
        if ($role->save()) {
            return redirect(route('admin.role.view'))->with('success_role',__('message.Updated successfully!'));
        }else{
            return redirect(route('admin.role.view'))->with('not_success_role',__('message.Updated fail!'));
        }

    }
        /**
     * Delete role 
     * @param   int $int
     * @return  json
     **/
    public function deleteRole(Request $request) {
        try{
            $id = $request->id;
            $role=Sentinel::findRoleById($id);
            $role->delete();
            if ($role) {
                $success = __('message.Deleted successfully!');
                return response()->json([
                    'data_obj'=>$role,
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
