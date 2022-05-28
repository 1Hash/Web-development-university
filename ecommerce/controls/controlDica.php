<?php

session_start();

require_once("../models/ModelDica.class.php");
require_once("../classes/Dica.class.php");

if (isset($_POST['tituloDicaInput'])) {
    
    $titulo = $_POST['tituloDicaInput'];    
    $descricao = $_POST['descricaoDicaInput'];
    $data = date("Y-m-d");
    
    define('TAMANHO_MAXIMO', (2 * 2048 * 2048));
    
    $condCarregaFoto = true;

    if (isset($_FILES['foto'])) {

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
            echo retorno('A imagem deve possuir no máximo 4 MB');
            exit;
        }

        if ($condCarregaFoto) {
            $conteudo = file_get_contents($foto['tmp_name']);
        }           
    }
    else {
        echo retorno('Nenhuma imagem foi selecionada!');
        exit;
    }
    
    $dica = new Dica($titulo, $descricao, $data);
    
    if ($dica->publicar($dica, $conteudo, $tipo)) {
        
        echo retorno('Dica publicada!', true);
        exit;
    }
    else {
        
        echo retorno('Ocorreu um erro ao publicar a dica!');
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