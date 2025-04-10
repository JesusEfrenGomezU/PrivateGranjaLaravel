@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Mantenimientos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Mantenimientos</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-11">
                    <h3>Mantenimientos</h3>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{-- Paginador --}}
            <form action="{{ route('mantenimientos.index') }}" method="GET" class="navbar-search">
                <div class="row mt-3">
                    <div class="col-md-auto">
                        <select name="records_per_page" class="form-select bg-light border-0 small" value="{{ $data->records_per_page }}">
                            <option value="2" {{ $data->records_per_page == 2 ? 'selected' : '' }}>2</option>
                            <option value="10" {{ $data->records_per_page == 10 ? 'selected' : '' }}>10</option>
                            <option value="15" {{ $data->records_per_page == 15 ? 'selected' : '' }}>15</option>
                            <option value="30" {{ $data->records_per_page == 30 ? 'selected' : '' }}>30</option>
                            <option value="50" {{ $data->records_per_page == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>

                    <div class="col-md-10">
                        <div class="input-group-mb-3">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="search" name="filter" value="{{ $data->filter }}">
                        </div>
                    </div>

                    <div class="col-md-auto">
                        <div class="input-group-mb-3">
                            <button class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Lista de registros --}}
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Parcela</th>
                        <th>Descripción</th>
                        <th>Fecha de Mantenimiento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mantenimientos as $mantenimiento)
                        <tr>
                            <td>{{ $mantenimiento->id }}</td>
                            <td>{{ $mantenimiento->parcela->ubicacion }}</td>
                            <td>{{ $mantenimiento->Descripcion }}</td>
                            <td>{{ $mantenimiento->FechaMantenimiento }}</td>
                            <td>
                                <a href="{{ route('mantenimientos.edit', $mantenimiento->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('mantenimientos.delete', $mantenimiento->id) }}" method="POST" style="display: contents;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btnDelete">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mantenimientos->appends(request()->except('page'))->links('components.customPagination') }}
        </div>
    </div>
</section>
@endsection

<script type="module">
    $(document).ready(function() {
        $('.btnDelete').click(function(event) {
            event.preventDefault();
            Swal.fire({
                title: "¿Desea eliminar este Mantenimiento?",
                text: "No podrá revertirlo",
                icon: 'question',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    });
</script>
