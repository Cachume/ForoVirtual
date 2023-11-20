<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo | Foro</title>
    <link rel="stylesheet" href="public/css/admin.css">
    <link rel="stylesheet" href="public/css/usuarios.css">
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="./styles/mensajes.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <aside class="aside_index">
        <div class="user_info">
            <h2>Panel Administrativo</h2>
            <img src="public/img/user_img/<?php echo (!empty($_SESSION['imagen']))?$_SESSION['imagen']:"usuario.png";?>" alt="">
            <h3><?php echo $_SESSION['nombres']." ".$_SESSION['apellidos'];?></h3>
            <a>Administrador</a>
        </div>
        <hr>
        <div class="menu">
            <ul>
                <li><img src="public/img/icons/pagina-de-inicio (1).png" alt=""><a href="index.php">Inicio</a></li>
                <li><img src="public/img/icons/grupo.png" alt=""><a href="index.php?u=admin&m=usuarios">Usuarios Registrados</a></li>
                <li><img src="public/img/icons/foro.png" alt=""><a href="index.php?u=admin&m=temas">Temas</a></li>
                <li><img src="public/img/icons/sin-parar.png" alt=""><a href="index.php?u=admin&m=sanciones">Sanciones</a></li>
                <li><img src="public/img/icons/advertencia.png" alt=""><a href="index.php?u=admin&m=errores">Errores</a></li>
                <li style="display:none;"><img src="public/img/icons/nueva-base-de-datos.png" alt=""><a href="">Base de Datos</a></li>
                <li><img src="public/img/icons/salida.png" alt=""><a href="index.php?u=perfil">Salir</a></li>
            </ul>
        </div>
    </aside>