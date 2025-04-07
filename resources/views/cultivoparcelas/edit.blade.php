@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Editar Cultivo-Parcela</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cultivoparcelas.index') }}">Cultivo-Parcelas</a></li>
                <li class="breadcrumb-item active">Editar Cultivo-Parcela</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h3>Editar Cultivo-Parcela</h3>
            </div>

            <div class="card-body mt-3">
                <form action="{{ route('cultivoparcelas.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="cultivoparcela_id" value="{{ $cultivoparcela->id }}" />

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Digite la descripción..." name="Descripcion" style="height: 100px;">{{ $cultivoparcela->Descripcion }}</textarea>
                            <label>Descripción</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="Digite la fecha de registro..." name="FechaRegistro" value="{{ $cultivoparcela->FechaRegistro }}">
                            <label>Fecha de Registro</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" name="parcela_id">
                                <option value="">Seleccione una Parcela</option>
                                @foreach ($parcelas as $parcela)
                                    <option value="{{ $parcela->id }}" {{ $cultivoparcela->parcela_id == $parcela->id ? 'selected' : '' }}>
                                        {{ $parcela->ubicacion }}
                                    </option>
                                @endforeach
                            </select>
                            <label>Parcela</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" name="cultivo_id">
                                <option value="">Seleccione un Cultivo</option>
                                @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}" {{ $cultivoparcela->cultivo_id == $cultivo->id ? 'selected' : '' }}>
                                        {{ $cultivo->tipo }}
                                    </option>
                                @endforeach
                            </select>
                            <label>Cultivo</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('cultivoparcelas.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
