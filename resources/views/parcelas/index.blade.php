@extends('layouts.app')

@section('content')
    <h1>Parcelas</h1>

    <a href="{{route('parcelas.create')}}" class="btn btn-primary">Nueva Parcela</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tamaño</th>
                <th>Ubicacion</th>
                <th>Estado</th>
                <th>Usuario</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($parcelas as $parcela)
                <tr>
                    <td>{{ $parcela->id }}</td>
                    <td>{{ $parcela->tamano }}</td>
                    <td>{{ $parcela->ubicacion }}</td>
                    <td>{{ $parcela->estado }}</td>
                    <td>{{ $parcela->usuario }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
