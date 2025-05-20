@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nuevo Rol</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rols.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Nuevo Rol</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
            {{-- Roles --}}
            <div class="card shadow mt-3">
                <div class="card body">
                    <h3 class="card-title">Nuevo rol</h3>
                    <form action="{{ route('rols.store')}}" method="POST" id="frmCreate">
                        @csrf

                        <input type="hidden" name="permissions" id="permissions">
                        <input type="hidden" name="sections" id="sections">

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name" placeholder="Nombre..." class="form-control">
                                <label for="">Nombre</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Secciones --}}
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="car-tittle">Secciones</h3>

                    <div class="row">
                        @foreach($sectionGroups as $key => $group)

                            <div class="col-md-3 mt-3">
                                @foreach($group as $item)
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input section" data-section-id="{{ $item->id }}" id="section_{{ $item->id }}">

                                        <label for="section_{{ $item->id }}" class="form-check-label">{{ $item->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- Permisos --}}
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="car-tittle">Permisos</h3>

                    <div class="row">
                        @foreach($modules as $key => $module)

                            <div class="col-md-3 mt-3">

                                <h5>{{ $key }}</h5>

                                @foreach($module as $item)
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input permission" data-permission-id="{{ $item->id }}" id="permission_{{ $item->id }}">

                                        <label for="permission_{{ $item->id }}" class="form-check-label">{{ $item->description }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" form="frmCreate" id="btnSave">Guardar</button>
                <button href="{{ route('rols.index') }}" class="btn btn-secundary">Volver</button>
            </div>
    </section>
@endsection

<script type="module">
    $(document).ready(function() {
        $('#btnSave').click(function(event) {
            //Secciones
           const sections = $('.section:checked')

           let sectionsIds = [];

           sections.each(function () {
                const permissionId = $(this).data('section->id');
                sectionsIds.push(sectionId);
           });

           console.log(sectionsIds);

           $('#sections').val(JSON.stringify(sectionsIds));

           //Permisos
           const permissions = $('.permission:checked')

           let permissionsIds = [];

           permissions.each(function () {
                const permissionId = $(this).data('permission->id');
                permissionsIds.push(permissionId);
           });

           $('#permissions').val(JSON.stringify(permissionsIds));
        });
    });
</script>
