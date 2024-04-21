@extends('layouts.panel')

@section('title', 'Editar Persona')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('personal') }}" style="color: #212529; text-decoration: none; margin-right: 10px;"><i class="fas fa-arrow-left"></i></a>
            Actualizacionde datos de {{ $persona->name . ' ' .  $persona->surname }}
        </h1>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="text-center">
            @if($persona->image)
                <img src="{{ asset('image/Perfil/' . $persona->image) }}" alt="Foto de perfil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            @else
                <img src="{{ asset('image/Perfil/Perfil.png') }}" alt="Foto de perfil por defecto" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user me-1"></i>
                        Información Personal
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('update', $persona->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <input type="hidden" name="id" value="{{ $persona->id }}">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $persona->name }}" required>
                                <label for="surname">Apellido:</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{ $persona->surname }}" required>
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $persona->email }}" required>
                                <label for="phone">Celular:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $persona->phone }}" required>
                                <label for="level_id">Nivel:</label>
                                <input type="number" class="form-control" id="level_id" name="level_id" value="{{ $persona->level_id }}" min="1" max="3" required>
                            </div>                            
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                <button id="cancelEdit" class="btn btn-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelEdit = document.getElementById('cancelEdit');

        cancelEdit.addEventListener('click', function(event) {
            event.preventDefault();
            window.history.back(); // Volver a la página anterior al hacer clic en el botón de cancelar
        });
    });
</script>

@endsection