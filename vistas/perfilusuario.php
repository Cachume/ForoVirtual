<main class="main_profile">
        <h2 class="nombreperfil">Perfil de <?php echo $_SESSION['nombres']." ".$_SESSION['apellidos']; ?></h2>
        <div class="perfil" style="background-image: url('public/img/<?php echo $retVal = ($_SESSION['correo']=="albertq703@gmail.com") ? "wallpaperbetter.jpg" : "upt2.png";?>')">
            <div class="perfil_info">
                <div class="perfil_user">
                    <img src="public/img/user_img/<?php echo $_SESSION['imagen'];?>" alt="" class="perfil_user_img">
                    <span class="names" ><?php echo $_SESSION['nombres']." ".$_SESSION['apellidos']; ?></span>
                    <span class="<?php echo $rol;?>" id="<?php echo $rol;?>" ><?php echo $rol;?></span>
                    <div class="perfil_user_data">
                        <div class="data">
                            <h5>Registrado el:</h5>
                            <span><?php echo $datosusuario['registro'];?></span>
                        </div>
                        <div class="data">
                            <h5>Fecha de nacimiento:</h5>
                            <span><?php echo $datosusuario['fdn'];?></span>
                        </div>
                        <div class="data">
                            <h5>Carrera:</h5>
                            <span><?php echo $datosusuario['pnf'];?></span>
                        </div>
                        <div class="data">
                            <h5>Sexo:</h5>
                            <span><?php echo $datosusuario['sexo'];?></span>
                        </div>
                    </div>
                </div>
                <div class="perfil_post">
                    <h1>Mis publicaciones</h1>
                    <div class="perfil_posts">
                    <?php
                        if(!$publicaciones){
                            echo "<br><h1>No hay publicaciones";
                        }else{
                             foreach ($publicaciones as $fila) {
                        ?>   
                        <div class="post">
                            <br>
                            <h1><?php echo $fila['titulo']?></h1>
                            <br>
                            <p><?php echo $fila['cuerpo']?></p>
                            <br>
                            <?php if($fila['imagen']!=""){
                                echo '<img src="public/img/publi_img/'.$fila['imagen'].'" width="280px" height="150px" alt="" srcset="">';
                            }
                            ?>
                        </div>
                        <?php }}?>
                    </div>
                </div>
            </div>
        </div>
    </main>