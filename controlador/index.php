<?php

class IndexController
{

    public function default()
    {
        require('public/layout/header.php');
        require('vistas/index.php');
        require('public/layout/footer.php');
    }
}

?>