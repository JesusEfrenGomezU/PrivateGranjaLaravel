@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nueva Cosecha</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cosechas.index') }}">Cosechas</a></li>
                <li class="breadcrumb-item active">Nueva Cosecha</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Nueva Cosecha</h3>
            </div>

            <div class="card-body mt-3">
                <form action="{{ route('cosechas.store') }}" class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" name="cultivo_id">
                                <option value="">Seleccione un Cultivo</option>
                                @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}">{{ $cultivo->tipo }}</option>
                                @endforeach
                            </select>
                            <label>Cultivo</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Digite el valor recolectado..." name="Recolectado">
                            <label>Recolectado</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite la medida..." name="Medida">
                            <label>Medida</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de cosecha..." name="FechaCosecha">
                            <label>Fecha de Cosecha</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('cosechas.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
