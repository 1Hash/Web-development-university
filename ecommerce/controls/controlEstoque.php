<?php

session_start();

require_once("../models/ModelEstoque.class.php");
require_once("../classes/Estoque.class.php");

require_once("../models/ModelProduto.class.php");
require_once("../classes/Produto.class.php");
    
$produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

if (isset($_POST['produtoInputEstoque'])) {
    
    $idProduto = $_POST['produtoInputEstoque'];
    $esferico = $_POST['selectEsfericoEstoque'];
    
    $cilindro = null;
    $eixo = null;
    $adicao = null;
    $cor = null;
    $olho = null;
    
    if (isset($_POST['selectCilindroEstoque'])) {
        $cilindro = $_POST['selectCilindroEstoque'];
    }
    
    if (isset($_POST['selectEixoEstoque'])) {
        $eixo = $_POST['selectEixoEstoque'];
    }
    
    if (isset($_POST['selectAdicaoEstoque'])) {
        $adicao = $_POST['selectAdicaoEstoque'];
    }
    
    if (isset($_POST['selectCorEstoque'])) {
        $cor = $_POST['selectCorEstoque'];
    }
    
    if (isset($_POST['olho'])) {
        $olho = $_POST['olho'];
    }

    $curvaBase = $_POST['selectCurvaBaseEstoque'];
    $diametro = $_POST['selectDiametroEstoque'];    
    $quantidade = $_POST['inputQuantidadeEstoque'];
    
    if ($olho == "dominante") {
        $olho = 1;
    }
    else if ($olho == "naoDominante"){
        $olho = 0;
    }
    else {
        $olho = null;
    }

    $estoque = new Estoque(null, $esferico, $cilindro, $eixo, $curvaBase, $diametro, $adicao, $cor, $olho, $quantidade, $idProduto);
    
    foreach ($estoque->funcaoGetTodosEstoque() as $var) {
        if ($var['grauEsferico'] == $esferico && $var['grauCilindro'] == $cilindro && $var['eixo'] == $eixo && $var['curvaBase'] == $curvaBase && $var['diametro'] == $diametro && $var['grauAdicao'] == $adicao && $var['cor'] == $cor && $var['olho'] == $olho && $var['idProduto'] == $idProduto) {
            echo retorno("Este produto já existe no estoque!");
            exit;
        }
    }
    
    if ($estoque->cadastrar($estoque)) {
        echo retorno("Produto adicionado ao estoque! <a href='consultar-estoque' class='alert-link'>Clique aqui para consultar o estoque!</a>", true);
        exit;
    }
    else {
        echo retorno("Não foi possível adicionar o produto ao estoque!");
        exit;
    }
}

if (isset($_POST['idEstoque'])) {
    
    $idProduto = $_POST['produtoInputEstoqueE'];
    $esferico = $_POST['selectEsfericoEstoque'];
    $idEstoque = $_POST['idEstoque'];
    
    $cilindro = null;
    $eixo = null;
    $adicao = null;
    $cor = null;
    $olho = null;
    
    if (isset($_POST['selectCilindroEstoque'])) {
        $cilindro = $_POST['selectCilindroEstoque'];
    }
    
    if (isset($_POST['selectEixoEstoque'])) {
        $eixo = $_POST['selectEixoEstoque'];
    }
    
    if (isset($_POST['selectAdicaoEstoque'])) {
        $adicao = $_POST['selectAdicaoEstoque'];
    }
    
    if (isset($_POST['selectCorEstoque'])) {
        $cor = $_POST['selectCorEstoque'];
    }
    
    if (isset($_POST['olho'])) {
        $olho = $_POST['olho'];
    }

    $curvaBase = $_POST['selectCurvaBaseEstoque'];
    $diametro = $_POST['selectDiametroEstoque'];    
    $quantidade = $_POST['inputQuantidadeEstoque'];
    
    if ($olho == "dominante") {
        $olho = 1;
    }
    else if ($olho == "naoDominante"){
        $olho = 0;
    }
    else {
        $olho = null;
    }

    $estoque = new Estoque(null, $esferico, $cilindro, $eixo, $curvaBase, $diametro, $adicao, $cor, $olho, $quantidade, $idProduto);
    
    foreach ($estoque->funcaoGetTodosEstoque() as $var) {
        if ($var['idEstoque'] != $idEstoque && $var['grauEsferico'] == $esferico && $var['grauCilindro'] == $cilindro && $var['eixo'] == $eixo && $var['curvaBase'] == $curvaBase && $var['diametro'] == $diametro && $var['grauAdicao'] == $adicao && $var['cor'] == $cor && $var['olho'] == $olho && $var['idProduto'] == $idProduto) {
            echo retorno("Este produto já existe no estoque!");
            exit;
        }
    }
    
    if ($estoque->alterar($estoque, $idEstoque)) {
        echo retorno("Produto editado! <a href='consultar-estoque' class='alert-link'>Clique aqui para consultar o estoque!</a>", true);
        exit;
    }
    else {
        echo retorno("Não foi possível editar o produto!");
        exit;
    }
}

if (isset($_GET['carregarParametros'])) {
    
    $id = $_GET['carregarParametros'];
    
    foreach ($produto->getProduto($id) as $var) {
        
    echo "<div id='parametrosEstoque2'>";

    echo "<div class='form-group col-sm-6'>";
    echo "<label for='selectEsfericoEstoque'>Esférico</label>";
    echo "<select id='selectEsfericoEstoque' name='selectEsfericoEstoque' class='form-control'>";
    echo "<option value=''>-- Esférico --</option>";
    
    foreach ($produto->funcaoGetIntervaloEsferico($id) as $var2) {
        echo "<option value='".$var2['grauEsferico']."'>".$var2['grauEsferico']."</option>";
    }  
    
    echo "</select>";
    echo "</div>";
    
    if ($var['torica'] == 1) {
    
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='selectCilindroEstoque'>Cilíndro</label>";
        echo "<select id='selectCilindroEstoque' name='selectCilindroEstoque' class='form-control'>";
        echo "<option value=''>-- Cilíndro --</option>";

        foreach ($produto->funcaoGetIntervaloCilindro($id) as $var2) {
            echo "<option value='".$var2['grauCilindro']."'>".$var2['grauCilindro']."</option>";
        }  

        echo "</select>";
        echo "</div>";
    }
    
    if ($var['torica'] == 1) {
    
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='selectEixoEstoque'>Eixo</label>";
        echo "<select id='selectEixoEstoque' name='selectEixoEstoque' class='form-control'>";
        echo "<option value=''>-- Eixo --</option>";

        foreach ($produto->funcaoGetIntervaloEixo($id) as $var2) {
            echo "<option value='".$var2['eixo']."'>".$var2['eixo']."</option>";
        }
    
        echo "</select>";
        echo "</div>";
    }

    echo "<div class='form-group col-sm-6'>";
    echo "<label for='selectCurvaBaseEstoque'>Curva Base</label>";
    echo "<select id='selectCurvaBaseEstoque' name='selectCurvaBaseEstoque' class='form-control'>";
    echo "<option value=''>-- Curva Base --</option>";

    foreach ($produto->funcaoGetIntervaloCurvaBase($id) as $var2) {
        echo "<option value='".$var2['curvaBase']."'>".$var2['curvaBase']."</option>";
    }

    echo "</select>";
    echo "</div>";

    if ($var['multifocal'] == 1) {
    
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='selectAdicaoEstoque'>Adição</label>";
        echo "<select id='selectAdicaoEstoque' name='selectAdicaoEstoque' class='form-control'>";
        echo "<option value=''>-- Adição --</option>";
        
        foreach ($produto->funcaoGetIntervaloAdicao($id) as $var2) {
            echo "<option value='".$var2['grauAdicao']."'>".$var2['grauAdicao']."</option>";
        }
        
        echo "</select>";
        echo "</div>";
    }
    
    
    echo "<div class='form-group col-sm-6'>";
    echo "<label for='selectDiametroEstoque'>Diâmetro</label>";
    echo "<select id='selectDiametroEstoque' name='selectDiametroEstoque' class='form-control'>";
    echo "<option value=''>-- Diâmetro --</option>";
    
    foreach ($produto->funcaoGetIntervaloDiametro($id) as $var2) {
        echo "<option value='".$var2['diametro']."'>".$var2['diametro']."</option>";
    }
    
    echo "</select>";
    echo "</div>";

    if ($var['colorida'] == 1) {
    
        echo "<div class='form-group col-sm-6'>";
        echo "<label for='selectCorEstoque'>Cor</label>";
        echo "<select id='selectCorEstoque' name='selectCorEstoque' class='form-control'>";
        echo "<option value=''>-- Cor --</option>";

        foreach ($produto->funcaoGetIntervaloCor($id) as $var2) {
            echo "<option value='".$var2['cor']."'>".$var2['cor']."</option>";
        }

        echo "</select>";
        echo "</div>";
    
    }
    
    if ($var['multifocal'] == 1) {
    
        echo "<div class='form-group col-sm-12'></div>";
        
        echo "<div class='form-group col-sm-4'>";
        echo "<div class='radio'><label><input type='radio' name='olho' id='checkDominante' value='dominante'><span><b> Dominante</b></span></label></div>";
        echo "</div>";
        echo "<div class='form-group col-sm-4'>";
        echo "<div class='radio'><label><input type='radio' name='olho' id='checkNaoDominante' value='naoDominante' checked='checked'><span><b> Não dominante</b></span></label></div>";
        echo "</div>";

    }

    echo "</div>";
    
    }   
}

if (isset($_GET['carregarParametros2'])) {
    
    $id = $_GET['carregarParametros2'];
    $idEstoque = $_GET['idEstoque'];
    
    $estoque = new Estoque(null, null, null, null, null, null, null, null, null, null, null);
    
    foreach ($produto->getProduto($id) as $var) {
        foreach ($estoque->funcaoGetEstoque($idEstoque) as $var2) {

            echo "<div id='parametrosEstoque2'>";

            echo "<div class='form-group col-sm-6'>";
            echo "<label for='selectEsfericoEstoque'>Esférico</label>";
            echo "<select id='selectEsfericoEstoque' name='selectEsfericoEstoque' class='form-control'>"; 

            echo "<option value='".$var2['grauEsferico']."'>".$var2['grauEsferico']."</option>";

            foreach ($produto->funcaoGetIntervaloEsfericoEdit($id, $var2['grauEsferico']) as $var3) {
                echo "<option value='".$var3['grauEsferico']."'>".$var3['grauEsferico']."</option>";
            }

            echo "</select>";
            echo "</div>";

            if ($var['torica'] == 1) {

                echo "<div class='form-group col-sm-6'>";
                echo "<label for='selectCilindroEstoque'>Cilíndro</label>";
                echo "<select id='selectCilindroEstoque' name='selectCilindroEstoque' class='form-control'>";
                
                echo "<option value='".$var2['grauCilindro']."'>".$var2['grauCilindro']."</option>";

                foreach ($produto->funcaoGetIntervaloCilindroEdit($id, $var2['grauCilindro']) as $var3) {
                    echo "<option value='".$var3['grauCilindro']."'>".$var3['grauCilindro']."</option>";
                }  

                echo "</select>";
                echo "</div>";
            }

            if ($var['torica'] == 1) {

                echo "<div class='form-group col-sm-6'>";
                echo "<label for='selectEixoEstoque'>Eixo</label>";
                echo "<select id='selectEixoEstoque' name='selectEixoEstoque' class='form-control'>";
                
                echo "<option value='".$var2['eixo']."'>".$var2['eixo']."</option>";

                foreach ($produto->funcaoGetIntervaloEixoEdit($id, $var2['eixo']) as $var3) {
                    echo "<option value='".$var3['eixo']."'>".$var3['eixo']."</option>";
                }

                echo "</select>";
                echo "</div>";
            }

            echo "<div class='form-group col-sm-6'>";
            echo "<label for='selectCurvaBaseEstoque'>Curva Base</label>";
            echo "<select id='selectCurvaBaseEstoque' name='selectCurvaBaseEstoque' class='form-control'>";
            
            echo "<option value='".$var2['curvaBase']."'>".$var2['curvaBase']."</option>";

            foreach ($produto->funcaoGetIntervaloCurvaBaseEdit($id, $var2['curvaBase']) as $var3) {
                echo "<option value='".$var3['curvaBase']."'>".$var3['curvaBase']."</option>";
            }

            echo "</select>";
            echo "</div>";

            if ($var['multifocal'] == 1) {

                echo "<div class='form-group col-sm-6'>";
                echo "<label for='selectAdicaoEstoque'>Adição</label>";
                echo "<select id='selectAdicaoEstoque' name='selectAdicaoEstoque' class='form-control'>";
                
                echo "<option value='".$var2['grauAdicao']."'>".$var2['grauAdicao']."</option>";

                foreach ($produto->funcaoGetIntervaloAdicaoEdit($id, $var2['grauAdicao']) as $var3) {
                    echo "<option value='".$var3['grauAdicao']."'>".$var3['grauAdicao']."</option>";
                }

                echo "</select>";
                echo "</div>";
            }


            echo "<div class='form-group col-sm-6'>";
            echo "<label for='selectDiametroEstoque'>Diâmetro</label>";
            echo "<select id='selectDiametroEstoque' name='selectDiametroEstoque' class='form-control'>";
            
            echo "<option value='".$var2['diametro']."'>".$var2['diametro']."</option>";

            foreach ($produto->funcaoGetIntervaloDiametroEdit($id, $var2['diametro']) as $var3) {
                echo "<option value='".$var3['diametro']."'>".$var3['diametro']."</option>";
            }

            echo "</select>";
            echo "</div>";

            if ($var['colorida'] == 1) {

                echo "<div class='form-group col-sm-6'>";
                echo "<label for='selectCorEstoque'>Cor</label>";
                echo "<select id='selectCorEstoque' name='selectCorEstoque' class='form-control'>";
                
                echo "<option value='".$var2['cor']."'>".$var2['cor']."</option>";

                foreach ($produto->funcaoGetIntervaloCorEdit($id, $var2['cor']) as $var3) {
                    echo "<option value='".$var3['cor']."'>".$var3['cor']."</option>";
                }

                echo "</select>";
                echo "</div>";

            }

            if ($var['multifocal'] == 1) {

                echo "<div class='form-group col-sm-12'></div>";

                echo "<div class='form-group col-sm-4'>";
                if ($var2['olho'] == 1) {
                    echo "<div class='radio'><label><input type='radio' name='olho' id='checkDominante' value='dominante' checked='checked'><span><b> Dominante</b></span></label></div>";
                }
                else {
                    echo "<div class='radio'><label><input type='radio' name='olho' id='checkDominante' value='dominante'><span><b> Dominante</b></span></label></div>";
                }
                echo "</div>";
                echo "<div class='form-group col-sm-4'>";
                if ($var2['olho'] != 1) {
                    echo "<div class='radio'><label><input type='radio' name='olho' id='checkNaoDominante' value='naoDominante' checked='checked'><span><b> Não dominante</b></span></label></div>";
                }
                else {
                    echo "<div class='radio'><label><input type='radio' name='olho' id='checkNaoDominante' value='naoDominante'><span><b> Não dominante</b></span></label></div>";
                }
                echo "</div>";

            }

            echo "</div>";
        }  
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

