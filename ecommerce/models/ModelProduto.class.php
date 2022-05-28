<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelProduto extends DB {
    
    public function cadastrarProduto(Produto $produto) {
		
        $db = true;
        
        try {
            
            $sql = "INSERT INTO `Produtos` (`nome`, `valorUnit`, `idFornecedor`, `descartavel`, `anual`, `mensal`, `diaria`, `quinzenal`, `esferica`, `torica`, `multifocal`, `colorida`, `curvaUnica`, `diametroPadrao`, `olho`, `descricao`, `marca`, `tipo`, `material`, `visitint`, `imagem`, `tipoImagem`)
           VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

           $stmt=DB::prepare($sql);
           $stmt->bindValue(1, $produto->getNome());
           $stmt->bindValue(2, $produto->getValorUnit());
           $stmt->bindValue(3, $produto->getIdFornecedor());
           $stmt->bindValue(4, $produto->getDescartavel());
           $stmt->bindValue(5, $produto->getAnual());
           $stmt->bindValue(6, $produto->getMensal());
           $stmt->bindValue(7, $produto->getDiaria());
           $stmt->bindValue(8, $produto->getQuinzenal());
           $stmt->bindValue(9, $produto->getEsferica());
           $stmt->bindValue(10, $produto->getTorica());
           $stmt->bindValue(11, $produto->getMultifocal());
           $stmt->bindValue(12, $produto->getColorida());
           $stmt->bindValue(13, $produto->getCurvaUnica());
           $stmt->bindValue(14, $produto->getDiametroPadrao());
           $stmt->bindValue(15, $produto->getOlho());
           $stmt->bindValue(16, $produto->getDescricao());
           $stmt->bindValue(17, $produto->getMarca());
           $stmt->bindValue(18, $produto->getTipo());
           $stmt->bindValue(19, $produto->getMaterial());
           $stmt->bindValue(20, $produto->getVisitint());
           $stmt->bindValue(21, $produto->getImagem());
           $stmt->bindValue(22, $produto->getTipoImagem());


            if(!$stmt->execute()) {
                $db = false;
            }
            
            $nome = $produto->getNome();
            $fornecedor = $produto->getIdFornecedor();
            $valor = $produto->getValorUnit();
           
            $sqlConsulta = "SELECT `idProduto` FROM produtos WHERE (nome = '$nome' AND `idFornecedor` = '$fornecedor' AND `valorUnit` = '$valor')";
            $consulta = DB::PDO($sqlConsulta);
            $consulta->execute();
            
            $ret = $consulta->fetchAll();
            
            foreach($ret as $item)
            {
               $id = $item["idProduto"];
            }
            
            
            
            for($indice = 0; $indice < count($produto->getIntervaloEsferico()); $indice++) {
                
                
                
                $sql2 = "INSERT INTO `intervaloesferico` (`grauEsferico`, `idProduto`) VALUES(?,?)";
           
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $produto->getIntervaloEsferico()[$indice]);
                $stmt2->bindValue(2, $id);
                
                if(!$stmt2->execute()) {
                    $db = false;
                }
            }
            
            for($indice = 0; $indice < count($produto->getIntervaloCurvaBase()); $indice++) {
             
                $sql2 = "INSERT INTO `intervalocurvabase` (`curvaBase`, `idProduto`) VALUES(?,?)";
                
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $produto->getIntervaloCurvaBase()[$indice]);
                $stmt2->bindValue(2, $id);
                
                if(!$stmt2->execute()) {
                    $db = false;
                }
            }
            
            for($indice = 0; $indice < count($produto->getIntervaloDiametro()); $indice++) {  
            
                $sql2 = "INSERT INTO `intervalodiametro` (`diametro`, `idProduto`) VALUES(?,?)";
           
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $produto->getIntervaloDiametro()[$indice]);
                $stmt2->bindValue(2, $id);
                
                if(!$stmt2->execute()) {
                    $db = false;
                }
            }

            if (count($produto->getIntervaloCilindro()) > 0) {               
            
                for($indice = 0; $indice < count($produto->getIntervaloCilindro()); $indice++) {

                    $sql2 = "INSERT INTO `intervalocilindro` (`grauCilindro`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloCilindro()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }
            
            if (count($produto->getIntervaloEixo()) > 0) {
                
                for($indice = 0; $indice < count($produto->getIntervaloEixo()); $indice++) {
            
                    $sql2 = "INSERT INTO `intervaloeixo` (`eixo`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloEixo()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }
            
            if (count($produto->getIntervaloAdicao()) > 0) {
                
                for($indice = 0; $indice < count($produto->getIntervaloAdicao()); $indice++) {  
            
                    $sql2 = "INSERT INTO `intervaloadicao` (`grauAdicao`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloAdicao()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }
            
            if (count($produto->getIntervaloCor()) > 0) {
                
                for($indice = 0; $indice < count($produto->getIntervaloCor()); $indice++) {  
            
                    $sql2 = "INSERT INTO `intervalocor` (`cor`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloCor()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }
            
        } catch (Exception $e) {
            
            echo $e;
        }
        
        return $db;
    }
    
    //----------------------------------------------------[ ALTERAR PRODUTO ]-------------------------------------------------------------------//

    public function alterar(Produto $produto, $id) {
		
        $db = true;
        
        try {
            
           $sql = "UPDATE `Produtos` SET `nome`=:nome, `valorUnit`=:valorUnit, `idFornecedor`=:idFornecedor, `descartavel`=:descartavel, `anual`=:anual, `mensal`=:mensal, `diaria`=:diaria, `quinzenal`=:quinzenal, `esferica`=:esferica, `torica`=:torica, `multifocal`=:multifocal, `colorida`=:colorida, `curvaUnica`=:curvaUnica, `diametroPadrao`=:diametroPadrao, `olho`=:olho, `descricao`=:descricao, `marca`=:marca, `tipo`=:tipo, `material`=:material, `visitint`=:visitint, `imagem`=:imagem, `tipoImagem`=:tipoImagem WHERE `idProduto` = $id";

           $stmt=DB::prepare($sql);
           $stmt->bindValue(':nome', $produto->getNome());
           $stmt->bindValue(':valorUnit', $produto->getValorUnit());
           $stmt->bindValue(':idFornecedor', $produto->getIdFornecedor());
           $stmt->bindValue(':descartavel', $produto->getDescartavel());
           $stmt->bindValue(':anual', $produto->getAnual());
           $stmt->bindValue(':mensal', $produto->getMensal());
           $stmt->bindValue(':diaria', $produto->getDiaria());
           $stmt->bindValue(':quinzenal', $produto->getQuinzenal());
           $stmt->bindValue(':esferica', $produto->getEsferica());
           $stmt->bindValue(':torica', $produto->getTorica());
           $stmt->bindValue(':multifocal', $produto->getMultifocal());
           $stmt->bindValue(':colorida', $produto->getColorida());
           $stmt->bindValue(':curvaUnica', $produto->getCurvaUnica());
           $stmt->bindValue(':diametroPadrao', $produto->getDiametroPadrao());
           $stmt->bindValue(':olho', $produto->getOlho());
           $stmt->bindValue(':descricao', $produto->getDescricao());
           $stmt->bindValue(':marca', $produto->getMarca());
           $stmt->bindValue(':tipo', $produto->getTipo());
           $stmt->bindValue(':material', $produto->getMaterial());
           $stmt->bindValue(':visitint', $produto->getVisitint());
           $stmt->bindValue(':imagem', $produto->getImagem());
           $stmt->bindValue(':tipoImagem', $produto->getTipoImagem());
           
            if(!$stmt->execute()) {
                $db = false;
            }
            
            $sqlDeleteEsferico = "DELETE FROM `intervaloesferico` WHERE idProduto = $id";
            $deleteEsferico = DB::PDO($sqlDeleteEsferico);
            $deleteEsferico->execute();
            
            for($indice = 0; $indice < count($produto->getIntervaloEsferico()); $indice++) {
                
                
                
                $sql2 = "INSERT INTO `intervaloesferico` (`grauEsferico`, `idProduto`) VALUES(?,?)";
           
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $produto->getIntervaloEsferico()[$indice]);
                $stmt2->bindValue(2, $id);
                
                if(!$stmt2->execute()) {
                    $db = false;
                }
            }
            
            $sqlDeleteCurvaBase = "DELETE FROM `intervalocurvabase` WHERE idProduto = $id";
            $deleteCurvaBase = DB::PDO($sqlDeleteCurvaBase);
            $deleteCurvaBase->execute();
            
            for($indice = 0; $indice < count($produto->getIntervaloCurvaBase()); $indice++) {
             
                $sql2 = "INSERT INTO `intervalocurvabase` (`curvaBase`, `idProduto`) VALUES(?,?)";
                
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $produto->getIntervaloCurvaBase()[$indice]);
                $stmt2->bindValue(2, $id);
                
                if(!$stmt2->execute()) {
                    $db = false;
                }
            }
            
            $sqlDeleteDiametro = "DELETE FROM `intervalodiametro` WHERE idProduto = $id";
            $deleteDiametro = DB::PDO($sqlDeleteDiametro);
            $deleteDiametro->execute();
            
            for($indice = 0; $indice < count($produto->getIntervaloDiametro()); $indice++) {  
            
                $sql2 = "INSERT INTO `intervalodiametro` (`diametro`, `idProduto`) VALUES(?,?)";
           
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $produto->getIntervaloDiametro()[$indice]);
                $stmt2->bindValue(2, $id);
                
                if(!$stmt2->execute()) {
                    $db = false;
                }
            }
            
            $sqlDeleteCilindro = "DELETE FROM `intervalocilindro` WHERE idProduto = $id";
            $deleteCilindro = DB::PDO($sqlDeleteCilindro);
            $deleteCilindro->execute();

            if (count($produto->getIntervaloCilindro()) > 0) {               
            
                for($indice = 0; $indice < count($produto->getIntervaloCilindro()); $indice++) {

                    $sql2 = "INSERT INTO `intervalocilindro` (`grauCilindro`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloCilindro()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }
            
            $sqlDeleteEixo = "DELETE FROM `intervaloeixo` WHERE idProduto = $id";
            $deleteEixo = DB::PDO($sqlDeleteEixo);
            $deleteEixo->execute();
            
            if (count($produto->getIntervaloEixo()) > 0) {
                
                for($indice = 0; $indice < count($produto->getIntervaloEixo()); $indice++) {
            
                    $sql2 = "INSERT INTO `intervaloeixo` (`eixo`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloEixo()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }
            
            $sqlDeleteAdicao = "DELETE FROM `intervaloadicao` WHERE idProduto = $id";
            $deleteAdicao = DB::PDO($sqlDeleteAdicao);
            $deleteAdicao->execute();
            
            if (count($produto->getIntervaloAdicao()) > 0) {
                
                for($indice = 0; $indice < count($produto->getIntervaloAdicao()); $indice++) {  
            
                    $sql2 = "INSERT INTO `intervaloadicao` (`grauAdicao`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloAdicao()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }

            $sqlDeleteCor = "DELETE FROM `intervalocor` WHERE idProduto = $id";
            $deleteCor = DB::PDO($sqlDeleteCor);
            $deleteCor->execute();
            
            if (count($produto->getIntervaloCor()) > 0) {
                
                for($indice = 0; $indice < count($produto->getIntervaloCor()); $indice++) {  
            
                    $sql2 = "INSERT INTO `intervalocor` (`cor`, `idProduto`) VALUES(?,?)";

                    $stmt2=DB::prepare($sql2);
                    $stmt2->bindValue(1, $produto->getIntervaloCor()[$indice]);
                    $stmt2->bindValue(2, $id);

                    if(!$stmt2->execute()) {
                        $db = false;
                    }
                }
            }
            
        } catch (Exception $e) {
            
            echo $e;
        }
        
        return $db;
    }
    
    function retorno($mensagem, $sucesso = false) {
        // Criando vetor com a propriedades
        $retorno = array();
        $retorno['sucesso'] = $sucesso;
        $retorno['mensagem'] = $mensagem;

        // Convertendo para JSON e retornando
        return json_encode($retorno);
    }
    
    public function getImg($id) {
		
        try {
            
            $sql = "SELECT imagem, tipoImagem FROM produtos WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM produtos WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getProdutoHistorico($idPedido) {
		
        try {
            
            $sql = "SELECT * FROM itenspedido INNER JOIN produtos ON itenspedido.idProduto = produtos.idProduto WHERE `idPedido` = $idPedido";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getDetalhesProdutoHistorico($idProduto, $idPedido) {
		
        try {
            
            $sql = "SELECT * FROM itenspedido INNER JOIN produtos ON itenspedido.idProduto = produtos.idProduto WHERE `idProduto` = $idProduto AND `idPedido` = $idPedido";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getTodosProdutos() {
		
        try {
            
            $sql = "SELECT * FROM produtos";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getTodosProdutosOption($id) {
		
        try {
            
            $sql = "SELECT * FROM produtos WHERE `idProduto` != $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloEsferico($id) {
		
        try {
            
            $sql = "SELECT * FROM intervaloesferico WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloEsfericoEdit($id, $grau) {
		
        try {
            
            $sql = "SELECT * FROM intervaloesferico WHERE `idProduto` = $id AND `grauEsferico` != $grau";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCurvaBase($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalocurvabase WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCurvaBaseEdit($id, $curva) {
		
        try {
            
            $sql = "SELECT * FROM intervalocurvabase WHERE `idProduto` = $id AND `curvaBase` != $curva";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloDiametro($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalodiametro WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloDiametroEdit($id, $diametro) {
		
        try {
            
            $sql = "SELECT * FROM intervalodiametro WHERE `idProduto` = $id AND `diametro` != $diametro";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCilindro($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalocilindro WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCilindroEdit($id, $cilindro) {
		
        try {
            
            $sql = "SELECT * FROM intervalocilindro WHERE `idProduto` = $id AND `grauCilindro` != $cilindro";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloEixo($id) {
		
        try {
            
            $sql = "SELECT * FROM intervaloeixo WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloEixoEdit($id, $eixo) {
		
        try {
            
            $sql = "SELECT * FROM intervaloeixo WHERE `idProduto` = $id AND `eixo` != $eixo";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloAdicao($id) {
		
        try {
            
            $sql = "SELECT * FROM intervaloadicao WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloAdicaoEdit($id, $adicao) {
		
        try {
            
            $sql = "SELECT * FROM intervaloadicao WHERE `idProduto` = $id AND `grauAdicao` != $adicao";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCor($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalocor WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCorEdit($id, $cor) {
		
        try {
            
            $sql = "SELECT * FROM intervalocor WHERE `idProduto` = $id AND `cor` != $cor";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloEsfericoProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM intervaloesferico WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCilindroProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalocilindro WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloEixoProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM intervaloeixo WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCurvaBaseProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalocurvabase WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloDiametroProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalodiametro WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloCorProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM intervalocor WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function funcaoGetIntervaloAdicaoProduto($id) {
		
        try {
            
            $sql = "SELECT * FROM intervaloadicao WHERE `idProduto` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function desativar($id) {
        
      try {

        $sql = "UPDATE `produtos` SET `status`=:status WHERE `idProduto` = '$id'";

        $stmt = DB::prepare($sql);
        $stmt->bindValue(':status', 1);
        return $stmt->execute();
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function ativar($id) {
        
      try {

        $sql = "UPDATE `produtos` SET `status`=NULL WHERE `idProduto` = '$id'";

        $stmt = DB::prepare($sql);
        return $stmt->execute();
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function registrarOpiniao($id, $nota, $opiniao, $idUsuario) {
        
      try {

        $sql = "INSERT INTO `avaliacao` (`idProduto`, `idUsuario`, `nota`, `opiniao`)
        VALUES (?,?,?,?)";

        $stmt=DB::prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $idUsuario);
        $stmt->bindValue(3, $nota);
        $stmt->bindValue(4, $opiniao);

        return $stmt->execute();
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function emitirRelatorioVendas($data1, $data2) {
        
      try {

        $sql = "SELECT *, SUM(itenspedido.quantidadeD) as q1, SUM(itenspedido.quantidadeE) as q2 FROM produtos 
                INNER JOIN itenspedido
                ON itenspedido.idProduto = produtos.idProduto
                INNER JOIN pedidos
                ON pedidos.idPedido = itenspedido.idPedido
                WHERE pedidos.data >= '$data1 00:00:00' AND pedidos.data <= '$data2 23:59:59' 
                GROUP BY itenspedido.idProduto";
      
        $consulta = DB::PDO($sql);
        $consulta->execute();        
        $ret = $consulta->fetchAll();

        return $ret;        
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function emitirRelatorioCompras($data1, $data2) {
        
      try {

        $sql = "SELECT *, SUM(itenscompra.quantidade) as q FROM produtos 
                INNER JOIN itenscompra
                ON itenscompra.idProduto = produtos.idProduto
                INNER JOIN compras
                ON compras.idCompra = itenscompra.idCompra
                WHERE compras.data >= '$data1' AND compras.data <= '$data2' 
                GROUP BY itenscompra.idProduto";
      
        $consulta = DB::PDO($sql);
        $consulta->execute();        
        $ret = $consulta->fetchAll();

        return $ret;        
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
}