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
            <form action="{{ route('mantenimientos.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <div class="form-floating">
                        <select name="parcela_id" class="form-select">
                            <option value="">Seleccione una Parcela</option>
                            @foreach ($parcelas as $parcela)
                                <option value="{{ $parcela->id }}">{{ $parcela->ubicacion }}</option>
                            @endforeach
                        </select>
                        <label>Parcela</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" name="FechaMantenimiento" class="form-control" placeholder="Digite la fecha de mantenimiento">
                        <label>Fecha de Mantenimiento</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" name="Descripcion" class="form-control" placeholder="Digite la descripción">
                        <label>Descripción</label>
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
