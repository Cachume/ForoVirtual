<?php

class PerfilController extends BasedeDatos
{

    private $errores;
    public function __CONSTRUCT(){
        parent::__CONSTRUCT();
        if(!isset($_SESSION['id'])){
            header("location: index.php?u=inicio");
            exit();
        }
    }

    public function default()
    {
        if(empty($_SESSION['imagen'])){
            $this->completeprofile();
        }else{
        $datosusuario=$this->getDatosusuarios($_SESSION['id']);
        $rol=$this->rolname($_SESSION['rol']);
        $publicaciones=$this->getperfilPublicacion($_SESSION['id']);
        require('public/layout/header.php');
        require('vistas/perfilusuario.php');
        require('public/layout/footer.php');
        }
    }

    private function completeprofile()
    {
        require('public/layout/header.php');
        require('vistas/completarusuario.php');
        require('public/layout/footer.php');
    }

    public function completedUser(){
        if(isset($_POST['perfilcompletar'])){
            echo "entro";
            $imagen=$_FILES['uimg']['name'];
            $fdn=$_POST['fdn'];
            $genero=$_POST['genero'];
            $carrera=$_POST['major'];
            $pin=$_POST['pin'];

            if(!$this->validarFDN($fdn)){
                $mensaje=$this->errores;
                $this->mensajes("error",$mensaje);
                exit();
            }
            if(!$this->validarImg($imagen)){
                $mensaje=$this->errores;
                $this->mensajes("error",$mensaje);
                exit();
            }
            if(!$this->validarGenero($genero)){
                $mensaje=$this->errores;
                $this->mensajes("error",$mensaje);
                exit();
            }
            if(!$this->validarCarrera($carrera)){
                $mensaje=$this->errores;
                $this->mensajes("error",$mensaje);
                exit();
            }
            
            $img_name=$_SESSION['id'].$_SESSION['nombres']."___".$imagen;
            $pine=password_hash($pin,PASSWORD_BCRYPT);
            if(move_uploaded_file($_FILES['uimg']['tmp_name'],"public/img/user_img/".$img_name)){
                if($this->completarPerfil($img_name,$fdn,$genero,$carrera,$pine)){
                $_SESSION['imagen']=$img_name;
                $this->mensajes("success","Has completado exitosamente tu perfil");
                exit();
                }
            }
        }else{
            echo "<script>alert('no hay nada :c');</script>";
            $this->default();
        }
    }

    private function validarFDN($fdn){
        $fecha=explode("-",$fdn);
        if($fecha[2] < 0 || $fecha[2] > 31){
            $this->errores="El dia ingresado no es valido";
            return false;
        }
        if($fecha[1] < 0 || $fecha[1] > 12){
            $this->errores="El mes ingresado no es valido";
            return false;
        }
        if($fecha[0] < 1960 || $fecha[0] > date("Y")-18){
            $this->errores="El año ingresado no es valido";
            return false;
        }
        return true;
    }
    private function validarImg($imagen){
        $extencion=explode("/",$_FILES['uimg']['type']);        
        if($extencion[1] != "jpeg" && $extencion !="png" && $extencion != "jpg"){
            $this->errores="Solo se aceptan imagenes tipo png/jpg/jpeg";
            return false;
        }
        return true;
    }

    private function validarGenero($genero){
        if($genero != "Masculino" && $genero != "Femenino" ){
            $this->errores="Tu genero es desconocido";
            return false; 
        }
        return true;
    }
    private function validarCarrera($carrera){
        if($carrera != "Ing Sistemas" && $carrera != "Ing Electrónica" ){
            $this->errores="La carrera ingresada es desconocida";
            return false; 
        }
        return true;
    }

    public function cerrarsesion()
    {
        // Inicia o reanuda la sesión
        session_start();

        // Elimina todas las variables de sesión
        session_unset();

        // Destruye la sesión
        session_destroy();

        // Redirige al inicio de sesión
        header("Location:index.php?u=inicio");

    }

    private function mensajes($tipo,$mensaje){
        header("location: index.php?u=perfil&".$tipo."=".$mensaje."");
        exit();    
    }

    private function rolname($rol){
        $rolname="";
        switch ($rol) {
            case 1:
                $rolname="Administrador";
                break;
            case 2:
                $rolname="Moderador";
                break;
            case 3:
                $rolname="Docente";
                break;
            default:
                $rolname="Estudiante";
                break;
        }
        return $rolname;
    }

}

?>