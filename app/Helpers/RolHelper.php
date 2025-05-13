<?php

namespace App\Helpers;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RolHelper{

    public static function currentUserIsAdmin(){
        try {
            $rol = Auth::user()->rol->name;

            return $rol == 'Administrador';

        } catch (\Exception $ex) {
            dd($ex);
        }

    }

    public static function isAuthorized($permission){
        try {
            if (!Auth::check()){
                return false;
            }

            if (RolHelper::currentUserIsAdmin()){
                return true;

            }

            $userId = Auth::user()->id;
            $obj = explode('.', $permission);
            $module = $obj[0];
            $permissionName = $obj[1];

            $permissionId = Permission::select('permissions.id')
                                        ->join('rol_permissions', 'permissions.id', 'rol_permissions.permission_id')
                                        ->join('rols', 'rol_permissions.rol_id', 'rols.id')
                                        ->join('users', 'rols.id', 'users.rol_id')
                                        ->where('permissions.module', '=', $module)
                                        ->where('permissions.name', '=', $permissionName)
                                        ->where('users.id', "=", $userId)
                                        ->first();

            return $permissionId != null;

        } catch (\Exception $ex){
            dd($ex);
        }

    }

}
