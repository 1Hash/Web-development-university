<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelUsuario extends DB {
    
    public function cadastrar(Usuario $usuario) {
		
        $pontos = array("-", ".");
	$cpf = str_replace($pontos, "", $usuario->getCpf());
        
        try {
            
           $sql = "INSERT INTO `Usuarios` (`nome`, `sobrenome`, `e-mail`, `cpf`, `senha`, `cep`, `endereço`, `numero`, `complemento`, `bairro`, `telefone`, `idEstado`, `idCidade`) 
           VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

           $stmt=DB::prepare($sql);
           $stmt->bindValue(1, $usuario->getNome());
           $stmt->bindValue(2, $usuario->getSobrenome());
           $stmt->bindValue(3, $usuario->getEmail());
           $stmt->bindValue(4, $cpf);
           $stmt->bindValue(5, $usuario->getSenha());
           $stmt->bindValue(6, $usuario->getCep());
           $stmt->bindValue(7, $usuario->getEndereco());
           $stmt->bindValue(8, $usuario->getNumero());
           $stmt->bindValue(9, $usuario->getComplemento());
           $stmt->bindValue(10, $usuario->getBairro());
           $stmt->bindValue(11, $usuario->getTelefone());
           $stmt->bindValue(12, $usuario->getEstado());
           $stmt->bindValue(13, $usuario->getCidade());
           
           return $stmt->execute();
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function alterar(Usuario $usuario, $id, $imagem, $tipo) {
        
      try {
          
        $pontos = array("-", ".");
	$cpf = str_replace($pontos, "", $usuario->getCpf());

        $sql = "UPDATE `Usuarios` SET `nome`=:nome, `sobrenome`=:sobrenome, `e-mail`=:email, `cpf`=:cpf, `endereço`=:endereco, `numero`=:numero, `cep`=:cep, `complemento`=:complemento, `bairro`=:bairro, `telefone`=:telefone, `idEstado`=:estado, `idCidade`=:cidade, `imagem`=:imagem, `imagemTipo`=:tipo WHERE `idUsuario` = '$id'";

        $stmt = DB::prepare($sql);
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':sobrenome', $usuario->getSobrenome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':cep', $usuario->getCep());
        $stmt->bindValue(':endereco', $usuario->getEndereco());
        $stmt->bindValue(':numero', $usuario->getNumero());
        $stmt->bindValue(':complemento', $usuario->getComplemento());
        $stmt->bindValue(':bairro', $usuario->getBairro());
        $stmt->bindValue(':telefone', $usuario->getTelefone());
        $stmt->bindValue(':estado', $usuario->getEstado());
        $stmt->bindValue(':cidade', $usuario->getCidade());
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':tipo', $tipo);
        return $stmt->execute();
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function alterarSenha($id, $senha) {
        
      try {

        $sql = "UPDATE `Usuarios` SET `senha`=:senha WHERE `idUsuario` = '$id'";

        $stmt = DB::prepare($sql);
        $stmt->bindValue(':senha', $senha);
        return $stmt->execute();
      } 
      catch (Exception $e) {
        print ("Ocorreu um erro ao tentar executar esta ação - Mensagem: ".$e->getMessage());
      }
    }
    
    public function consultaCadastroUsuario($cpfp, $email) {
		
        try {
            
            $pontos = array("-", ".");
            $cpf = str_replace($pontos, "", $cpfp);
            
            $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf' OR `e-mail` = '$email'";
            $consulta = DB::PDO($sql);
            $consulta->execute();
            $cont = $consulta->rowCount();
            
            if ($cont > 0) {
                return true;
            }
            else {
                return false;
            }
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function consultaLogin($emailCPF, $senha) {
		    
        $pontos = array("-", ".");
	$cpf = str_replace($pontos, "", $emailCPF);
        
        try {
            
            $sql = "SELECT * FROM usuarios WHERE (cpf = '$emailCPF' OR `e-mail` = '$emailCPF' OR cpf = '$cpf') AND (senha = '$senha')";
            $consulta = DB::PDO($sql);
            $consulta->execute();
            $cont = $consulta->rowCount();
            
            if ($cont > 0) {
                return true;
            }
            else {
                return false;
            }
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getIDUsuario($emailCPF) {
		
        try {
            
            $sql = "SELECT `idUsuario` FROM usuarios WHERE (cpf = '$emailCPF' OR `e-mail` = '$emailCPF')";
            $consulta = DB::PDO($sql);
            $consulta->execute();
            
            $ret = $consulta->fetchAll();
            
            foreach($ret as $item)
            {
               $id = $item["idUsuario"];
            }
            
            return $id;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getUsuario($id) {
		
        try {
            
            $sql = "SELECT * FROM usuarios WHERE `idUsuario` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getImagem($id) {
		
        try {
            
            $sql = "SELECT imagem, imagemTipo FROM usuarios WHERE `idUsuario` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getImagemP($id) {
		
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
    
    public function getImagemN($id) {
		
        try {
            
            $sql = "SELECT imagem, tipoImagem FROM noticias WHERE `idNoticias` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
    
    public function getImagemD($id) {
		
        try {
            
            $sql = "SELECT imagem, tipoImagem FROM dicas WHERE `idDicas` = $id";
            $consulta = DB::PDO($sql);
            $consulta->execute();        
            $ret = $consulta->fetchAll();
            
            return $ret;
           
        } catch (Exception $e) {
            
            echo $e;
        }
    }
}
