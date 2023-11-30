<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No tienes permitido usar este sitio</title>
    <link rel="stylesheet" href="public/css/baneado.css">
    <link rel="stylesheet" href="public/css/normalize.css">

</head>
<body>
    <main class="main_ban">
            <div class="ban_imagen">
            <img src="public/img/user_img/<?php echo (!empty($_SESSION['imagen']))?$_SESSION['imagen']:"usuario.png";?>" alt="">
                <img src="public/img/cuenta-privada.png" alt="">
            </div>
            <div class="ban_datos">
                <h2>Foro Virtual | UPT "Jose Felix Ribas"</h5>
                <h3>Oh! has sido baneado del sitio :c</h3>
                <br>
                <h4>Baneado por: <?php echo $datos['nombres']." ".$datos['apellidos'];?></h4>
                <h4>Razon:<?php echo $datos['razon'];?></h4>
                <h4>Baneado el: <?php echo $datos['fecha'];?></h4>
                <br><br>
                <a href="index.php?ban=salir">Cerrar Sesión</a>
                <p>
                    Si crees que se trata de algun error contacta con el administrador del sitio
                </p>
            </div>

    </main>
    
</body>
</html>