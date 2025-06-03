@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Editar user</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">users</a></li>
                <li class="breadcrumb-item active">Editar usuario</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Editar user</h3>
            </div>

            <div class="card-body mt-3">

                <form action="{{ route('users.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ $user->id }}" />

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" step="0.01" class="form-control" placeholder="Digite la cedula..." name="cedula" value="{{ $user->document }}" />
                            <label>Cedula</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite los Apellidos..." name="apellidos" value="{{ $user->last_name }}" />
                            <label>Apellidos</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite los nombres..." name="nombres" value="{{ $user->first_name }}" />
                            <label>Nombres</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el password..." name="password" value="{{ $user->password }}" />
                            <label>?Password</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Digite el correo..." name="correo" value="{{ $user->email }}" />
                            <label>?Correo</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de registro..." name="fecha_registro" value="{{ $user->created_at }}" />
                            <label>?fecha_registro</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </form>

            </div>
        </div>
    </section>
@endsection