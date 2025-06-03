<?php

namespace App\Http\Controllers;

use App\Models\Cultivoparcela;
use App\Models\Parcela;
use App\Models\Cultivo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CultivoparcelasController extends Controller
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
        $cultivoparcelas = Cultivoparcela::with('parcela', 'cultivo')
            ->where('Descripcion', 'LIKE', "%{$request->filter}%")
            ->orWhere('fecha_registro', 'LIKE', "%{$request->filter}%")
            ->orWhereHas('parcela', function($q) use ($request) {
                $q->where('ubicacion', 'LIKE', "%{$request->filter}%");
            })
            ->orWhereHas('cultivo', function($q) use ($request) {
                $q->where('tipo', 'LIKE', "%{$request->filter}%");
            })
            ->paginate($request->records_per_page);

        return view('cultivoparcelas.index', ['cultivoparcelas' => $cultivoparcelas, 'data' => $request]);
    }

    /*
    public function create() {
        // Se obtienen todas las parcelas y cultivos para los desplegables
        $parcelas = Parcela::all();
        $cultivos = Cultivo::all();
        return view('cultivoparcelas.create', compact('parcelas', 'cultivos'));
    }

    public function store(Request $request) {
        Validator::make($request->all(), [
            'Descripcion'   => 'required|string',
            'fecha_registro' => 'required|date',
            'parcela_id'    => 'required|exists:parcelas,id',
            'cultivo_id'    => 'required|exists:cultivos,id',
        ], [
            'Descripcion.required'   => 'La descripción es requerida.',
            'Descripcion.string'     => 'La descripción debe ser una cadena de caracteres.',
            'fecha_registro.required' => 'La fecha de registro es requerida.',
            'fecha_registro.date'     => 'La fecha de registro debe ser una fecha válida.',
            'parcela_id.required'    => 'Debe seleccionar una parcela.',
            'parcela_id.exists'      => 'La parcela seleccionada no existe.',
            'cultivo_id.required'    => 'Debe seleccionar un cultivo.',
            'cultivo_id.exists'      => 'El cultivo seleccionado no existe.',
        ])->validate();

        try {
            $cultivoparcela = new Cultivoparcela();
            $cultivoparcela->Descripcion   = $request->Descripcion;
            $cultivoparcela->fecha_registro = $request->fecha_registro;
            $cultivoparcela->parcela_id    = $request->parcela_id;
            $cultivoparcela->cultivo_id    = $request->cultivo_id;
            $cultivoparcela->save();

            Session::flash('message', ['content' => 'Cultivo-Parcela creado con éxito', 'type' => 'success']);
            return redirect()->action([CultivoparcelasController::class, 'index']);

        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id) {
        $cultivoparcela = Cultivoparcela::find($id);
        if (empty($cultivoparcela)) {
            Session::flash('message', ['content' => "El registro con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }
        // Se cargan también todas las parcelas y cultivos para los desplegables
        $parcelas = Parcela::all();
        $cultivos = Cultivo::all();
        return view('cultivoparcelas.edit', compact('cultivoparcela', 'parcelas', 'cultivos'));
    }

    public function update(Request $request) {
        Validator::make($request->all(), [
            'Descripcion'   => 'required|string',
            'fecha_registro' => 'required|date',
            'parcela_id'    => 'required|exists:parcelas,id',
            'cultivo_id'    => 'required|exists:cultivos,id',
            'cultivoparcela_id' => 'required|exists:cultivoparcelas,id',
        ], [
            'Descripcion.required'   => 'La descripción es requerida.',
            'Descripcion.string'     => 'La descripción debe ser una cadena de caracteres.',
            'fecha_registro.required' => 'La fecha de registro es requerida.',
            'fecha_registro.date'     => 'La fecha de registro debe ser una fecha válida.',
            'parcela_id.required'    => 'Debe seleccionar una parcela.',
            'parcela_id.exists'      => 'La parcela seleccionada no existe.',
            'cultivo_id.required'    => 'Debe seleccionar un cultivo.',
            'cultivo_id.exists'      => 'El cultivo seleccionado no existe.',
        ])->validate();

        try {
            $cultivoparcela = Cultivoparcela::find($request->cultivoparcela_id);
            $cultivoparcela->Descripcion   = $request->Descripcion;
            $cultivoparcela->fecha_registro = $request->fecha_registro;
            $cultivoparcela->parcela_id    = $request->parcela_id;
            $cultivoparcela->cultivo_id    = $request->cultivo_id;
            $cultivoparcela->save();

            Session::flash('message', ['content' => 'Cultivo-Parcela actualizado con éxito', 'type' => 'success']);
            return redirect()->action([CultivoparcelasController::class, 'index']);

        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {
        try {
            $cultivoparcela = Cultivoparcela::find($id);
            if (empty($cultivoparcela)) {
                Session::flash('message', ['content' => "El registro con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }
            $cultivoparcela->delete();
            Session::flash('message', ['content' => 'Cultivo-Parcela eliminado con éxito', 'type' => 'success']);
            return redirect()->action([CultivoparcelasController::class, 'index']);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }*/
}
