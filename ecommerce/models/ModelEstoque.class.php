<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelEstoque extends DB {
    
    public function cadastrar(Estoque $estoque) {
		
        try {
            
            $quantidadeInsert = $estoque->getQuantidade();
            $idProdutoInsert = $estoque->getIdProduto();

            $cilindro;
            $eixo;
            $adicao;
            $cor;

            if ($estoque->getGrauCilindro() == null) {
                $cilindro = "IS NULL";
            }
            else {
                $cilindro = " = ".$estoque->getGrauCilindro();
            }

            if ($estoque->getEixo() == null) {
                $eixo = "IS NULL";
            }
            else {
                $eixo = " = ".$estoque->getEixo();
            }

            if ($estoque->getGrauAdicao() == null) {
                $adicao = "IS NULL";
            }
            else {
                $adicao = " = ".$estoque->getGrauAdicao();
            }

            if ($estoque->getCor() == null) {
                $cor = "IS NULL";
            }
            else {
                $cor = " = ".$estoque->getCor();
            }

            $selectMenorData = "SELECT * FROM ItensPedido 
                                INNER JOIN pedidos
                                ON pedidos.idPedido = itenspedido.idPedido
                                WHERE idProduto = $idProdutoInsert 
                                AND qtdePendente > 0 
                                AND esfericoD = ".$estoque->getGrauEsferico()." 
                                AND cilindroD $cilindro 
                                AND eixoD $eixo 
                                AND curvaBaseD = ".$estoque->getCurvaBase()." 
                                AND diametroD = ".$estoque->getDiametro()." 
                                AND adicaoD $adicao 
                                AND corD $cor 
                                AND data = (SELECT MIN(data) from ItensPedido
                                INNER JOIN pedidos ON pedidos.idPedido = itenspedido.idPedido 
                                WHERE idProduto = $idProdutoInsert 
                                AND qtdePendente > 0 
                                AND esfericoD = ".$estoque->getGrauEsferico()." 
                                AND cilindroD $cilindro 
                                AND eixoD $eixo 
                                AND curvaBaseD = ".$estoque->getCurvaBase()." 
                                AND diametroD = ".$estoque->getDiametro()." 
                                AND adicaoD $adicao 
                                AND corD $cor)";

            $consultaMenorData = DB::PDO($selectMenorData);
            $consultaMenorData->execute();
            $countSelect = $consultaMenorData->rowCount();

            if ($countSelect == 0) {

                $selectMenorData = "SELECT * FROM ItensPedido 
                                    INNER JOIN pedidos
                                    ON pedidos.idPedido = itenspedido.idPedido
                                    WHERE idProduto = $idProdutoInsert 
                                    AND qtdePendente > 0 
                                    AND esfericoE = ".$estoque->getGrauEsferico()." 
                                    AND cilindroE $cilindro 
                                    AND eixoE $eixo 
                                    AND curvaBaseE = ".$estoque->getCurvaBase()." 
                                    AND diametroE = ".$estoque->getDiametro()." 
                                    AND adicaoE $adicao 
                                    AND corE $cor 
                                    AND data = (SELECT MIN(data) from ItensPedido
                                    INNER JOIN pedidos ON pedidos.idPedido = itenspedido.idPedido 
                                    WHERE idProduto = $idProdutoInsert 
                                    AND qtdePendente > 0 
                                    AND esfericoE = ".$estoque->getGrauEsferico()." 
                                    AND cilindroE $cilindro 
                                    AND eixoE $eixo 
                                    AND curvaBaseE = ".$estoque->getCurvaBase()." 
                                    AND diametroE = ".$estoque->getDiametro()." 
                                    AND adicaoE $adicao 
                                    AND corE $cor)";

                $consultaMenorData = DB::PDO($selectMenorData);
                $consultaMenorData->execute();
                $countSelect = $consultaMenorData->rowCount();
            }

            $sobrouEstoque = $quantidadeInsert;

            for ($i = $quantidadeInsert; $i > 0 && $countSelect > 0; $i--) {

                $consultaDados = DB::PDO($selectMenorData);
                $consultaDados->execute();        
                $resultado = $consultaDados->fetchAll();

                foreach ($resultado as $var) {

                    $quantidadePendente = $var['qtdePendente'] - 1;
                    $idItensPedido = $var['ItensPedido'];

                    $updatePendente = "UPDATE `itenspedido` SET `qtdePendente`=:quantidadePendente WHERE `itensPedido` = $idItensPedido";
                    $update = DB::prepare($updatePendente);
                    $update->bindValue(':quantidadePendente', $quantidadePendente);
                    $update->execute();
                }

                $consultaMenorData = DB::PDO($selectMenorData);
                $consultaMenorData->execute();
                $countSelect = $consultaMenorData->rowCount();

                $sobrouEstoque = $i - 1;
            }
            
           $sql = "INSERT INTO `estoque` (`grauEsferico`, `grauCilindro`, `eixo`, `grauAdicao`, `diametro`, `curvaBase`, `olho`, `quantidade`, `idProduto`) 
           VALUES (?,?,?,?,?,?,?,?,?)";

           $stmt=DB::prepare($sql);
           $stmt->bindValue(1, $estoque->getGrauEsferico());
           $stmt->bindValue(2, $estoque->getGrauCilindro());
           $stmt->bindValue(3, $estoque->getEixo());
           $stmt->bindValue(4, $estoque->getGrauAdicao());
           $stmt->bindValue(5, $estoque->getDiametro());
           $stmt->bindValue(6, $estoque->getCurvaBase());
           $stmt->bindValue(7, $estoque->getOlho());
           $stmt->bindValue(8, $sobrouEstoque);
           $stmt->bindValue(9, $estoque->getIdProduto());
           
           return $stmt->execute();
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function alterar(Estoque $estoque, $id) {
        
      try {

        $quantidadeInsert = $estoque->getQuantidade();
        $idProdutoInsert = $estoque->getIdProduto();
        
        $cilindro;
        $eixo;
        $adicao;
        $cor;
        
        if ($estoque->getGrauCilindro() == null) {
            $cilindro = "IS NULL";
        }
        else {
            $cilindro = " = ".$estoque->getGrauCilindro();
        }
        
        if ($estoque->getEixo() == null) {
            $eixo = "IS NULL";
        }
        else {
            $eixo = " = ".$estoque->getEixo();
        }
        
        if ($estoque->getGrauAdicao() == null) {
            $adicao = "IS NULL";
        }
        else {
            $adicao = " = ".$estoque->getGrauAdicao();
        }
        
        if ($estoque->getCor() == null) {
            $cor = "IS NULL";
        }
        else {
            $cor = " = ".$estoque->getCor();
        }
        
        $selectMenorData = "SELECT * FROM ItensPedido 
                            INNER JOIN pedidos
                            ON pedidos.idPedido = itenspedido.idPedido
                            WHERE idProduto = $idProdutoInsert 
                            AND qtdePendente > 0 
                            AND esfericoD = ".$estoque->getGrauEsferico()." 
                            AND cilindroD $cilindro 
                            AND eixoD $eixo 
                            AND curvaBaseD = ".$estoque->getCurvaBase()." 
                            AND diametroD = ".$estoque->getDiametro()." 
                            AND adicaoD $adicao 
                            AND corD $cor 
                            AND data = (SELECT MIN(data) from ItensPedido
                            INNER JOIN pedidos ON pedidos.idPedido = itenspedido.idPedido 
                            WHERE idProduto = $idProdutoInsert 
                            AND qtdePendente > 0 
                            AND esfericoD = ".$estoque->getGrauEsferico()." 
                            AND cilindroD $cilindro 
                            AND eixoD $eixo 
                            AND curvaBaseD = ".$estoque->getCurvaBase()." 
                            AND diametroD = ".$estoque->getDiametro()." 
                            AND adicaoD $adicao 
                            AND corD $cor)";
        
        $consultaMenorData = DB::PDO($selectMenorData);
        $consultaMenorData->execute();
        $countSelect = $consultaMenorData->rowCount();
        
        if ($countSelect == 0) {
            
            $selectMenorData = "SELECT * FROM ItensPedido 
                                INNER JOIN pedidos
                                ON pedidos.idPedido = itenspedido.idPedido
                                WHERE idProduto = $idProdutoInsert 
                                AND qtdePendente > 0 
                                AND esfericoE = ".$estoque->getGrauEsferico()." 
                                AND cilindroE $cilindro 
                                AND eixoE $eixo 
                                AND curvaBaseE = ".$estoque->getCurvaBase()." 
                                AND diametroE = ".$estoque->getDiametro()." 
                                AND adicaoE $adicao 
                                AND corE $cor 
                                AND data = (SELECT MIN(data) from ItensPedido
                                INNER JOIN pedidos ON pedidos.idPedido = itenspedido.idPedido 
                                WHERE idProduto = $idProdutoInsert 
                                AND qtdePendente > 0 
                                AND esfericoE = ".$estoque->getGrauEsferico()." 
                                AND cilindroE $cilindro 
                                AND eixoE $eixo 
                                AND curvaBaseE = ".$estoque->getCurvaBase()." 
                                AND diametroE = ".$estoque->getDiametro()." 
                                AND adicaoE $adicao 
                                AND corE $cor)";

            $consultaMenorData = DB::PDO($selectMenorData);
            $consultaMenorData->execute();
            $countSelect = $consultaMenorData->rowCount();
        }

        $sobrouEstoque = $quantidadeInsert;
        
        for ($i = $quantidadeInsert; $i > 0 && $countSelect > 0; $i--) {
            
            $consultaDados = DB::PDO($selectMenorData);
            $consultaDados->execute();        
            $resultado = $consultaDados->fetchAll();
            
            foreach ($resultado as $var) {
                
                $quantidadePendente = $var['qtdePendente'] - 1;
                $idItensPedido = $var['ItensPedido'];

                $updatePendente = "UPDATE `itenspedido` SET `qtdePendente`=:quantidadePendente WHERE `itensPedido` = $idItensPedido";
                $update = DB::prepare($updatePendente);
                $update->bindValue(':quantidadePendente', $quantidadePendente);
                $update->execute();
            }
            
            $consultaMenorData = DB::PDO($selectMenorData);
            $consultaMenorData->execute();
            $countSelect = $consultaMenorData->rowCount();
            
            $sobrouEstoque = $i - 1;
        }

        $sql = "UPDATE `estoque` SET `grauEsferico`=:grauEsferico, `grauCilindro`=:grauCilindro, `eixo`=:eixo, `grauAdicao`=:grauAdicao, `diametro`=:diametro, `curvaBase`=:curvaBase, `olho`=:olho, `quantidade`=:quantidade, `idProduto`=:idProduto WHERE `idEstoque` = '$id'";

        $stmt = DB::prepare($sql);
        $stmt->bindValue(':grauEsferico', $estoque->getGrauEsferico());
        $stmt->bindValue(':grauCilindro', $estoque->getGrauCilindro());
        $stmt->bindValue(':eixo', $estoque->getEixo());
        $stmt->bindValue(':grauAdicao', $estoque->getGrauAdicao());
        $stmt->bindValue(':diametro', $estoque->getDiametro());
        $stmt->bindValue(':curvaBase', $estoque->getCurvaBase());
        $stmt->bindValue(':olho', $estoque->getOlho());
        $stmt->bindValue(':quantidade', $sobrouEstoque);
        $stmt->bindValue(':idProduto', $estoque->getIdProduto());
        return $stmt->execute();
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function funcaoGetEstoque($id) {
		
        try {
            
            $sql = "SELECT * FROM estoque WHERE `idEstoque` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetTodosEstoque() {
		
        try {
            
            $sql = "SELECT * FROM estoque";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetTodosEstoquePendentes() {
		
        try {
            
            $sql = "SELECT * FROM itenspedido INNER JOIN pedidos ON itenspedido.idPedido = pedidos.idPedido WHERE itenspedido.qtdePendente > 0 ORDER BY pedidos.data";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
}

