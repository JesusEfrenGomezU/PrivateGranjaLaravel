<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MantenimientosController extends Controller
{
    public function index(Request $request){
        // Los dos errores son normales, no hay que hacerles nada.
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                : env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $mantenimientos = Mantenimiento::where('CodigoParcela', 'LIKE', "%$request->filter%")
            ->orWhere('Usuario', 'LIKE', "%$request->filter%")
            ->orWhere('Descripcion', 'LIKE', "%$request->filter%")
            ->orWhere('FechaMantenimiento', 'LIKE', "%$request->filter%")
            ->paginate($request->records_per_page);

        return view('mantenimientos.index', [ 'mantenimientos' => $mantenimientos, 'data' => $request ]);
    }

    public function create(){
        return view('mantenimientos.create');
    }

    public function store(Request $request){
        Validator::make($request->all(), [
            'CodigoParcela'      => 'required|integer',
            'Usuario'            => 'required|max:32',
            'Descripcion'        => 'required|max:255',
            'FechaMantenimiento' => 'required|date',
        ], [
            'CodigoParcela.required'      => 'El código de parcela es requerido.',
            'CodigoParcela.integer'       => 'El código de parcela debe ser un número entero.',
            'Usuario.required'            => 'El usuario es requerido.',
            'Usuario.max'                 => 'El usuario no puede tener más de :max caracteres.',
            'Descripcion.required'        => 'La descripción es requerida.',
            'Descripcion.max'             => 'La descripción no puede tener más de :max caracteres.',
            'FechaMantenimiento.required' => 'La fecha de mantenimiento es requerida.',
            'FechaMantenimiento.date'     => 'La fecha de mantenimiento debe ser una fecha válida.',
        ])->validate();

        try {
            $mantenimiento = new Mantenimiento();
            $mantenimiento->CodigoParcela      = $request->CodigoParcela;
            $mantenimiento->Usuario            = $request->Usuario;
            $mantenimiento->Descripcion        = $request->Descripcion;
            $mantenimiento->FechaMantenimiento = $request->FechaMantenimiento;
            $mantenimiento->save();

            Session::flash('message', ['content' => 'Mantenimiento creado con éxito', 'type' => 'success']);
            return redirect()->action([MantenimientosController::class, 'index']);

        } catch(\Exception $ex){
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id) {
        $mantenimiento = Mantenimiento::find($id);

        if (empty($mantenimiento)) {
            Session::flash('message', ['content' => "El mantenimiento con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }

        return view('mantenimientos.edit', ['mantenimiento' => $mantenimiento]);
    }

    public function update(Request $request) {
        Validator::make($request->all(), [
            'CodigoParcela'      => 'required|integer',
            'Usuario'            => 'required|max:32',
            'Descripcion'        => 'required|max:255',
            'FechaMantenimiento' => 'required|date',
            'mantenimiento_id'   => 'required|exists:mantenimientos,id',
        ], [
            'CodigoParcela.required'      => 'El código de parcela es requerido.',
            'CodigoParcela.integer'       => 'El código de parcela debe ser un número entero.',
            'Usuario.required'            => 'El usuario es requerido.',
            'Usuario.max'                 => 'El usuario no puede tener más de :max caracteres.',
            'Descripcion.required'        => 'La descripción es requerida.',
            'Descripcion.max'             => 'La descripción no puede tener más de :max caracteres.',
            'FechaMantenimiento.required' => 'La fecha de mantenimiento es requerida.',
            'FechaMantenimiento.date'     => 'La fecha de mantenimiento debe ser una fecha válida.',
        ])->validate();

        try {
            $mantenimiento = Mantenimiento::find($request->mantenimiento_id);
            $mantenimiento->CodigoParcela      = $request->CodigoParcela;
            $mantenimiento->Usuario            = $request->Usuario;
            $mantenimiento->Descripcion        = $request->Descripcion;
            $mantenimiento->FechaMantenimiento = $request->FechaMantenimiento;
            $mantenimiento->save();

            Session::flash('message', ['content' => 'Mantenimiento actualizado con éxito', 'type' => 'success']);
            return redirect()->action([MantenimientosController::class, 'index']);

        } catch(\Exception $ex){
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {
        try {
            $mantenimiento = Mantenimiento::find($id);

            if (empty($mantenimiento)) {
                Session::flash('message', ['content' => "El mantenimiento con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }

            $mantenimiento->delete();

            Session::flash('message', ['content' => 'Mantenimiento eliminado con éxito', 'type' => 'success']);
            return redirect()->action([MantenimientosController::class, 'index']);

        } catch(Exception $ex){
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
