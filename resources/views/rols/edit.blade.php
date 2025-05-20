@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Editar Rol</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rols.index') }}">Secciones</a></li>
                <li class="breadcrumb-item active">Editar Rol</li>
            </ol>
        </nav>
    </div>

    <section class="rol dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Editar Rol</h3>
            </div>

            <div class="card-body mt-3">

                <form action="{{ route('rols.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="rol_id" value="{{ $rol->id }}" />

                    <div class="col md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite la sección..." name="name" value="{{ $rol->name }}" />
                            <label>Rol</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('rols.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </form>

            </div>
        </div>
    </section>
@endsection
