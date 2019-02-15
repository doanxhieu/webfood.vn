<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole
{
    public function getAllRole($role, $permissions)
    {
        $arr_role= array();
        foreach ($role as $key => $value) {
            $arr_role[$value->slug]=false;
        }
        foreach ($arr_role as $key => $value) {
            if ($key==$permissions) {
                $arr_role[$key]=true;
            }
        }
        return $arr_role;
    }
    /**
     * 
     * */
    public function getRolePermissions($permissions){
        foreach ($permissions as $key_per => $value_per) {
            foreach ($value_per as $key => $value) {
                if ($value==true) {
                    $arr[$key_per.'.'.$key] = true;
                }else{
                    $arr[$key_per.'.'.$key] = false;
                }
            }
        }
        return $arr;
    }
}
