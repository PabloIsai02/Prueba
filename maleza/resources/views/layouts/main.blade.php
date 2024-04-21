<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Enlace al CDN de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Estilos personalizados -->
</head>
<body style="background-color: #0000">
    @yield('menu')

    @yield("content")

    {{-- <!-- Enlace al CDN de Bootstrap 5 y scripts necesarios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> --}}


    <script>
        function mostrarToast(event) {
            // Previene el envío del formulario normal
            event.preventDefault();

            // Muestra el toast
            var miToast = new bootstrap.Toast(document.getElementById('miToast'));
            miToast.show();
        }

        function realizarAccion() {
            // Aquí puedes agregar la lógica para la acción que deseas realizar al hacer clic en "Take action"
            alert('Gracias por ponerte en contacto con nosotros.\nPronto el personal se comunicara con tigo.');
        }

        function ocultarToast() {
            // Oculta el toast manualmente
            var miToast = new bootstrap.Toast(document.getElementById('miToast'));
            miToast.hide();
        }
    </script>
</body>
</html>