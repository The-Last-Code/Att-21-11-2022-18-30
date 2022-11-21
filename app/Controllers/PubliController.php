<?php

include '../Dao/Publicacao.php';

session_start();
$id=$_GET['id'];
$_SESSION['idPub'] = $id;

class PubliController 
{
    private $model;

    function __construct()
    {
        $this->model = new Publicacao();
        $this->getAllPubli();
    }

    function getAllPubli()
    {
        $this->model->getPubli($_SESSION['idPub']);

        $this->model->getAreaPubli($_SESSION['idPub']);

        // if($this->model->getPubli($_SESSION['idPub']) == true) )
        // {
            header('location: ../View/Pub.php');
        // }
    }

}

new PubliController();
?>