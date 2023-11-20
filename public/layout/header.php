<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="public/css/index.css">
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="public/css/inicio.css">
    <link rel="stylesheet" href="public/css/registro.css">
    <link rel="stylesheet" href="public/css/perfil.css">
    <link rel="stylesheet" href="public/css/recuperar.css">
    <link rel="stylesheet" href="public/css/nuevaclave.css">
    <link rel="stylesheet" href="public/css/publicacion.css">
    <link rel="stylesheet" href="public/css/hilos.css">
    <link rel="stylesheet" href="public/css/secciones.css">
    <link rel="stylesheet" href="public/css/pregunta.css">
    <link rel="stylesheet" href="public/css/hilosrespuesta.css">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UPT Foro | Inicio</title>
</head>

<body>
    <div class="cintillo">
        <img src="public/img/cintillo-foro-pt1.jpg">
        <img src="public/img/cintillo-foro-pt2.jpg">
    </div>
    <header>
        <div class="h_top">
            <h2>Foro UPT "Jose Felix Ribas"</h2>
            <a href="index.php?u=inicio">Iniciar Sesion</a>
        </div>
        <nav class="h_bottom">
            <ul>
                <li><img src="public/img/icons/hogar.png"><a href="index.php">Inicio</a></li>
                <li><img src="public/img/icons/cursor-dedo.png"><a href="index.php?u=secciones">Foro</a></li>
                <li><img src="public/img/icons/globo.png"><a href="">Novedades</a></li>
                <li><img src="public/img/icons/comentario-alt.png"><a href="">Soporte</a></li>  
                <?php
                    if(isset($_SESSION['id'])){
                        echo '<li><img class="userimg" src="public/img/user_img/'.$_SESSION['imagen'].'"><a href="index.php?u=perfil">Mi Perfil</a></li>
                            <li><img src="public/img/icons/globo.png"><a href="index.php?u=perfil&m=cerrarsesion">Cerrar Sesión</a></li>
                        ';
                    }

                if (isset($_GET['m'])) {
                    if ($_GET['m'] == "hilos") {
                        echo "<li><img src='public/img/icons/comentario-alt.png'><a href='index.php?u=secciones&m=crearpublicacion&sec=".$_GET['sec']."' id='crearpublicación'>Crear Publicación</a></li>";
                    }
                }

                ?>
            </ul>
            <form action="" method="post">
                <input type="text" name="search" id="" placeholder="Busqueda.....">
                <button type="submit" hidden></button>
            </form>
        </nav>
        <nav class="h_bottom__mobile">
            <img src="public/img/icons/menu-hamburguesa32px.png" class="imgl" onclick="verpubli()">
            <ul class="lsk">
                <?php
                    if(isset($_SESSION['id'])){
                        echo '<li><img src="public/img/user_img/'.$_SESSION['imagen'].'" alt=""><a href="index.php?u=perfil">'.$_SESSION['nombres'].'</a></li>';
                    }else{
                        echo 'li><img src="public/img/icons/cerrar.png" alt=""><a href="index.php?u=inicio">Acceder</a></li>';
                    }
                ?>        
            </ul>
            <div class="h_menu" id="menu">
                <div class="h_title">
                    <h2>Menu</h2>
                    <img src="public/img/icons/cruz.png" alt="" onclick="verpubli()">
                </div>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="foro.html">Foro</a></li>
                    <li><a href="">Novedades</a></li>
                    <li><a href="">Soporte</a></li>
                </ul>
                <form action="" method="post">
                    <input type="text" name="search" id="" placeholder="Busqueda.....">
                    <button type="submit" hidden></button>
                </form>
            </div>
        </nav>
    </header>

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