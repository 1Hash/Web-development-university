<?php

session_start();

require_once("../models/ModelProduto.class.php");
require_once("../classes/Produto.class.php");

include '../mpdf/mpdf.php';
set_time_limit(0);

// -------------------------------------------------[ CADASTRO PRODUTO ]------------------------------------------------- //

if (isset($_POST['nomeInput'])) {

    $fornecedor = $_POST['fornecedorInput'];
    $nome = $_POST['nomeInput'];
    $valor = $_POST['valorInput'];
    
    $uso = $_POST['uso'];
    
    $troca;
    
    if (isset($_POST['troca'])) {
        $troca = $_POST['troca'];
    }

    $tipo = $_POST['tipo'];
    
    if ($tipo == "multifocal") {
        
        $olho = $_POST['olho'];
        
    }
    else {
        $olho = 0;
    }
    
    $descricao = $_POST['descricaoInput'];
    $marca = $_POST['marcaInput'];
    $tipoDetalhes = $_POST['tipoInput'];
    $material = $_POST['materialInput'];
    $visitint = $_POST['visitintInput'];
    
    $descartavel = 0;
    $anual = 0;
    
    $mensal = 0;
    $diaria = 0;
    $quinzenal = 0;
    
    $esferica = 0;
    $torica = 0;
    $multifocal = 0;
    
    $dominante = 0;
    
    $cor = 0;
    $curvaUnica = 0;
    $diametroPadrao = 0;
    
    $valorCurvaUnica = 0;
    $valorDiametroPadrao = 0;
    
    if (isset($_POST['checkColorida'])) {
        $cor = true;
    }
    
    if (isset($_POST['checkCurvaBase'])) {
        $curvaUnica = true;
    }
    
    if (isset($_POST['checkDiametro'])) {
        $diametroPadrao = true;
    }
    
    if ($curvaUnica) {
        $_SESSION['listaCB'][] = floatval($_POST['curvaUnicaInput']);
    }
    
    if ($diametroPadrao) {        
        $_SESSION['listaDiametro'][] = floatval($_POST['diametroInput']);
    }
    
    if ($uso == "descartavel") {
        $descartavel = true;
        
        if ($troca == "mensal") {
            $mensal = true;
        }
        else if($troca == "diaria") {
            $diaria = true;
        }
        else if ($troca == "quinzenal") {
            $quinzenal = true;
        }       
    }
    else if($uso == "anual"){
        $anual = true;
    }
    
    if($tipo == "esferica") {
        $esferica = true;
    }
    else if ($tipo == "torica") {
        $torica = true;
    }
    else if ($tipo == "multifocal") {
        $multifocal = true;
    }
    
    $intervaloEsferico = array();
    $intervaloCurvaBase = array();
    $intervaloDiametro = array();
    $intervaloCilindro = array();
    $intervaloEixo = array();
    $intervaloAdicao = array();
    $intervaloCor = array();

    if (!empty($_SESSION['listaEsferico']) && !empty($_SESSION['listaCB']) && !empty($_SESSION['listaDiametro'])) {
        if ($torica && !empty($_SESSION['listaCilindro'])  && !empty($_SESSION['listaEixo'])) {
            
            for($i = 0; $i < count($_SESSION['listaCilindro']); $i++) {
                $intervaloCilindro[] = floatval($_SESSION['listaCilindro'][$i]);
            }
            
            for($i = 0; $i < count($_SESSION['listaEixo']); $i++) {
                $intervaloEixo[] = $_SESSION['listaEixo'][$i];
            }
        }
        else if ($multifocal && !empty($_SESSION['listaAdicao'])) {
            
            for($i = 0; $i < count($_SESSION['listaAdicao']); $i++) {
                $intervaloAdicao[] = floatval($_SESSION['listaAdicao'][$i]);
            }
        }
        
        if($cor && !empty($_SESSION['listaCor'])){
            
            for($i = 0; $i < count($_SESSION['listaCor']); $i++) {
                $intervaloCor[] = $_SESSION['listaCor'][$i];
            }
        }
        
        for($i = 0; $i < count($_SESSION['listaEsferico']); $i++) {
            $intervaloEsferico[] = floatval($_SESSION['listaEsferico'][$i]);
        }
        
        for($i = 0; $i < count($_SESSION['listaCB']); $i++) {
            $intervaloCurvaBase[] = floatval($_SESSION['listaCB'][$i]);
        }
        
        for($i = 0; $i < count($_SESSION['listaDiametro']); $i++) {
            $intervaloDiametro[] = floatval($_SESSION['listaDiametro'][$i]);
        }
    }
    
    if ($olho == "dominante") {
        $dominante = true;
    }
    else {
        $dominante = 0;
    }
    
    define('TAMANHO_MAXIMO', (2 * 2048 * 2048));
    
    $condCarregaFoto = true;

    // Transformando foto em dados (binário)
    if (isset($_FILES['foto'])) {

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
    else {
        echo retorno('Nenhuma imagem foi selecionada!');
        exit;
    }
    
    $produto = new Produto(null, $nome, $valor, $fornecedor, $descartavel, $anual, $mensal, $diaria, $quinzenal, $esferica, $torica, $multifocal, $cor, $valorCurvaUnica, $valorDiametroPadrao, $dominante, $descricao, $marca, $tipoDetalhes, $material, $visitint, $conteudo, $tipo, $intervaloEsferico, $intervaloCilindro, $intervaloEixo, $intervaloCurvaBase, $intervaloDiametro, $intervaloAdicao, $intervaloCor);
    
    if ($produto->cadastrarProduto($produto)) {
        echo retorno('Produto cadastrado com sucesso!', true);
        unset($_SESSION['listaEsferico']);
        unset($_SESSION['listaCilindro']);
        unset($_SESSION['listaEixo']);
        unset($_SESSION['listaCB']);
        unset($_SESSION['listaAdicao']);
        unset($_SESSION['listaDiametro']);
        unset($_SESSION['listaCor']);
        exit;
    }
    else {
        echo retorno('Não foi possível cadastrar o produto!');
        exit;
    }   
}

// -------------------------------------------------[ EDITAR PRODUTO ]------------------------------------------------//

if (isset($_POST['idProdutoEdit'])) {

    $id = $_POST['idProdutoEdit'];
    
    $fornecedor = $_POST['fornecedorInput'];
    $nome = $_POST['nomeInputEdit'];
    $valor = $_POST['valorInput'];
    
    $uso = $_POST['uso'];
    
    $troca;
    
    if (isset($_POST['troca'])) {
        $troca = $_POST['troca'];
    }

    $tipo = $_POST['tipo'];
    
    if ($tipo == "multifocal") {
        
        $olho = $_POST['olho'];
        
    }
    else {
        $olho = 0;
    }
    
    $descricao = $_POST['descricaoInput'];
    $marca = $_POST['marcaInput'];
    $tipoDetalhes = $_POST['tipoInput'];
    $material = $_POST['materialInput'];
    $visitint = $_POST['visitintInput'];
    
    $descartavel = 0;
    $anual = 0;
    
    $mensal = 0;
    $diaria = 0;
    $quinzenal = 0;
    
    $esferica = 0;
    $torica = 0;
    $multifocal = 0;
    
    $dominante = 0;
    
    $cor = 0;
    $curvaUnica = 0;
    $diametroPadrao = 0;
    
    $valorCurvaUnica = 0;
    $valorDiametroPadrao = 0;
    
    if (isset($_POST['checkColorida'])) {
        $cor = true;
        
    }
    
    if (isset($_POST['checkCurvaBase'])) {
        $curvaUnica = true;
    }
    
    if (isset($_POST['checkDiametro'])) {
        $diametroPadrao = true;
    }
    
    if ($curvaUnica) {
        $_SESSION['listaCB'][] = floatval($_POST['curvaUnicaInput']);
    }
    
    if ($diametroPadrao) {        
        $_SESSION['listaDiametro'][] = floatval($_POST['diametroInput']);
    }
    
    if ($uso == "descartavel") {
        $descartavel = true;
        
        if ($troca == "mensal") {
            $mensal = true;
        }
        else if($troca == "diaria") {
            $diaria = true;
        }
        else if ($troca == "quinzenal") {
            $quinzenal = true;
        }       
    }
    else if($uso == "anual"){
        $anual = true;
    }
    
    if($tipo == "esferica") {
        $esferica = true;
    }
    else if ($tipo == "torica") {
        $torica = true;
    }
    else if ($tipo == "multifocal") {
        $multifocal = true;
    }
    
    $intervaloEsferico = array();
    $intervaloCurvaBase = array();
    $intervaloDiametro = array();
    $intervaloCilindro = array();
    $intervaloEixo = array();
    $intervaloAdicao = array();
    $intervaloCor = array();
    
    

    if (!empty($_SESSION['listaEsferico']) && !empty($_SESSION['listaCB']) && !empty($_SESSION['listaDiametro'])) {
        if ($torica && !empty($_SESSION['listaCilindro'])  && !empty($_SESSION['listaEixo'])) {
            
            for($i = 0; $i < count($_SESSION['listaCilindro']); $i++) {
                $intervaloCilindro[] = floatval($_SESSION['listaCilindro'][$i]);
            }
            
            for($i = 0; $i < count($_SESSION['listaEixo']); $i++) {
                $intervaloEixo[] = $_SESSION['listaEixo'][$i];
            }
        }
        else if ($multifocal && !empty($_SESSION['listaAdicao'])) {
            
            for($i = 0; $i < count($_SESSION['listaAdicao']); $i++) {
                $intervaloAdicao[] = floatval($_SESSION['listaAdicao'][$i]);
            }
        }
        
        if($cor && !empty($_SESSION['listaCor'])){

            for($i = 0; $i < count($_SESSION['listaCor']); $i++) {
                $intervaloCor[] = $_SESSION['listaCor'][$i];
            }
        }
        
        for($i = 0; $i < count($_SESSION['listaEsferico']); $i++) {
            $intervaloEsferico[] = floatval($_SESSION['listaEsferico'][$i]);
        }
        
        for($i = 0; $i < count($_SESSION['listaCB']); $i++) {
            $intervaloCurvaBase[] = floatval($_SESSION['listaCB'][$i]);
        }
        
        for($i = 0; $i < count($_SESSION['listaDiametro']); $i++) {
            $intervaloDiametro[] = floatval($_SESSION['listaDiametro'][$i]);
        }
    }
    
    if ($olho == "dominante") {
        $dominante = true;
    }
    else {
        $dominante = 0;
    }
    
    define('TAMANHO_MAXIMO', (2 * 1024 * 1024));
    
    $condCarregaFoto = true;

    // Transformando foto em dados (binário)
    if (isset($_FILES['foto'])) {

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
    else {
        
        $produtoImg = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            
        foreach($produtoImg->getImg($id) as $var) {

            if ($var['imagem'] == null) {

                $conteudo = null;
                $tipo = null;
            }
            else {
                $conteudo = $var['imagem'];
                $tipo = $var['tipoImagem'];
                $condCarregaFoto = false;
            }
        }
    }

    $produto = new Produto(null, $nome, $valor, $fornecedor, $descartavel, $anual, $mensal, $diaria, $quinzenal, $esferica, $torica, $multifocal, $cor, $valorCurvaUnica, $valorDiametroPadrao, $dominante, $descricao, $marca, $tipoDetalhes, $material, $visitint, $conteudo, $tipo, $intervaloEsferico, $intervaloCilindro, $intervaloEixo, $intervaloCurvaBase, $intervaloDiametro, $intervaloAdicao, $intervaloCor);
    
    if ($produto->alterar($produto, $id)) {
        echo retorno('Produto alterado com sucesso!', true);
        unset($_SESSION['listaEsferico']);
        unset($_SESSION['listaCilindro']);
        unset($_SESSION['listaEixo']);
        unset($_SESSION['listaCB']);
        unset($_SESSION['listaAdicao']);
        unset($_SESSION['listaDiametro']);
        unset($_SESSION['listaCor']);
        exit;
    }
    else {
        echo retorno('Não foi possível alterar o produto!', true);
        exit;
    }   
}

// -------------------------------------------------[ ESFÉRICO ]------------------------------------------------- //

if (isset($_GET['inicioEsf'])) {
    
    $inicio = floatval($_GET['inicioEsf']);
    $fim = floatval($_GET['fimEsf']);
    $passos = floatval($_GET['passosEsf']);
    
    $intervalo = array();
    
    if ($inicio < $fim) {
        
        for($i = $inicio; $i <= $fim; $i += $passos) {
            array_push($intervalo, floatval($i));
        }        
    }
    else if ($inicio > $fim) {
        
        for($i = $inicio; $i >= $fim; $i -= $passos) {
            array_push($intervalo, floatval($i));
        }
    }
    
    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaEsferico']); $i++) {
        $auxSession[] = floatval($_SESSION['listaEsferico'][$i]);
    }
    
    if (empty($_SESSION['listaEsferico'])) {
        $_SESSION['listaEsferico'] = $intervalo;
    }
    else {
        
        foreach($intervalo as $key => $var) {

            $cont = 0;

            foreach($auxSession as $key => $var2) {
                
                if ($var == $var2) {

                    $cont++;

                }
            }

            if ($cont == 0) {

                array_push($auxSession, $var);
            }            
        }
        
        sort($auxSession);
        $_SESSION['listaEsferico'] = $auxSession;
        
    }
    
    if (count($_SESSION['listaEsferico']) > 0) {
    
        echo "<div id='tabelaEsferico'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaEsferico']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaEsferico'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaEsferico\").load(\"./controls/controlProduto.php?excluirEsf=".$_SESSION['listaEsferico'][$i]." #tabelaEsferico\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

// -------------------------------------------------[ EXCLUIR ESFÉRICO ]------------------------------------------------- //

if (isset($_GET['excluirEsf'])) {
    
    $valorGet = floatval($_GET['excluirEsf']);

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaEsferico']); $i++) {
        $auxSession[] = floatval($_SESSION['listaEsferico'][$i]);
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaEsferico'] = $auxSession;
    
    if (count($_SESSION['listaEsferico']) > 0) {
    
        echo "<div id='tabelaEsferico'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";   

        for($i = 0; $i < count($_SESSION['listaEsferico']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaEsferico'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaEsferico\").load(\"./controls/controlProduto.php?excluirEsf=".$_SESSION['listaEsferico'][$i]." #tabelaEsferico\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosEsf'])) {
    
    $_SESSION['listaEsferico'] = array();
}

// -------------------------------------------------[ CURVA BASE ]------------------------------------------------- //

if (isset($_GET['inicioCB'])) {
    
    $inicio = $_GET['inicioCB'];
    $fim = $_GET['fimCB'];
    $passos = $_GET['passosCB'];
    
    $intervalo = array();
    
    if ($inicio < $fim) {
        
        for($i = $inicio; $i <= $fim; $i += $passos) {
            array_push($intervalo, $i);
        }
    }
    else if ($inicio > $fim) {
        
        for($i = $inicio; $i >= $fim; $i -= $passos) {
            array_push($intervalo, $i);
        }
    }
    
    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaCB']); $i++) {
        $auxSession[] = $_SESSION['listaCB'][$i];
    }
    
    if (empty($_SESSION['listaCB'])) {
        $_SESSION['listaCB'] = $intervalo;
    }
    else {
        
        foreach($intervalo as $key => $var) {

            $cont = 0;

            foreach($auxSession as $key => $var2) {
                
                if ($var == $var2) {

                    $cont++;

                }
            }

            if ($cont == 0) {

                array_push($auxSession, $var);
            }            
        }
        
        sort($auxSession);
        $_SESSION['listaCB'] = $auxSession;
    }
    
    if (count($_SESSION['listaCB']) > 0) {
    
        echo "<div id='tabelaCurvaBase'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaCB']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaCB'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaCurvaBase\").load(\"./controls/controlProduto.php?excluirCB=".$_SESSION['listaCB'][$i]." #tabelaCurvaBase\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

// -------------------------------------------------[ EXCLUIR CURVA BASE ]------------------------------------------------- //

if (isset($_GET['excluirCB'])) {
    
    $valorGet = $_GET['excluirCB'];

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaCB']); $i++) {
        $auxSession[] = $_SESSION['listaCB'][$i];
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaCB'] = $auxSession;  
    
    if (count($_SESSION['listaCB']) > 0) {
    
        echo "<div id='tabelaCurvaBase'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";   

        for($i = 0; $i < count($_SESSION['listaCB']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaCB'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaCurvaBase\").load(\"./controls/controlProduto.php?excluirCB=".$_SESSION['listaCB'][$i]." #tabelaCurvaBase\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosCB'])) {
    
    $_SESSION['listaCB'] = array();
}

// -------------------------------------------------[ DIÂMETRO ]------------------------------------------------- //

if (isset($_GET['inicioDiametro'])) {
    
    $inicio = $_GET['inicioDiametro'];
    $fim = $_GET['fimDiametro'];
    $passos = $_GET['passosDiametro'];
    
    $intervalo = array();
    
    if ($inicio < $fim) {
        
        for($i = $inicio; $i <= $fim; $i += $passos) {
            array_push($intervalo, $i);
        }
    }
    else if ($inicio > $fim) {
        
        for($i = $inicio; $i >= $fim; $i -= $passos) {
            array_push($intervalo, $i);
        }
    }
    
    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaDiametro']); $i++) {
        $auxSession[] = $_SESSION['listaDiametro'][$i];
    }
    
    if (empty($_SESSION['listaDiametro'])) {
        $_SESSION['listaDiametro'] = $intervalo;
    }
    else {
        
        foreach($intervalo as $key => $var) {

            $cont = 0;

            foreach($auxSession as $key => $var2) {
                
                if ($var == $var2) {

                    $cont++;

                }
            }

            if ($cont == 0) {

                array_push($auxSession, $var);
            }            
        }
        
        sort($auxSession);
        $_SESSION['listaDiametro'] = $auxSession;
    }
    
    if (count($_SESSION['listaDiametro']) > 0) {
    
        echo "<div id='tabelaDiametro'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaDiametro']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaDiametro'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaDiametro\").load(\"./controls/controlProduto.php?excluirDiametro=".$_SESSION['listaDiametro'][$i]." #tabelaDiametro\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

// -------------------------------------------------[ EXCLUIR DIÂMETRO ]------------------------------------------------- //

if (isset($_GET['excluirDiametro'])) {
    
    $valorGet = $_GET['excluirDiametro'];

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaDiametro']); $i++) {
        $auxSession[] = $_SESSION['listaDiametro'][$i];
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaDiametro'] = $auxSession;  
    
    if (count($_SESSION['listaDiametro']) > 0) {
    
        echo "<div id='tabelaDiametro'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";   

        for($i = 0; $i < count($_SESSION['listaDiametro']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaDiametro'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaDiametro\").load(\"./controls/controlProduto.php?excluirDiametro=".$_SESSION['listaDiametro'][$i]." #tabelaDiametro\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosDiametro'])) {
    
    $_SESSION['listaDiametro'] = array();
}

// -------------------------------------------------[ CILINDRO ]------------------------------------------------- //

if (isset($_GET['inicioCilindro'])) {
    
    $inicio = $_GET['inicioCilindro'];
    $fim = $_GET['fimCilindro'];
    $passos = $_GET['passosCilindro'];
    
    $intervalo = array();
    
    if ($inicio < $fim) {
        
        for($i = $inicio; $i <= $fim; $i += $passos) {
            array_push($intervalo, $i);
        }
    }
    else if ($inicio > $fim) {
        
        for($i = $inicio; $i >= $fim; $i -= $passos) {
            array_push($intervalo, $i);
        }
    }
    
    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaCilindro']); $i++) {
        $auxSession[] = $_SESSION['listaCilindro'][$i];
    }
    
    if (empty($_SESSION['listaCilindro'])) {
        $_SESSION['listaCilindro'] = $intervalo;
    }
    else {
        
        foreach($intervalo as $key => $var) {

            $cont = 0;

            foreach($auxSession as $key => $var2) {
                
                if ($var == $var2) {

                    $cont++;

                }
            }

            if ($cont == 0) {

                array_push($auxSession, $var);
            }            
        }
        
        sort($auxSession);
        $_SESSION['listaCilindro'] = $auxSession;
    }
    
    if (count($_SESSION['listaCilindro']) > 0) {
    
        echo "<div id='tabelaCilindro'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Cilindro</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaCilindro']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaCilindro'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaCilindro\").load(\"./controls/controlProduto.php?excluirCilindro=".$_SESSION['listaCilindro'][$i]." #tabelaCilindro\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

// -------------------------------------------------[ EXCLUIR CILINDRO ]------------------------------------------------- //

if (isset($_GET['excluirCilindro'])) {
    
    $valorGet = $_GET['excluirCilindro'];

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaCilindro']); $i++) {
        $auxSession[] = $_SESSION['listaCilindro'][$i];
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaCilindro'] = $auxSession;  
    
    if (count($_SESSION['listaCilindro']) > 0) {
    
        echo "<div id='tabelaCilindro'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Cilindro</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";   

        for($i = 0; $i < count($_SESSION['listaCilindro']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaCilindro'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaCilindro\").load(\"./controls/controlProduto.php?excluirCilindro=".$_SESSION['listaCilindro'][$i]." #tabelaCilindro\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosCilindro'])) {
    
    $_SESSION['listaCilindro'] = array();
}

// -------------------------------------------------[ EIXO ]------------------------------------------------- //

if (isset($_GET['inicioEixo'])) {
    
    $inicio = $_GET['inicioEixo'];
    $fim = $_GET['fimEixo'];
    $passos = $_GET['passosEixo'];
    
    $intervalo = array();
    
    if ($inicio < $fim) {
        
        for($i = $inicio; $i <= $fim; $i += $passos) {
            array_push($intervalo, $i);
        }
    }
    else if ($inicio > $fim) {
        
        for($i = $inicio; $i >= $fim; $i -= $passos) {
            array_push($intervalo, $i);
        }
    }
    
    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaEixo']); $i++) {
        $auxSession[] = $_SESSION['listaEixo'][$i];
    }
    
    if (empty($_SESSION['listaEixo'])) {
        $_SESSION['listaEixo'] = $intervalo;
    }
    else {
        
        foreach($intervalo as $key => $var) {

            $cont = 0;

            foreach($auxSession as $key => $var2) {
                
                if ($var == $var2) {

                    $cont++;

                }
            }

            if ($cont == 0) {

                array_push($auxSession, $var);
            }            
        }
        
        sort($auxSession);
        $_SESSION['listaEixo'] = $auxSession;
    }
    
    if (count($_SESSION['listaEixo']) > 0) {
    
        echo "<div id='tabelaEixo'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Eixo</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaEixo']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaEixo'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaEixo\").load(\"./controls/controlProduto.php?excluirEixo=".$_SESSION['listaEixo'][$i]." #tabelaEixo\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

// -------------------------------------------------[ EXCLUIR EIXO ]------------------------------------------------- //

if (isset($_GET['excluirEixo'])) {
    
    $valorGet = $_GET['excluirEixo'];

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaEixo']); $i++) {
        $auxSession[] = $_SESSION['listaEixo'][$i];
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaEixo'] = $auxSession;  
    
    if (count($_SESSION['listaEixo']) > 0) {
    
        echo "<div id='tabelaEixo'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Eixo</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";   

        for($i = 0; $i < count($_SESSION['listaEixo']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaEixo'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaEixo\").load(\"./controls/controlProduto.php?excluirEixo=".$_SESSION['listaEixo'][$i]." #tabelaEixo\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosEixo'])) {
    
    $_SESSION['listaEixo'] = array();
}

// -------------------------------------------------[ ADICAO ]------------------------------------------------- //

if (isset($_GET['inicioAdicao'])) {
    
    $inicio = $_GET['inicioAdicao'];
    $fim = $_GET['fimAdicao'];
    $passos = $_GET['passosAdicao'];
    
    $intervalo = array();
    
    if ($inicio < $fim) {
        
        for($i = $inicio; $i <= $fim; $i += $passos) {
            array_push($intervalo, $i);
        }
    }
    else if ($inicio > $fim) {
        
        for($i = $inicio; $i >= $fim; $i -= $passos) {
            array_push($intervalo, $i);
        }
    }
    
    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaAdicao']); $i++) {
        $auxSession[] = $_SESSION['listaAdicao'][$i];
    }
    
    if (empty($_SESSION['listaAdicao'])) {
        $_SESSION['listaAdicao'] = $intervalo;
    }
    else {
        
        foreach($intervalo as $key => $var) {

            $cont = 0;

            foreach($auxSession as $key => $var2) {
                
                if ($var == $var2) {

                    $cont++;

                }
            }

            if ($cont == 0) {

                array_push($auxSession, $var);
            }            
        }
        
        sort($auxSession);
        $_SESSION['listaAdicao'] = $auxSession;
    }
    
    if (count($_SESSION['listaAdicao']) > 0) {
    
        echo "<div id='tabelaAdicao'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaAdicao']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaAdicao'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaAdicao\").load(\"./controls/controlProduto.php?excluirAdicao=".$_SESSION['listaAdicao'][$i]." #tabelaAdicao\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

// -------------------------------------------------[ EXCLUIR ADICAO ]------------------------------------------------- //

if (isset($_GET['excluirAdicao'])) {
    
    $valorGet = $_GET['excluirAdicao'];

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaAdicao']); $i++) {
        $auxSession[] = $_SESSION['listaAdicao'][$i];
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaAdicao'] = $auxSession;  
    
    if (count($_SESSION['listaAdicao']) > 0) {
    
        echo "<div id='tabelaAdicao'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Grau</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";   

        for($i = 0; $i < count($_SESSION['listaAdicao']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaAdicao'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaAdicao\").load(\"./controls/controlProduto.php?excluirAdicao=".$_SESSION['listaAdicao'][$i]." #tabelaAdicao\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosAdicao'])) {
    
    $_SESSION['listaAdicao'] = array();
}

// -------------------------------------------------[ COR ]------------------------------------------------- //

if (isset($_GET['nomeCor'])) {
    
    $nome = $_GET['nomeCor'];
    
    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaCor']); $i++) {
        $auxSession[] = $_SESSION['listaCor'][$i];
    }
    
    //$auxSession[] = $nome;
    
    if($nome != '' && !empty($nome)) {
   
        if (empty($_SESSION['listaCor'])) {
            $_SESSION['listaCor'] = array();
            $_SESSION['listaCor'][] = $nome;
        }
        else {

            $cont = 0;

            foreach($auxSession as $key => $var) {

                if ($var == $nome) {

                    $cont++;
                }
            }

            if ($cont == 0 && !empty($nome)) {
                array_push($auxSession, $nome);
            }

            sort($auxSession);
            $_SESSION['listaCor'] = $auxSession;
        }
    }

    if (count($_SESSION['listaCor']) > 0) {

        echo "<div id='tabelaCor'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Cor</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaCor']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaCor'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaCor\").load(\"./controls/controlProduto.php?excluirCor=".$_SESSION['listaCor'][$i]." #tabelaCor\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

// -------------------------------------------------[ EXCLUIR COR ]------------------------------------------------- //

if (isset($_GET['excluirCor'])) {
    
    $valorGet = $_GET['excluirCor'];

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaCor']); $i++) {
        $auxSession[] = $_SESSION['listaCor'][$i];
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaCor'] = $auxSession;  
    
    if (count($_SESSION['listaCor']) > 0) {
    
        echo "<div id='tabelaCor'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Cor</th><th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";   

        for($i = 0; $i < count($_SESSION['listaCor']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaCor'][$i]."</td><td class='col-xs-1 cursor' onclick='$(\"#tabelaCor\").load(\"./controls/controlProduto.php?excluirCor=".$_SESSION['listaCor'][$i]." #tabelaCor\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosCor'])) {
    
    $_SESSION['listaCor'] = array();
}

// -------------------------------------------------[ GET IMAGEM ]------------------------------------------------- //
    
if (isset($_GET['getImagem'])) {

    $id = (int) $_GET['getImagem'];

    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    //$produto = new Produto();

    foreach($produto->getImagem($id) as $var) {
        if ($var['imagem'] != null) {

            header('Content-Type: '. $var['tipoImagem']);
            echo $var['imagem'];
        }
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

if (isset($_POST['ativado'])) {
    
    $id = $_POST['ativado'];
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    if ($produto->desativar($id)) {
        header('Location: ../consultar-produto');
    }
}

if (isset($_POST['desativado'])) {
    
    $id = $_POST['desativado'];
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    if ($produto->ativar($id)) {
        header('Location: ../consultar-produto');
    }
}

if (isset($_GET['produtoSession'])) {
    
    $id = $_GET['produtoSession'];
    
    if (!empty($id)) {
    
        $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $nome = "";
        $torica = 0;
        $multifocal = 0;
        $colorida = 0;

        foreach ($produto->getProduto($id) as $var) {
            $nome = $var['nome'];
            $torica = $var['torica'];
            $multifocal = $var ['multifocal'];
            $colorida = $var['colorida'];

        }

        if (!empty($_GET['esferico'])) {
            $esferico = $_GET['esferico'];
        }
        else {
            $esferico = '';
        }

        if (!empty($_GET['curvaBase'])) {
            $curvaBase = $_GET['curvaBase'];
        }
        else {
            $curvaBase = '';
        }

        if (!empty($_GET['diametro'])) {
            $diametro = $_GET['diametro'];
        }
        else {
            $diametro = '';
        }

        if($torica) {

            if (!empty($_GET['cilindro'])) {
                $cilindro = $_GET['cilindro'];
            }
            else {
                $cilindro = '';
            }

            if (!empty($_GET['eixo'])) {
                $eixo = $_GET['eixo'];
            }
            else {
                $eixo = '';
            }
        }
        else {

            $cilindro = '';
            $eixo = '';
        }

        if($multifocal) {

            if (!empty($_GET['adicao'])) {
                $adicao = $_GET['adicao'];
            }
            else {
                $adicao = '';
            }
        }
        else {

            $adicao = '';
        }


        if($colorida) {

            if (!empty($_GET['cor'])) {
                $cor = $_GET['cor'];
            }
            else {
                $cor = '';
            }
        }
        else {

            $cor = '';
        }

        if (!empty($_GET['quantidade'])) {
            $quantidade = $_GET['quantidade'];
        }
        else {
            $quantidade = 1;
        }

            if (empty($_SESSION['listaProdutos'])) {
                $_SESSION['listaProdutos'] = array();
                $_SESSION['listaProdutos'][0]['id'] = 0;
                $_SESSION['listaProdutos'][0]['idProduto'] = $id;
                $_SESSION['listaProdutos'][0]['nome'] = $nome;
                $_SESSION['listaProdutos'][0]['esferico'] = $esferico;
                $_SESSION['listaProdutos'][0]['curvaBase'] = $curvaBase;
                $_SESSION['listaProdutos'][0]['diametro'] = $diametro;
                $_SESSION['listaProdutos'][0]['cilindro'] = $cilindro;
                $_SESSION['listaProdutos'][0]['eixo'] = $eixo;
                $_SESSION['listaProdutos'][0]['adicao'] = $adicao;
                $_SESSION['listaProdutos'][0]['cor'] = $cor;
                $_SESSION['listaProdutos'][0]['quantidade'] = $quantidade;
            }
            else {
                
            $contcond = 0;

            foreach ($_SESSION['listaProdutos'] as $indice => $valor) {

                if ($valor['nome'] == $nome && $valor['esferico'] == $esferico && $valor['curvaBase'] == $curvaBase && $valor['diametro'] == $diametro && $valor['cilindro'] == $cilindro && $valor['eixo'] == $eixo && $valor['adicao'] == $adicao && $valor['cor'] == $cor) {
                    $contcond++;
                }                  
            }

            if($contcond == 0) {

                $i = 0;
                $cont = 0;

                foreach ($_SESSION['listaProdutos'] as $indice => $valor) {

                    if ($valor['id'] > $i) {
                        $i = $valor['id'];
                    }
                    $cont++;
                }

                $_SESSION['listaProdutos'][$cont]['id'] = $i + 1;
                $_SESSION['listaProdutos'][$cont]['idProduto'] = $id;
                $_SESSION['listaProdutos'][$cont]['nome'] = $nome;
                $_SESSION['listaProdutos'][$cont]['esferico'] = $esferico;
                $_SESSION['listaProdutos'][$cont]['curvaBase'] = $curvaBase;
                $_SESSION['listaProdutos'][$cont]['diametro'] = $diametro;
                $_SESSION['listaProdutos'][$cont]['cilindro'] = $cilindro;
                $_SESSION['listaProdutos'][$cont]['eixo'] = $eixo;
                $_SESSION['listaProdutos'][$cont]['adicao'] = $adicao;
                $_SESSION['listaProdutos'][$cont]['cor'] = $cor;
                $_SESSION['listaProdutos'][$cont]['quantidade'] = $quantidade;
            }
        }

        if (count($_SESSION['listaProdutos']) > 0) {

            echo "<div id='tabelaProdutos'>";
            echo "<center>";
            echo "<div class='panel-body table-scroll nopaddintop'>";
            echo "<table class='table table-bordered table-hover table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='col-xs-11'>Produto</th>";
            echo "<th class='col-xs-11'>Esferico</th>";
            echo "<th class='col-xs-11'>Curva Base</th>";
            echo "<th class='col-xs-11'>Diâmetro</th>";
            echo "<th class='col-xs-11'>Cilindro</th>";
            echo "<th class='col-xs-11'>Eixo</th>";
            echo "<th class='col-xs-11'>Adição</th>";
            echo "<th class='col-xs-11'>Cor</th>";
            echo "<th class='col-xs-11'>Quantidade</th>";
            echo "<th class='col-xs-1'><center>Remover</center></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            for($i = 0; $i < count($_SESSION['listaProdutos']); $i++) {
                echo "<tr>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['nome']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['esferico']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['curvaBase']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['diametro']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['cilindro']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['eixo']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['adicao']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['cor']."</td>";
                echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['quantidade']."</td>";
                echo "<td class='col-xs-1 cursor' onclick='$(\"#tabelaProdutos\").load(\"./controls/controlProduto.php?excluirProduto=".$_SESSION['listaProdutos'][$i]['id']." #tabelaProdutos\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
                echo "</tr>";
            }

            echo "<tbody>";
            echo "</table>";
            echo "</div>";
            echo " </center>";
            echo "</div>";
        }
    }
}

if (isset($_GET['excluirProduto'])) {
    
    $valorGet = $_GET['excluirProduto'];

    $auxSession = array();
    
    for($i = 0; $i < count($_SESSION['listaProdutos']); $i++) {
        $auxSession[] = $_SESSION['listaProdutos'][$i];
    }
    
    foreach($auxSession as $indice => $valor) {

        if ($valor['id'] == $valorGet) {

            unset($auxSession[$indice]);

        }
    }             

    sort($auxSession);
    $_SESSION['listaProdutos'] = $auxSession;  
    
    if (count($_SESSION['listaProdutos']) > 0) {
    
        echo "<div id='tabelaProdutos'>";
        echo "<center>";
        echo "<div class='panel-body table-scroll nopaddintop'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='col-xs-11'>Produto</th>";
        echo "<th class='col-xs-11'>Esferico</th>";
        echo "<th class='col-xs-11'>Curva Base</th>";
        echo "<th class='col-xs-11'>Diâmetro</th>";
        echo "<th class='col-xs-11'>Cilindro</th>";
        echo "<th class='col-xs-11'>Eixo</th>";
        echo "<th class='col-xs-11'>Adição</th>";
        echo "<th class='col-xs-11'>Cor</th>";
        echo "<th class='col-xs-11'>Quantidade</th>";
        echo "<th class='col-xs-1'><center>Remover</center></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        for($i = 0; $i < count($_SESSION['listaProdutos']); $i++) {
            echo "<tr>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['nome']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['esferico']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['curvaBase']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['diametro']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['cilindro']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['eixo']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['adicao']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['cor']."</td>";
            echo "<td class='col-xs-11'>".$_SESSION['listaProdutos'][$i]['quantidade']."</td>";
            echo "<td class='col-xs-1 cursor' onclick='$(\"#tabelaProdutos\").load(\"./controls/controlProduto.php?excluirProduto=".$_SESSION['listaProdutos'][$i]['id']." #tabelaProdutos\");'><center><i class='fa fa-times' aria-hidden='true'></i></center></td>";
            echo "</tr>";
        }

        echo "<tbody>";
        echo "</table>";
        echo "</div>";
        echo " </center>";
        echo "</div>";
    }
}

if (isset($_GET['excluirTodosProdutos'])) {
    
    $_SESSION['listaProdutos'] = array();
}

if  (isset($_POST['score'])) {
    
    $nota = floatval($_POST['score']);
    $id = $_POST['idProduto'];
    $opiniao = $_POST['opiniao'];
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    if ($produto->registrarOpiniao($id, $nota, $opiniao, $_SESSION['usuario'])) {
        header('Location: ../historico-compras');
    }
    
}

if (isset($_GET['data1'])) {
    
    $data1 = $_GET['data1'];
    $data2 = $_GET['data2'];
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    echo "<div id='tabelaVendas'>";
    echo "<div class='panel-body table-scroll-estoque nopaddintop'>";
            echo "<table class='table table-bordered table-hover table-striped hd-center'>";
              echo "<thead>";
                echo "<tr>";
                    echo "<th>Data</th><th>Produto</th><th>Quantidade</th><th>Valor</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
    
    foreach($produto->emitirRelatorioVendas($data1, $data2) as $var) {
            
        $qtde = $var['q1'] + $var['q2'];
        $valorTotal = $var['valorUnit'] * $qtde;
        
                echo "<tr>";
                    echo "<td>".date("d/m/Y", strtotime($var['data']))."</td><td>".$var['nome']."</td><td>$qtde</td><td>R$ ".number_format((float)$valorTotal, 2, '.', '')."</td>";
                echo "</tr>";
    }
    
                echo "<tbody>";
            echo "</table>";
          echo "</div>";
          echo "</div>";
    
}

if(isset($_POST['data1'])) {
    
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];
    
    $valor = 0;

    $retorno .= "<table border='1' cellspacing='0' cellpadding='15' width='1100' align='center' text-align='center'>
        <thead>
        <tr class='header'>
        <th>DATA</th>
        <th>PRODUTO</td>
        <th>QUANTIDADE</th>
        <th>VALOR</td>       
        </tr>
        </thead>";
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    foreach ($produto->emitirRelatorioVendas($data1, $data2) as $var) {

        $qtde = $var['q1'] + $var['q2'];
        $valorTotal = $var['valorUnit'] * $qtde;
        
        $valor += $valorTotal;

        $retorno .= "<tr>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>" . date("d/m/Y", strtotime($var['data'])) ."</td>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>" . $var['nome'] ."</td>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>" . $qtde . "</td>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>R$ " . number_format((float)$valorTotal, 2, '.', '') . "</td>";
        $retorno .= "</tr>";
    }

    $retorno .= "</table>";


    $topo .= "<table width=\"1100\">
        <tr>
            <td align=\"left\"><img style='width: 220px; height: 64px;' src='../images/logo-teal.png'/></td>
            <td align=\"left\"><b>RELATÓRIO DE VENDAS</b></td>
            <td align=\"left\"><b>DATA INICIO: ".date("d/m/Y", strtotime($data1))."</b></td>
            <td align=\"left\"><b>DATA FIM: ".date("d/m/Y", strtotime($data2))."</b></td>
            <td align=\"right\"><b>GERADO EM: ".date("d/m/Y")."</b></td>
        </tr>
    </table>";
    
    $retorno .= "<p>&nbsp;</p><p>&nbsp;<b>Valor Total: R$ ".number_format((float)$valor, 2, '.', '')."</b>";


    $nomePDF = "Relatorio-Vendas-".date("d-m-Y").".pdf";
    $pdf =  new mPDF('utf-8', 'A4-L', 11, 'Arial', '15','15','30');
    $pdf->setHTMLHeader($topo);
    $pdf->setFooter('{PAGENO} / {nb}');
    $pdf->WriteHTML($retorno);
     

    $pdf->Output($nomePDF, 'I');
}

if (isset($_GET['data1Compras'])) {
    
    $data1 = $_GET['data1Compras'];
    $data2 = $_GET['data2Compras'];
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    echo "<div id='tabelaCompras'>";
    echo "<div class='panel-body table-scroll-estoque nopaddintop'>";
            echo "<table class='table table-bordered table-hover table-striped hd-center'>";
              echo "<thead>";
                echo "<tr>";
                    echo "<th>Data</th><th>Produto</th><th>Quantidade</th><th>Valor</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
    
    foreach($produto->emitirRelatorioCompras($data1, $data2) as $var) {
            
        $qtde = $var['q'];
        $valorTotal = $var['valorUnit'] * $qtde;
        
                echo "<tr>";
                    echo "<td>".date("d/m/Y", strtotime($var['data']))."</td><td>".$var['nome']."</td><td>$qtde</td><td>R$ ".number_format((float)$valorTotal, 2, '.', '')."</td>";
                echo "</tr>";
    }
    
                echo "<tbody>";
            echo "</table>";
          echo "</div>";
          echo "</div>";
    
}

if(isset($_POST['data1Compras'])) {
    
    $data1 = $_POST['data1Compras'];
    $data2 = $_POST['data2Compras'];
    
    $valor = 0;

    $retorno .= "<table border='1' cellspacing='0' cellpadding='15' width='1100' align='center' text-align='center'>
        <thead>
        <tr class='header'>
        <th>DATA</th>
        <th>PRODUTO</td>
        <th>QUANTIDADE</th>
        <th>VALOR</td>       
        </tr>
        </thead>";
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    foreach ($produto->emitirRelatorioCompras($data1, $data2) as $var) {

        $qtde = $var['q'];
        $valorTotal = $var['valorUnit'] * $qtde;
        
        $valor += $valorTotal;

        $retorno .= "<tr>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>" . date("d/m/Y", strtotime($var['data'])) ."</td>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>" . $var['nome'] ."</td>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>" . $qtde . "</td>";
        $retorno .= "<td style='border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center; padding: 10px 30px 10px 30px;'>R$ " . number_format((float)$valorTotal, 2, '.', '') . "</td>";
        $retorno .= "</tr>";
    }

    $retorno .= "</table>";


    $topo .= "<table width=\"1100\">
        <tr>
            <td align=\"left\"><img style='width: 220px; height: 64px;' src='../images/logo-teal.png'/></td>
            <td align=\"left\"><b>RELATÓRIO DE COMPRAS</b></td>
            <td align=\"left\"><b>DATA INICIO: ".date("d/m/Y", strtotime($data1))."</b></td>
            <td align=\"left\"><b>DATA FIM: ".date("d/m/Y", strtotime($data2))."</b></td>
            <td align=\"right\"><b>GERADO EM: ".date("d/m/Y")."</b></td>
        </tr>
    </table>";
    
    $retorno .= "<p>&nbsp;</p><p>&nbsp;<b>Valor Total: R$ ".number_format((float)$valor, 2, '.', '')."</b>";


    $nomePDF = "Relatorio-Compras-".date("d-m-Y").".pdf";
    $pdf =  new mPDF('utf-8', 'A4-L', 11, 'Arial', '15','15','30');
    $pdf->setHTMLHeader($topo);
    $pdf->setFooter('{PAGENO} / {nb}');
    $pdf->WriteHTML($retorno);
     

    $pdf->Output($nomePDF, 'I');
}

