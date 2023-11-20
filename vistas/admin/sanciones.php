<main class="main_usuarios">

        <div class="titulos">
            <h1>Usuarios Sancionados</h1>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Sancionado por:</th>
                <th>Razon</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            <?php
                if(!$datos){
                    echo "<tr >
                        <td colspan='7'>No hay sanciones. ¿No te gustaria sancionar a un usuario? >:D</td>
                        </tr>
                    ";
                }else{
                    foreach ($datos as $fila) {
            ?>
            <tr>
                <td><?php echo $fila['id_user']?></td>
                <td><?php echo $fila['id_sancionador']?></td>
                <td><?php echo $fila['razon']?></td>
                <td><?php echo $fila['fecha']?></td>
                <td>
                    <form action="index.php?u=admin&m=unsanc" method="post">
                        <input type="number" style="display:none;" name="idu" value="<?php echo $fila['id_user']?>">
                    <button class="boton_rojo" type="submit" name="metodo" value="unban">Desbanear</button>
                    </form>
                </td>  
            </tr>

     <?php
            }}
            ?>
        </table>

    </main>

</body>
</html>