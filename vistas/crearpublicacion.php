<main class="main_index">
    <div class="publicacion">
        <h2>Crear una nueva publicación</h2>
        <form id="formulario" method="post" enctype="multipart/form-data" action="index.php?u=secciones&publi=<?php echo $_GET['sec']; ?>&m=guardarPublicacion">
            <input type="hidden" name="crearPublicacion" value="true">
            <label for="titulo">Título de la publicación</label>
            <input class="titulopubli" type="text" id="titulo" name="titulo"
                placeholder="Escribe el título de tu publicación..." required>
            <label for="cuerpo">Cuerpo de la publicación</label>
            <textarea id="cuerpo" name="cuerpo" placeholder="Escribe el contenido de tu publicación..."
                required></textarea>
            <label for="imagen" class="boton-anadir-imagen">Añadir Imagen</label>
            <input type="file" id="imagen" name="imagenp" accept="image/*" style="display: none;">
            <button type="submit" id="crearPublicacion" class="boton-crear">Crear Publicación</button>
            <a type="button" id="cancelarPublicacion" class="boton-cancelar"
                href="index.php?u=secciones&m=hilos">Cancelar Publicación</a>
        </form>
    </div>
</main>