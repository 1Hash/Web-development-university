<?php

session_start();

require_once("../models/ModelUsuario.class.php");
require_once("../classes/Usuario.class.php");


    // -------------------------------------------------[ CADASTRO USUÁRIO ]------------------------------------------------- //

    if (isset($_POST['nome'])) {

        $id = null;
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confirmarSenha'];
        
        $senha = sha1($senha);
        
        $usuario = new Usuario($id, $nome, $sobrenome, $cpf, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $estado, $telefone, $email, $senha);
        
        if ($usuario->consultaCadastroUsuario($cpf, $email)) {
            print "0";
        }
        else {
            
            if ($usuario->cadastrar($usuario)){
                print "1";
            }
            else {
                print "0";
            }
        }
    }
    
    // -------------------------------------------------[ EDITAR USUÁRIO ]------------------------------------------------- //
    
    if (isset($_POST['idInputEditar'])) {

        // Constantes
        define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

        $id = $_POST['idInputEditar'];
        $nome = $_POST['nomeInput'];
        $sobrenome = $_POST['sobrenomeInput'];
        $email = $_POST['emailInput'];
        $cpf = $_POST['cpfInput'];
        $telefone = $_POST['telefoneInput'];
        $cep = $_POST['cepInput'];
        $endereco = $_POST['enderecoInput'];
        $numero = $_POST['numeroInput'];
        $complemento = $_POST['complementoInput'];
        $bairro = $_POST['bairroInput'];
        $estado = $_POST['estadoInput'];
        $cidade = $_POST['cidadeInput'];
        
        $condCarregaFoto = true;

        // Transformando foto em dados (binário)
        if (!isset($_FILES['foto'])) {
            
            $usuarioImg = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            
            foreach($usuarioImg->getImagem($id) as $var) {
                
                if ($var['imagem'] == null) {
                    
                    $conteudo = null;
                    $tipo = null;
                }
                else {
                    $conteudo = $var['imagem'];
                    $tipo = $var['imagemTipo'];
                    $condCarregaFoto = false;
                }
            }
        }
        else {
            
            //Recupera os dados dos campos
            $foto = $_FILES['foto'];
            $tipo = $foto['type'];
            $tamanho = $foto['size'];

            // Formato
            if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)) {
                echo retorno('Isso não é uma imagem válida');
                exit;
            }

            // Tamanho
            if ($tamanho > TAMANHO_MAXIMO) {
                echo retorno('A imagem deve possuir no máximo 2 MB');
                exit;
            }
            
            if ($condCarregaFoto) {
                $conteudo = file_get_contents($foto['tmp_name']);
            }           
        }

        $usuario = new Usuario($id, $nome, $sobrenome, $cpf, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $estado, $telefone, $email, null);

        if ($usuario->alterar($usuario, $id, $conteudo, $tipo)) {
            echo retorno("Dados alterados com sucesso!", true);
            exit;
        }
        else {
            echo retorno("Não foi possível alterar seus dados no momento!");
            exit;
        }
    } 

    // -------------------------------------------------[ LOGIN USUÁRIO ]------------------------------------------------- //
    
    if (isset($_POST['emailCPF'])) {
        
        $emailCPF = $_POST['emailCPF'];
        $senha = $_POST['senha'];
        
        $senha = sha1($senha);
        
        $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        
        if ($usuario->consultaLogin($emailCPF, $senha)) {
            if ($emailCPF == "admin@elentes.com") {
                $_SESSION['admin'] = $usuario->getIDUsuario($emailCPF);
                print "2";
            }
            else {
                $_SESSION['usuario'] = $usuario->getIDUsuario($emailCPF);
                print "0";
            }
            
        }
        else {
            print "1";
        }
    }
    
    // -------------------------------------------------[ GET IMAGEM ]------------------------------------------------- //
    
    if (isset($_GET['getImagem'])) {
        
        $id = (int) $_GET['getImagem'];

        $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        
        foreach($usuario->getImagem($id) as $var) {
            if ($var['imagem'] != null) {

                header('Content-Type: '. $var['imagemTipo']);
                echo $var['imagem'];
            }
        }
    }
    
    if (isset($_GET['getImagemP'])) {
        
        $id = (int) $_GET['getImagemP'];

        $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        
        foreach($usuario->getImagemP($id) as $var) {
            if ($var['imagem'] != null) {

                header('Content-Type: '. $var['tipoImagem']);
                echo $var['imagem'];
            }
        }
    }
    
    if (isset($_GET['getImagemN'])) {
        
        $id = (int) $_GET['getImagemN'];

        $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        
        foreach($usuario->getImagemN($id) as $var) {
            if ($var['imagem'] != null) {

                header('Content-Type: '. $var['tipoImagem']);
                echo $var['imagem'];
            }
        }
    }
    
    if (isset($_GET['getImagemD'])) {
        
        $id = (int) $_GET['getImagemD'];

        $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        
        foreach($usuario->getImagemD($id) as $var) {
            if ($var['imagem'] != null) {

                header('Content-Type: '. $var['tipoImagem']);
                echo $var['imagem'];
            }
        }
    }
    
    // -------------------------------------------------[ ALTERAR SENHA ]------------------------------------------------- //
    
    if (isset($_POST['novaSenhaInput'])) {
        
        
        
        $senha = $_POST['novaSenhaInput'];
        
        $senha = sha1($senha);
        
        $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        
        
        if ($usuario->alterarSenha($_SESSION['usuario'], $senha)) {
            echo retorno("Senha alterada com sucesso!", true);
            exit;
        }
        else {
            echo retorno("Não foi possível alterar sua senha no momento!");
            exit;
        }
    }
    
    // -------------------------------------------------[ FUNÇÕES ]------------------------------------------------- //
    
    function retorno($mensagem, $sucesso = false)
    {
        // Criando vetor com a propriedades
        $retorno = array();
        $retorno['sucesso'] = $sucesso;
        $retorno['mensagem'] = $mensagem;

        // Convertendo para JSON e retornando
        return json_encode($retorno);
    }
    

