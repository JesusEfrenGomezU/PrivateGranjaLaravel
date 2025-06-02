@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Cambiar Contraseña</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Cambiar Contraseña</li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">

            <div class="card-body">

                <h5 class = "card-title">Cambiar Contraseña</h5>

                <form action="{{ route('profile.updatePassword') }}" class="row g-3" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="password" 
                                    class="form-control" 
                                    placeholder="Contraseña actual..."
                                    name="current_password" >
                                <label>Contraseña actual</label>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="password" 
                                    class="form-control" 
                                    placeholder="Nueva Contraseña..."
                                    name="new_password" >
                                <label>Nueva Contraseña</label>
                            </div>
                        </div>
                         
                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="password" 
                                    class="form-control" 
                                    placeholder="Confirmar Contraseña..."
                                    name="new_password_confirmation" >
                                <label>Confirmar Contraseña</label>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('home.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection