@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nuevo Usuario</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                <li class="breadcrumb-item active">Nuevo Usuario</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Nuevo Usuario</h3>
            </div>

            <div class="card-body mt-3">

                <form action="{{ route('usuarios.store') }}" class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" step="0.01" class="form-control" placeholder="Digite la cedula..." name="cedula">
                            <label>Cedula</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite los apellidos..." name="apellidos">
                            <label>Apellidos</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite los nombres..." name="nombres">
                            <label>Nombres</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el password..." name="password">
                            <label>Password</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el correo..." name="correo">
                            <label>Correo</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el telefono..." name="telefono">
                            <label>Telefono</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de registro..." name="fecha_registro">
                            <label>fecha_registro</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label>Seleccione Roles</label>
                            @foreach($rols as $rol)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cultivos[]" value="{{ $rol->id }}" id="cultivo_{{ $rol->id }}">
                                    <label class="form-check-label" for="rol_{{ $rol->id }}">
                                        {{ $rol->nombre }} 
                                    </label>
                                </div>
                            @endforeach
                    </div>
          
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </form>

            </div>
        </div>
    </section>
@endsection