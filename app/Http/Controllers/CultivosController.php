<?php

namespace App\Http\Controllers;

use App\Models\Cultivo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CultivosController extends Controller
{
    public function index(Request $request) {
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                : env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $cultivos = Cultivo::where('tipo', 'LIKE', "%$request->filter%")
            ->orWhere('siembra', 'LIKE', "%$request->filter%")
            ->orWhere('cosecha', 'LIKE', "%$request->filter%")
            ->orWhere('estado', 'LIKE', "%$request->filter%")
            ->paginate($request->records_per_page);

        return view('cultivos.index', ['cultivos' => $cultivos, 'data' => $request]);
    }

    public function create() {
        return view('cultivos.create');
    }

    public function store(Request $request) {
        Validator::make($request->all(), [
            'tipo'    => 'required|max:32',
            'siembra' => 'required|date',
            'cosecha' => 'required|date',
            'estado'  => 'required|string|max:32',
        ], [
            'tipo.required'    => 'El tipo es requerido.',
            'tipo.max'         => 'El tipo no puede tener más de :max caracteres.',
            'siembra.required' => 'La fecha de siembra es requerida.',
            'siembra.date'     => 'La fecha de siembra debe ser una fecha válida.',
            'cosecha.required' => 'La fecha de cosecha es requerida.',
            'cosecha.date'     => 'La fecha de cosecha debe ser una fecha válida.',
            'estado.required'  => 'El estado es requerido.',
            'estado.string'    => 'El estado debe ser una cadena de caracteres.',
            'estado.max'       => 'El estado no puede tener más de :max caracteres.',
        ])->validate();

        try {
            $cultivo = new Cultivo();
            $cultivo->tipo = $request->tipo;
            $cultivo->siembra = $request->siembra;
            $cultivo->cosecha = $request->cosecha;
            $cultivo->estado = $request->estado;
            $cultivo->save();

            Session::flash('message', ['content' => 'Cultivo creado con éxito', 'type' => 'success']);
            return redirect()->action([CultivosController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id) {
        $cultivo = Cultivo::find($id);
        if (empty($cultivo)) {
            Session::flash('message', ['content' => "El cultivo con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }
        return view('cultivos.edit', ['cultivo' => $cultivo]);
    }

    public function update(Request $request) {
        Validator::make($request->all(), [
            'tipo'       => 'required|max:32',
            'siembra'    => 'required|date',
            'cosecha'    => 'required|date',
            'estado'     => 'required|string|max:32',
            'cultivo_id' => 'required|exists:cultivos,id',
        ], [
            'tipo.required'    => 'El tipo es requerido.',
            'tipo.max'         => 'El tipo no puede tener más de :max caracteres.',
            'siembra.required' => 'La fecha de siembra es requerida.',
            'siembra.date'     => 'La fecha de siembra debe ser una fecha válida.',
            'cosecha.required' => 'La fecha de cosecha es requerida.',
            'cosecha.date'     => 'La fecha de cosecha debe ser una fecha válida.',
            'estado.required'  => 'El estado es requerido.',
            'estado.string'    => 'El estado debe ser una cadena de caracteres.',
            'estado.max'       => 'El estado no puede tener más de :max caracteres.',
        ])->validate();

        try {
            $cultivo = Cultivo::find($request->cultivo_id);
            $cultivo->tipo = $request->tipo;
            $cultivo->siembra = $request->siembra;
            $cultivo->cosecha = $request->cosecha;
            $cultivo->estado = $request->estado;
            $cultivo->save();

            Session::flash('message', ['content' => 'Cultivo actualizado con éxito', 'type' => 'success']);
            return redirect()->action([CultivosController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {
        try {
            $cultivo = Cultivo::find($id);
            if (empty($cultivo)) {
                Session::flash('message', ['content' => "El cultivo con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }
            $cultivo->delete();
            Session::flash('message', ['content' => 'Cultivo eliminado con éxito', 'type' => 'success']);
            return redirect()->action([CultivosController::class, 'index']);
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
