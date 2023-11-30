<div class="formularioregis">
<form class="registro" method="post" action="index.php?u=registro&m=registrarusuario">
        <h4>Registro</h4>
        <div class="tooltip">
            <input class="controles" type="tex" name="nombres" required placeholder="Ingrese su Nombre"
            data-tooltip="Solo se admiten letras mayúsculas y minúsculas.">
        <span class="tooltiptext"></span>
        </div>
        <div class="tooltip">
            <input class="controles" type="tex" name="apellidos" required placeholder="Ingrese su Apellido"
            data-tooltip="Solo se admiten letras mayúsculas y minúsculas.">
        <span class="tooltiptext"></span>
        </div>
        
        <div class="tooltip">
            <input class="controles" type="email" name="correo" required placeholder="Ingrese su Contraseña"
            data-tooltip="No se pueden ingresar caracteres distintos a puntos, arroba y pisos bajos">
        <span class="tooltiptext"></span>
        </div>
        <div class="tooltip">
            <input class="controles" type="password" name="clave" required placeholder="Ingrese su Contraseña"
            data-tooltip="De 6 a 8 caracteres letras mayúscula y minúscula, números y
            símbolos “., $,%,#”.">
        <span class="tooltiptext"></span>
        </div>
        <input class="controles" type="password" name="Rclave" required placeholder="Confirmar  Contraseña">
            
            <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
            <input class="boton" type="submit" name="accionregis" value="Registrar">
        <p><a href="index.php?u=inicio">Ya tengo cuenta</a></p>
    </form>
    <img class="imagen" src="public/img/3.png" alt="">
</div>