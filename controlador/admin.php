<?php

    class AdminController extends BasedeDatos{

        public $mensajes;
        public function __CONSTRUCT(){
            parent::__CONSTRUCT();
            if(isset($_SESSION['id'])){
                if($_SESSION['imagen']==""){
                    header("location: index.php?u=perfil");
                    exit();
                }
                if($_SESSION['rol']==4){
                    header("location: index.php?u=perfil");
                    exit();
                }
            }else{
                header("location: index.php?u=inicio");
                exit(); 
            }
            
        }
        public function default(){
            require('public/layout/headeradmin.php');
            require('vistas/admin/index.php');
            require('public/layout/footeradmin.php');
        }
        public function usuarios(){
            $datos=$this->getUsers();
            require('public/layout/headeradmin.php');
            require('vistas/admin/usuarios.php');
            require('public/layout/footeradmin.php');
        }
        public function temas(){
            $datos=$this->getTemas();
            $mensaje=$this->mensajes;
            require('public/layout/headeradmin.php');
            require('vistas/admin/temas.php');
            require('public/layout/footeradmin.php');
        }
        public function sanciones(){
            $datos=$this->getSanciones();
            require('public/layout/headeradmin.php');
            require('vistas/admin/sanciones.php');
            require('public/layout/footeradmin.php');
        }

        public function sancionar(){
            $id=$_GET['idu'];
            $datos=$this->getuser($id);
            require('public/layout/headeradmin.php');
            require('vistas/admin/sancion.php');
            require('public/layout/footeradmin.php');
        }
        private function sancionmensaje($mensaje){
            $datos=$mensaje;
            require('public/layout/headeradmin.php');
            require('vistas/admin/sancionmes.php');
            require('public/layout/footeradmin.php');
        }
        public function usersan(){
            if(isset($_POST['accion']) && $_POST['accion']=="banuser"){
                $razonban=$_POST['razon'];
                $id_user=$_POST['idu'];
                $id_sancionador=$_SESSION['id'];

                if($id_user==1){
                    $mensaje=['titulo'=>"No puedes hacer eso!",'imagen'=>"confundido.png", 'mensaje'=>'¿Que estas haciendo? >:c.', 'info' => "No puedes sancionar a un administrador."];
                    $this->sancionmensaje($mensaje);
                    exit();
                }

                if ($this->setSancion($id_user,$id_sancionador,$razonban)) {
                    $mensaje=['titulo'=>"Usuario Sancionado Exitosamente",'imagen'=>"pensando.png", 'mensaje'=>'Que mal por ese usuario, ¿no?.', 'info' => "El usuario se ha agregado en la lista de sancionados."];
                    $this->sancionmensaje($mensaje);
                }else{
                    $mensaje=['titulo'=>"El usuario no ha sido sancionado",'imagen'=>"confundido.png", 'mensaje'=>'¿Pero que ha pasado?', 'info' => "No se ha podido agregar el usuario a la lista de sanciones."];
                    $this->sancionmensaje($mensaje);
                }
            }else{
                $this->sanciones();
            }
        }
        public function unsanc(){
            if(isset($_POST['metodo']) && $_POST['metodo']=="unban"){
                $id_user=$_POST['idu'];

                if($this->removeSancion($id_user)){
                    $mensaje=['titulo'=>"Se ha removido la sanción",'imagen'=>"pensando.png", 'mensaje'=>'Al final el usuario no hizo nada grave, ¿verdad?.', 'info' => "El usuario se ha eliminado en la lista de sancionados."];
                    $this->sancionmensaje($mensaje);
                }else{
                    $mensaje=['titulo'=>"No se ha podido remover la sanción",'imagen'=>"confundido.png", 'mensaje'=>'¿Pero que ha pasado?', 'info' => "No se ha podido eliminar el usuario a la lista de sanciones."];
                    $this->sancionmensaje($mensaje);
                }
            }else{
                $this->sanciones();
            }
        }    
        public function addtheme(){
            if(isset($_POST['newtheme'])){
                $nombretema=$_POST['nombretema'];
                $descripciontema=$_POST['descripciontema'];
                if(strlen($nombretema)<8 || strlen($nombretema) >30){    
                    $this->mensajes=["alert_bad","El campo tema tiene un min de 8 y max de 30"];
                    $this->temas();
                    exit();
                }
                if(strlen($descripciontema)<15 || strlen($descripciontema) >40){
                    $this->mensajes=["alert_bad","El campo descripcion tiene un min de 15 y max de 40"];
                    $this->temas();
                    exit();
                }
                if($this->saveTheme($nombretema,$descripciontema)){
                    $this->mensajes=["alert_good","Se ha creado exitosamente el tema"];
                    $this->temas();
                    exit();
                }else{
                    $this->mensajes=["alert_bad","No se ha podido crear el tema :("];
                    $this->temas();
                    exit();
                }
            }else{
                $this->temas();
            }
        }
    }
?>