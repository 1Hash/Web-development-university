<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelNoticia extends DB {
    
    public function publicar(Noticia $noticia, $imagem, $tipoImagem) {

        try {

           $sql = "INSERT INTO `noticias` (`titulo`, `descricao`, `imagem`, `tipoImagem`, `data`) 
           VALUES (?,?,?,?,?)";

           $stmt=DB::prepare($sql);
           $stmt->bindValue(1, $noticia->getTitulo());
           $stmt->bindValue(2, $noticia->getDescricao());
           $stmt->bindValue(3, $imagem);
           $stmt->bindValue(4, $tipoImagem);
           $stmt->bindValue(5, $noticia->getData());
           
           return $stmt->execute();
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getNoticia($id) {
		
        try {
            
            $sql = "SELECT * FROM noticias WHERE `idNoticias` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
}

