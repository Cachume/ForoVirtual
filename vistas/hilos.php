<main class="main-hilos">
        <div class="hilos-titulos">
            <h1>Programacion</h1>
            <a href="index.php?u=secciones&m=crearpublicacion&sec=<?php echo$_GET['sec'];?>">Crear publicacion</a>
        </div>
        <div class="publicaciones">
            <?php
            if(!$datos){
                echo "<br><h1>No hay publicaciones en este tema<h1>
                    <span>Utiliza el boton que dice Crear publicacion que se encuentra en el header</span>
                ";
            }else{
        foreach ($datos as $fila) {
            ?>   
            <div class="publicacion_item">
                <div class="publicacion_info">
                    <a href="index.php?u=secciones&m=hilosrespuesta&p=<?php echo $fila['id']; ?>"><?php echo $fila['titulo'];?></a>
                    <p><?php echo $fila['cuerpo']; ?></p>
                </div>
                <div class="publicacion_autor">
                    <img src="public/img/user_img/<?php echo $fila['fotoperfil']; ?>" alt="" srcset="">
                    <span><?php echo $fila['nombres']." ".$fila['apellidos'];?></span>
                </div>
            </div>
            <?php }} ?>
        </div>
    </main>