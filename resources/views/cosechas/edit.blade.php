
@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Editar Cosecha</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cosechas.index') }}">Cosechas</a></li>
                <li class="breadcrumb-item active">Editar Cosecha</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Editar Cosecha</h3>
            </div>

            <div class="card-body mt-3">
                <form action="{{ route('cosechas.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="cosecha_id" value="{{ $cosecha->id }}" />

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Digite el código de cultivo..." name="CodigoCultivo" value="{{ $cosecha->CodigoCultivo }}">
                            <label>Código de Cultivo</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el usuario..." name="Usuario" value="{{ $cosecha->Usuario }}">
                            <label>Usuario</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Digite el valor recolectado..." name="Recolectado" value="{{ $cosecha->Recolectado }}">
                            <label>Recolectado</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite la medida..." name="Medida" value="{{ $cosecha->Medida }}">
                            <label>Medida</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de cosecha..." name="FechaCosecha" value="{{ $cosecha->FechaCosecha }}">
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
