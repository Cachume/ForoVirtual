<?php
    class baneadoController extends BasedeDatos{

        public function __CONSTRUCT(){
            parent::__CONSTRUCT();
            if(!isset($_SESSION['baneado'])){
                header("location: index.php");
            }
        }

        public function default(){
            $datos=$this->getbanUser($_SESSION['id']);
            require('vistas/baneado.php');
        }

    }


?>