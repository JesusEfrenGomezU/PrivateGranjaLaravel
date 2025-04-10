@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Editar Cultivo</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cultivos.index') }}">Cultivos</a></li>
                <li class="breadcrumb-item active">Editar Cultivo</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Editar Cultivo</h3>
            </div>

            <div class="card-body mt-3">
                <form action="{{ route('cultivos.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="cultivo_id" value="{{ $cultivo->id }}" />

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el tipo..." name="tipo" value="{{ $cultivo->tipo }}">
                            <label>Tipo</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de siembra..." name="siembra" value="{{ $cultivo->siembra }}">
                            <label>Fecha de Siembra</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de cosecha..." name="cosecha" value="{{ $cultivo->cosecha }}">
                            <label>Fecha de Cosecha</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el estado..." name="estado" value="{{ $cultivo->estado }}">
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
