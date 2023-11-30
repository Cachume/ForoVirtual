<?php

    class LoginController extends BasedeDatos{

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
            require('vistas/inicio.php');
            require('public/layout/footer.php');
        }
        
        public function Recuperar(){
            require('public/layout/header.php');
            require('vistas/recuperar.php');
            require('public/layout/footer.php');
         }

        public function loginuser(){
            if(isset($_POST['login'])){
                $correo=$_POST['correouser'];
                $contrasena=$_POST['contrasenauser'];

                if(!$this->validarlogin($correo,$contrasena)){
                    $mensaje=$this->errores;
                    $this->mensajes("error",$mensaje);
                    exit();
                }
                
                if(!$datos=$this->iniciarsesion($correo,$contrasena)){
                    $this->mensajes("error","Correo o contraseña incorrectos");
                    exit();
                }else{
                    $dato=$datos;
                    $_SESSION['id']=$dato['id'];
                    $_SESSION['nombres']=$dato['nombres'];
                    $_SESSION['apellidos']=$dato['apellidos'];
                    $_SESSION['correo']=$dato['correo'];
                    $_SESSION['rol']=$dato['rol'];
                    $_SESSION['imagen']=$dato['fotoperfil'];
                    if($this->checkUser($dato['id'])){
                        $_SESSION['baneado']=true;
                        header("location: index.php?u=baneado");
                        exit();
                    }
                    if($_SESSION['imagen'] != "" && $_SESSION['rol']==1){
                        header("location: index.php?u=admin&success=Has iniciado sesion correctamente");
                    }else{
                        header("location: index.php?u=perfil&success=Has iniciado sesion correctamente");
                    }
                    exit();
                }
            }else{
                $this->default();
            }   
        }

        private function validarlogin($correo, $contrasena){
            echo "adentro funcion";
            if(empty($correo) AND empty($contrasena)){
                $this->errores="Todos los campos son requeridos";
                return false;
            }
            if(strlen($correo)> 60){
                $this->errores="El campo correo tiene un maximo de 60 caracteres";
                return false;
            }
            if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
                $this->errores="Correo electronico no valido";
                return false;
            }
            if(strlen($contrasena) < 8 || strlen($contrasena) >30){
                $this->errores="La contraseña debe tener minimo 8 caracteres y maximo 30";
                return false;
            }
           if(!preg_match("/^[A-Za-z.$%#\d]+$/",$contrasena)){
                $this->errores="La contraseña contiene caracteres no admitidos";
                return false;    
            }
            return true;
        }

        private function mensajes($tipo,$mensaje){
            header("location: index.php?u=inicio&".$tipo."=".$mensaje."");         
        }

    }  

?>