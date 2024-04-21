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
        <a class="navbar-brand ps-3" >Dashboard</a>
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
                
                <div class="sb-sidenav-footer">
                    <div class="small">{{auth()->user()->level->name }} Logueado</div>
                    @auth
                    {{ auth()->user()->name . ' ' . auth()->user()->surname }}
                    @endauth
                </div>
            </nav>
        </div>
   

        
        <div id="layoutSidenav_content">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container-fluid px-4">
                    <h1 class="mt-4" style="color: #212529">Bienvenido 
                    @auth
                        {{ auth()->user()->name }}
                    @endauth
                    </h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">{{ auth()->user()->level->name }}</li>
                    </ol>
                    <div class="row">
                        <!-- Tarjeta de Productos -->
                        <div class="col-md-4">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Productos</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('products') }}">Ver Productos</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta de Categorías -->
                        <div class="col-md-4">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Categorías</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('category') }}">Ver Categorías</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <!-- Solo mostrar si el nivel del usuario es 1 (Administrador) -->
                        @if(auth()->user()->level_id === 1)
                            <div class="col-md-4">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Clientes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('customers.index') }}">Ver Clientes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Ordenes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('orders') }}">Ver Ordenes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Proveedores</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('suppliers') }}">Ver Proveedores</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Nuevo div para usuarios -->
                            <div class="col-md-4">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Usuarios</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('user') }}">Ver Usuarios</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del nuevo div para usuarios -->
                        @endif
                    </div>
                    @yield('content')
                </div>
            </main>
            <footer class="py-4 mt-auto" style="background-color: #f8f9fa">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; La Maleza OS</div>
                        <div>
                            <a href="" style="color: #2A6376">Privacy Policy</a>
                            &middot;
                            <a href="" style="color: #2A6376">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
