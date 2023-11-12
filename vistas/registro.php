<div class="formularioregis">
    <form method="post" action="index.php?u=registro&m=registrarusuario" class="registro">
        <h4>Registro</h4>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error1">
                <?php echo $_GET['error'] ?>
            </p>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
            <p class="success">
                <?php echo $_GET['success'] ?>
            </p>
        <?php } ?>
        <input class="controles" type="text" name="nombres" required placeholder="Ingrese sus nombres">
        <input class="controles" type="text" name="apellidos" required placeholder="Ingrese sus apellidos">
        <input class="controles" type="email" name="correo" required placeholder="Ingrese su correo">
        <input class="controles" type="password" name="clave" required placeholder="Ingrese su contraseña">
        <input class="controles" type="password" name="Rclave" required placeholder="Confirmar contraseña">
        <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
        <input class="boton" type="submit" name="accionregis" value="Registrar">
        <p><a href="index.php?u=inicio">Ya tengo cuenta</a></p>
    </form>
    <img class="imagen" src="public/img/3.png" alt="">
</div>