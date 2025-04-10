<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Parcela;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MantenimientosController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                ? $request->records_per_page
                : env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        // Se carga la relación 'parcela' para mostrar la ubicación en la vista.
        // Además se permite filtrar por Descripcion, FechaMantenimiento o por la ubicación de la parcela.
        $mantenimientos = Mantenimiento::with('parcela')
            ->where('Descripcion', 'LIKE', "%{$request->filter}%")
            ->orWhere('FechaMantenimiento', 'LIKE', "%{$request->filter}%")
            ->orWhereHas('parcela', function($q) use ($request) {
                $q->where('ubicacion', 'LIKE', "%{$request->filter}%");
            })
            ->paginate($request->records_per_page);

        return view('mantenimientos.index', [
            'mantenimientos' => $mantenimientos,
            'data' => $request
        ]);
    }

    public function create()
    {
        // Se obtienen todas las parcelas para el desplegable
        $parcelas = Parcela::all();
        return view('mantenimientos.create', compact('parcelas'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'parcela_id'         => 'required|exists:parcelas,id',
            'Descripcion'        => 'required|string',
            'FechaMantenimiento' => 'required|date',
        ], [
            'parcela_id.required'         => 'Debe seleccionar una parcela.',
            'parcela_id.exists'           => 'La parcela seleccionada no existe.',
            'Descripcion.required'        => 'La descripción es requerida.',
            'Descripcion.string'          => 'La descripción debe ser una cadena de caracteres.',
            'FechaMantenimiento.required' => 'La fecha de mantenimiento es requerida.',
            'FechaMantenimiento.date'     => 'La fecha de mantenimiento debe ser una fecha válida.',
        ])->validate();

        try {
            $mantenimiento = new Mantenimiento();
            $mantenimiento->parcela_id = $request->parcela_id;
            $mantenimiento->Descripcion = $request->Descripcion;
            $mantenimiento->FechaMantenimiento = $request->FechaMantenimiento;
            $mantenimiento->save();

            Session::flash('message', ['content' => 'Mantenimiento creado con éxito', 'type' => 'success']);
            return redirect()->action([MantenimientosController::class, 'index']);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $mantenimiento = Mantenimiento::find($id);
        if (empty($mantenimiento)) {
            Session::flash('message', ['content' => "El mantenimiento con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }
        // Se obtienen todas las parcelas para el desplegable
        $parcelas = Parcela::all();
        return view('mantenimientos.edit', compact('mantenimiento', 'parcelas'));
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'parcela_id'         => 'required|exists:parcelas,id',
            'Descripcion'        => 'required|string',
            'FechaMantenimiento' => 'required|date',
            'mantenimiento_id'   => 'required|exists:mantenimientos,id',
        ], [
            'parcela_id.required'         => 'Debe seleccionar una parcela.',
            'parcela_id.exists'           => 'La parcela seleccionada no existe.',
            'Descripcion.required'        => 'La descripción es requerida.',
            'Descripcion.string'          => 'La descripción debe ser una cadena de caracteres.',
            'FechaMantenimiento.required' => 'La fecha de mantenimiento es requerida.',
            'FechaMantenimiento.date'     => 'La fecha de mantenimiento debe ser una fecha válida.',
        ])->validate();

        try {
            $mantenimiento = Mantenimiento::find($request->mantenimiento_id);
            $mantenimiento->parcela_id = $request->parcela_id;
            $mantenimiento->Descripcion = $request->Descripcion;
            $mantenimiento->FechaMantenimiento = $request->FechaMantenimiento;
            $mantenimiento->save();

            Session::flash('message', ['content' => 'Mantenimiento actualizado con éxito', 'type' => 'success']);
            return redirect()->action([MantenimientosController::class, 'index']);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $mantenimiento = Mantenimiento::find($id);
            if (empty($mantenimiento)) {
                Session::flash('message', ['content' => "El mantenimiento con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }
            $mantenimiento->delete();
            Session::flash('message', ['content' => 'Mantenimiento eliminado con éxito', 'type' => 'success']);
            return redirect()->action([MantenimientosController::class, 'index']);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
