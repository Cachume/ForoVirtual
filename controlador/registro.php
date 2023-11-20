<?php

    class RegisController extends BasedeDatos{

        private $errores;

        public function __CONSTRUCT(){
            parent::__CONSTRUCT();
            if(isset($_SESSION['id'])){
                header("location: index.php?u=perfil");
                exit();
            }
        }   

        public function default(){
            require('public/layout/header.php');
            require('vistas/registro.php');
            require('public/layout/footer.php');
        }

        public function registrarusuario(){
            if (isset($_POST['accionregis'])) {
                $nombres = $_POST['nombres'];
                $apellidos = $_POST['apellidos'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $rclave = $_POST['Rclave'];
                if(empty($nombres) OR empty($apellidos) OR empty($correo) OR empty($clave) OR empty($rclave)){
                    header("location: index.php?u=registro&error=Todos los campos son requeridos");
                    exit();
                }
                if(!$this->valNombresApellidos($nombres,$apellidos)){
                    $mensaje=$this->errores;
                    $this->mensajes("error",$mensaje);
                    exit();
                }
                if(!$this->valCorreo($correo)){
                    $mensaje=$this->errores;
                    $this->mensajes("error",$mensaje);
                    exit();
                } 
                if(!$this->valContrasena($clave, $rclave)){
                    $mensaje=$this->errores;
                    $this->mensajes("error",$mensaje);
                    exit();
                }
                if($this->registrar($nombres,$apellidos,$correo,$clave)){
                    $this->mensajes("success","Te has registrado Exitosamente");
                    exit();
                }else{
                    $this->mensajes("error","Ha ocurrido un error en registrarte");
                    exit();
                }
            }else{
                $this->default();  
            }
        }
        private function mensajes($tipo,$mensaje){
            header("location: index.php?u=registro&".$tipo."=".$mensaje."");         
        }
        private function valNombresApellidos($nombres, $apellidos){
            if(strlen($nombres) > 30 || strlen($apellidos) > 30){
                $this->errores="Los campos nombres y apellidos tienen un maximo de 30 caracteres";
                return false;
            } 
            if(!preg_match('/^[A-Za-z\s]+$/',$nombres) OR !preg_match('/^[A-Za-z\s]+$/',$apellidos)){
                $this->errores="Se han ingresado datos no validos";
                return false;
            }
            return true;
        }
        private function valCorreo($correo){
            if(strlen($correo)> 60){
                $this->errores="El campo correo tiene un maximo de 60 caracteres";
                return false;
            }
            if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
                $this->errores="Correo electronico no valido";
                return false;
            }
            if($this->comprobarCorreo($correo)){
                $this->errores="El correo electronico ya se encuentra en uso";
                return false;
            }
            return true;
        }
        private function valContrasena($contrasena,$ccontrasena){
            if(strlen($contrasena) < 8 || strlen($contrasena) >30 || strlen($ccontrasena) < 8 || strlen($ccontrasena) >30){
                $this->errores="La contraseña debe tener minimo 8 caracteres y maximo 30";
                return false;
            }
            if($contrasena != $ccontrasena){
                $this->errores="Las claves no coinciden";
                return false;
            }
           if(!preg_match("/^[A-Za-z.$%#\d]+$/",$contrasena) OR !preg_match("/^[A-Za-z.$%#\d]+$/",$ccontrasena)){
                $this->errores="La contraseña contiene caracteres no admitidos";
                return false;    
            }
            return true;
        }
    }
?>