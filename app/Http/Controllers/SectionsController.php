<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SectionsController extends Controller
{
    public function index(){

        $sections = Section::all();

        return view('sections/index', [ 'sections' => $sections ]);
    }

    public function create() {

        return view('sections/create');
    }

    public function store(Request $request) {

        Validator::make($request->all(), [
            'name' => 'required|max:64'
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no puede ser mayor a :max carácteres.'
        ])->validate();

        try {

            $section = new Section();
            $section->name = $request->name;
            $section->save();

            Session::flash('message', ['content' => 'Sección creada con éxito', 'type' => 'success']);

            return redirect()->action([SectionsController::class, 'index']);

        } catch(\Exception $ex){

            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
