@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nueva Parcela</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('parcelas.index') }}">Parcelas</a></li>
                <li class="breadcrumb-item active">Nueva Parcela</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Nueva Parcela</h3>
            </div>

            <div class="card-body mt-3">

                <form action="{{ route('parcelas.store') }}" class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" step="0.01" class="form-control" placeholder="Digite el tamaño..." name="tamano">
                            <label>Tamaño (m^2)</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite la ubicación..." name="ubicacion">
                            <label>Ubicación</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el estado..." name="estado">
                            <label>Estado</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el usuario..." name="usuario">
                            <label>Usuario</label>
                        </div>
                    </div>

                    //Aca se mostrarian todos lo cultivos como checkboxes... Canson
                    <div class="col-md-12">
                        <label>Seleccione Cultivos</label>
                            @foreach($cultivos as $cultivo)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cultivos[]" value="{{ $cultivo->id }}" id="cultivo_{{ $cultivo->id }}">
                                    <label class="form-check-label" for="cultivo_{{ $cultivo->id }}">
                                        {{ $cultivo->tipo }}
                                    </label>
                                </div>
                            @endforeach
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('parcelas.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
