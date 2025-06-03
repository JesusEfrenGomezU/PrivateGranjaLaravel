@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Perfil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Perfil</li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">

            <div class="card-body">

                <h5 class = "card-title">Perfil</h5>

                <form action="{{ route('profile.update') }}" class="row g-3" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="row">
              
                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="{{ $user->email }}" readonly >
                                <label>Email</label>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="text" 
                                    class="form-control" 
                                    value="{{ $user -> document }}" 
                                    placeholder="Documento..."
                                    name="document" >
                                <label>Documento</label>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="text" 
                                    class="form-control" 
                                    value="{{ $user -> first_name }}" 
                                    placeholder="Nombres..."
                                    name="first_name" >
                                <label>Nombres</label>
                            </div>
                        </div>
                         
                        <div class="col-md-6 mt-3">
                            <div class="form-floating">
                                <input type="text" 
                                    class="form-control" 
                                    value="{{ $user -> last_name }}" 
                                    placeholder="Apellidos..."
                                    name="last_name" >
                                <label>Apellidos</label>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('profile.changePassword') }}" class="btn btn-warning">Cambiar Contraseña</a>
                        <a href="{{ route('home.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection