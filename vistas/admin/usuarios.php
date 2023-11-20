<main class="main_usuarios">
        <div class="titulos">
            <h1>Usuarios Registrados</h1>
            
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo Electronico</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php
                if(!$datos){
                    echo "<br><h1>No hay publicaciones en este tema<h1>
                        <span>Utiliza el boton que dice Crear publicacion que se encuentra en el header</span>
                    ";
                }else{
                    foreach ($datos as $fila) {
            ?>   
            <tr>
                <td><?php echo $fila['id']?></td>
                <td><?php echo $fila['nombres']?></td>
                <td><?php echo $fila['apellidos']?></td>
                <td><?php echo $fila['correo']?></td>
                <td><?php echo $fila['rol']?></td>
                <td>
                    <form action="" method="post">
                        <a href="eliminar_usuario.php?idu=<?php echo $fila['id']?>" class="boton_rojo">Eliminar</a>
                        <a href="editar_usuario.php?idu=<?php echo $fila['id']?>" class="boton_verde">Editar</a>
                        <a href="index.php?u=admin&m=sancionar&idu=<?php echo $fila['id']?>" class="boton_rojo">Banear</a>
                    </form>
                </td>  
            </tr>

     <?php
            }}
            ?>
        </table>

    </main>
