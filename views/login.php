<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login y saber más</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión</p>
                    <button id="btn__iniciar-sesion">Iniciar sesión</button>
                </div>
                <div class="caja__trasera-saber">
                    <h3>¿No sabes para qué sirve?</h3>
                    <p>Conoce nuestras ventajas</p>
                    <button id="btn__saberMas">Saber más</button>
                </div>
            </div>
            <!-- Formulario de login y saber más -->
            <div class="contenedor__login-register">
                <!-- Login -->
                <form action="../controllers/AdminController.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electrónico" name="correo" required />
                    <input type="password" placeholder="Contraseña" name="contrasena" required />
                    <button type="submit" name="login">Entrar</button>
                </form>
                <!-- Saber más -->
                <form class="formulario__register">
                    <h2>Saber más</h2>
                    <article>
                        <img src="images/poster_trabajador.jpg" alt="Poster Trabajador" />
                        <img src="images/poster_hoover.png" alt="Poster Hoover" />
                    </article>
                </form>
            </div>
        </div>
    </main>

    <script src="js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const msg = urlParams.get('msg');
            const status = urlParams.get('status');

            if (msg && status) {
                Swal.fire({
                    icon: status,
                    title: status === 'success' ? 'Éxito' : 'Error',
                    text: msg
                });
            }
        });
    </script>
</body>

</html>