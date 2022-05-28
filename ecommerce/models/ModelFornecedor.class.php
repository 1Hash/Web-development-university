<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelFornecedor extends DB {
    
    public function cadastrarFornecedor(Fornecedor $fornecedor) {
		
        try {
            
           $sql = "INSERT INTO `Fornecedores` (`razaoSocial`, `cnpj`, `inscricaoEstadual`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `telefone`, `e-mail`, `idEstado`, `idCidade`) 
           VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

           $stmt=DB::prepare($sql);
           $stmt->bindValue(1, $fornecedor->getRazaoSocial());
           $stmt->bindValue(2, $fornecedor->getCnpj());
           $stmt->bindValue(3, $fornecedor->getInscricaoEstadual());
           $stmt->bindValue(4, $fornecedor->getCep());
           $stmt->bindValue(5, $fornecedor->getEndereco());
           $stmt->bindValue(6, $fornecedor->getNumero());
           $stmt->bindValue(7, $fornecedor->getComplemento());
           $stmt->bindValue(8, $fornecedor->getBairro());
           $stmt->bindValue(9, $fornecedor->getTelefone());
           $stmt->bindValue(10, $fornecedor->getEmail());
           $stmt->bindValue(11, $fornecedor->getEstado());
           $stmt->bindValue(12, $fornecedor->getCidade());
           return $stmt->execute();
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function alterarFornecedor(Fornecedor $fornecedor, $id) {
        
      try {

        $sql = "UPDATE `Fornecedores` SET `razaoSocial`=:razaoSocial, `cnpj`=:cnpj, `inscricaoEstadual`=:inscricaoEstadual, `cep`=:cep, `endereco`=:endereco, `numero`=:numero, `complemento`=:complemento, `bairro`=:bairro, `telefone`=:telefone, `idEstado`=:estado, `idCidade`=:cidade, `e-mail`=:email WHERE `idFornecedor` = '$id'";

        $stmt = DB::prepare($sql);
        $stmt->bindValue(':razaoSocial', $fornecedor->getRazaoSocial());
        $stmt->bindValue(':cnpj', $fornecedor->getCnpj());
        $stmt->bindValue(':inscricaoEstadual', $fornecedor->getInscricaoEstadual());
        $stmt->bindValue(':cep', $fornecedor->getCep());
        $stmt->bindValue(':endereco', $fornecedor->getEndereco());
        $stmt->bindValue(':numero', $fornecedor->getNumero());
        $stmt->bindValue(':complemento', $fornecedor->getComplemento());
        $stmt->bindValue(':bairro', $fornecedor->getBairro());
        $stmt->bindValue(':telefone', $fornecedor->getTelefone());
        $stmt->bindValue(':estado', $fornecedor->getEstado());
        $stmt->bindValue(':cidade', $fornecedor->getCidade());
        $stmt->bindValue(':email', $fornecedor->getEmail());
        return $stmt->execute();
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function getTodosFornecedores() {
		
        try {
            
            $sql = "SELECT * FROM fornecedores";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getFornecedor($id) {
		
        try {
            
            $sql = "SELECT * FROM fornecedores WHERE `idFornecedor` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function inserirCompra($fornecedor, $obs, $produtos) {
        
        $cond = true;
        $data = date('Y-m-d');
        
        try {
            
            $sql = "INSERT INTO `compras` (`obs`, `data`) 
            VALUES (?,?)";
            
            $stmt=DB::prepare($sql);
            $stmt->bindValue(1, $obs);
            $stmt->bindValue(2, $data);
            
            if(!$stmt->execute()) {
                $cond = false;
            }
            
            $sqlConsulta = "SELECT `idCompra` FROM compras";
            $consulta = DB::PDO($sqlConsulta);
            $consulta->execute();
            
            $ret = $consulta->fetchAll();
            
            $idCompras = 0;
            
            foreach($ret as $item)
            {
               $idCompras = $item["idCompra"];
            }
            
            foreach ($produtos as $indice => $var) {

                $sql2 = "INSERT INTO `itenscompra` (`idProduto`, `idFornecedor`, `quantidade`, `idCompra`, `esferico`, `cilindro`, `eixo`, `curvaBase`, `diametro`, `adicao`, `cor`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";

                $cilindro = 0;
                $eixo = 0;
                $adicao = 0;
                
                if (!empty($var['cilindro'])) {
                    $cilindro = $var['cilindro'];
                }
                
                if (!empty($var['eixo'])) {
                    $eixo = $var['eixo'];
                }
                
                if (!empty($var['adicao'])) {
                    $adicao = $var['adicao'];
                }
                
                $stmt2=DB::prepare($sql2);
                $stmt2->bindValue(1, $var['idProduto']);
                $stmt2->bindValue(2, $fornecedor);
                $stmt2->bindValue(3, $var['quantidade']);
                $stmt2->bindValue(4, $idCompras);
                $stmt2->bindValue(5, $var['esferico']);
                $stmt2->bindValue(6, $cilindro);
                $stmt2->bindValue(7, $eixo);
                $stmt2->bindValue(8, $var['curvaBase']);
                $stmt2->bindValue(9, $var['diametro']);
                $stmt2->bindValue(10, $eixo);
                $stmt2->bindValue(11, $var['cor']);
                
                if(!$stmt2->execute()) {
                    $cond = false;
                }
            }

            return $cond;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
}

