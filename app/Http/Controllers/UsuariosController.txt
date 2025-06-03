<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Pail\ValueObjects\Origin\Console;

class UsuariosController extends Controller
{
    public function index(Request $request){
        //Los dos errores son normales, no hay que hacerles nada.
        if (!empty($request->records_per_page)) {

            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE') ? $request->records_per_page
                                                                                                : env('PAGINATION_MAX_SIZE');
        } else {

            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $usuarios = Usuario::where('cedula', 'LIKE', "%$request->filter%")
                        ->orWhere('apellidos', 'LIKE', "%$request->filter%")
                        ->orWhere('nombres', 'LIKE', "%$request->filter%")
                        ->orWhere('password', 'LIKE', "%$request->filter%")
                        ->orWhere('correo', 'LIKE', "%$request->filter%")
                        ->orWhere('telefono', 'LIKE', "%$request->filter%")
                        ->orWhere('fecha_registro', 'LIKE', "%{$request->filter}%")
                        ->paginate($request->records_per_page);
        
        return view('usuarios/index', [ 'usuarios' => $usuarios, 'data' => $request ]);
    }

    public function create(){

        //return view('usuarios/create');
        $rols = \App\Models\Rol::all();
        return view('usuarios.create', compact('rols'));

     }

     /*public function store(Request $request){

        Validator::make($request->all(), [
            'cedula'  => 'required|string|max:10',
            'apellidos'  => 'required|string|max:32',
            'nombres'  => 'required|string|max:32',
            'password'  => 'required|string|max:15',
            'correo'  => 'required|string|max:40',
            'telefono'  => 'required|string|max:15',
            'fecha_registro' => 'required|date',
        ], [
            'cedula.required'    => 'La cédula es requerido.',
            'cedula.string'     => 'La cédula debe ser una cadena de caracteres.',
            'cedula.max'     => 'La cédula no puede tener más de :max caracteres.',

            'apellidos.required'    => 'El apellido es requerido.',
            'apellidos.string'     => 'El apellido debe ser una cadena de caracteres.',
            'apellidos.max'     => 'El apellido no puede tener más de :max caracteres.',

            'nombres.required'    => 'El nombre es requerido.',
            'nombres.string'     => 'El nombre debe ser una cadena de caracteres.',
            'nombres.max'     => 'El nombre no puede tener más de :max caracteres.',

            'password.required'    => 'La contraseña es requerido.',
            'password.string'     => 'La contraseña debe ser una cadena de caracteres.',
            'password.max'     => 'La contraseña no puede tener más de :max caracteres.',

            'correo.required'    => 'El correo es requerido.',
            'correo.string'     => 'El correo debe ser una cadena de caracteres.',
            'correo.max'     => 'El correo no puede tener más de :max caracteres.',

            'telefono.required'    => 'El telefono es requerido.',
            'telefono.string'     => 'El telefono debe ser una cadena de caracteres.',
            'telefono.max'     => 'El telefono no puede tener más de :max caracteres.',

            'fecha_registro.required'    => 'La fecha de registro es requerida.',
            'fecha_registro.date'     => 'La fecha de registro debe ser una fecha válida.',


        ])->validate();

        try {

            $usuario = new Usuario();
            $usuario->cedula = $request->cedula;
            $usuario->apellidos = $request->apellidos;
            $usuario->nombres = $request->nombres;
            $usuario->password = $request->password;
            $usuario->correo = $request->correo;
            $usuario->telefono = $request->telefono;
            $usuario->fecha_registro = $request->fecha_registro;            
            $usuario->save();

            Session::flash('message', ['content' => 'Usuario creado con éxito', 'type' => 'success']);

            return redirect()->action([UsuariosController::class, 'index']);

        } catch(\Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }

     }*/

     public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'cedula'  => 'required|string|max:10',
            'apellidos'  => 'required|string|max:32',
            'nombres'  => 'required|string|max:32',
            'password'  => 'required|string|max:15',
            'correo'  => 'required|string|max:40',
            'telefono'  => 'required|string|max:15',
            'fecha_registro' => 'required|date',
            'rols'   => 'required|array',
            'rols.*' => 'exists:rols,id',

        ], [
            'cedula.required'    => 'La cédula es requerido.',
            'cedula.string'     => 'La cédula debe ser una cadena de caracteres.',
            'cedula.max'     => 'La cédula no puede tener más de :max caracteres.',

            'apellidos.required'    => 'El apellido es requerido.',
            'apellidos.string'     => 'El apellido debe ser una cadena de caracteres.',
            'apellidos.max'     => 'El apellido no puede tener más de :max caracteres.',

            'nombres.required'    => 'El nombre es requerido.',
            'nombres.string'     => 'El nombre debe ser una cadena de caracteres.',
            'nombres.max'     => 'El nombre no puede tener más de :max caracteres.',

            'password.required'    => 'La contraseña es requerido.',
            'password.string'     => 'La contraseña debe ser una cadena de caracteres.',
            'password.max'     => 'La contraseña no puede tener más de :max caracteres.',

            'correo.required'    => 'El correo es requerido.',
            'correo.string'     => 'El correo debe ser una cadena de caracteres.',
            'correo.max'     => 'El correo no puede tener más de :max caracteres.',

            'telefono.required'    => 'El telefono es requerido.',
            'telefono.string'     => 'El telefono debe ser una cadena de caracteres.',
            'telefono.max'     => 'El telefono no puede tener más de :max caracteres.',

            'fecha_registro.required'    => 'La fecha de registro es requerida.',
            'fecha_registro.date'     => 'La fecha de registro debe ser una fecha válida.',

            'rols.required'  => 'Debe seleccionar al menos un rol.',
            'rols.array'     => 'El formato de los roles seleccionados no es válido.',
            'rols.*.exists'  => 'Alguno de los roles seleccionados no existe.',

        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } //Esto como tal solo es un seguro contra errores 

        try {
            //Aca ya estamos creando la usuario 
            $usuario = new Usuario();
            $usuario->cedula = $request->cedula;
            $usuario->apellidos = $request->apellidos;
            $usuario->nombres = $request->nombres;
            $usuario->password = $request->password;
            $usuario->correo = $request->correo;
            $usuario->telefono = $request->telefono;
            $usuario->fecha_registro = $request->fecha_registro;            
            $usuario->save();
            
            //Este foreach esta para que recorra los cultivos y vaya creando registro en Cultivousuarios uno a uno
            foreach ($request->rols as $rol_id) {
                \App\Models\UsuarioRol::create([

                    'usuario_id'    => $usuario->id,
                    'rol_id'    => $rol_id,
                    //Las asignaciones de datos dadas por el registro de la usuario, predeterminadas y de cultivos
                ]);
            }

            Session::flash('message', ['content' => 'usuario creada con éxito junto con sus cultivos', 'type' => 'success']);
            return redirect()->action([usuariosController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        } //Este catch solo esta para dar mensaje en caso de cualquier error al generar registro

       // \DB::transaction(function() use ($request, &$usuario) { });
       // //Esto es un rollback para cualquier problema generado al crear registros a la base de datos no le de la palida

    }

     public function edit($id) {

        $usuario = Usuario::find($id);

        if (empty($usuario)) {

            Session::flash('message', ['content' => "El usuario con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }

        return view('usuarios/edit', ['usuario' => $usuario]);
    }

    public function update(Request $request) {

        Validator::make($request->all(), [
            'cedula'  => 'required|string|max:10',
            'apellidos'  => 'required|string|max:32',
            'nombres'  => 'required|string|max:32',
            'password'  => 'required|string|max:15',
            'correo'  => 'required|string|max:40',
            'telefono'  => 'required|string|max:15',
            'fecha_registro' => 'required|date',
        ], [
            'cedula.required'    => 'La cédula es requerido.',
            'cedula.string'     => 'La cédula debe ser una cadena de caracteres.',
            'cedula.max'     => 'La cédula no puede tener más de :max caracteres.',

            'apellidos.required'    => 'El apellido es requerido.',
            'apellidos.string'     => 'El apellido debe ser una cadena de caracteres.',
            'apellidos.max'     => 'El apellido no puede tener más de :max caracteres.',

            'nombres.required'    => 'El nombre es requerido.',
            'nombres.string'     => 'El nombre debe ser una cadena de caracteres.',
            'nombres.max'     => 'El nombre no puede tener más de :max caracteres.',

            'password.required'    => 'La contraseña es requerido.',
            'password.string'     => 'La contraseña debe ser una cadena de caracteres.',
            'password.max'     => 'La contraseña no puede tener más de :max caracteres.',

            'correo.required'    => 'El correo es requerido.',
            'correo.string'     => 'El correo debe ser una cadena de caracteres.',
            'correo.max'     => 'El correo no puede tener más de :max caracteres.',

            'telefono.required'    => 'El telefono es requerido.',
            'telefono.string'     => 'El telefono debe ser una cadena de caracteres.',
            'telefono.max'     => 'El telefono no puede tener más de :max caracteres.',

            'fecha_registro.required'    => 'La fecha de registro es requerida.',
            'fecha_registro.date'     => 'La fecha de registro debe ser una fecha válida.',

        ])->validate();

        try {
            $usuario = Usuario::find($request->usuario_id);
            $usuario->cedula = $request->cedula;
            $usuario->apellidos = $request->apellidos;
            $usuario->nombres = $request->nombres;
            $usuario->password = $request->password;
            $usuario->correo = $request->correo;
            $usuario->telefono = $request->telefono;
            $usuario->fecha_registro = $request->fecha_registro; 
            $usuario->save();

            Session::flash('message', ['content' => 'Usuario actualizado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {

        try {

            $usuario = Usuario::find($id);

            if (empty($usuario)) {

                Session::flash('message', ['content' => "El usuario con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }

            $usuario->delete();

            Session::flash('message', ['content' => 'Usuario eliminado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);

        } catch(Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

}
