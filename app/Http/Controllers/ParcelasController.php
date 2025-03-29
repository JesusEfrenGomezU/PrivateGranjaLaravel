<?php

namespace App\Http\Controllers;

use App\Models\Parcela;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ParcelasController extends Controller
{
    public function index(){

        $parcelas = Parcela::all();

        return view('parcelas/index',['parcelas'=>$parcelas]);
    }


    public function create(){

       return view('parcelas/create');
    }

    public function store(Request $request){
        //dd($request->all()); se puede usar para validar y ver como llega la info
        try{
            $parcela = new Parcela();
            $parcela->tamano = $request->tamano;
            $parcela->ubicacion = $request->ubicacion;
            $parcela->estado = $request->estado;
            $parcela->usuario = $request->usuario;
            $parcela->save();

            return redirect()->action([ParcelasController::class, 'index']);
        }catch(Exception $ex){
            Log::error($ex);
        }

     }
}
