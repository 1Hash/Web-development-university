<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelDica extends DB {
    
    public function publicar(Dica $dica, $imagem, $tipoImagem) {

        try {

           $sql = "INSERT INTO `dicas` (`titulo`, `descricao`, `imagem`, `tipoImagem`, `data`) 
           VALUES (?,?,?,?,?)";

           $stmt=DB::prepare($sql);
           $stmt->bindValue(1, $dica->getTitulo());
           $stmt->bindValue(2, $dica->getDescricao());
           $stmt->bindValue(3, $imagem);
           $stmt->bindValue(4, $tipoImagem);
           $stmt->bindValue(5, $dica->getData());
           
           return $stmt->execute();
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getDicas($id) {
		
        try {
            
            $sql = "SELECT * FROM dicas WHERE `idDicas` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
}
