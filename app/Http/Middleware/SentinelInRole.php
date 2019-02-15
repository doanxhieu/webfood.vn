<?php

namespace App\Http\Middleware;
use Closure;
use Sentinel;
use App\Models\Role;
class SentinelInRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rol = new Role();
        $actions = $request->route()->getAction();
        $name_route = $actions['as'];

        $user = Sentinel::getUser()->roles()->first();
        $permissions_role = Sentinel::getUser()->roles()->first()->permissions;
        $permissions_user = $user->permissions;
        // lay permisssion theo tai khoan dang nhap 
        foreach ($permissions_user as $key => $value) {
            if ($value==true) {
                $permissions_user_true = $key;
            }
        }
        // lay danh sach quyen duoc phep thuc hien
        foreach ($permissions_role as $key => $value) {
            if ($value==true) {
                $permissions_role_true[$key]=true;
            }
        }
        foreach ($permissions_role as $key => $value) {
            if ($value==true) {
                $permissions_role_index[] =$key;
            }
        }
        // nếu tài khoản được cấp quyền thực hiện
        if (array_key_exists(substr($actions['as'],6), $permissions_role_true)) {
            return $next($request);
        }
        return redirect(route('admin.404'))->withErrors(['not_permissions'=>'Bạn không có quyền truy cập!']);
        
    }
}
