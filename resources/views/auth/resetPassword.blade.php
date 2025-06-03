@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Recuperar Contraseña</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Recuperar Contraseña</li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">

            <div class="card-body">

                <h5 class = "card-title">Perfil</h5>

                <form action="{{ route('password.update') }}" class="row g-3" method="POST">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="password" 
                                    class="form-control" 
                                    placeholder="Nueva Contraseña..."
                                    name="password" >
                                <label>Nueva Contraseña</label>
                            </div>
                        </div>
                         
                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="password" 
                                    class="form-control" 
                                    placeholder="Confirmar Contraseña..."
                                    name="password_confirmation" >
                                <label>Confirmar Contraseña</label>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection