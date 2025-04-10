<?php

namespace App\Http\Controllers;

use App\Models\Parcela;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ParcelasController extends Controller
{
    public function index(Request $request){
        //Los dos errores son normales, no hay que hacerles nada.
        if (!empty($request->records_per_page)) {

            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE') ? $request->records_per_page
                                                                                                : env('PAGINATION_MAX_SIZE');
        } else {

            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        $parcelas = Parcela::where('ubicacion', 'LIKE', "%$request->filter%")
                        ->orWhere('estado', 'LIKE', "%$request->filter%")
                        ->orWhere('usuario', 'LIKE', "%$request->filter%")
                        ->orWhere('tamano', 'LIKE', "%$request->filter%")
                        ->paginate($request->records_per_page);

        return view('parcelas/index', [ 'parcelas' => $parcelas, 'data' => $request ]);
    }


    public function create(){

       return view('parcelas/create');
    }

    public function store(Request $request){

        Validator::make($request->all(), [
            'tamano'     => 'required|numeric',
            'ubicacion'  => 'required|max:32',
            'estado'     => 'required|max:32',
            'usuario'    => 'required|max:32',
        ], [
            'tamano.required'    => 'El tamaño es requerido.',
            'tamano.numeric'     => 'El tamaño debe ser un número.',
            'ubicacion.required' => 'La ubicación es requerida.',
            'ubicacion.max'      => 'La ubicación no puede tener más de :max caracteres.',
            'estado.required'    => 'El estado es requerido.',
            'estado.max'         => 'El estado no puede tener más de :max caracteres.',
            'usuario.required'   => 'El usuario es requerido.',
            'usuario.max'        => 'El usuario no puede tener más de :max caracteres.',
        ])->validate();

        try {

            $parcela = new Parcela();
            $parcela->tamano = $request->tamano;
            $parcela->ubicacion = $request->ubicacion;
            $parcela->estado = $request->estado;
            $parcela->usuario = $request->usuario;
            $parcela->save();

            Session::flash('message', ['content' => 'Parcela creada con éxito', 'type' => 'success']);

            return redirect()->action([ParcelasController::class, 'index']);

        } catch(\Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }

     }


    public function edit($id) {

        $parcela = Parcela::find($id);

        if (empty($parcela)) {

            Session::flash('message', ['content' => "La parcela con id: '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }

        return view('parcelas/edit', ['parcela' => $parcela]);
    }

    public function update(Request $request) {

        Validator::make($request->all(), [
            'tamano'     => 'required|numeric',
            'ubicacion'  => 'required|max:32',
            'estado'     => 'required|max:32',
            'usuario'    => 'required|max:32',
            'parcela_id' => 'required|exists:sections,id',
        ], [
            'tamano.required'    => 'El tamaño es requerido.',
            'tamano.numeric'     => 'El tamaño debe ser un número.',
            'ubicacion.required' => 'La ubicación es requerida.',
            'ubicacion.max'      => 'La ubicación no puede tener más de :max caracteres.',
            'estado.required'    => 'El estado es requerido.',
            'estado.max'         => 'El estado no puede tener más de :max caracteres.',
            'usuario.required'   => 'El usuario es requerido.',
            'usuario.max'        => 'El usuario no puede tener más de :max caracteres.',
        ])->validate();

        try {

            $parcela = Parcela::find($request->parcela_id);
            $parcela->tamano = $request->tamano;
            $parcela->ubicacion = $request->ubicacion;
            $parcela->estado = $request->estado;
            $parcela->usuario = $request->usuario;
            $parcela->save();

            Session::flash('message', ['content' => 'Parcela actualizada con éxito', 'type' => 'success']);
            return redirect()->action([ParcelasController::class, 'index']);

        } catch(\Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {

        try {

            $parcela = Parcela::find($id);

            if (empty($parcela)) {

                Session::flash('message', ['content' => "La parcela con id: '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }

            $parcela->delete();

            Session::flash('message', ['content' => 'Parcela eliminada con éxito', 'type' => 'success']);
            return redirect()->action([ParcelasController::class, 'index']);

        } catch(Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
