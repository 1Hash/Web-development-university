<?php

session_start();

require_once("../models/ModelNoticia.class.php");
require_once("../classes/Noticia.class.php");

if (isset($_POST['tituloNoticiaInput'])) {
    
    $titulo = $_POST['tituloNoticiaInput'];    
    $descricao = $_POST['descricaoNoticiaInput'];
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
    
    
    
    $noticia = new Noticia($titulo, $descricao, $data);
    
    if ($noticia->publicar($noticia, $conteudo, $tipo)) {
        
        echo retorno('Noticia publicada!', true);
        exit;
    }
    else {
        
        echo retorno('Ocorreu um erro ao publicar a noticia!');
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

