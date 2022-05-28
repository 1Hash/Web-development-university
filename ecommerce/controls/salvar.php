<?php
// Incluindo arquivo de conexão
require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

require_once("../models/ModelUsuario.class.php");
require_once("../classes/Usuario.class.php");

function retorno($mensagem, $sucesso = false)
{
    // Criando vetor com a propriedades
    $retorno = array();
    $retorno['sucesso'] = $sucesso;
    $retorno['mensagem'] = $mensagem;

    // Convertendo para JSON e retornando
    return json_encode($retorno);
} 

// Constantes
define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

// Verificando se selecionou alguma imagem
if (!isset($_FILES['foto']))
{
    echo retorno('Selecione uma imagem');
    exit;
}


$id = $_POST['idInput'];
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

// Recupera os dados dos campos
$foto = $_FILES['foto'];
//$nome = $foto['name'];
$tipo = $foto['type'];
$tamanho = $foto['size'];

// Validações básicas
// Formato
if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo))
{
    echo retorno('Isso não é uma imagem válida');
    exit;
}



// Tamanho
if ($tamanho > TAMANHO_MAXIMO)
{
    echo retorno('A imagem deve possuir no máximo 2 MB');
    exit;
}



// Transformando foto em dados (binário)
$conteudo = file_get_contents($foto['tmp_name']);



$usuario = new Usuario($id, $nome, $sobrenome, $cpf, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $estado, $telefone, $email, null);




if ($usuario->alterar($usuario, $id, $conteudo)) {
	echo retorno("Deu boa, bem boa");
	exit;
}
else {
	echo retorno("Deu cocozinho");
	exit;
}


/*
// Preparando comando
$stmt = $pdo->prepare('INSERT INTO fotos (nome, conteudo, tipo, tamanho) VALUES (:nome, :conteudo, :tipo, :tamanho)');

// Definindo parâmetros
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':conteudo', $conteudo, PDO::PARAM_LOB);
$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
$stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);

// Executando e exibindo resultado
echo ($stmt->execute()) ? retorno('Foto cadastrada com sucesso', true) : retorno($stmt->errorInfo());*/