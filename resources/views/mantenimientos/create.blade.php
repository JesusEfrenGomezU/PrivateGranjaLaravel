@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nuevo Mantenimiento</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mantenimientos.index') }}">Mantenimientos</a></li>
                <li class="breadcrumb-item active">Nuevo Mantenimiento</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Nuevo Mantenimiento</h3>
            </div>

            <div class="card-body mt-3">

                <form action="{{ route('mantenimientos.store') }}" class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Digite el código de parcela..." name="CodigoParcela">
                            <label>Código de Parcela</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el usuario..." name="Usuario">
                            <label>Usuario</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite la descripción..." name="Descripcion">
                            <label>Descripción</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de mantenimiento..." name="FechaMantenimiento">
                            <label>Fecha de Mantenimiento</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </form>

            </div>
        </div>
    </section>
@endsection
