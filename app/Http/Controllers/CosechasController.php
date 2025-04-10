<?php

namespace App\Http\Controllers;

use App\Models\Cosecha;
use App\Models\Cultivo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CosechasController extends Controller
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

        // Se incluye la relación con Cultivo para mostrar el tipo en la vista y se filtra también
        $cosechas = Cosecha::with('cultivo')
            ->where('Recolectado', 'LIKE', "%{$request->filter}%")
            ->orWhere('Medida', 'LIKE', "%{$request->filter}%")
            ->orWhere('FechaCosecha', 'LIKE', "%{$request->filter}%")
            ->orWhereHas('cultivo', function($q) use ($request) {
                $q->where('tipo', 'LIKE', "%{$request->filter}%");
            })
            ->paginate($request->records_per_page);

        return view('cosechas.index', ['cosechas' => $cosechas, 'data' => $request]);
    }

    public function create()
    {
        // Se obtienen todos los cultivos para el desplegable
        $cultivos = Cultivo::all();
        return view('cosechas.create', compact('cultivos'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'cultivo_id'   => 'required|exists:cultivos,id',
            'Recolectado'  => 'required|integer',
            'Medida'       => 'required|string|max:32',
            'FechaCosecha' => 'required|date',
        ], [
            'cultivo_id.required'  => 'Debe seleccionar un cultivo.',
            'cultivo_id.exists'    => 'El cultivo seleccionado no existe.',
            'Recolectado.required' => 'El valor recolectado es requerido.',
            'Recolectado.integer'  => 'El valor recolectado debe ser un número entero.',
            'Medida.required'      => 'La medida es requerida.',
            'Medida.string'        => 'La medida debe ser una cadena de caracteres.',
            'Medida.max'           => 'La medida no puede tener más de :max caracteres.',
            'FechaCosecha.required'=> 'La fecha de cosecha es requerida.',
            'FechaCosecha.date'    => 'La fecha de cosecha debe ser una fecha válida.',
        ])->validate();

        try {
            $cosecha = new Cosecha();
            $cosecha->cultivo_id   = $request->cultivo_id;
            $cosecha->Recolectado  = $request->Recolectado;
            $cosecha->Medida       = $request->Medida;
            $cosecha->FechaCosecha = $request->FechaCosecha;
            $cosecha->save();

            Session::flash('message', ['content' => 'Cosecha creada con éxito', 'type' => 'success']);
            return redirect()->action([CosechasController::class, 'index']);

        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $cosecha = Cosecha::find($id);
        if (empty($cosecha)) {
            Session::flash('message', ['content' => "La cosecha con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }
        // Se obtienen todos los cultivos para el desplegable
        $cultivos = Cultivo::all();
        return view('cosechas.edit', compact('cosecha', 'cultivos'));
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'cultivo_id'   => 'required|exists:cultivos,id',
            'Recolectado'  => 'required|integer',
            'Medida'       => 'required|string|max:32',
            'FechaCosecha' => 'required|date',
            'cosecha_id'   => 'required|exists:cosechas,id',
        ], [
            'cultivo_id.required'  => 'Debe seleccionar un cultivo.',
            'cultivo_id.exists'    => 'El cultivo seleccionado no existe.',
            'Recolectado.required' => 'El valor recolectado es requerido.',
            'Recolectado.integer'  => 'El valor recolectado debe ser un número entero.',
            'Medida.required'      => 'La medida es requerida.',
            'Medida.string'        => 'La medida debe ser una cadena de caracteres.',
            'Medida.max'           => 'La medida no puede tener más de :max caracteres.',
            'FechaCosecha.required'=> 'La fecha de cosecha es requerida.',
            'FechaCosecha.date'    => 'La fecha de cosecha debe ser una fecha válida.',
        ])->validate();

        try {
            $cosecha = Cosecha::find($request->cosecha_id);
            $cosecha->cultivo_id   = $request->cultivo_id;
            $cosecha->Recolectado  = $request->Recolectado;
            $cosecha->Medida       = $request->Medida;
            $cosecha->FechaCosecha = $request->FechaCosecha;
            $cosecha->save();

            Session::flash('message', ['content' => 'Cosecha actualizada con éxito', 'type' => 'success']);
            return redirect()->action([CosechasController::class, 'index']);

        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $cosecha = Cosecha::find($id);
            if (empty($cosecha)) {
                Session::flash('message', ['content' => "La cosecha con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }
            $cosecha->delete();
            Session::flash('message', ['content' => 'Cosecha eliminada con éxito', 'type' => 'success']);
            return redirect()->action([CosechasController::class, 'index']);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
