<main class="main_usuarios">
    <br><br>
    <div class="titulos">
            <h1>Sancionar Usuario</h1>
        </div>

        <form action="index.php?u=admin&m=usersan" class="formban" method="post">
            <div class="formban_imgs">
                <img src="public/img/icons/confundido.png" alt="">
                <img src="public/img/icons/bloquear(1).png" alt="">
                <img src="public/img/user_img/<?php echo (!empty($datos['fotoperfil']))?$datos['fotoperfil']:"usuario.png";?>" alt="">
            </div>
            <h3>¿Porque razon quieres sancionar a <?php echo $datos['nombres']." ".$datos['apellidos'];?>?</h3>
            <input type="text" name="razon" placeholder="Motivo"  required>
            <input type="hidden" name="idu" value="<?php echo $datos['id']?>">
            <h3>¿Estas seguro de proceder con la sanción?</h3><br>
            <div class="mensaje_botones">
                <button type="submit" name="accion" value="banuser" class="boton_verde">Aceptar</button>
                <a type="submit" href="index.php?u=admin&m=sanciones" class="boton_rojo">Cancelar</a>
                </div>
        </form>

    <div class="alertas">      
     <?php //Alertas de error
         echo (isset($alerta)) ? $alerta : $alerta='';?>
    </div>
</main>