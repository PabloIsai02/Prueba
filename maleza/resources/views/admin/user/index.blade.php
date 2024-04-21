@extends('layouts.panel')

@section('title', 'Users-Admin')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<h1 class="mt-4 text-center">
    <a href="{{ route('admin') }}" style="color: #212529; text-decoration: none; margin-right: 10px;"><i class="fas fa-arrow-left"></i></a>
    Control de Usuarios
</h1>
<div class="mb-3 d-flex justify-content-center">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUUModal"><i class="fas fa-plus"></i> Añadir Usuario</button>
</div>

<div class="container-xl d-flex justify-content-center align-items-center">


<!-- HTML -->
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Dashboard</a>
        <!-- Navbar Search-->
        @if(auth()->user()->level_id === 1)
            <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="{{ route('search') }}" method="GET">
                <div class="input-group">
                    <input class="form-control" type="text" name="query" placeholder="Buscar entidad..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        @endif
        <!-- Navbar Dropdown -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Sidebar Menu Items -->
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="{{ route('admin') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home-alt"></i></div>
                            Inicio
                        </a>
                        <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-copy"></i></div>
                            Secciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('products') }}">
                                    <i class="fas fa-mug-hot fa-sm me-2"></i> Productos
                                </a>
                                @if(auth()->user()->level_id === 1)
                                    <a class="nav-link" href="{{ route('user') }}">
                                        <i class="fas fa-user fa-sm me-2"></i> Usuarios
                                    </a>
                                    <a class="nav-link" href="{{ route('customers.index') }}">
                                        <i class="fas fa-users fa-sm me-2"></i> Clientes
                                    </a>
                                    <a class="nav-link" href="{{ route('orders') }}">
                                        <i class="fas fa-clipboard fa-sm me-2"></i> Ordenes
                                    </a>
                                    <a class="nav-link" href="{{ route('suppliers') }}">
                                        <i class="fas fa-truck-field fa-sm me-2"></i> Proveedores
                                    </a>
                                @endif
                            </nav>
                        </div>
                        @if(auth()->user()->level_id === 1)
                            <a class="nav-link" href="{{ route('personal') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                                Personal
                            </a>
                            <a class="nav-link" href="{{ route('orders') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard"></i></div>
                                Ordenes
                            </a>
                        @endif
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">{{auth()->user()->level->name }} Logueado</div>
                    @auth
                        {{ auth()->user()->name . ' ' . auth()->user()->surname }}
                    @endauth
                </div>
            </nav>
        </div>




    <!-- Alertas de notificación -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;"> <!-- Añadido estilo para margen superior -->
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 20px;"> <!-- Añadido estilo para margen superior -->
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-striped table-hover">
                <!-- Table Header -->
                <thead>
                    <tr>
                        {{-- <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th> --}}
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Nivel</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            {{-- <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{$user['id']}}" name="options[]" value="{{$user['id']}}">
                                    <label for="checkbox{{$user['id']}}"></label>
                                </span>
                            </td> --}}
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status == 1 ? 'Activo' : 'Inactivo' }}</td>
                            <td>{{ $user->level->name }}</td>
                            <td>{{$user['Imagen']}}</td>
                            <td class="d-flex align-items-center">
                                <form action="{{ route('destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este Usuario?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination and Other Elements -->
            <div class="hint-text">Mostrando <b>{{count($users)}}</b> resultados de un total de <b>{{ $users->total() }}</b></div>
        </div>
    </div> 
</div>

<div class="modal fade" id="addUUModal" tabindex="-1" aria-labelledby="addUUModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUUModalLabel">Añadir Usuario:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí va el formulario para añadir un nuevo administrador -->
                <form action="{{ route('añadir-usuario') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <label for="surname">Apellido:</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                        <label for="phone">Celular:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <label for="image">Imagen:</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>                        
        </div>
    </div>
</div>
@endsection
