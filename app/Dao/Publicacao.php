<?php

require_once '../Conection/Conn.php';

    class Publicacao extends Conn{
        private $tableProjeto;
        
        public function __construct()
        {
            parent::__construct();
            $this->tableProjeto ='projeto';
            $this->tableCientista ='cientista';
            $this->tableFormacao ='formacao';
            $this->tableRede ='rede_sociais';
            $this->tableTelefone ='telefone';
            $this->tableAtuacaoCientista ='area_atuacao_cientista';
            $this->tableAreaAtuacao = 'area_atuacao';
        }

        public function setCadastroPub($tit_projeto, $dti_projeto, $dtt_projeto,$res_projeto, $pub_projeto, $id)
        {
                $sql = $this->pdo->prepare("INSERT INTO $this->tableProjeto(tit_projeto,dti_projeto,dtt_projeto
                ,res_projeto,pub_projeto, fk_id_cientista)
                VALUES (:a, :b,:c,:d,:e, :f)");

                $sql->bindValue(":a", $tit_projeto);
                $sql->bindValue(":b", $dti_projeto);
                $sql->bindValue(":c", $dtt_projeto);
                $sql->bindValue(":d", $res_projeto);
                $sql->bindValue(":e", $pub_projeto);
                $sql->bindValue(":f", $id);
                $sql->execute(); 
                return true;
            }

            public function getPubli($id)
            {
                $sql = $this->pdo->prepare("SELECT * FROM 
                $this->tableProjeto,
                $this->tableCientista,
                $this->tableFormacao,
                $this->tableRede, 
                $this->tableTelefone
                where 
                $this->tableProjeto.id_projeto = :a AND
                $this->tableCientista.id_cientista = :b AND
                $this->tableFormacao.fk_id_cientista = :b AND
                $this->tableRede.fk_id_cientista = :b AND
                $this->tableTelefone.fk_id_cientista = :b
                ");

                $sql->bindValue(":a", $id);
                $sql->bindValue(":b", $_SESSION['login']);

                $sql->execute();       
            
                $resultQuery = $sql->fetchAll();

                $_SESSION['queryTabela'] = $resultQuery;

                return true;
            } 

            public function getAreaPubli($id)
            {
                $sql = $this->pdo->prepare("SELECT fk_id_area_atuacao FROM $this->tableAtuacaoCientista
                WHERE fk_id_cientista = :a");
                $sql->bindValue(":a", $id);
                $sql->execute();    

                $idIdArea = $sql->fetch(PDO::FETCH_ASSOC);
                    
                ksort($idIdArea);
                foreach ($idIdArea as $chave => $value)
                {
                    $id_area = $value;
                }

                $sql = $this->pdo->prepare("SELECT nom_area_atuacao FROM $this->tableAreaAtuacao
                WHERE id_area_atuacao = :c");
                $sql->bindValue(":c", $id_area);
                $sql->execute(); 

                $resultQuery2 = $sql->fetchAll();

                $_SESSION['queryTabela2'] = $resultQuery2;

                return true;

            }
}
    
?>