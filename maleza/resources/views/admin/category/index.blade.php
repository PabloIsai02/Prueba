@extends('layouts.panel')

@section('title', 'Categorías Admin')

@section('content')
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

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

        <!-- Main Content -->
        <div class="container-xl" style="padding-left: 250px;">
            <!-- Notification Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Add Category Button -->
            @if(auth()->user()->level_id === 1)
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-6">
                        <h2>Categorías</h2>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategoryModal">
                            <i class="material-icons">&#xE147;</i> <span>Agregar nueva categoría</span>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Categories Table -->
            <div class="table-responsive" style="margin-right: 0;">
                <div class="table-wrapper">
                    <table class="table table-striped table-hover">
                        <!-- Table Header -->
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Creado</th>
                            <th>Actualizado</th>
                            @if(auth()->user()->level_id === 1)
                                <th class="text-end">Acciones</th>
                            @endif
                        </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->Nombre }}</td>
                                <td>{{ $category->Creado ?: 'No encontrado' }}</td>
                                <td>{{ $category->Updated ?: 'No encontrado' }}</td>
                                @if(auth()->user()->level_id === 1)
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#editCategoryModal{{ $category->id }}">
                                            Editar
                                        </button>
                                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>

                            <!-- Edit Category Modal -->
                            <div class="modal" id="editCategoryModal{{ $category->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Editar Categoría</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Category Name Field -->
                                                <div class="form-group">
                                                    <label for="name">Nombre</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           value="{{ $category->Nombre }}" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Category Modal -->
        @if(auth()->user()->level_id === 1)
            <div class="modal" id="addCategoryModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Nueva Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Add Category Form -->
                            <form action="{{ route('admin.category.store') }}" method="POST">
                                @csrf
                                <!-- Category Name Field -->
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Categoría</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

@endsection
