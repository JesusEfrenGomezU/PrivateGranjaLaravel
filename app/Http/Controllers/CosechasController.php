<?php

namespace App\Http\Controllers;

use App\Models\Cosecha;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CosechasController extends Controller
{
    public function index(Request $request) {
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                : env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $cosechas = Cosecha::where('CodigoCultivo', 'LIKE', "%$request->filter%")
            ->orWhere('Usuario', 'LIKE', "%$request->filter%")
            ->orWhere('Recolectado', 'LIKE', "%$request->filter%")
            ->orWhere('Medida', 'LIKE', "%$request->filter%")
            ->orWhere('FechaCosecha', 'LIKE', "%$request->filter%")
            ->paginate($request->records_per_page);

        return view('cosechas.index', ['cosechas' => $cosechas, 'data' => $request]);
    }

    public function create() {
        return view('cosechas.create');
    }

    public function store(Request $request) {
        Validator::make($request->all(), [
            'CodigoCultivo' => 'required|integer',
            'Usuario'       => 'required|string|max:32',
            'Recolectado'   => 'required|integer',
            'Medida'        => 'required|string|max:32',
            'FechaCosecha'  => 'required|date',
        ], [
            'CodigoCultivo.required' => 'El código de cultivo es requerido.',
            'CodigoCultivo.integer'  => 'El código de cultivo debe ser un número entero.',
            'Usuario.required'       => 'El usuario es requerido.',
            'Usuario.string'         => 'El usuario debe ser una cadena de caracteres.',
            'Usuario.max'            => 'El usuario no puede tener más de :max caracteres.',
            'Recolectado.required'   => 'El valor recolectado es requerido.',
            'Recolectado.integer'    => 'El valor recolectado debe ser un número entero.',
            'Medida.required'        => 'La medida es requerida.',
            'Medida.string'          => 'La medida debe ser una cadena de caracteres.',
            'Medida.max'             => 'La medida no puede tener más de :max caracteres.',
            'FechaCosecha.required'  => 'La fecha de cosecha es requerida.',
            'FechaCosecha.date'      => 'La fecha de cosecha debe ser una fecha válida.',
        ])->validate();

        try {
            $cosecha = new Cosecha();
            $cosecha->CodigoCultivo = $request->CodigoCultivo;
            $cosecha->Usuario       = $request->Usuario;
            $cosecha->Recolectado   = $request->Recolectado;
            $cosecha->Medida        = $request->Medida;
            $cosecha->FechaCosecha  = $request->FechaCosecha;
            $cosecha->save();

            Session::flash('message', ['content' => 'Cosecha creada con éxito', 'type' => 'success']);
            return redirect()->action([CosechasController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id) {
        $cosecha = Cosecha::find($id);
        if (empty($cosecha)) {
            Session::flash('message', ['content' => "La cosecha con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }
        return view('cosechas.edit', ['cosecha' => $cosecha]);
    }

    public function update(Request $request) {
        Validator::make($request->all(), [
            'CodigoCultivo' => 'required|integer',
            'Usuario'       => 'required|string|max:32',
            'Recolectado'   => 'required|integer',
            'Medida'        => 'required|string|max:32',
            'FechaCosecha'  => 'required|date',
            'cosecha_id'    => 'required|exists:cosechas,id',
        ], [
            'CodigoCultivo.required' => 'El código de cultivo es requerido.',
            'CodigoCultivo.integer'  => 'El código de cultivo debe ser un número entero.',
            'Usuario.required'       => 'El usuario es requerido.',
            'Usuario.string'         => 'El usuario debe ser una cadena de caracteres.',
            'Usuario.max'            => 'El usuario no puede tener más de :max caracteres.',
            'Recolectado.required'   => 'El valor recolectado es requerido.',
            'Recolectado.integer'    => 'El valor recolectado debe ser un número entero.',
            'Medida.required'        => 'La medida es requerida.',
            'Medida.string'          => 'La medida debe ser una cadena de caracteres.',
            'Medida.max'             => 'La medida no puede tener más de :max caracteres.',
            'FechaCosecha.required'  => 'La fecha de cosecha es requerida.',
            'FechaCosecha.date'      => 'La fecha de cosecha debe ser una fecha válida.',
        ])->validate();

        try {
            $cosecha = Cosecha::find($request->cosecha_id);
            $cosecha->CodigoCultivo = $request->CodigoCultivo;
            $cosecha->Usuario       = $request->Usuario;
            $cosecha->Recolectado   = $request->Recolectado;
            $cosecha->Medida        = $request->Medida;
            $cosecha->FechaCosecha  = $request->FechaCosecha;
            $cosecha->save();

            Session::flash('message', ['content' => 'Cosecha actualizada con éxito', 'type' => 'success']);
            return redirect()->action([CosechasController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {
        try {
            $cosecha = Cosecha::find($id);
            if (empty($cosecha)) {
                Session::flash('message', ['content' => "La cosecha con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }
            $cosecha->delete();
            Session::flash('message', ['content' => 'Cosecha eliminada con éxito', 'type' => 'success']);
            return redirect()->action([CosechasController::class, 'index']);
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
