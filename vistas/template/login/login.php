<?php
include_once("modelos/model_login.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay un mensaje de error en la sesión
if (isset($_SESSION['error'])) {
    // Mostrar el mensaje de error
    echo '<div class="error-message">' . $_SESSION['error'] . '</div>';

    // Eliminar el mensaje de error de la sesión para que no se muestre nuevamente después de recargar la página
    unset($_SESSION['error']);
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Iniciar Sesión</title>

<div class="container justify-content-center d-flex mt-5 mb-5">
    <div class="login-container">
        <div class="login-logo-container">
            <img src="" alt="Logo Intelisof" />
        </div>
        <form action="loginProcess.php" method="post">
            <div class="login-input-group">
                <span class="login-icon"><img src="recursos/iconos/usuario.svg"></span>
                <input type="text" name="username" placeholder="Usuario" class="login-input" required>
            </div>
            <div class="login-input-group">
                <span class="login-icon"><img src="recursos/iconos/pass.svg"></span>
                <input type="password" id="password" name="password" placeholder="Contraseña" class="login-input" required>

                <div class="checkbox-container">
                    <input type="checkbox" id="showPassCheck" onclick="showPassword()">
                    <label id="showPassLabel" for="showPassCheck">Mostrar Contraseña</label>
                </div>
            </div>
            <button type="submit" class="login-button">Entrar</button>
        </form>
    </div>
</div>

<?php if (isset($_SESSION['login_error'])) : ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo $_SESSION['login_error']; ?>'
        });
    </script>
    <?php
    // Limpiar el mensaje de error después de mostrarlo
    unset($_SESSION['login_error']);
    ?>
<?php endif; ?>

<script>
    function showPassword() {
        let pass = document.getElementById("password");
        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
</script>