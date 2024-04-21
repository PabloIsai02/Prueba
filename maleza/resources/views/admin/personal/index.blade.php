@extends('layouts.panel')

@section('title', 'Admins-Admin')

@section('content')
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
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3">Dashboard</a>
        <!-- Navbar Search-->
        @if(auth()->user()->level_id === 1)
        <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="{{ route('search') }}" method="GET">
            <div class="input-group">
                <input class="form-control" type="text" name="query" placeholder="Buscar entidad..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        @endif
        <!-- Navbar-->
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
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
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
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">
                        <a href="{{ route('admin') }}" style="color: #212529; text-decoration: none; margin-right: 10px;"><i class="fas fa-arrow-left"></i></a>
                        Gestión de Personal</h1>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Ver Administradores</h5>
                                    <ol class="breadcrumb mb-4">
                                        <li class="breadcrumb-item active">
                                            Haz clic para ver los administradores.
                                        </li>
                                        <li class="breadcrumb-item active" style="display: flex; align-items: center;">
                                            <div>
                                                Añadir Administradores
                                            </div>
                                        </li>
                                    </ol>
                                    <button id="adminsButton" class="btn btn-primary"><i class="fas fa-users"></i> Ver Administradores</button>
                                    <button id="addadminButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal"><i class="fas fa-users"></i> Añadir Administradores</button>
                                </div>
                            </div>
                            <div id="adminsSection" style="display: none;">
                                @foreach($adminUsers as $adminUser)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        @if($adminUser->id != auth()->user()->id) <!-- Verificar si el usuario no es el logueado -->
                                        <a href="{{ route('edit', $adminUser->id) }}" class="float-end" style="margin-left: 10px;"><i class="fas fa-edit" style="color:#212529"></i></a>
                                        <a href="{{ route('destroy', $adminUser->id) }}" class="float-end delete-admin" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que quieres eliminar este administrador?')) { document.getElementById('deleteForm_{{ $adminUser->id }}').submit(); }">
                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                        </a>
                                        <form id="deleteForm_{{ $adminUser->id }}" action="{{ route('destroy', $adminUser->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                        <h5 class="card-title">{{ $adminUser->name }}</h5>
                                        <p class="card-text">{{ $adminUser->email }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Ver Empleados</h5>
                                    <ol class="breadcrumb mb-4">
                                        <li class="breadcrumb-item active">
                                            Haz clic para ver los Empleados.
                                        </li>
                                        <li class="breadcrumb-item active" style="display: flex; align-items: center;">
                                            <div>
                                                Añadir Empleados
                                            </div>
                                        </li>
                                    </ol>
                                    <button id="employeesButton" class="btn btn-primary"><i class="fas fa-users"></i> Ver Empleados</button>
                                    <button id="addemployeesButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i class="fas fa-users"></i> Añadir Empleados</button>
                                </div>
                            </div>
                            <div id="employeesSection" style="display: none;">
                                @foreach($employeeUsers as $employeeUser)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        @if($employeeUser->id != auth()->user()->id) <!-- Verificar si el usuario no es el logueado -->
                                        <a href="{{ route('edit', $employeeUser->id) }}" class="float-end" style="margin-left: 10px;"><i class="fas fa-edit" style="color:#212529"></i></a>
                                        <a href="{{ route('destroy', $employeeUser->id) }}" class="float-end delete-admin" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que quieres eliminar este Empleado?')) { document.getElementById('deleteForm_{{ $employeeUser->id }}').submit(); }">
                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                        </a>
                                        <form id="deleteForm_{{ $employeeUser->id }}" action="{{ route('destroy', $employeeUser->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                        <h5 class="card-title">{{ $employeeUser->name }}</h5>
                                        <p class="card-text">{{ $employeeUser->email }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/script.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide sections when buttons are clicked
        $(document).ready(function() {
            $("#adminsButton").click(function() {
                $("#adminsSection").toggle();
            });
            $("#addadminButton").click(function() {
                $("#addAdminSection").toggle();
            });
            $("#employeesButton").click(function() {
                $("#employeesSection").toggle();
            });
            $("#addemployeesButton").click(function() {
                $("#addEmployeesSection").toggle();
            });
        });
    </script>

    <!-- Modal para añadir administrador -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Añadir Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('añadir-aministrador') }}" method="POST" enctype="multipart/form-data">
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

    <!-- Modal para añadir empleado -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Añadir Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('añadir-empleado') }}" method="POST" enctype="multipart/form-data">
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

    <script>
        // Función para mostrar el modal de añadir administrador
        $("#addadminButton").click(function() {
            $('#addAdminModal').modal('show');
        });

        // Función para mostrar el modal de añadir empleado
        $("#addemployeesButton").click(function() {
            $('#addEmployeeModal').modal('show');
        });
    </script>
</body>

</html>
@endsection
