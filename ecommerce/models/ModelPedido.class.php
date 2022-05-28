<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelPedido extends DB {
    
    public function cadastrar(Pedido $pedido) {
	
        $db = true;
        
        try {
            
            $sql = "INSERT INTO `pedidos` (`precoTotal`, `tipoPagamento`, `data`, `idUsuario`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `idEstado`, `idCidade`, `tipoEntrega`) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

            $stmt=DB::prepare($sql);
            $stmt->bindValue(1, $pedido->getTotal());
            $stmt->bindValue(2, $pedido->getParcela());
            $stmt->bindValue(3, $pedido->getData());
            $stmt->bindValue(4, $pedido->getUsuario());
            $stmt->bindValue(5, $pedido->getCep());
            $stmt->bindValue(6, $pedido->getEndereco());
            $stmt->bindValue(7, $pedido->getNumero());
            $stmt->bindValue(8, $pedido->getComplemento());
            $stmt->bindValue(9, $pedido->getBairro());
            $stmt->bindValue(10, $pedido->getEstado());
            $stmt->bindValue(11, $pedido->getCidade());
            $stmt->bindValue(12, $pedido->getEntregaFinal());

            if(!$stmt->execute()) {
                $db = false;
            }
           
            $sqlConsulta = "SELECT MAX(idPedido) FROM pedidos";
            $consulta = DB::PDO($sqlConsulta);
            $consulta->execute();
            
            $ret = $consulta->fetchAll();
            
            foreach($ret as $item)
            {
                $id = $item["MAX(idPedido)"];
            }


            for($indice = 0; $indice < count($_SESSION['carrinho']); $indice++) {
                
                $idProduto = $_SESSION['carrinho'][$indice]['idProduto'];
                $quantidadeTotal = $_SESSION['carrinho'][$indice]['quantidadeE'] + $_SESSION['carrinho'][$indice]['quantidadeD'];
                
                
                $sqlConsultaTodoEstoque = "SELECT * FROM estoque WHERE `idProduto` = $idProduto";
                $consultaEstoque = DB::PDO($sqlConsultaTodoEstoque);
                $consultaEstoque->execute();

                $retEstoque = $consultaEstoque->fetchAll();

                $idEstoque = -5;
                $auxID = 0;
                
                if ($_SESSION['carrinho'][$indice]['esfericoD'] == $_SESSION['carrinho'][$indice]['esfericoE'] && 
                    $_SESSION['carrinho'][$indice]['curvaBaseD'] == $_SESSION['carrinho'][$indice]['curvaBaseE'] && 
                    $_SESSION['carrinho'][$indice]['diametroD'] == $_SESSION['carrinho'][$indice]['diametroE'] && 
                    $_SESSION['carrinho'][$indice]['cilindroD'] == $_SESSION['carrinho'][$indice]['cilindroE'] && 
                    $_SESSION['carrinho'][$indice]['eixoD'] == $_SESSION['carrinho'][$indice]['eixoE'] && 
                    $_SESSION['carrinho'][$indice]['adicaoD'] == $_SESSION['carrinho'][$indice]['adicaoE'] && 
                    $_SESSION['carrinho'][$indice]['corD'] == $_SESSION['carrinho'][$indice]['corE']) {
                    
                    $idEstoque = -4;
                }

                foreach ($retEstoque as $var) {
                    
                    if ($_SESSION['carrinho'][$indice]['esfericoD'] == $_SESSION['carrinho'][$indice]['esfericoE'] && 
                        $_SESSION['carrinho'][$indice]['curvaBaseD'] == $_SESSION['carrinho'][$indice]['curvaBaseE'] && 
                        $_SESSION['carrinho'][$indice]['diametroD'] == $_SESSION['carrinho'][$indice]['diametroE'] && 
                        $_SESSION['carrinho'][$indice]['cilindroD'] == $_SESSION['carrinho'][$indice]['cilindroE'] && 
                        $_SESSION['carrinho'][$indice]['eixoD'] == $_SESSION['carrinho'][$indice]['eixoE'] && 
                        $_SESSION['carrinho'][$indice]['adicaoD'] == $_SESSION['carrinho'][$indice]['adicaoE'] && 
                        $_SESSION['carrinho'][$indice]['corD'] == $_SESSION['carrinho'][$indice]['corE']) {
                    
                        if ($var['grauEsferico'] == $_SESSION['carrinho'][$indice]['esfericoD'] && 
                            $var['curvaBase'] == $_SESSION['carrinho'][$indice]['curvaBaseD'] && 
                            $var['diametro'] == $_SESSION['carrinho'][$indice]['diametroD'] && 
                            $var['grauCilindro'] == $_SESSION['carrinho'][$indice]['cilindroD'] && 
                            $var['eixo'] == $_SESSION['carrinho'][$indice]['eixoD'] && 
                            $var['grauAdicao'] == $_SESSION['carrinho'][$indice]['adicaoD'] && 
                            $var['cor'] == $_SESSION['carrinho'][$indice]['corD'] && 
                            $var['idProduto'] == $idProduto) {
                            
                            $idEstoque = $var['idEstoque'];
                            break;
                        }
                        else {
                            $idEstoque = -1;
                        }
                    }
                    else
                    {
                        if ($var['grauEsferico'] == $_SESSION['carrinho'][$indice]['esfericoD'] && 
                            $var['curvaBase'] == $_SESSION['carrinho'][$indice]['curvaBaseD'] && 
                            $var['diametro'] == $_SESSION['carrinho'][$indice]['diametroD'] && 
                            $var['grauCilindro'] == $_SESSION['carrinho'][$indice]['cilindroD'] && 
                            $var['eixo'] == $_SESSION['carrinho'][$indice]['eixoD'] && 
                            $var['grauAdicao'] == $_SESSION['carrinho'][$indice]['adicaoD'] && 
                            $var['cor'] == $_SESSION['carrinho'][$indice]['corD'] && 
                            $var['idProduto'] == $idProduto) {
                            
                            $idEstoque = $var['idEstoque'];
                            break;
                        }
                        else {

                            if ($var['grauEsferico'] == $_SESSION['carrinho'][$indice]['esfericoE'] && 
                                $var['curvaBase'] == $_SESSION['carrinho'][$indice]['curvaBaseE'] && 
                                $var['diametro'] == $_SESSION['carrinho'][$indice]['diametroE'] && 
                                $var['grauCilindro'] == $_SESSION['carrinho'][$indice]['cilindroE'] && 
                                $var['eixo'] == $_SESSION['carrinho'][$indice]['eixoE'] && 
                                $var['grauAdicao'] == $_SESSION['carrinho'][$indice]['adicaoE'] && 
                                $var['cor'] == $_SESSION['carrinho'][$indice]['corE'] && 
                                $var['idProduto'] == $idProduto) {
                                $idEstoque = $var['idEstoque'];
                                break;
                            }
                            else {

                                $auxID = 1;
                            }

                            $idEstoque = -1;
                        }
                    }
                }
                
                if ($idEstoque >= 0) {
                    
                    try {

                        $sqlConsultaEstoque = "SELECT * FROM estoque WHERE `idEstoque` = $idEstoque";
                        $consulta2 = DB::PDO($sqlConsultaEstoque);
                        $consulta2->execute();

                        $ret2 = $consulta2->fetchAll();

                        foreach($ret2 as $item)
                        {
                            $quantidadeEstoque = $item['quantidade'];
                        }
                    }
                    catch (Exception $e) {
                        $quantidadeEstoque = 0;
                    }

                    $quantidadeFinal = $quantidadeEstoque;
                    $quantidadePendente = 0;

                    for ($i = $quantidadeTotal; $i > 0; $i--) {

                        if ($quantidadeFinal > 0) {
                            $quantidadeFinal = $quantidadeFinal - 1;
                        }
                        else {
                            $quantidadePendente = $i;
                            break;
                        }
                    }

                    $sql = "UPDATE `estoque` SET `quantidade`=:quantidade WHERE `idEstoque` = '$idEstoque'";

                    $stmt = DB::prepare($sql);
                    $stmt->bindValue(':quantidade', $quantidadeFinal);
                    $stmt->execute();
                    
                }
                else if (($idEstoque == -1 && $auxID == 1) || ($idEstoque == -5)) {
                 
                    $sql2 = "INSERT INTO `estoque` (`grauEsferico`, `grauCilindro`, `eixo`, `grauAdicao`, `diametro`, `curvaBase`, `olho`, `quantidade`, `idProduto`) 
                    VALUES (?,?,?,?,?,?,?,?,?)";
                    
                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $_SESSION['carrinho'][$indice]['esfericoE']);
                    $stmt2->bindValue(2, $_SESSION['carrinho'][$indice]['cilindroE']);
                    $stmt2->bindValue(3, $_SESSION['carrinho'][$indice]['eixoE']);
                    $stmt2->bindValue(4, $_SESSION['carrinho'][$indice]['adicaoE']);
                    $stmt2->bindValue(5, $_SESSION['carrinho'][$indice]['diametroE']);
                    $stmt2->bindValue(6, $_SESSION['carrinho'][$indice]['curvaBaseE']);
                    $stmt2->bindValue(7, $_SESSION['carrinho'][$indice]['olhoE']);
                    $stmt2->bindValue(8, 0);
                    $stmt2->bindValue(9, $_SESSION['carrinho'][$indice]['idProduto']);

                    $stmt2->execute();

                    $sqlConsulta = "SELECT MAX(idEstoque) FROM estoque";
                    $consulta = DB::PDO($sqlConsulta);
                    $consulta->execute();

                    $ret = $consulta->fetchAll();

                    foreach($ret as $item)
                    {
                        $idEstoque = $item["MAX(idEstoque)"];
                    }

                    try {

                        $sqlConsultaEstoque = "SELECT * FROM estoque WHERE `idEstoque` = $idEstoque";
                        $consulta2 = DB::PDO($sqlConsultaEstoque);
                        $consulta2->execute();

                        $ret2 = $consulta2->fetchAll();

                        foreach($ret2 as $item)
                        {
                            $quantidadeEstoque = $item['quantidade'];
                        }
                    }
                    catch (Exception $e) {
                        $quantidadeEstoque = 0;
                    }

                    $quantidadeFinal = $quantidadeEstoque;
                    $quantidadePendente = 0;

                    for ($i = $quantidadeTotal; $i > 0; $i--) {

                        if ($quantidadeFinal > 0) {
                            $quantidadeFinal = $quantidadeFinal - 1;
                        }
                        else {
                            $quantidadePendente = $i;
                            break;
                        }
                    }

                    $sql = "UPDATE `estoque` SET `quantidade`=:quantidade WHERE `idEstoque` = '$idEstoque'";

                    $stmt = DB::prepare($sql);
                    $stmt->bindValue(':quantidade', $quantidadeFinal);
                    $stmt->execute();
                    
                    //------------------------------ segundo insert
                    
                    $sql3 = "INSERT INTO `estoque` (`grauEsferico`, `grauCilindro`, `eixo`, `grauAdicao`, `diametro`, `curvaBase`, `olho`, `quantidade`, `idProduto`) 
                    VALUES (?,?,?,?,?,?,?,?,?)";

                    $stmt3=DB::prepare($sql3);
                    $stmt3->bindValue(1, $_SESSION['carrinho'][$indice]['esfericoD']);
                    $stmt3->bindValue(2, $_SESSION['carrinho'][$indice]['cilindroD']);
                    $stmt3->bindValue(3, $_SESSION['carrinho'][$indice]['eixoD']);
                    $stmt3->bindValue(4, $_SESSION['carrinho'][$indice]['adicaoD']);
                    $stmt3->bindValue(5, $_SESSION['carrinho'][$indice]['diametroD']);
                    $stmt3->bindValue(6, $_SESSION['carrinho'][$indice]['curvaBaseD']);
                    $stmt3->bindValue(7, $_SESSION['carrinho'][$indice]['olhoD']);
                    $stmt3->bindValue(8, 0);
                    $stmt3->bindValue(9, $_SESSION['carrinho'][$indice]['idProduto']);

                    $stmt3->execute();

                    $sqlConsulta = "SELECT MAX(idEstoque) FROM estoque";
                    $consulta = DB::PDO($sqlConsulta);
                    $consulta->execute();

                    $ret = $consulta->fetchAll();

                    foreach($ret as $item)
                    {
                        $idEstoque = $item["MAX(idEstoque)"];
                    }

                    try {

                        $sqlConsultaEstoque = "SELECT * FROM estoque WHERE `idEstoque` = $idEstoque";
                        $consulta2 = DB::PDO($sqlConsultaEstoque);
                        $consulta2->execute();

                        $ret2 = $consulta2->fetchAll();

                        foreach($ret2 as $item)
                        {
                            $quantidadeEstoque = $item['quantidade'];
                        }
                    }
                    catch (Exception $e) {
                        $quantidadeEstoque = 0;
                    }

                    $quantidadeFinal = $quantidadeEstoque;
                    $quantidadePendente = 0;

                    for ($i = $quantidadeTotal; $i > 0; $i--) {

                        if ($quantidadeFinal > 0) {
                            $quantidadeFinal = $quantidadeFinal - 1;
                        }
                        else {
                            $quantidadePendente = $i;
                            break;
                        }
                    }

                    $sql = "UPDATE `estoque` SET `quantidade`=:quantidade WHERE `idEstoque` = '$idEstoque'";

                    $stmt = DB::prepare($sql);
                    $stmt->bindValue(':quantidade', $quantidadeFinal);
                    $stmt->execute();
                    
                }
                else if($idEstoque == -1 && $auxID == 0 || $idEstoque == -4) {
                    
                    $sql3 = "INSERT INTO `estoque` (`grauEsferico`, `grauCilindro`, `eixo`, `grauAdicao`, `diametro`, `curvaBase`, `olho`, `quantidade`, `idProduto`) 
                    VALUES (?,?,?,?,?,?,?,?,?)";

                    $stmt3=DB::prepare($sql3);
                    $stmt3->bindValue(1, $_SESSION['carrinho'][$indice]['esfericoD']);
                    $stmt3->bindValue(2, $_SESSION['carrinho'][$indice]['cilindroD']);
                    $stmt3->bindValue(3, $_SESSION['carrinho'][$indice]['eixoD']);
                    $stmt3->bindValue(4, $_SESSION['carrinho'][$indice]['adicaoD']);
                    $stmt3->bindValue(5, $_SESSION['carrinho'][$indice]['diametroD']);
                    $stmt3->bindValue(6, $_SESSION['carrinho'][$indice]['curvaBaseD']);
                    $stmt3->bindValue(7, $_SESSION['carrinho'][$indice]['olhoD']);
                    $stmt3->bindValue(8, 0);
                    $stmt3->bindValue(9, $_SESSION['carrinho'][$indice]['idProduto']);

                    $stmt3->execute();

                    $sqlConsulta = "SELECT MAX(idEstoque) FROM estoque";
                    $consulta = DB::PDO($sqlConsulta);
                    $consulta->execute();

                    $ret = $consulta->fetchAll();

                    foreach($ret as $item)
                    {
                        $idEstoque = $item["MAX(idEstoque)"];
                    }

                    try {

                        $sqlConsultaEstoque = "SELECT * FROM estoque WHERE `idEstoque` = $idEstoque";
                        $consulta2 = DB::PDO($sqlConsultaEstoque);
                        $consulta2->execute();

                        $ret2 = $consulta2->fetchAll();

                        foreach($ret2 as $item)
                        {
                            $quantidadeEstoque = $item['quantidade'];
                        }
                    }
                    catch (Exception $e) {
                        $quantidadeEstoque = 0;
                    }

                    $quantidadeFinal = $quantidadeEstoque;
                    $quantidadePendente = 0;

                    for ($i = $quantidadeTotal; $i > 0; $i--) {

                        if ($quantidadeFinal > 0) {
                            $quantidadeFinal = $quantidadeFinal - 1;
                        }
                        else {
                            $quantidadePendente = $i;
                            break;
                        }
                    }

                    $sql = "UPDATE `estoque` SET `quantidade`=:quantidade WHERE `idEstoque` = '$idEstoque'";

                    $stmt = DB::prepare($sql);
                    $stmt->bindValue(':quantidade', $quantidadeFinal);
                    $stmt->execute();                   
                }
                else {
                    $quantidadePendente = 0;
                }

                $sql2 = "INSERT INTO `itensPedido` (`idProduto`, `quantidadeD`, `idPedido`, `esfericoD`, `esfericoE`, `cilindroD`, `cilindroE`, `eixoD`, `eixoE`, `adicaoD`, `adicaoE`, `curvaBaseD`, `curvaBaseE`, `diametroD`, `diametroE`, `corD`, `corE`, `olhoDominante`, `quantidadeE`, `qtdePendente`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                
                $olhoD = 0;
                
                if ($_SESSION['carrinho'][$indice]['olhoD'] == 1) {
                    $olhoD = 1;
                }
                
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $_SESSION['carrinho'][$indice]['idProduto']);
                $stmt2->bindValue(2, $_SESSION['carrinho'][$indice]['quantidadeD']);
                $stmt2->bindValue(3, $id);
                $stmt2->bindValue(4, $_SESSION['carrinho'][$indice]['esfericoD']);
                $stmt2->bindValue(5, $_SESSION['carrinho'][$indice]['esfericoE']);
                $stmt2->bindValue(6, $_SESSION['carrinho'][$indice]['cilindroD']);
                $stmt2->bindValue(7, $_SESSION['carrinho'][$indice]['cilindroE']);
                $stmt2->bindValue(8, $_SESSION['carrinho'][$indice]['eixoD']);
                $stmt2->bindValue(9, $_SESSION['carrinho'][$indice]['eixoE']);
                $stmt2->bindValue(10, $_SESSION['carrinho'][$indice]['adicaoD']);
                $stmt2->bindValue(11, $_SESSION['carrinho'][$indice]['adicaoE']);
                $stmt2->bindValue(12, $_SESSION['carrinho'][$indice]['curvaBaseD']);
                $stmt2->bindValue(13, $_SESSION['carrinho'][$indice]['curvaBaseE']);
                $stmt2->bindValue(14, $_SESSION['carrinho'][$indice]['diametroD']);
                $stmt2->bindValue(15, $_SESSION['carrinho'][$indice]['diametroE']);
                $stmt2->bindValue(16, $_SESSION['carrinho'][$indice]['corD']);
                $stmt2->bindValue(17, $_SESSION['carrinho'][$indice]['corE']);
                $stmt2->bindValue(18, $olhoD);
                $stmt2->bindValue(19, $_SESSION['carrinho'][$indice]['quantidadeE']);
                $stmt2->bindValue(20, $quantidadePendente);
                
                if(!$stmt2->execute()) {
                    $db = false;
                }
            }
           
        } catch (Exception $e) {
            
            echo $e;
        }
        
        return $db;
    }
    
    public function getUltimoID() {
        
        $sqlConsulta = "SELECT MAX(idPedido) FROM pedidos";
        $consulta = DB::PDO($sqlConsulta);
        $consulta->execute();

        $ret = $consulta->fetchAll();
        
        $id;

        foreach($ret as $item)
        {
            $id = $item["MAX(idPedido)"];
        }
        
        return $id;        
    }
    
    public function funcaoGetPedidosAprovados() {
        
        $sqlConsulta = "SELECT * FROM pedidos 
                        INNER JOIN usuarios
                        ON usuarios.idUsuario = pedidos.idUsuario
                        INNER JOIN estados
                        ON estados.idEstado = usuarios.idEstado
                        INNER JOIN cidades
                        ON cidades.idCidade = usuarios.idCidade
                        ORDER BY data";
        
        $consulta = DB::PDO($sqlConsulta);
        $consulta->execute();

        $ret = $consulta->fetchAll();
        
        return $ret;
    }
    
    public function funcaoGetItensPedido($id) {
        
        try {
            
            $sql = "SELECT * FROM itenspedido WHERE `idPedido` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetHistorico($id) {
        
        try {
            
            $sql = "SELECT * FROM pedidos WHERE `idUsuario` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
}
