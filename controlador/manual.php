<?php
    class ManualController{


        public function default(){
            require('public/layout/header.php');
            $ruta_pdf = 'public/manual.pdf';
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="archivo.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($ruta_pdf));
            header('Accept-Ranges: bytes');
        
            // Leer el archivo y mostrarlo en el navegador
            readfile($ruta_pdf);
            require('public/layout/footer.php');
        }
    }

?>