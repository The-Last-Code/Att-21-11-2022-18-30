<?php 

include '../Dao/EditPubli.php';

session_start();
$id=$_GET['id'];
$_SESSION['idEditPub'] = $id;

    
class EditPubliController 
{
    private $model;

    function __construct()
    {
        $this->model = new EditPubli();
        $this->getAllEditPubli();
    }

    function getAllEditPubli()
    {
       
        if($this->model->ExcluiPubli($_SESSION['idEditPub']) == true)
        {
            header('location: ../View/MinhasPublicacoes.php');
        }
        echo 'Error';exit;
    }

}

new EditPubliController();
?>