@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrate') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Resto del formulario -->

                        <!-- Campo de Selección de Nivel de Usuario -->
                        <div class="row mb-3">
                            <label for="level" class="col-md-4 col-form-label text-md-end">{{ __('Nivel de Usuario') }}</label>
                            <div class="col-md-6">
                                <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                                    <option value="3" selected>Usuario</option>
                                    <option value="2">Empleado</option>
                                    <option value="1">Administrador</option>
                                </select>
                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarte') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validación para mostrar o no el buscador de entidad -->
@auth
    @if(auth()->user()->level_id !== 3)
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="{{ route('search') }}" method="GET">
            <div class="input-group">
                <input class="form-control" type="text" name="query" placeholder="Buscar entidad..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    @endif
@endauth
@endsection
