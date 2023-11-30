<?php
class SeccionesController extends BasedeDatos
{

    public $errores;
    public function __CONSTRUCT(){
        parent::__CONSTRUCT();
    }  

    public function default()
    {
        $datos=$this->getSecciones();
        require('public/layout/header.php');
        require('vistas/secciones.php');
        require('public/layout/footer.php');
    }

    public function hilos()
    {
        $hilos=$_GET['sec'];
        $datos=$this->getHilos($hilos);
        require('public/layout/header.php');
        require('vistas/hilos.php');
        require('public/layout/footer.php');
    }

    public function publicaciones()
    {
        require('public/layout/header.php');
        require('vistas/crearpublicacion.php');
        require('public/layout/footer.php');
    }

    public function crearpublicacion()
    {
        require('public/layout/header.php');
        require('vistas/crearpublicacion.php');
        require('public/layout/footer.php');
    }

    public function hilosrespuesta()
    {
        $publicacion=$_GET['p'];
        $datos=$this->getPublicacion($publicacion);
        $comentario= $datos['tabla_comentarios'];
        $datosc=$this->getComentarios($comentario);
        require('public/layout/header.php');
        require('vistas/hilosrespuesta.php');
        require('public/layout/footer.php');
    }

    public function guardarPublicacion()
    {
        if (isset($_POST['crearPublicacion'])) {
            $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : "";
            $cuerpo = isset($_POST['cuerpo']) ? trim($_POST['cuerpo']) : "";
            $imagen = $_FILES['imagenp']['name'];
            $publi=$_GET['publi'];

            $errores = array();

            if (empty($titulo)) {
                $errores[] = "El título de la publicación es obligatorio.";
            }

            if (empty($cuerpo)) {
                $errores[] = "El cuerpo de la publicación es obligatorio.";
            }

            if (empty($errores)) {
                // Aquí, si no hay errores, continúa con el proceso
                $img_name=$_SESSION['id']."_publicacion"."___".$imagen;
                move_uploaded_file($_FILES['imagenp']['tmp_name'],"public/img/publi_img/".$img_name);
                $publicacionGuardada = $this->guardarPublicacionEnDb($titulo, $cuerpo, $img_name, $publi);

                if ($publicacionGuardada) {
                    // La publicación se guardó 
                    header("location:index.php?u=secciones&sec=".$publi."&m=hilos&success=La publicación se creó exitosamente");
                } else {
                    // Ocurrió un error al guardar la publicación
                    header("location:index.php?u=secciones&m=crearpublicacion&error=Ocurrió un error al crear la publicación");
                 }
                
            } else {
                $this->crearpublicacion();
            }
        }
    }

    public function guardarcomentario()
    {
        if (isset($_POST['respuesta']) && isset($_GET['p'])) {
            $tablacomentario= $_POST['comentarioid'];
            $comentario= $_POST['cuerpo'];
            $imagen=$_FILES['imagen']['name'];
            
            if($imagen != ""){
                if(!$this->validarImg($imagen)){
                    $mensaje=$this->errores;
                    $this->mensajes("error",$mensaje,$_GET['p']);
                }
                $img_name=$_SESSION['id']."_comentario"."___".$imagen;
                if(move_uploaded_file($_FILES['imagen']['tmp_name'],"public/img/comen_img/".$img_name)){
                    if($this->guardarComentarios($tablacomentario,$_SESSION['id'],$comentario,$img_name)){
                    $this->mensajes("success","Se ha creado exitosamente el comentario",$_GET['p']);
                    }
                }
            }else{
                if($this->guardarComentarios($tablacomentario,$_SESSION['id'],$comentario,"")){
                    $this->mensajes("success","Se ha creado exitosamente el comentario",$_GET['p']);
                    }
            }
           
        } else {
            $this->mensajes("error","La respuesta no fue enviada",$_GET['p']);
        }
    }

    public function cerrarhilo(){
        if(isset($_GET['sec'])){
            $publi=$_GET['sec'];
            if(is_numeric($publi)){
                if($this->closeHilo($publi)){
                    $this->mensajes("success","Se ha cerrado el hilo",$publi);
                }else{
                    $this->mensajes("error","No se ha podido cerrar el hilo",$publi);
                }
            }else{
                $this->default();
            }
        }else{
            $this->default();
        }
    }

    private function mensajes($tipo,$mensaje,$p){
        header("location: index.php?u=secciones&m=hilosrespuesta&p=".$p."&".$tipo."=".$mensaje."");         
    }

    private function validarImg($imagen){
        $extencion=explode("/",$_FILES['imagen']['type']);       
        if($extencion[1] != "jpeg" && $extencion[1] !="png" && $extencion[1] != "jpg"){
            $this->errores="Solo se aceptan imagenes tipo png/jpg/jpeg";
            return false;
        }
        return true;
    }
}
?>