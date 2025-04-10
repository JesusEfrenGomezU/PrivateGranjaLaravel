@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nuevo Cultivo</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cultivos.index') }}">Cultivos</a></li>
                <li class="breadcrumb-item active">Nuevo Cultivo</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Nuevo Cultivo</h3>
            </div>

            <div class="card-body mt-3">
                <form action="{{ route('cultivos.store') }}" class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el tipo..." name="tipo">
                            <label>Tipo</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de siembra..." name="siembra">
                            <label>Fecha de Siembra</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de cosecha..." name="cosecha">
                            <label>Fecha de Cosecha</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el estado..." name="estado">
                            <label>Estado</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('cultivos.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
