@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nueva Sección</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Secciones</a></li>
                <li class="breadcrumb-item active">Nueva Sección</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Nueva Sección</h3>
            </div>

            <div class="card-body mt-3">

                <form action="{{ route('sections.store') }}" class="row g-3" method="POST">
                    @csrf
                    <div class="col md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite la sección..." name="name">
                            <label>Sección</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </form>

            </div>
        </div>
    </section>
@endsection
