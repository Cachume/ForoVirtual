<main class="main_publicacion">
        <div class="publicacion">
            <div class="user_publicacion">
                <div class="publicacionbotones">
                    <a href="index.php?u=secciones&m=hilos&sec=<?php echo $datos['id_tema']?>">🡸 Regresar</a>
                    <?php
                    if(!$datos['estado']=="Cerrado"){
                        ?>
                        <a href="index.php?u=secciones&m=cerrarhilo&sec=<?php echo $datos['id']?>">Cerrar hilo</a>
                    <?php }
                    ?>
                </div>
                <h1><?php echo $datos['titulo'];?></h1>
                <p> <?php echo $datos['cuerpo'];?></p>
                <img src="public/img/publi_img/<?php echo $datos['imagen'];?>" alt="" srcset="">
                <div class="user_data">
                    <img src="public/img/user_img/<?php echo $datos['fotoperfil'];?>" alt="">
                    <span>Publicación creada por: <?php echo $datos['nombres']." ".$datos['apellidos'];?></span>
                </div>
                <div class="respuesta">
                    <?php if(isset($_SESSION['id']) && $datos['estado']==""){echo '<button id="abrirPopup">Responder</button>';}?>

                    <div id="popup" class="overlay">
                        <div class="popup">
                            <h2>Responder</h2>
                            <a class="cerrar" href="#">&times;</a>
                            <form id="formulario" method="post" action="index.php?u=secciones&p=<?php echo $datos['id'];?>&m=guardarcomentario" enctype="multipart/form-data">
                                <input type="hidden" name="comentarioid" value="<?php echo $datos['tabla_comentarios'];?>">
                                <textarea name="cuerpo" placeholder="Escribe tu respuesta..." required></textarea>
                                <input type="file" name="imagen" accept="image/*" multiple>
                                <button type="submit" name="respuesta">Responder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="publicacion_comentario">
                <h2>Comentarios</h2>
                <?php
                    if(!$datosc){
                        echo "
                            <span>Sin comentarios</span>
                        ";
                    }else{
                        foreach ($datosc as $fila) {
                        $user=$this->getuser($fila['id_user']);
                    ?>   
                    <div class="user_comentario">
                        <p><?php echo $fila['comentario']?></p>
                        <img class="user_comentario_img" src="public/img/comen_img/<?php echo $fila['imagen'];?>" alt="" srcset="">
                        <div class="user_data">
                            <img src="public/img/user_img/<?php echo $user['fotoperfil'];?>" alt="">
                            <span>Comentario creado por: <?php echo $user['nombres']." ".$user['apellidos'];?></span>
                        </div>
                    </div>
                <?php }} ?>
            </div>
        </div>
    </main>