<main class="main_temas">
        <div class="tablatemas">
            <div class="titulos">
                <h1>Temas Registrados</h1>
                <button class="boton_verde" id="botontema">Añadir Tema</button>
            </div>
            <?php
                if(!empty($mensaje)){
                    echo'
                    <div class="'.$mensaje[0].'">
                        <span>'.$mensaje['1'].'</span>
                    </div>
                    ';
                }
            ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tema</th>
                    <th style="width: 400px;">Descripción</th>
                    <th>Acciones</th>
                </tr>
                <?php
                    if(!$datos){
                        echo "<tr>
                            <td colspan='4' >No hay temas :(</td>
                            </tr>
                        ";
                    }else{
                        foreach ($datos as $fila) {
                ?>   
                
                <tr>
                    <td><?php echo $fila['id_tema'];?></td>
                    <td><?php echo $fila['tema'];?></td>
                    <td><?php echo $fila['descripcion'];?></td>
                    <td>
                        <form action="" method="post">
                            <a href="eliminar_usuario.php?idu=<?php echo $fila['id_tema']?>" class="boton_rojo">Eliminar</a>
                            <a href="editar_usuario.php?idu=<?php echo $fila['id_tema']?>" class="boton_verde">Editar</a>
                        </form>
                    </td>  
                </tr>
                <?php }}?>
            </table>
        </div>
    </main>   
    <div class="ventanatema" id="ventanatema">
        <div class="fondotema" id="fondotema"></div>
        <form action="index.php?u=admin&m=addtheme" method="post">
            <h2>Añadir Tema</h2>
            <label for="nombretema">Ingresa el nombre del tema:</label>
            <input type="text" name="nombretema" id="">
            <label for="descripciontema">Ingresa la descripcion del tema:</label>
            <textarea name="descripciontema" id="" cols="30" rows="10"></textarea>
            <div class="form_botones">
                <button type="submit" name="newtheme">Añadir tema</button>
                <button class="boton_rojo" id="closev" type="button" ">Cerrar</button>
            </div>
        </form>
    </div>