<div class="canales">
  <section class="seccion">

    <h2>Secciones</h2>
    <?php
      if(!$datos){
        echo "<h3>No hay secciones disponibles<h3>";
      }else{
        foreach ($datos as $fila) {
        ?>               
      <div class="comentario">
        <img src="public/img/libro.png" alt="">
        <div class="comentario_titulo">
          <a href="index.php?u=secciones&m=hilos&sec=<?php echo $fila['id_tema']?>"><?php echo $fila['tema']?></a>
          <p><?php echo $fila['descripcion']?></p>
        </div>
        <div style="display:none;" class="comentario_temas">
          <span>200</span> <span>Temas</span>
        </div>
        <div class="comentario_mensajes">
          <span>5</span> <span>Mensajes</span>
        </div>
      </div>
    <?php } }?>
  </section>
  <section style="display:none;" class="seccion">

    <h2>Matematicas</h2>

    <div class="comentario">
      <img src="public/img/reproductor-de-video.png" alt="">
      <div class="comentario_titulo">
        <a href="https://www.example.com">Videos</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="comentario_temas">
        <span>200</span> <span>Temas</span>
      </div>
      <div class="comentario_mensajes">

        <span>5</span> <span>Mensajes</span>
      </div>

    </div>
    <div class="comentario">
      <img src="public/img/charla.png" alt="">
      <div class="comentario_titulo">
        <a href="https://www.example.com">Preguntas Y Respuestas</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="comentario_temas">
        <span>200</span> <span>Temas</span>
      </div>
      <div class="comentario_mensajes">

        <span>5</span> <span>Mensajes</span>
      </div>
    </div>
  </section>
</div>
<aside class="uno_noticias">
  <div class="noticias">
    <h3>NOTICIAS</h3>
    <img src="public/img/CNN_International_logo.svg.png" alt="">
  </div>
</aside>
</div>