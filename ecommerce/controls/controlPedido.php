<?php

session_start();

require_once("../models/ModelProduto.class.php");
require_once("../classes/Produto.class.php");

require_once("../models/ModelUsuario.class.php");
require_once("../classes/Usuario.class.php");

require_once("../models/ModelEC.class.php");
require_once("../classes/EC.class.php");

require_once("../models/ModelPedido.class.php");
require_once("../classes/Pedido.class.php");

require_once("../models/ModelFornecedor.class.php");
require_once("../classes/Fornecedor.class.php");

$produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

if (isset($_POST['idProdutoInput'])) {
    
    $id = $_POST['idProdutoInput'];
    $nome = $_POST['nomeProduto'];
    $valorUnit = $_POST['valorProduto'];
    $esferica = $_POST['esferica'];
    $torica = $_POST['torica'];
    $multifocal = $_POST['multifocal'];
    $colorida = $_POST['colorida'];
    
    $graus = $_POST['grau'];

    if ($graus == "diferente") {

        $esfericoE = $_POST['grauEsfericoE'];
        $esfericoD = $_POST['grauEsfericoD'];
        
        if ($torica) {
        
            $cilindroE = $_POST['grauCilindroE'];
            $cilindroD = $_POST['grauCilindroD'];

            $eixoE = $_POST['eixoE'];
            $eixoD = $_POST['eixoD'];
        }

        $curvaBaseE = $_POST['curvaBaseE'];
        $curvaBaseD = $_POST['curvaBaseD'];

        $diametroE = $_POST['diametroE'];
        $diametroD = $_POST['diametroD'];
        
        if ($multifocal) {
            
            $adicaoE = $_POST['grauAdicaoE'];
            $adicaoD = $_POST['grauAdicaoD'];
            
            if ($_POST['olho'] == "direito") {
                $olho = "Direito";
            }
            else if ($_POST['olho'] == "esquerdo") {
                $olho = "Esquerdo";
            }
        }
        
        if ($colorida) {
            $corD = $_POST['corD'];
            $corE = $_POST['corE'];
        }

        $quantidadeE = $_POST['quantidadeE'];
        $quantidadeD = $_POST['quantidadeD'];
    }
    else {

        $esfericoE = $_POST['grauEsfericoD'];
        $esfericoD = $_POST['grauEsfericoD'];
        
        if ($torica) {
        
            $cilindroE = $_POST['grauCilindroD'];
            $cilindroD = $_POST['grauCilindroD'];

            $eixoE = $_POST['eixoD'];
            $eixoD = $_POST['eixoD'];
        }

        $curvaBaseE = $_POST['curvaBaseD'];
        $curvaBaseD = $_POST['curvaBaseD'];

        $diametroE = $_POST['diametroD'];
        $diametroD = $_POST['diametroD'];
        
        if ($multifocal) {
            
            $adicaoE = $_POST['grauAdicaoD'];
            $adicaoD = $_POST['grauAdicaoD'];
            
            if ($_POST['olho'] == "direito") {
                $olho = "Direito";
            }
            else if ($_POST['olho'] == "esquerdo") {
                $olho = "Esquerdo";
            }
        }

        if ($colorida) {
            $corD = $_POST['corD'];
            $corE = $_POST['corD'];
        }

        $quantidadeE = 0;
        $quantidadeD = $_POST['quantidadeD'];
    }
    
    if (!isset($_SESSION['carrinho'])) {

        $_SESSION['carrinho'] = array();
        
        $_SESSION['carrinho'][0]['id'] = 0;
        $_SESSION['carrinho'][0]['idProduto'] = $id;
        $_SESSION['carrinho'][0]['nome'] = $nome;
        $_SESSION['carrinho'][0]['valor'] = number_format((float)$valorUnit, 2, '.', '');
        $_SESSION['carrinho'][0]['esfericoE'] = number_format((float)$esfericoE, 2, '.', '');
        $_SESSION['carrinho'][0]['esfericoD'] = number_format((float)$esfericoD, 2, '.', '');
        
        if ($torica) {
        
            $_SESSION['carrinho'][0]['cilindroE'] = number_format((float)$cilindroE, 2, '.', '');
            $_SESSION['carrinho'][0]['cilindroD'] = number_format((float)$cilindroD, 2, '.', '');
            $_SESSION['carrinho'][0]['eixoE'] = $eixoE;
            $_SESSION['carrinho'][0]['eixoD'] = $eixoD;
        }
        else {
            
            $_SESSION['carrinho'][0]['cilindroE'] = null;
            $_SESSION['carrinho'][0]['cilindroD'] = null;
            $_SESSION['carrinho'][0]['eixoE'] = null;
            $_SESSION['carrinho'][0]['eixoD'] = null;
        }
        
        $_SESSION['carrinho'][0]['curvaBaseE'] = number_format((float)$curvaBaseE, 2, '.', '');
        $_SESSION['carrinho'][0]['curvaBaseD'] = number_format((float)$curvaBaseD, 2, '.', '');
        $_SESSION['carrinho'][0]['diametroE'] = number_format((float)$diametroE, 2, '.', '');
        $_SESSION['carrinho'][0]['diametroD'] = number_format((float)$diametroD, 2, '.', '');
        
        if ($multifocal) {
        
            $_SESSION['carrinho'][0]['adicaoE'] = number_format((float)$adicaoE, 2, '.', '');
            $_SESSION['carrinho'][0]['adicaoD'] = number_format((float)$adicaoD, 2, '.', '');
            
            if ($_POST['olho'] == "direito") {
                $_SESSION['carrinho'][0]['olhoD'] = 1;
                $_SESSION['carrinho'][0]['olhoE'] = 0;
            }
            else if ($_POST['olho'] == "esquerdo") {
                $_SESSION['carrinho'][0]['olhoE'] = 1;
                $_SESSION['carrinho'][0]['olhoD'] = 0;
            }
        }
        else {
            
            $_SESSION['carrinho'][0]['adicaoE'] = null;
            $_SESSION['carrinho'][0]['adicaoD'] = null;
            
            $_SESSION['carrinho'][0]['olhoE'] = null;
            $_SESSION['carrinho'][0]['olhoD'] = null;
        }

        if ($colorida) {
            
            $_SESSION['carrinho'][0]['corE'] = $corE;
            $_SESSION['carrinho'][0]['corD'] = $corD;
        }
        else {
            
            $_SESSION['carrinho'][0]['corE'] = null;
            $_SESSION['carrinho'][0]['corD'] = null;
        }
        
        $_SESSION['carrinho'][0]['quantidadeE'] = $quantidadeE;
        $_SESSION['carrinho'][0]['quantidadeD'] = $quantidadeD;       
    }
    else {
        
        $count = count($_SESSION['carrinho']);
    
        $i = 0;
        
        foreach ($_SESSION['carrinho'] as $indice => $valor) {
            
            if ($valor['id'] > $i) {
                $i = $valor['id'];
            }
        }
        
        $_SESSION['carrinho'][$count]['id'] = $i+1;
        $_SESSION['carrinho'][$count]['idProduto'] = $id;
        $_SESSION['carrinho'][$count]['nome'] = $nome;
        $_SESSION['carrinho'][$count]['valor'] = number_format((float)$valorUnit, 2, '.', '');
        $_SESSION['carrinho'][$count]['esfericoE'] = number_format((float)$esfericoE, 2, '.', '');
        $_SESSION['carrinho'][$count]['esfericoD'] = number_format((float)$esfericoD, 2, '.', '');
        
        if ($torica) {
        
            $_SESSION['carrinho'][$count]['cilindroE'] = number_format((float)$cilindroE, 2, '.', '');
            $_SESSION['carrinho'][$count]['cilindroD'] = number_format((float)$cilindroD, 2, '.', '');
            $_SESSION['carrinho'][$count]['eixoE'] = $eixoE;
            $_SESSION['carrinho'][$count]['eixoD'] = $eixoD;
        }
        else {
            
            $_SESSION['carrinho'][$count]['cilindroE'] = null;
            $_SESSION['carrinho'][$count]['cilindroD'] = null;
            $_SESSION['carrinho'][$count]['eixoE'] = null;
            $_SESSION['carrinho'][$count]['eixoD'] = null;
        }
        
        $_SESSION['carrinho'][$count]['curvaBaseE'] = number_format((float)$curvaBaseE, 2, '.', '');
        $_SESSION['carrinho'][$count]['curvaBaseD'] = number_format((float)$curvaBaseD, 2, '.', '');
        $_SESSION['carrinho'][$count]['diametroE'] = number_format((float)$diametroE, 2, '.', '');
        $_SESSION['carrinho'][$count]['diametroD'] = number_format((float)$diametroD, 2, '.', '');
        
        if ($multifocal) {
        
            $_SESSION['carrinho'][$count]['adicaoE'] = number_format((float)$adicaoE, 2, '.', '');
            $_SESSION['carrinho'][$count]['adicaoD'] = number_format((float)$adicaoD, 2, '.', '');
            
            if ($_POST['olho'] == "direito") {
                $_SESSION['carrinho'][$count]['olhoD'] = 1;
                $_SESSION['carrinho'][$count]['olhoE'] = 0;
            }
            else if ($_POST['olho'] == "esquerdo") {
                $_SESSION['carrinho'][$count]['olhoE'] = 1;
                $_SESSION['carrinho'][$count]['olhoD'] = 0;
            }
        }
        else {
            
            $_SESSION['carrinho'][$count]['adicaoE'] = null;
            $_SESSION['carrinho'][$count]['adicaoD'] = null;
            
            $_SESSION['carrinho'][$count]['olhoE'] = null;
            $_SESSION['carrinho'][$count]['olhoD'] = null;
        }

        if ($colorida) {
            
            $_SESSION['carrinho'][$count]['corE'] = $corE;
            $_SESSION['carrinho'][$count]['corD'] = $corD;
        }
        else {
            
            $_SESSION['carrinho'][$count]['corE'] = null;
            $_SESSION['carrinho'][$count]['corD'] = null;
        }
        
        $_SESSION['carrinho'][$count]['quantidadeE'] = $quantidadeE;
        $_SESSION['carrinho'][$count]['quantidadeD'] = $quantidadeD; 
    }
    
    header('location: ../carrinho');
}

if (isset($_POST['idProdutoInputEdit'])) {
    
    $idCarrinho = $_POST['idCarrinho'];
    $id = $_POST['idProdutoInputEdit'];
    $nome = $_POST['nomeProduto'];
    $valor = $_POST['valorProduto'];
    
    $graus = $_POST['grau'];

    if ($graus == "diferente") {

        $esfericoE = $_POST['grauEsfericoE'];
        $esfericoD = $_POST['grauEsfericoD'];

        $curvaBaseE = $_POST['curvaBaseE'];
        $curvaBaseD = $_POST['curvaBaseD'];

        $diametroE = $_POST['diametroE'];
        $diametroD = $_POST['diametroD'];

        $quantidadeE = $_POST['quantidadeE'];
        $quantidadeD = $_POST['quantidadeD'];            
    }
    else {

        $esfericoE = $_POST['grauEsfericoE'];
        $esfericoD = null;

        $curvaBaseE = $_POST['curvaBaseE'];
        $curvaBaseD = null;

        $diametroE = $_POST['diametroE'];
        $diametroD = null;

        $quantidadeE = $_POST['quantidadeE'];
        $quantidadeD = null;    
    }
    
    foreach ($_SESSION['carrinho'] as $indice => $valor) {
        
        if ($valor['id'] == $idCarrinho) {
            
            $_SESSION['carrinho'][$indice]['esfericoE'] = number_format((float)$esfericoE, 2, '.', '');
            $_SESSION['carrinho'][$indice]['esfericoD'] = number_format((float)$esfericoD, 2, '.', '');
            $_SESSION['carrinho'][$indice]['curvaBaseE'] = number_format((float)$curvaBaseE, 2, '.', '');
            $_SESSION['carrinho'][$indice]['curvaBaseD'] = number_format((float)$curvaBaseD, 2, '.', '');
            $_SESSION['carrinho'][$indice]['diametroE'] = number_format((float)$diametroE, 2, '.', '');
            $_SESSION['carrinho'][$indice]['diametroD'] = number_format((float)$diametroD, 2, '.', '');
            $_SESSION['carrinho'][$indice]['quantidadeE'] = $quantidadeE;
            $_SESSION['carrinho'][$indice]['quantidadeD'] = $quantidadeD;
            
        }
    }
    
    sort($_SESSION['carrinho']);
    
    header('location: ../carrinho');
}

if (isset($_POST['removerProdCarrinho'])) {

    $id = $_POST['removerProdCarrinho'];
    
    foreach ($_SESSION['carrinho'] as $indice => $valor) {
        
        if ($valor['id'] == $id) {
            
            unset($_SESSION['carrinho'][$indice]);
        }
    }
    
    sort($_SESSION['carrinho']);
    
    header('location: ../carrinho');
}

if (isset($_GET['entrega'])) {
    
    $id = $_GET['entrega'];
    
    $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    foreach ($usuario->getUsuario($id) as $var) {
       
        echo "<div id='entrega2'>";
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='cepInput'>CEP (*)</label>";
        echo "<input type='text' class='form-control' id='cepInput' name='cepInput' value='".$var['cep']."' placeholder='_____-___' disabled>";
        echo "</div>";
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='enderecoInput'>Endereço (*)</label>";
        echo "<input type='text' class='form-control' id='enderecoInput' name='enderecoInput' value='".$var['endereço']."' placeholder='Endereço' disabled>";
        echo "</div>";
        echo "<div class='form-group col-sm-12'></div>";
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='numeroInput'>Número (*)</label>";
        echo "<input type='text' class='form-control' id='numeroInput' name='numeroInput' value='".$var['numero']."' placeholder='Número' disabled>";
        echo "</div>";
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='complementoInput'>Complemento</label>";
        echo "<input type='text' class='form-control' id='complementoInput' name='complementoInput' value='".$var['complemento']."' placeholder='Complemento' disabled>";
        echo "</div>";
        echo "<div class='form-group col-sm-12'></div>";
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='bairroInput'>Bairro (*)</label>";
        echo "<input type='text' class='form-control' id='bairroInput' name='bairroInput' value='".$var['bairro']."' placeholder='Bairro' disabled>";
        echo "</div>";
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='estadoInput'>Estado (*)</label>";
        echo "<select class='form-control' data-live-search='true' id='estadoInput' name='estadoInput' disabled>";
            $ec = new EC();

            foreach($ec->ConsultarEstadoSelecionado($var['idEstado']) as $varEC) {
                echo "<option value='".$varEC['idEstado']."'>".$varEC['estNome']."</option>";
            }	

            foreach($ec->ConsultarEstados($var['idEstado']) as $varEC) {
                echo "<option value='".$varEC['idEstado']."'>".$varEC['estNome']."</option>";
            }
            
        echo "</select>";
        echo "</div>";
        echo "<div class='form-group col-sm-12'></div>";
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='cidadeInput'>Cidade (*)</label>";
        echo "<select class='form-control' id='cidadeInput' name='cidadeInput' disabled>";

            $ec = new EC();

            foreach($ec->ConsultarCidadeSelecionada($var['idCidade']) as $varEC) {
                echo "<option value='".$varEC['idCidade']."'>".$varEC['cidNome']."</option>";
            }	

            foreach($ec->ConsultarCidades($var['idEstado'], $var['idCidade']) as $varEC) {
                echo "<option value='".$varEC['idCidade']."'>".$varEC['cidNome']."</option>";
            }
            
        echo "</select>";
        echo "</div>";
        echo "</div>"; 
    } 
}

if (isset($_GET['detalhesModal'])) {
    
    $id = $_GET['detalhesModal'];
    
    foreach ($_SESSION['carrinho'] as $indice => $valor) {
        
        if ($valor['id'] == $id) {
            
            if ($valor['esfericoE'] == $valor['esfericoD']) {
            
            echo "<tbody id='tabelaDetalhes'>
                    <tr>
                    <td>
                    <b>Nome</b>
                    </td>
                    <td>
                    ".$valor['nome']."
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <b>Grau Esférico</b>
                    </td>
                    <td>
                    ".$valor['esfericoD']."
                    </td>
                    </tr>";
            
                    if (isset($valor['cilindroD'])) {
            
                    echo "<tr>
                    <td>
                    <b>Grau Cilindro</b>
                    </td>
                    <td>
                    ".$valor['cilindroD']."
                    </td>
                    </tr>";
                    
                    }
                    
                    if (isset($valor['adicaoD'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Adição</b>
                    </td>
                    <td>
                    ".$valor['adicaoD']."
                    </td>
                    </tr>";
                    
                    }
                    
                    if (isset($valor['adicaoD'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Eixo</b>
                    </td>
                    <td>
                    ".$valor['adicaoD']."
                    </td>
                    </tr>";
                    
                    }
                    
                    echo "<tr>
                    <td>
                    <b>Curva Base</b>
                    </td>
                    <td>
                    ".$valor['curvaBaseD']."
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <b>Diâmetro</b>
                    </td>
                    <td>
                    ".$valor['diametroD']."
                    </td>
                    </tr>";
                    
                    if (isset($valor['cor'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Cor</b>
                    </td>
                    <td>
                    ".$valor['cor']."
                    </td>
                    </tr>";
                    
                    }
                    
                     if (isset($valor['multifocalD'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Olho Dominante</b>
                    </td>
                    <td>";
                    
                    foreach ($produto->getProduto($valor['idProduto']) as $var) {
                        if ($var['olho'] == 1) {
                            echo "Olho Dominante";
                        }
                        else {
                            echo "Olho Não Dominante";
                        }
                    }
                    
                    echo "</td>
                    </tr>";
                    
                    }
                    
                    echo "<tr>
                    <td>
                    <b>Quantidade</b>
                    </td>
                    <td>
                    ".$valor['quantidadeD']."
                    </td>
                    </tr>";
                    
                    echo "</tbody>";
            }
            else {
                
                echo "<tbody id='tabelaDetalhes'>
                    <tr>
                    <td>
                    <b>Nome</b>
                    </td>
                    <td colspan='2'>
                    ".$valor['nome']."
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
                    <b>Olho</b>
                    </td>
                    <td>
                    <b>Olho direito</b>
                    </td>
                    <td>
                    <b>Olho esquerdo</b>
                    </td>
                    </tr>

                    <tr>
                    <td>
                    <b>Grau Esférico</b>
                    </td>
                    <td>
                    ".$valor['esfericoD']."
                    </td>
                    <td>
                    ".$valor['esfericoE']."
                    </td>
                    </tr>";
                    
                    if (isset($valor['cilindroD'])) {
            
                    echo "<tr>
                    <td>
                    <b>Grau Cilindro</b>
                    </td>
                    <td>
                    ".$valor['cilindroD']."
                    </td>
                    <td>
                    ".$valor['cilindroE']."
                    </td>
                    </tr>";
                    
                    }
                    
                    if (isset($valor['adicaoD'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Adição</b>
                    </td>
                    <td>
                    ".$valor['adicaoD']."
                    </td>
                    <td>
                    ".$valor['adicaoE']."
                    </td>
                    </tr>";
                    
                    }
                    
                    if (isset($valor['adicaoD'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Eixo</b>
                    </td>
                    <td>
                    ".$valor['adicaoD']."
                    </td>
                    <td>
                    ".$valor['adicaoE']."
                    </td>
                    </tr>";
                    
                    }
                    
                    echo "<tr>
                    <td>
                    <b>Curva Base</b>
                    </td>
                    <td>
                    ".$valor['curvaBaseD']."
                    </td>
                    <td>
                    ".$valor['curvaBaseE']."
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <b>Diâmetro</b>
                    </td>
                    <td>
                    ".$valor['diametroD']."
                    </td>
                    <td>
                    ".$valor['diametroE']."
                    </td>
                    </tr>";
                    
                    if (isset($valor['corD'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Cor</b>
                    </td>
                    <td>
                    ".$valor['corD']."
                    </td>
                    <td>
                    ".$valor['corE']."
                    </td>
                    </tr>";
                    
                    }
                    
                    if (isset($valor['multifocalD'])) {
                    
                    echo "<tr>
                    <td>
                    <b>Olho Dominante</b>
                    </td>
                    <td>";
                    
                    foreach ($produto->getProduto($valor['idProduto']) as $var) {
                        if ($var['olho'] == 1) {
                            echo "Olho Dominante";
                        }
                        else {
                            echo "Olho Não Dominante";
                        }
                    }
                    
                    echo "</td>
                    <td>
                    </td>
                    </tr>";
                    
                    }
                    
                    echo "<tr>
                    <td>
                    <b>Quantidade</b>
                    </td>
                    <td>
                    ".$valor['quantidadeD']."
                    </td>
                    <td>
                    ".$valor['quantidadeE']."
                    </td>
                    </tr>";
                    
                    echo "</tbody>";                
            }
        }       
    }
}

if (isset($_POST['data'])) {
    
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $entregaFinal = $_POST['entregaFinal'];
    $parcela = $_POST['parcela'];
    $total = $_POST['total'];
    $data = $_POST['data'];
    
    $pedido = new Pedido(null, $cep, $endereco, $numero, $complemento, $bairro, $estado, $cidade, $entregaFinal, $parcela, $total, $data, $_SESSION['usuario']);   
    
    if ($pedido->cadastrar($pedido)) {
        unset($_SESSION['carrinho']);
        print "1";
    }
    else {
        print "<script>alert('d');</script>";
    }
}

if (isset($_GET['modalDetalhesPedido'])) {
    
    $id = $_GET['modalDetalhesPedido'];
    
    $pedido = new Pedido(null, null, null, null, null, null, null, null, null, null, null, null, null); 
    $fornecedor = new Fornecedor(null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    echo "<div id='tabelaDetalhesPedido'>";
    echo "<table class='table table-bordered table-hover table-striped hd-center alinharv'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Nome</th><th>Esférico</th><th>Cilíndro</th><th>Eixo</th><th>Curva Base</th><th>Diâmetro</th><th>Adição</th><th>Cor</th><th>Dominante</th><th>Fornecedor</th><th><center>Quantidade</center></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";    

        foreach ($pedido->funcaoGetItensPedido($id) as $var) {
            if ($var['esfericoD'] == $var['esfericoE'] && $var['cilindroD'] == $var['cilindroE'] && $var['eixoD'] == $var['eixoE'] && $var['curvaBaseD'] == $var['curvaBaseE'] && $var['diametroD'] == $var['diametroE'] && $var['corD'] == $var['corE'] && $var['adicaoD'] == $var['adicaoE']) {

            echo "<tr>";
            echo "<td>";
            foreach ($produto->getProduto($var['idProduto']) as $var2) { echo $var2['nome']; }
            echo "</td>";
            echo "<td>".$var['esfericoD']."</td>";
            echo "<td>";
            if ($var['cilindroD'] != null) { echo $var['cilindroD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['eixoD'] != null) { echo $var['eixoD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>".$var['curvaBaseD']."</td>";
            echo "<td>".$var['diametroD']."</td>";
            echo "<td>";
            if ($var['adicaoD'] != null) { echo $var['adicaoD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['corD'] != null) { echo $var['corD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['olhoDominante'] != null) { if ($var['olhoDominante'] == 1) { echo "Dominante"; }else { echo "Não dominante"; } }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            foreach ($produto->getProduto($var['idProduto']) as $var2) { foreach ($fornecedor->getFornecedor($var2['idFornecedor']) as $var3) { echo $var3['razaoSocial']; } }
            echo "</td>";            
            $quantidadeTotal = $var['quantidadeD'] + $var['quantidadeE'];            
            echo "<td>".$quantidadeTotal."</td>";
            echo "</tr>";
        
          }
          else {                                            

            echo "<tr>";
            echo "<td>";
            foreach ($produto->getProduto($var['idProduto']) as $var2) { echo $var2['nome']; }
            echo "</td>";
            echo "<td>".$var['esfericoD']."</td>";
            echo "<td>";
            if ($var['cilindroD'] != null) { echo $var['cilindroD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['eixoD'] != null) { echo $var['eixoD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>".$var['curvaBaseD']."</td>";
            echo "<td>".$var['diametroD']."</td>";
            echo "<td>";
            if ($var['adicaoD'] != null) { echo $var['adicaoD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['corD'] != null) { echo $var['corD']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['olhoDominante'] != null) { if ($var['olhoDominante'] == 1) { echo "Dominante"; }else { echo "Não dominante"; } }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            foreach ($produto->getProduto($var['idProduto']) as $var2) { foreach ($fornecedor->getFornecedor($var2['idFornecedor']) as $var3) { echo $var3['razaoSocial']; } }
            echo "</td>";
            $quantidadeTotal = $var['quantidadeD'] + $var['quantidadeE'];            
            echo "<td>".$quantidadeTotal."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>";
            foreach ($produto->getProduto($var['idProduto']) as $var2) { echo $var2['nome']; }
            echo "</td>";
            echo "<td>".$var['esfericoE']."</td>";
            echo "<td>";
            if ($var['cilindroE'] != null) { echo $var['cilindroE']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['eixoE'] != null) { echo $var['eixoE']; }else { echo "-"; }
            echo "</td>";
            echo "<td>".$var['curvaBaseE']."</td>";
            echo "<td>".$var['diametroE']."</td>";
            echo "<td>";
            if ($var['adicaoE'] != null) { echo $var['adicaoE']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['corE'] != null) { echo $var['corE']; }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            if ($var['olhoDominante'] != null) { if ($var['olhoDominante'] == 1) { echo "Dominante"; }else { echo "Não dominante"; } }else { echo "-"; }
            echo "</td>";
            echo "<td>";
            foreach ($produto->getProduto($var['idProduto']) as $var2) { foreach ($fornecedor->getFornecedor($var2['idFornecedor']) as $var3) { echo $var3['razaoSocial']; } }
            echo "</td>";
            $quantidadeTotal2 = $var['quantidadeD'] + $var['quantidadeE'];            
            echo "<td>".$quantidadeTotal2."</td>";
            echo "</tr>";                                              
          }
        }
    
    echo "<tbody>";
    echo "</table>";
    echo "</div>";
}

if (isset($_POST['idPedidoRefazerCompra'])) {
    
    unset($_SESSION['carrinho']);
    
    $id = $_POST['idPedidoRefazerCompra'];
    
    $pedido = new Pedido(null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    $i = -1;
    
    $cont = 0;
    
    foreach ($pedido->funcaoGetItensPedido($id) as $var) {
        
        $_SESSION['carrinho'][$cont]['id'] = $i+1;
        $_SESSION['carrinho'][$cont]['idProduto'] = $var['idProduto'];
        
        foreach ($produto->getProduto($var['idProduto']) as $var2) {
            
            $_SESSION['carrinho'][$cont]['nome'] = $var2['nome'];
            $_SESSION['carrinho'][$cont]['valor'] = number_format((float)$var2['valorUnit'], 2, '.', '');
        }
        
        $_SESSION['carrinho'][$cont]['esfericoE'] = number_format((float)$var['esfericoE'], 2, '.', '');
        $_SESSION['carrinho'][$cont]['esfericoD'] = number_format((float)$var['esfericoD'], 2, '.', '');
        
        if ($var['cilindroD'] != null || $var['cilindroD'] != '') {
        
            $_SESSION['carrinho'][$cont]['cilindroE'] = number_format((float)$var['cilindroE'], 2, '.', '');
            $_SESSION['carrinho'][$cont]['cilindroD'] = number_format((float)$var['cilindroD'], 2, '.', '');
            $_SESSION['carrinho'][$cont]['eixoE'] = $var['eixoE'];
            $_SESSION['carrinho'][$cont]['eixoD'] = $var['eixoD'];
        }
        else {
            
            $_SESSION['carrinho'][$cont]['cilindroE'] = null;
            $_SESSION['carrinho'][$cont]['cilindroD'] = null;
            $_SESSION['carrinho'][$cont]['eixoE'] = null;
            $_SESSION['carrinho'][$cont]['eixoD'] = null;
        }
        
        $_SESSION['carrinho'][$cont]['curvaBaseE'] = number_format((float)$var['curvaBaseE'], 2, '.', '');
        $_SESSION['carrinho'][$cont]['curvaBaseD'] = number_format((float)$var['curvaBaseD'], 2, '.', '');
        $_SESSION['carrinho'][$cont]['diametroE'] = number_format((float)$var['diametroE'], 2, '.', '');
        $_SESSION['carrinho'][$cont]['diametroD'] = number_format((float)$var['diametroD'], 2, '.', '');
        
        if ($var['adicaoD'] != null || $var['adicaoD'] != '') {
        
            $_SESSION['carrinho'][$cont]['adicaoE'] = number_format((float)$var['adicaoE'], 2, '.', '');
            $_SESSION['carrinho'][$cont]['adicaoD'] = number_format((float)$var['adicaoD'], 2, '.', '');
            
            if ($var['olhoDominante'] == 1) {
                $_SESSION['carrinho'][$cont]['olhoD'] = 1;
                $_SESSION['carrinho'][$cont]['olhoE'] = 0;
            }
            else if ($var['olhoDominante'] == 0) {
                $_SESSION['carrinho'][$cont]['olhoE'] = 1;
                $_SESSION['carrinho'][$cont]['olhoD'] = 0;
            }
        }
        else {
            
            $_SESSION['carrinho'][$cont]['adicaoE'] = null;
            $_SESSION['carrinho'][$cont
                    ]['adicaoD'] = null;
            
            $_SESSION['carrinho'][$cont]['olhoE'] = null;
            $_SESSION['carrinho'][$cont]['olhoD'] = null;
        }

        if ($var['corD'] != null || $var['corD'] != '') {
            
            $_SESSION['carrinho'][$cont]['corE'] = $var['corE'];
            $_SESSION['carrinho'][$cont]['corD'] = $var['corD'];
        }
        else {
            
            $_SESSION['carrinho'][$cont]['corE'] = null;
            $_SESSION['carrinho'][$cont]['corD'] = null;
        }
        
        $_SESSION['carrinho'][$cont]['quantidadeE'] = $var['quantidadeE'];
        $_SESSION['carrinho'][$cont]['quantidadeD'] = $var['quantidadeD'];
        
        $cont++;
    }
    
    header('location: ../carrinho');
}