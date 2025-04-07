@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Editar Parcela</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('parcelas.index') }}">Parcelas</a></li>
                <li class="breadcrumb-item active">Editar Parcela</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Editar Parcela</h3>
            </div>

            <div class="card-body mt-3">

                <form action="{{ route('parcelas.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="parcela_id" value="{{ $parcela->id }}" />

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" step="0.01" class="form-control" placeholder="Digite el tamaño..." name="tamano" value="{{ $parcela->tamano }}" />
                            <label>Tamaño</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite la ubicación..." name="ubicacion" value="{{ $parcela->ubicacion }}" />
                            <label>Ubicación</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el estado..." name="estado" value="{{ $parcela->estado }}" />
                            <label>Estado</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el usuario..." name="usuario" value="{{ $parcela->usuario }}" />
                            <label>Usuario</label>
                        </div>
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
