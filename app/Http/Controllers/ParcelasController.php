<?php

namespace App\Http\Controllers;

use App\Models\Parcela;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ParcelasController extends Controller
{
    //Esta funcion nos pasa todos los cultivos y se los manda a la vista
    public function create() {
        $cultivos = \App\Models\Cultivo::all();
        return view('parcelas.create', compact('cultivos'));
    }

    
    public function index(Request $request)
    {
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE') ? $request->records_per_page
                : env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }
        // Cargar la relación 'user' y aplicar los filtros
        $parcelas = Parcela::with('user') // Cargar la relación 'user'
            ->where('ubicacion', 'LIKE', "%$request->filter%")
            ->orWhere('estado', 'LIKE', "%$request->filter%")
            ->orWhere('users_id', 'LIKE', "%$request->filter%")
            ->orWhere('tamano', 'LIKE', "%$request->filter%")
            ->paginate($request->records_per_page);
        return view('parcelas.index', ['parcelas' => $parcelas, 'data' => $request]);
    }



    /*public function create(){

       return view('parcelas/create');
    }*/
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'tamano'     => 'required|numeric',
            'ubicacion'  => 'required|max:32',
            'estado'     => 'required|max:32',
            'cultivos'   => 'required|array',
            'cultivos.*' => 'exists:cultivos,id',
            //En la 51 estamos definiendo el cultivo como un campo necesario para el registro de la parcela
            //En la 52 le ponemos el comando para que en este campo se muestren todos los cultivos existentes
        ], [
            'tamano.required'    => 'El tamaño es requerido.',
            'tamano.numeric'     => 'El tamaño debe ser un número.',
            'ubicacion.required' => 'La ubicación es requerida.',
            'ubicacion.max'      => 'La ubicación no puede tener más de :max caracteres.',
            'estado.required'    => 'El estado es requerido.',
            'estado.max'         => 'El estado no puede tener más de :max caracteres.',
            'cultivos.required'  => 'Debe seleccionar al menos un cultivo.',
            'cultivos.array'     => 'El formato de los cultivos seleccionados no es válido.',
            'cultivos.*.exists'  => 'Alguno de los cultivos seleccionados no existe.',
            //Las lineas 64, 65 y 66 son meramente remarcaciones de de avisos en casos donde no se escojan cultivos o lo haga mal

        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } //Esto como tal solo es un seguro contra errores

        try {
            //Aca ya estamos creando la parcela
            $parcela = new \App\Models\Parcela();
            $parcela->tamano = $request->tamano;
            $parcela->ubicacion = $request->ubicacion;
            $parcela->estado = $request->estado;
            $parcela->users_id = Auth::id(); // Obtener el ID del usuario autenticado
            $parcela->save();

            //Este foreach esta para que recorra los cultivos y vaya creando registro en Cultivoparcelas uno a uno
            foreach ($request->cultivos as $cultivo_id) {
                \App\Models\Cultivoparcela::create([
                    'Descripcion'   => 'Asignación de cultivo a parcela',
                    'fecha_registro' => now(),
                    'parcela_id'    => $parcela->id,
                    'cultivo_id'    => $cultivo_id,
                    //Las asignaciones de datos dadas por el registro de la parcela, predeterminadas y de cultivos
                ]);
            }

            Session::flash('message', ['content' => 'Parcela creada con éxito junto con sus cultivos', 'type' => 'success']);
            return redirect()->action([ParcelasController::class, 'index']);

        } catch(Exception $ex){
            Log::error($ex);

            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        } //Este catch solo esta para dar mensaje en caso de cualquier error al generar registro

        \DB::transaction(function() use ($request, &$parcela) {
        });//Esto es un rollback para cualquier problema generado al crear registros a la base de datos no le de la palida

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
            'parcela_id' => 'required|exists:parcelas,id',
        ], [
            'tamano.required'    => 'El tamaño es requerido.',
            'tamano.numeric'     => 'El tamaño debe ser un número.',
            'ubicacion.required' => 'La ubicación es requerida.',
            'ubicacion.max'      => 'La ubicación no puede tener más de :max caracteres.',
            'estado.required'    => 'El estado es requerido.',
            'estado.max'         => 'El estado no puede tener más de :max caracteres.',
        ])->validate();

        try {

            $parcela = Parcela::find($request->parcela_id);
            $parcela->tamano = $request->tamano;
            $parcela->ubicacion = $request->ubicacion;
            $parcela->estado = $request->estado;
            $parcela->users_id = Auth::id();
            $parcela->save();

            Session::flash('message', ['content' => 'Parcela actualizada con éxito', 'type' => 'success']);
            return redirect()->action([ParcelasController::class, 'index']);

        } catch(Exception $ex){

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
