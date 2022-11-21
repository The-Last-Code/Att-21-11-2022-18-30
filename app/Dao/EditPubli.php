<?php

    require_once '../Conection/Conn.php';

    class EditPubli extends Conn
    {

        public function __construct()
            {
                parent::__construct();
                $this->tableProjeto ='projeto';
            }
        
        function ExcluiPubli($id)
        {
            $sql = $this->pdo->prepare("DELETE FROM $this->tableProjeto WHERE id_projeto = :a");
            $sql->bindValue(":a", $id);
            $sql->execute(); 
            return true;
        }
    }

?>