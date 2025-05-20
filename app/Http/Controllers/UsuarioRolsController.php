<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Models\Rol;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsuarioRolsController extends Controller
{
    public function index(Request $request) {
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                : env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        // Se cargan las relaciones para poder mostrar los nombres en la vista y se permite filtrar también por
        // el campo Descripcion, fecha_registro y por los nombres de parcela (ubicacion) y cultivo (tipo)
        $usuariorols = UsuarioRol::with('user', 'rol')

           // ->where('usuario_id', 'LIKE', "%{$request->filter}%")
           // ->orWhere('rol_id', 'LIKE', "%{$request->filter}%")
            ->WhereHas('user', function($q) use ($request) {
                $q->where('users_id', 'LIKE', "%{$request->filter}%");
            })
            ->orWhereHas('rol', function($q) use ($request) {
                $q->where('rol_id', 'LIKE', "%{$request->filter}%");
            })
            ->paginate($request->records_per_page);

        return view('usuariorols.index', ['usuariorols' => $usuariorols, 'data' => $request]);
    }

}
