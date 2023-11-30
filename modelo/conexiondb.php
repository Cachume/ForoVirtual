<?php

    class BasedeDatos{

        private $hostname="localhost";
        private $nombreusuario="root";
        private $contrasena="";
        private $basedeforo="foro";
        private $basedecomentario="comentarios";
        private $db;
        private $dbc;

        public function __CONSTRUCT(){
            $this->db= new mysqli($this->hostname,$this->nombreusuario,$this->contrasena,$this->basedeforo);
            try {
                $this->dbc= new mysqli($this->hostname,$this->nombreusuario,$this->contrasena,$this->basedecomentario);
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
                $db= new mysqli($this->hostname,$this->nombreusuario,$this->contrasena, "");
                $db->query("CREATE DATABASE comentarios");
            }
        }
        private function obtenerRol(){
            $query=$this->db->prepare("SELECT id FROM usuarios WHERE id=1");
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                return 4;
            }else{
                return 1;
            }
        }
        public function registrar($nombres,$apellidos,$correo,$contrasena){
            $query=$this->db->prepare("INSERT INTO `usuarios`(`nombres`, `apellidos`, `correo`, `contrasena`, `rol`) VALUES (?,?,?,?,?)");
            $hash= password_hash($contrasena, PASSWORD_BCRYPT);
            $rol=$this->obtenerRol();
            $query->bind_param('ssssi',$nombres,$apellidos,$correo,$hash,$rol);
            $query->execute();
            if($query->affected_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        public function iniciarSesion($correo,$contrasena){
            $query= $this->db->prepare("SELECT `id`, `nombres`, `apellidos`, `correo`,`rol`, `fotoperfil`, `contrasena` FROM `usuarios` WHERE correo= ?");
            $query->bind_param('s',$correo);
            $query->execute();
            $resultado= $query->get_result();
            if($resultado->num_rows > 0){
               $datosuser=$resultado->fetch_assoc();
               if (password_verify($contrasena,$datosuser['contrasena'])) {
                    return $datosuser;
               }else{
                    return false;
               }
            }else{
                return false;
            }
        }
        public function completarPerfil($imagen,$fecha,$sexo,$pnf,$pin){
            $query=$this->db->prepare("UPDATE usuarios SET fotoperfil = ?, fdn= ?, sexo=?, pnf= ?, pin =? WHERE id=".$_SESSION['id']."");
            $query->bind_param('sssss', $imagen,$fecha,$sexo,$pnf,$pin);
            $query->execute();
            if($query->affected_rows > 0){
                return true;
            }else{
                return false;
            }
        }
        public function comprobarCorreo($correo){
            $query=$this->db->prepare("SELECT correo FROM usuarios WHERE correo= ?");
            $query->bind_param('s',$correo);
            $query->execute();
            $resultado= $query->get_result();
            if($resultado->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getDatosusuarios($id){
            $query=$this->db->prepare("SELECT fdn, sexo, pnf, registro FROM usuarios WHERE id=?");
            $query->bind_param('i', $id);
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows >0){
                $datos=$resultado->fetch_assoc();
                return $datos;
            }else{
                return false;
            }
        }
        public function getSecciones(){
            $query=$this->db->prepare("SELECT * FROM temas");
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[]=$fila;
                }
                return $datos;
            }else{
                return false;
            }
        }
        public function getHilos($hilo){
            $query=$this->db->prepare("SELECT publicaciones.id, publicaciones.estado ,publicaciones.titulo,publicaciones.cuerpo,publicaciones.id_tema,usuarios.fotoperfil ,usuarios.nombres, usuarios.apellidos FROM `publicaciones` JOIN usuarios ON publicaciones.autor_id=usuarios.id WHERE id_tema=?");
            $query->bind_param('i', $hilo);
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[]=$fila;
                }
                return $datos;
            }else{
                return false;
            }
        }
        public function guardarPublicacionEnDb($titulo,$cuerpo,$imagen,$id_tema){
            $query=$this->db->prepare("INSERT INTO publicaciones (id_tema,titulo,cuerpo,imagen,autor_id,tabla_comentarios) VALUES (?,?,?,?,?,?)");
            $fecha=new DateTime();
            $idcomentario="post___".$fecha->getTimestamp()."_".$_SESSION['id'];
            $query->bind_param('isssis', $id_tema,$titulo,$cuerpo,$imagen,$_SESSION['id'],$idcomentario);
            $query->execute();
            if($query->affected_rows >0){
                $creartabla=$this->dbc->query("
                CREATE TABLE IF NOT EXISTS ".$idcomentario." (
                    `id_c` INT NOT NULL AUTO_INCREMENT,
                    `id_user` INT NOT NULL,
                    `comentario` VARCHAR(255) NOT NULL,
                    `imagen` VARCHAR(100) NOT NULL,
                    `tiempo` VARCHAR(20) NOT NULL,
                    PRIMARY KEY(`id_c`)
                ) ENGINE = InnoDB");
                if($creartabla){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        
        public function getPublicacion($id){
            $query=$this->db->prepare("SELECT publicaciones.titulo, publicaciones.cuerpo, publicaciones.imagen, publicaciones.id_tema, publicaciones.id, publicaciones.tabla_comentarios,publicaciones.estado ,usuarios.nombres, usuarios.apellidos,usuarios.fotoperfil FROM `publicaciones` JOIN usuarios ON publicaciones.autor_id=usuarios.id WHERE publicaciones.id=? ");
            $query->bind_param('i', $id);
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                $datos=$resultado->fetch_assoc();
                return $datos;
            }else{
                return false;
            }
        }

        public function getperfilPublicacion($iduser){
            $query=$this->db->prepare("SELECT titulo, cuerpo, imagen FROM publicaciones WHERE autor_id=? ");
            $query->bind_param('i', $iduser);
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[]=$fila;
                }
                return $datos;
            }else{
                return false;
            }
        }

        public function getComentarios($tablacomentarios){
            $query=$this->dbc->prepare("SELECT id_c,id_user,comentario,imagen FROM ".$tablacomentarios);
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[]=$fila;
                }
                return $datos;
            }else{
                return false;
            }
        }

        public function guardarComentarios($tabla,$id_user,$comentario,$imagen){
            $query=$this->dbc->prepare("INSERT INTO ".$tabla." (id_user, comentario, imagen) VALUES (?,?,?)");
            $query->bind_param("iss",$id_user,$comentario,$imagen);
            $query->execute();
            if($query->affected_rows > 0){
                return true;
            }else{
                return false;
            }
        }
        public function getuser($id){
            $query=$this->db->prepare("SELECT id, nombres, apellidos, fotoperfil FROM usuarios WHERE id=?");
            $query->bind_param("i",$id);
            $query->execute();
            $resutado=$query->get_result();
            if($resutado->num_rows > 0){
                $datos=$resutado->fetch_assoc();
                return $datos;
            }
        }

        public function getUsers(){
            $query=$this->db->prepare("SELECT id,nombres,apellidos,correo,rol FROM usuarios");
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows >0){
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[]=$fila;
                }
                return $datos;
            }else{
                return false;
            }
        }

        public function getTemas(){
            $query=$this->db->prepare("SELECT * FROM temas");
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows >0){
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[]=$fila;
                }
                return $datos;
            }else{
                return false;
            }
        }

        public function saveTheme($nombretema,$nombredescripcion){
            try {
                $query=$this->db->prepare("INSERT INTO temas (tema, descripcion) VALUES (?,?)");
                $query->bind_param('ss',$nombretema,$nombredescripcion);
                $query->execute();
                if($query->affected_rows >0){
                    return true;
                }
            } catch (Exception $error) {
                //echo $error->getMessage();
                return false;
            }
        }
        public function getSanciones(){
            $query=$this->db->prepare("SELECT * FROM sanciones");
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows >0){
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[]=$fila;
                }
                return $datos;
            }else{
                return false;
            }
        }
        public function setSancion($id_user,$id_sancionador,$razon){
            try {
                $query=$this->db->prepare("INSERT INTO sanciones (id_user, id_sancionador,razon) VALUES (?,?,?)");
                $query->bind_param('iis',$id_user,$id_sancionador,$razon);
                $query->execute();
                if($query->affected_rows > 0){
                    return true;
                }
            } catch (Exception $error) {
                //echo $error->getMessage();
                return false;
            }
        }
        public function removeSancion($id_user){
            try {
                $query=$this->db->prepare("DELETE FROM sanciones WHERE id_user=?");
                $query->bind_param('i',$id_user);
                $query->execute();
                if($query->affected_rows > 0){
                    return true;
                }
            } catch (Exception $error) {
                //echo $error->getMessage();
                return false;
            }
        }

        public function closeHilo($publi){
            $query=$this->db->prepare("UPDATE publicaciones SET estado ='Cerrado' WHERE id=?");
            $query->bind_param('i',$publi);
            $query->execute();
                if($query->affected_rows > 0){
                    return true;
                }else{
                    return false;
                }
        }

        public function checkUser($id){
            $query=$this->db->prepare("SELECT * FROM sanciones WHERE id_user=?");
            $query->bind_param('i',$id);
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getbanUser($id){
            $query=$this->db->prepare("SELECT  sanciones.razon,sanciones.fecha ,usuarios.nombres, usuarios.apellidos FROM `sanciones` JOIN usuarios ON sanciones.id_sancionador=usuarios.id WHERE sanciones.id_user=? ");
            $query->bind_param('i', $id);
            $query->execute();
            $resultado=$query->get_result();
            if($resultado->num_rows > 0){
                $datos=$resultado->fetch_assoc();
                return $datos;
            }else{
                return false;
            }
        }

        public function __destruct(){
            $this->db->close();
        }
    }

?>