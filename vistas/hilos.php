<main class="main-hilos">
    <?php
        if(!$datos){
            echo "<br><h1>No hay publicaciones en este tema<h1>
                <span>Utiliza el boton que dice Crear publicacion que se encuentra en el header</span>
            ";
        }else{
      foreach ($datos as $fila) {
        ?>   
    <div class="hilo">
        <div class="pregunta">
            <div class=botones>
                <?php if(isset($_SESSION['id']) && $_SESSION['rol'] < 4){
                    echo '
                    <a class="boton-externo" href="index.php?u=secciones&publi='.$fila['id_tema'].'&m=crearpublicacion">Cerrar Hilo</a>
                    ';
                }?>
                <button style="display:none" class="boton-externo">Cerrar Hilo</button>
            </div>
            <div class="contpregunta">
                <h2><a href="index.php?u=secciones&m=hilosrespuesta&p=<?php echo $fila['id']; ?>"><?php echo $fila['titulo']; ?></a></h2>
                <p>
                <?php echo $fila['cuerpo']; ?>
                </p>
            </div>
            <div class="usuario">
                <img src="public/img/user_img/<?php echo $fila['fotoperfil']; ?>" alt="Foto de Perfil">
                <h3><?php echo $fila['nombres']." ".$fila['apellidos'];?></h3>
            </div>
        </div>
    </div>
    <?php }} ?>
</main>