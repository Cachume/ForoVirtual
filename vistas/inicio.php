<div class="formularioinicio">

    <form class="inicio" method="post" action="index.php?u=inicio&m=loginuser">
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
        <h1>Foro Virtual</h1>
        <h2>Universidad Politecnica Territorial <br>"Jose Felix Ribas" </h2>

        <h4>Inicio de Sesión</h4>
        <input class="datos" type="email" name="correouser" placeholder="Correo Electronico" required>
        <input class="datos" type="password" name="contrasenauser" placeholder="Contraseña" required>
        <p><a href="index.php?u=recuperar">¿Olvido su Contraseña?</a></p>
        <input class="boton" type="submit" name="login" value="Iniciar Sesión">
        <p><a href="index.php?u=registro">¿No tengo cuenta?</a></p>
    </form>

    <img class="imagen" src="public/img/4.png" alt="">
</div>