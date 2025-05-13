<?php

namespace Database\Seeders;
use App\Models\Permission;
use App\Models\Rol;
use App\Models\RolPermission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $adminRol = new Rol();
        $adminRol->name = 'Administrador';
        $adminRol->save();

        //cosechas Rol
        $cosechasRol = new Rol();
        $cosechasRol->name = 'Gestor cosechas';
        $cosechasRol->save();

        $cosechaPermissions = Permission::where('module', '=', 'Cosechas')
                                     ->get();

        foreach($cosechaPermissions as $permission) {

            $rolPermission = new RolPermission();
            $rolPermission->rol_id = $cosechasRol->id;
            $rolPermission->permission_id = $permission->id;
            $rolPermission->save();
        }

        // Sections Rol
        $sectionsRol = new Rol();
        $sectionsRol->name = 'Gestor de Secciones';
        $sectionsRol->save();

        $sectionPermissions = Permission::where('module', '=', 'Secciones')
                                        ->get();

        foreach($sectionPermissions as $permission) {

            $rolPermission = new RolPermission();
            $rolPermission->rol_id = $sectionsRol->id;
            $rolPermission->permission_id = $permission->id;
            $rolPermission->save();
        }

         // Cultivos-Parcelas Rol
        $cultivoparcelasRol = new Rol();
        $cultivoparcelasRol->name = 'Ver Cultivos-Parcelas';
        $cultivoparcelasRol->save();

        $cultivoparcelasPermissions = Permission::where('module', '=', 'Cultivoparcelas')
                                        ->get();

        foreach($cultivoparcelasPermissions as $permission) {

            $rolPermission = new RolPermission();
            $rolPermission->rol_id = $cultivoparcelasRol->id;
            $rolPermission->permission_id = $permission->id;
            $rolPermission->save();
        }

        // Cultivos Rol
        $cultivosRol = new Rol();
        $cultivosRol->name = 'Gestor de Cultivos';
        $cultivosRol->save();

        $cultivosPermissions = Permission::where('module', '=', 'Cultivos')
                                        ->get();

        foreach($cultivosPermissions as $permission) {

            $rolPermission = new RolPermission();
            $rolPermission->rol_id = $cultivosRol->id;
            $rolPermission->permission_id = $permission->id;
            $rolPermission->save();
        }

        // Mantenimientos Rol
        $mantenimientosRol = new Rol();
        $mantenimientosRol->name = 'Gestor de Mantenimientos';
        $mantenimientosRol->save();

        $mantenimientosPermissions = Permission::where('module', '=', 'Mantenimientos')
                                        ->get();

        foreach($mantenimientosPermissions as $permission) {

            $rolPermission = new RolPermission();
            $rolPermission->rol_id = $mantenimientosRol->id;
            $rolPermission->permission_id = $permission->id;
            $rolPermission->save();
        }

        // Parcelas Rol
        $parcelasRol = new Rol();
        $parcelasRol->name = 'Gestor de Parcelas';
        $parcelasRol->save();

        $parcelasPermissions = Permission::where('module', '=', 'Parcelas')
                                        ->get();

        foreach($parcelasPermissions as $permission) {

            $rolPermission = new RolPermission();
            $rolPermission->rol_id = $parcelasRol->id;
            $rolPermission->permission_id = $permission->id;
            $rolPermission->save();
        }

        // Parcelas Rol
        $parcelasRol = new Rol();
        $parcelasRol->name = 'Gestor de Parcelas';
        $parcelasRol->save();

        $parcelasPermissions = Permission::where('module', '=', 'Parcelas')
                                        ->get();

        foreach($parcelasPermissions as $permission) {

            $rolPermission = new RolPermission();
            $rolPermission->rol_id = $parcelasRol->id;
            $rolPermission->permission_id = $permission->id;
            $rolPermission->save();
        }


        // Users

        $user = new User();
        $user->first_name = 'Manuel';
        $user->last_name = 'Dominguez';
        $user->document = '12345678';
        $user->email = 'manueld@yopmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('1234');
        $user->rol_id = $adminRol->id;
        $user->save();

        $user = new User();
        $user->first_name = 'Ana';
        $user->last_name = 'Doe';
        $user->document = '2222';
        $user->email = 'anad@yopmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('1234');
        $user->rol_id = $cultivosRol->id;
        $user->save();

        $user = new User();
        $user->first_name = 'Jhon';
        $user->last_name = 'Doe';
        $user->document = '3333';
        $user->email = 'jhond@yopmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('1234');
        $user->rol_id = $sectionsRol->id;
        $user->save();



    }
}
