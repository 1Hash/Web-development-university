<?php

session_start();

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

require_once("../models/ModelFornecedor.class.php");
require_once("../classes/Fornecedor.class.php");


// --------------------------------- CADASTRAR FORNECEDOR ------------------------------- //
    if (isset($_POST['razaoSocialInput'])) {

        $id = null;
        $razaoSocial = $_POST['razaoSocialInput'];
        $cnpj = $_POST['cnpjInput'];
        $inscricaoEstadual = $_POST['inscricaoEstadualInput'];
        $telefone = $_POST['telefoneInput'];
        $email = $_POST['emailInput'];        
        $cep = $_POST['cepInput'];
        $endereco = $_POST['enderecoInput'];
        $numero = $_POST['numeroInput'];
        $complemento = $_POST['complementoInput'];
        $bairro = $_POST['bairroInput'];
        $estado = $_POST['estadoInput'];
        $cidade = $_POST['cidadeInput'];
        
        $fornecedor = new Fornecedor($id, $razaoSocial, $cnpj, $inscricaoEstadual, $telefone, $email, $cep, $endereco, $numero, $complemento, $bairro, $estado, $cidade);
        

        if ($fornecedor->cadastrarFornecedor($fornecedor)){
            echo retorno('Fornecedor cadastrado com sucesso!', true);
            exit;
        }
        else {
            echo retorno('Não foi possível cadastrar o Fornecedor!');
            exit;
        }
    }
    
    // --------------------------------- EDITAR FORNECEDOR ------------------------------- //
    if (isset($_POST['idFornecedorInput'])) {

        $id = $_POST['idFornecedorInput'];
        $razaoSocial = $_POST['razaoSocialInputEdit'];
        $cnpj = $_POST['cnpjInput'];
        $inscricaoEstadual = $_POST['inscricaoEstadualInput'];
        $telefone = $_POST['telefoneInput'];
        $email = $_POST['emailInput'];        
        $cep = $_POST['cepInput'];
        $endereco = $_POST['enderecoInput'];
        $numero = $_POST['numeroInput'];
        $complemento = $_POST['complementoInput'];
        $bairro = $_POST['bairroInput'];
        $estado = $_POST['estadoInput'];
        $cidade = $_POST['cidadeInput'];

        $fornecedor = new Fornecedor($id, $razaoSocial, $cnpj, $inscricaoEstadual, $telefone, $email, $cep, $endereco, $numero, $complemento, $bairro, $estado, $cidade);

        if ($fornecedor->alterarFornecedor($fornecedor, $id)) {
            echo retorno("Fornecedor alterado com sucesso!", true);
            exit;
        }
        else {
            echo retorno("Não foi possível alterar o fornecedor no momento!");
            exit;
        }
    } 
        
    function retorno($mensagem, $sucesso = false)
    {
        // Criando vetor com a propriedades
        $retorno = array();
        $retorno['sucesso'] = $sucesso;
        $retorno['mensagem'] = $mensagem;

        // Convertendo para JSON e retornando
        return json_encode($retorno);
    }
    
    if (isset($_GET['fornecedor'])) {
        
        $id = $_GET['fornecedor'];

        $sql = "SELECT * FROM produtos WHERE idFornecedor = '$id' ORDER BY nome";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um fornecedor</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione um produto --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['idProduto']."'>".$var['nome']."</option>";
            }
        }
        else if ($id != '') {
            echo "<option value=''>Esse fornecedor ainda não possui produtos</option>";
        }

        exit();  
    }
    
    if (isset($_GET['esferico'])) {
        
        $id = $_GET['esferico'];

        $sql = "SELECT * FROM intervaloesferico WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um produto</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione um grau --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['grauEsferico']."'>".$var['grauEsferico']."</option>";
            }
        }

        exit();  
    }
    
    if (isset($_GET['curvabase'])) {
        
        $id = $_GET['curvabase'];

        $sql = "SELECT * FROM intervalocurvabase WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um produto</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione uma curva base --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['curvaBase']."'>".$var['curvaBase']."</option>";
            }
        }

        exit();  
    }
    
    if (isset($_GET['diametro'])) {
        
        $id = $_GET['diametro'];

        $sql = "SELECT * FROM intervalodiametro WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um produto</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione um diametro --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['diametro']."'>".$var['diametro']."</option>";
            }
        }

        exit();  
    }
    
    if (isset($_GET['cilindro'])) {
        
        $id = $_GET['cilindro'];

        $sql = "SELECT * FROM intervalocilindro WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um produto</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione um grau --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['grauCilindro']."'>".$var['grauCilindro']."</option>";
            }
        }

        exit();  
    }
    
    if (isset($_GET['eixo'])) {
        
        $id = $_GET['eixo'];

        $sql = "SELECT * FROM intervaloeixo WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um produto</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione um eixo --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['eixo']."'>".$var['eixo']."</option>";
            }
        }

        exit();  
    }
    
    if (isset($_GET['adicao'])) {
        
        $id = $_GET['adicao'];

        $sql = "SELECT * FROM intervaloadicao WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um produto</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione um grau --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['grauAdicao']."'>".$var['grauAdicao']."</option>";
            }
        }

        exit();  
    }
    
    if (isset($_GET['cor'])) {
        
        $id = $_GET['cor'];

        $sql = "SELECT * FROM intervalocor WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        if($id == '') {
            echo "<option value=''>Primeiro selecione um produto</option>";
        }
        
        if (count($consulta) > 0) {

            echo "<option value=''>-- Selecione uma cor --</option>";
            
            foreach($consulta as $var) {

                echo "<option value='".$var['cor']."'>".$var['cor']."</option>";
            }
        }

        exit();  
    }
    
    if (isset($_POST['torica']) || isset($_POST['multifocal']) || isset($_POST['cor'])) {
        
        if (isset($_POST['torica'])) {
            $id = $_POST['torica'];
        }
        else if (isset($_POST['multifocal'])) {
            $id = $_POST['multifocal'];
        }
        else {
            $id = $_POST['cor'];
        }

        $sql = "SELECT * FROM produtos WHERE idProduto = '$id'";
        $consulta = DB::PDO($sql);

        $consulta->execute();
        $consulta = $consulta->fetchAll();
        
        foreach($consulta as $var) {


            if (isset($_POST['torica'])) {
                print $var['torica'];
                //retorno("teste");
            }
            else if (isset($_POST['multifocal'])) {
                print $var['multifocal'];
            }
            else {
                print $var['colorida'];
            }
        }

        exit();  
    }
    
    if (isset($_POST['obsPedidoFornecedor'])) {
        
        $obs = $_POST['obsPedidoFornecedor'];
        $id = $_POST['fornecedorInput'];
        
        $fornecedor = new Fornecedor(null, null, null, null, null, null, null, null, null, null, null, null, null);
        
        if ($fornecedor->inserirCompra($id, $obs, $_SESSION['listaProdutos'])) {
            
            header('Location: ../pedido-fornecedor?el');
        }
    }
