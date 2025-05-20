<?php

namespace App\Http\Controllers;

use App\Models\Permission;   // <-- acá
use App\Models\Section;
use App\Models\Rol;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RolsController extends Controller
{
    public function index (Request $request){
        $filter = $request->filter;

        if(!empty($request->records_per_page)){
            $request->records_per_page = $request->records_per_parge <= env('PAGINATION_MAX_SIZE')
                                                                    ? $request->records_per_page
                                                                    :   env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $rols = Rol::where('name', 'LIKE', "%$filter%")
                     ->paginate($request->records_per_page);

        return view('rols.index', ['rols' => $rols,
                                    'data' => $request]);
    }

    public function create(){
        $modules = Permission::all() -> groupby('module');

        $sectionGroups = Section::all() -> chunk(5);

        return view('rols/create', [
                    'modules' => $modules,
                    'sectionGroups' => $sectionGroups,
        ]);
    }

    public function edit($id){
        $rol = Rol::fund($id);

        if (empty($rol)) {
            Session::flash('message', ['content' => "El rol con el id '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        };

        $sections = Permission::all();

        $sections = $sections->map(function($item) use($id){
            $item->selected = false;

            $rolPermission = RolPermission::where('permission_id', '=', item->$id)
                                            ->where('rol_id', '=', $id)
                                            ->first();
        });

        $module = Permission::all() -> groupby('module');

        $sectionGroups = Section::all() -> chunk(5);

        return view('rols/create', [
                    'rol' => $rol,
                    'modules' => $modules,
                    'sectionGroups' => $sectionGroups
        ]);
    }

    public function store(Request $request){
        Validator::make($request->all(), [

            'name' => 'required|max:64',
            'permission' => 'required|json',
            'section' => 'required|json',

        ], [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no puede tener mas de :max caracteres',
            'permission.required' => 'Debe elegir al menos un permiso',
            'permission.json' => 'El campo se encuentra en el formato incorrecto',
            'section.required' => 'Seleccione al menos una seccion',
            'section.json' => 'El campo se encuentra en el formato incorrecto',
        ])->validate();

        try {
            BD::transaction(function() use($request){
                $rol = new Rol();
                $rol->name = $request->name;
                $rol->save();

                $permissions = json_decode($request->permissions);

                foreach ($permissions as $permission) {
                    $rolPermission = new RolPermission();
                    $rolPermission->rol_id = $rol->id;
                    $rolPermission->permission_id = $permission;
                    $rolPermission->save();
                }

                $sections = json_decode($request->sections);

                foreach ($sections as $section) {
                    $rolSection = new RolSection();
                    $rolSection->rol_id = $rol->id;
                    $rolSection->Section_id = $sention;
                    $rolSection->save();
                }
            });

            Session::flash('message', ['content' => 'Rol creado con exito', 'type' => 'succes']);
            return redirect()->action([RolsController::class, 'rols.index']);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function update(Request $request){
        Validator::make(Request->all(), [

            'rol_id' => 'required|exist:rol,id',
            'name' => 'required|max:64',
            'permission' => 'required|json',
            'section' => 'required|json',

        ], [
            'rol_id.required' => 'El id del rol es requerido',
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no puede tener mas de :max caracteres',
            'permission.required' => 'Debe elegir al menos un permiso',
            'permission.json' => 'El campo se encuentra en el formato incorrecto',
            'section.required' => 'Seleccione al menos una seccion',
            'section.json' => 'El campo se encuentra en el formato incorrecto',
        ])->validate();

        try {
            BD::transaction(function() use($request){
                $rol = Rol::find($request->rol_id);
                $rol->name = $request->name;
                $rol->save();

                RolPermission::where('rol_id', '=', $rol->id)->delete();

                $permissions = json_decode($request->permissions);

                foreach ($permissions as $permission) {
                    $rolPermission = new RolPermission();
                    $rolPermission->rol_id = $rol->id;
                    $rolPermission->permission_id = $permission;
                    $rolPermission->save();
                }

                RolSection::where('rol_id', '=', $rol->id)->delete();

                $sections = json_decode($request->sections);

                foreach ($sections as $section) {
                    $rolSection = new RolPermission();
                    $rolSection->rol_id = $rol->id;
                    $rolSection->Section_id = $sention;
                    $rolSection->save();
                }
            });

            Session::flash('message', ['content' => 'Rol actualizado con exito', 'type' => 'succes']);
            return redirect()->action([RolsController::class, 'rols.index']);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
