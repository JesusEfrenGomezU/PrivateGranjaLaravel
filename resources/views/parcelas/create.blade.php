@extends('layouts.app')

@section('content')
    <h1>Nueva Parcela</h1>

    <form action="{{route('parcelas.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tamaño</label>
            <input type="text" class="form-control" name="tamano" />
        </div>

        <div class="mb-3">
            <label class="form-label">Ubicacion</label>
            <input type="text" class="form-control" name="ubicacion" />
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <input type="text" class="form-control" name="estado" />
        </div>

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" />
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>

    </form>


@endsection
