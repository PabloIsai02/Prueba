@extends('layouts.main')

@section('title', 'La Maleza Café')

@section('menu')
<!-- Barra de Navegación -->
<nav id="menu" class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/images/logo2.png') }}" class="images" alt="100" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#productos">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#servicios">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contacto">Contacto</a>
            </li>
        </ul>
        <form class="d-flex">
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Registrarse</a>
        </form>
    </div>
    </div>
</nav>
@endsection

@section('content')
<!-- Carrusel de Imágenes -->
<div class="banner">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">         
        <div class="carousel-inner">             
            <div class="carousel-item active">                
                <div class="d-flex justify-content-center"> <!-- Cambiado a justify-content-center para centrar horizontalmente -->
                    <img src="{{ asset('assets/images/A3.jpg') }}" class="custom-image" alt="Imagen 1">
                    <img src="{{ asset('assets/images/A1.jpg') }}" class="custom-image" alt="Imagen 2">
                    <img src="{{ asset('assets/images/A3.jpg') }}" class="custom-image" alt="Imagen 3">
                </div>            
            </div>             
            <div class="carousel-item">                 
                <div class="d-flex justify-content-center"> <!-- Cambiado a justify-content-center para centrar horizontalmente -->
                    <img src="{{ asset('assets/images/HomePage2.jpeg') }}" class="custom-image" alt="Imagen 4">
                    <img src="{{ asset('assets/images/HomePage2.jpeg') }}" class="custom-image" alt="Imagen 5">
                    <img src="{{ asset('assets/images/A7.jpg') }}" class="custom-image" alt="Imagen 6"> 
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


<!-- Encabezado con Jumbotron -->
<header class="jumbotron text-center" style="font-family: 'Playfair Display', cursive;">
    <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo de La Maleza Café" style="max-width: 200px; height: auto;">
    <p class="lead">¡Ven a disfrutar en la Maleza!</p>
</header>


<!-- Sección de Productos -->
<section id="productos" class="container-fluid section-container productssectionclass">
    <!-- Carrusel de Productos -->
    <div id="carouselProductos" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="image-container">
                    <img src="{{ asset('assets/images/producto3.jpg') }}" class="d-block w-100" alt="Producto 1">
                </div>
                <div class="text-container">
                    <h5>¿Ya nos visitaste?</h5>
                    <p>Disfruta de nuestro café de especialidad al igual que nuestra gran variedad de platillos que te encantarán.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="image-container">
                    <img src="{{ asset('assets/images/producto1.jpg') }}" class="d-block w-100" alt="Producto 2">
                </div>
                <div class="text-container">
                    <h5>Encuentra tu bebida favorita</h5>
                    <p>Prueba nuestra deliciosa barra de bebidas tanto frías como calientes.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="image-container">
                    <img src="{{ asset('assets/images/producto2.jpg') }}" class="d-block w-100" alt="Producto 3">
                </div>
                <div class="text-container">
                    <h5>¿Vienes de pasada?</h5>
                    <p>Lleva contigo nuestro delicioso café!, contamos con opciones para llevar.</p>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>


<!-- Sección de Servicios -->
<section id="servicios" class="container-fluid clasedeservicios">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="image-container">
                <img src="{{ asset('assets/images/servicio2.jpeg') }}" class="d-block w-100" alt="Servicio 1">
            </div>
            <div class="text-container">
                <h5>¡Nos encanta que nos etiquetes!</h5>
                <p>Síguenos en todas nuestras redes sociales, encuéntranos como @lamalezacafe</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-container">
                <img src="{{ asset('assets/images/servicio2.jpg') }}" class="d-block w-100" alt="Servicio 2">
            </div>
            <div class="text-container">
                <h5>Clases de Barismo</h5>
                <p>Aprende todo sobre el mundo del barismo en nuestras clases especializadas, impartidas por expertos en café.</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-container">
                <img src="{{ asset('assets/images/servicio4.jpg') }}" class="d-block w-100" alt="Servicio 3">
            </div>
            <div class="text-container">
                <h5>En nuestra sucursal</h5>
                <p>Contamos con espacios al aire libre en nuestra terraza así como área refrigerada al interior de nuestro local.</p>
            </div>
        </div>
    </div>
</section>



<section id="reparaciones" class="container-fluid section-container2">
    <!-- Sección 2 -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="image-container3">
                <img src="{{ asset('assets/images/servicio4.jpeg') }}" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="text-container3">
                <h5>En nuestra sucursal</h5>
                <p>Contamos con espacios al aire libre en nuestra terraza así cómo área refrigerada al interior de nuestro local.</p>
                <div class="scrollable-list">

                </div>
            </div>
        </div>
    </div>

    <section id="opiniones" class="container-fluid section-container2">
    <h2 class="text-center mb-4">Opiniones de nuestros clientes:</h2>
    <div class="row">
        <!-- Tarjeta de opinión 1 -->
        <div class="col-md-4 tarjetitasdeopinion">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Excelente experiencia</h5>
                    <p class="card-text">La atención y calidad de los productos es increíble. ¡Volveré pronto!</p>
                    <div class="rating">
                        <img src="{{ asset('assets/images/estrella.png') }}" alt="Estrella" class="estrella">
                        <span class="score">4.5</span> <!-- Puntuación ficticia -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Tarjeta de opinión 2 -->
        <div class="col-md-4 tarjetitasdeopinion">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ambiente acogedor</h5>
                    <p class="card-text">Siempre disfruto pasar tiempo en La Maleza Café. ¡Recomendado!</p>
                    <div class="rating">
                        <img src="{{ asset('assets/images/estrella.png') }}" alt="Estrella" class="estrella">
                        <span class="score">4.2</span> <!-- Puntuación ficticia -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Tarjeta de opinión 3 -->
        <div class="col-md-4 tarjetitasdeopinion">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Café de calidad</h5>
                    <p class="card-text">Los mejores cafés que he probado. ¡No puedo esperar para volver!</p>
                    <div class="rating">
                        <img src="{{ asset('assets/images/estrella.png') }}" alt="Estrella" class="estrella">
                        <span class="score">4.8</span> <!-- Puntuación ficticia -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Tarjeta de opinión 4 -->
        <div class="col-md-4 tarjetitasdeopinion">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Atención al cliente excepcional</h5>
                    <p class="card-text">El personal siempre es amable y servicial. ¡Una experiencia increíble!</p>
                    <div class="rating">
                        <img src="{{ asset('assets/images/estrella.png') }}" alt="Estrella" class="estrella">
                        <span class="score">4.6</span> <!-- Puntuación ficticia -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Tarjeta de opinión 5 -->
        <div class="col-md-4 tarjetitasdeopinion">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Recomendado 100%</h5>
                    <p class="card-text">Si buscas un buen café y un lugar agradable, La Maleza Café es el indicado.</p>
                    <div class="rating">
                        <img src="{{ asset('assets/images/estrella.png') }}" alt="Estrella" class="estrella">
                        <span class="score">4.7</span> <!-- Puntuación ficticia -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Tarjeta de opinión 6 -->
        <div class="col-md-4 tarjetitasdeopinion">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Mi lugar favorito</h5>
                    <p class="card-text">Siempre me siento bienvenido y disfruto de la experiencia cada vez.</p>
                    <div class="rating">
                        <img src="{{ asset('assets/images/estrella.png') }}" alt="Estrella" class="estrella">
                        <span class="score">4.9</span> <!-- Puntuación ficticia -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Sección de Eventos Especiales o Promociones -->
<section id="eventos" class="container-fluid">
    <h2 class="text-center mb-4">Eventos Especiales</h2>
    <div class="row">
        <!-- Tarjeta de evento especial 1 -->
        <div class="col-md-4 eventosespecialestarjeta">
            <div class="card mb-4">
                <div class="card-body">
                    <img src="{{ asset('assets/images/A8.jpg') }}" alt="Evento 1" class="evento-imagen">
                    <div class="evento-contenido">
                        <h5 class="card-title">Noche de Jazz en Vivo</h5>
                        <p class="card-text">Disfruta de una noche llena de música jazz en vivo. ¡No te lo pierdas!</p>
                        <div class="date">Viernes, 25 de Abril</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tarjeta de evento especial 2 -->
        <div class="col-md-4 eventosespecialestarjeta">
            <div class="card mb-4">
                <div class="card-body">
                    <img src="{{ asset('assets/images/A6.jpg') }}" alt="Evento 2" class="evento-imagen">
                    <div class="evento-contenido">
                        <h5 class="card-title">Cata de Café Gratuita</h5>
                        <p class="card-text">Ven y descubre los secretos detrás de nuestros cafés en nuestra cata gratuita.</p>
                        <div class="date">Sábado, 26 de Abril</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tarjeta de evento especial 3 -->
        <div class="col-md-4 eventosespecialestarjeta">
            <div class="card mb-4">
                <div class="card-body">
                    <img src="{{ asset('assets/images/A5.jpg') }}" alt="Evento 3" class="evento-imagen">
                    <div class="evento-contenido">
                        <h5 class="card-title">Happy Hour de Café</h5>
                        <p class="card-text">¡Aprovecha nuestro happy hour de café y obtén descuentos en tus bebidas favoritas!</p>
                        <div class="date">Domingo, 27 de Abril</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






</section>
<!-- Contenedor de la sección de contacto -->
<section id="contacto" class="main-container">
    <!-- Información de contacto -->
    <div class="left-half">
    <div class="contact-image">
        <img src="{{ asset('assets/images/GT1.png') }}" alt="15" height="25">
    </div>
    <h2>Acerca de Nosotros:</h2>
    <p><strong>Dirección:</strong> Av. Niños Héroes 75-D Col. Centro</p>
    <p><strong>Horario:</strong> Lunes a Domingo: 9:00 AM - 10:00 PM </p>
    <p><strong>Teléfono:</strong> (662) 353-3778</p>
    <p><strong>Correo:</strong> lamalezacafe@gmail.com</p> 
</div>


    <!-- Formulario de contacto -->
    <div class="center-half">
        <h2>Contacto</h2>
        <form class="contact-form">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="email" placeholder="Ingrese su correo">
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular:</label>
                <input type="tel" class="form-control" id="celular" placeholder="Ingrese su número de celular">
            </div>
        </form>
        <form class="buton" onsubmit="mostrarToast(event)">
            <button type="submit" class="btn btn-primary" style="background-color: #212529">Enviar</button>
        </form>
        <!-- Toast para confirmar el envío del formulario -->
        <div id="miToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                ¿Los datos introducidos son correctos?
                <div class="mt-2 pt-2 border-top">
                    <button type="button" class="btn btn-primary btn-sm" onclick="realizarAccion()">Sí</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Descarga de la aplicación -->
    <div class="right-half">
    <h2 style="color: #212529">Nuestro Menú:</h2>
    <a href="https://www.madiffy.com/menu">
        <div class="app-logo">
            <img src="{{ asset('assets/images/logo5.png') }}" alt="Logo de la App" width="150" height="150">
        </div>
    </a>
</div>

</section>

<!-- Pie de página -->
<footer class="text-center p-4 text-white" style="background-color: #212529">
    <p> Desarrollado por 
        <a href="#" style="color: #ffffff;">Pablo Ortiz</p>
</footer>
@endsection
