<?php

session_start();

require_once("./conexao.class.php");

require_once("./models/ModelProduto.class.php");
require_once("./models/ModelFornecedor.class.php");

require_once("./classes/Produto.class.php");
require_once("./classes/Fornecedor.class.php");

require_once("./models/ModelUsuario.class.php");
require_once("./classes/Usuario.class.php");

$usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
$produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
$fornecedor = new Fornecedor(null, null, null, null, null, null, null, null, null, null, null, null, null);

$contCarrinho = 0;

if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $indice => $valor) {
        $contCarrinho++;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <base href="http://localhost/ecommerce/" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Detalhes Produto - ELentes</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/EL.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.default.css" rel="stylesheet">
    <link href="css/jquery.bootstrap-touchspin.css" rel="stylesheet">
    <link href="css/style.teal.flat.css" rel="stylesheet" id="theme">
    
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/mask.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/jquery.form.js"></script>
    
    <script>       
        $(document).ready(function(){
            $('#mesmoGrau').change(function(){
                $(".mesmoG").addClass("hidden");
                $(".ambos").removeClass("hidden");
                
                $("#grauEsfericoE").prop("required", false);
                $("#grauCilindroE").prop("required", false);
                $("#eixoE").prop("required", false);
                $("#curvaBaseE").prop("required", false);
                $("#diametroE").prop("required", false);
                $("#grauAdicaoE").prop("required", false);
                $("#corE").prop("required", false);
                $("#quantidadeE").prop("required", false);
            });
            
            $('#grauDiferente').change(function(){
                $(".mesmoG").removeClass("hidden");
                $(".ambos").addClass("hidden");
                
                $("#grauEsfericoE").attr("required", "true");
                $("#grauCilindroE").attr("required", "true");
                $("#eixoE").attr("required", "true");
                $("#curvaBaseE").attr("required", "true");
                $("#diametroE").attr("required", "true");
                $("#grauAdicaoE").attr("required", "true");
                $("#corE").attr("required", "true");
                $("#quantidadeE").attr("required", "true");
                
            });
            
            $(window).load(function() {
                $("#grauEsfericoE").attr("required", "true");
                $("#grauCilindroE").attr("required", "true");
                $("#eixoE").attr("required", "true");
                $("#curvaBaseE").attr("required", "true");
                $("#diametroE").attr("required", "true");
                $("#grauAdicaoE").attr("required", "true");
                $("#corE").attr("required", "true");
                $("#quantidadeE").attr("required", "true");
            });
            
            $("#login-usuario").validate({
            rules: {
                emailCPFInputLogin: {
                    required: true
                },          
                senhaInputLogin: {
                    required: true
                }
            },
            messages: {
                emailCPFInputLogin: {
                    required: "Insira seu E-mail ou CPF!"
                },
                senhaInputLogin: {
                    required: "Insira sua senha!"
                }
            }
        });

        $('.btnLoginUsuario').click(function () {

            if(!$("#login-usuario").valid()) {
                return false;
            }
            else {

                var emailCPF = $("#emailCPFInputLogin").val();
                var senha = $("#senhaInputLogin").val();

                $.post('./controls/controlUsuario.php', { emailCPF : emailCPF, senha : senha },
                function(get_retorno) {
                    if (get_retorno == "1") {
                        $("#mensagem").html('<i>Dados incorretos!</i>');
                    }
                    else if(get_retorno == "0"){
                        window.location.href = "./perfil-usuario.php";
                    }
                    else {
                        window.location.href = "./index-admin.php";
                    }
                });
            }
        });
        });
    </script>   
  </head>
  <body class="fade-down">
      
    <!-- Top Header -->
    <div class="top-header">
      <div class="container"> 
        <div class="row">
          <div class="col-xs-12">
            <ul class="list-inline pull-right">
              <li class="hidden-xs"><a href="suporte"><i class="fa fa-question-circle"></i> Suporte</a></li>
              <li class="hidden-xs"><a href=""><i class="fa fa-phone"></i>  +55 (41) 3223-0749</a></li>
              <li class="hidden-xs cursor" data-toggle="modal" data-target="#consultarFrete"><a><i class="fa fa-truck"></i> Consultar Frete</a></li>
              <li>
                  
                <?php

                if(!isset($_SESSION['usuario'])) {

                ?>
                  
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-user"></i> Entrar <span class="caret"></span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-login" aria-labelledby="dropdownLogin">
                    <form id="login-usuario" method="POST" action="./controls/controlUsuario.php">
                      <div class="form-group">
                        <label for="emailCPFInputLogin">E-mail ou CPF</label>
                        <input type="text" class="form-control" id="emailCPFInputLogin" name="emailCPFInputLogin" placeholder="E-mail ou CPF">
                      </div>
                      <div class="form-group">
                        <label for="senhaInputLogin">Senha</label>
                        <input type="password" class="form-control" id="senhaInputLogin" name="senhaInputLogin" placeholder="Senha">
                        <b style="padding-top: 10px; float: right;" id="mensagem" class="text-danger error"></b>
                      </div>
                      <button type="button" class="btn btn-theme btn-sm btnLoginUsuario"><i class="fa fa-long-arrow-right"></i> Entrar</button>
                      <a class="btn btn-theme btn-sm pull-right" href="registrar.php" role="button">Cadastrar-se</a>
                    </form>
                  </div>
                </div>
                  
                <?php } else { ?>
                  
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php                  
                        foreach($usuario->getUsuario($_SESSION['usuario']) as $var) {
                    ?>
                        <i class="fa fa-user"></i> Oi, <?php echo $var['nome']; ?> <span class="caret"></span>
                    <?php } ?>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUser">
                    <li><a href="perfil-usuario">Meu Perfil</a></li>
                    <li><a href="historico-compras">Histórico de Compras</a></li>
                    <li><a href="alterar-senha-usuario">Alterar senha</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="?go=sair">Sair</a></li>
                  </ul>
                </div>
                  
                <?php } ?>
                  
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Top Header -->

    <!-- Middle Header -->
    <div class="middle-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3 logo">
            <a href="index.php"><img alt="Logo" src="images/logo-teal.png" class="img-responsive" data-text-logo="ELentes-logo" /></a>
          </div>
          <div class="col-sm-8 col-md-6 search-box m-t-2">
            <form method="POST" action="produtos">
                <div class="input-group">
                  <input type="text" class="form-control" aria-label="Busque aqui..." name="busca" placeholder="Busque aqui...">
                  <div class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-search"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </form>
          </div>
          <div class="col-sm-4 col-md-3 cart-btn hidden-xs m-t-2">
            <a href="" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-shopping-cart"></i> <?php echo $contCarrinho; ?> <span class="caret"></span></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-cart">
                
                <?php
                
                $urlSite = 'http://localhost/ecommerce';
                $encoding = mb_internal_encoding();
                
                $total = 0;
                
                if (isset($_SESSION['carrinho'])) {
                    foreach ($_SESSION['carrinho'] as $indice => $valor) {
                
                        foreach ($produto->getProduto($valor['idProduto']) as $var) {
                        
                            $url = $var['nome']."-".$var['idProduto'];
                            $url = strtolower($url);
                            $url = retirarAcentos($url);
                            $url = str_replace(' ', '-', $url);

                            $valorUnitario = $var['valorUnit'];
                            $qtdeTotal = $valor['quantidadeE'] + $valor['quantidadeD'];
                            $subTotal = $qtdeTotal * $valorUnitario;

                            $total += $subTotal;

                            ?>
                                <div class="media">
                                    <div class="media-left">
                                      <!--<a href="detalhes.html"><img class="media-object img-thumbnail" src="images/demo/p1-small-1.jpg" width="50" alt="product"></a>-->
                                      <a href="<?php echo "$urlSite/detalhes/$url"; ?>">
                                        <img src="./controls/controlUsuario.php?getImagemP=<?php echo $var['idProduto']; ?>" alt="" width="50" class="media-object img-thumbnail">
                                    </a>
                                    </div>
                                    <div class="media-body">
                                      <!--<a href="detalhes.html" class="media-heading">WranglerGrey Printed Slim Fit Round Neck T-Shirt</a>-->
                                      <p><a href="<?php echo "$urlSite/detalhes/$url"; ?>" class="d-block"><?php echo mb_strtoupper($var['nome'], $encoding); ?></a></p>
                                      <div>x<?php echo $qtdeTotal; ?>   R$ <?php echo number_format((float)$valorUnitario, 2, '.', ''); ?></div>
                                    </div>
                                </div> 
                            <?php                
                        }
                    }
                }
                
                ?>

              <div class="subtotal-cart">Total: <span><b>R$  <?php echo number_format((float)$total, 2, '.', ''); ?></b></span></div>
              <div class="text-center">
                  <div class="btn-group" role="group" aria-label="View Cart and Checkout Button">
                    <a href="carrinho" class="btn btn-default btn-sm"><i class="fa fa-shopping-cart"></i> Ver Carrinho</a>
                    <a href="finalizar" class="btn btn-default btn-sm"><i class="fa fa-check"></i> Finalizar</a>
                  </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Header -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-default shadow-navbar" role="navigation">
      <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="carrinho" class="btn btn-default btn-cart-xs visible-xs pull-right">
              <i class="fa fa-shopping-cart"></i> Carrinho : <?php echo $contCarrinho; ?>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li><a href="index">Home</a></li>
              <li><a href="produtos">Produtos</a></li>
              <li><a href="noticias">Notícias</a></li>
              <li><a href="dicas">Dicas</a></li>
              <li><a href="sobre">Sobre</a></li>
            </ul>
          </div>
      </div>
    </nav>
    <!-- End Navigation Bar -->
    
    <?php
    
        $url = getIDUrl();
        $id = (int)$url[count($url) - 1];
        $encoding = mb_internal_encoding();
        
        foreach ($produto->getProduto($id) as $var) {        
    ?>

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index">Home</a></li>
          <li><a href="produtos">Produtos</a></li>
          <li class="active"><?php echo mb_strtoupper($var['nome'], $encoding); ?></li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Image List -->
        <div class="col-xs-12 col-sm-4 vcenter">
          <div class="image-detail">
            <img src="./controls/controlUsuario.php?getImagemP=<?php echo $id; ?>" data-zoom-image="./controls/controlUsuario.php?getImagemP=<?php echo $id; ?>" alt="">
          </div>
        </div><!--

        --><div class="col-xs-12 col-sm-8 vcenter">
            <div class="title-detail"><?php echo mb_strtoupper($var['nome'], $encoding); ?></div>
          <big style="font-size: 22px;">R$ <?php echo $var['valorUnit'];?></big>
          <br />
          <br />
          <form method="POST" action="./controls/controlPedido.php">
          <input type="text" name="idProdutoInput" value="<?php echo $var['idProduto']; ?>" class="hidden"/>
          <input type="text" name="nomeProduto" value="<?php echo $var['nome']; ?>" class="hidden"/>
          <input type="text" name="valorProduto" value="<?php echo $var['valorUnit']; ?>" class="hidden"/>
          <input type="text" name="esferica" value="<?php echo $var['esferica']; ?>" class="hidden"/>
          <input type="text" name="torica" value="<?php echo $var['torica']; ?>" class="hidden"/>
          <input type="text" name="multifocal" value="<?php echo $var['multifocal']; ?>" class="hidden"/>
          <input type="text" name="olho" value="<?php echo $var['olho']; ?>" class="hidden"/>
          <input type="text" name="colorida" value="<?php echo $var['colorida']; ?>" class="hidden"/>          
          <table class="table alinharv">
            <tbody>
              <tr>
                <td></td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td><div class="radio"><label><input id="grauDiferente" value="diferente" type="radio" name="grau" checked="checked"><span>Graus diferentes em cada olho</span></label></div></td>
                                <td><div class="radio"><label><input id="mesmoGrau" value="igual" type="radio" name="grau"><span>Mesmo grau nos dois olhos</span></label></div></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <tr>
                <td></td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td class="mesmoG"><b> Olho Direito</b></td>
                                <td class="mesmoG"><b> Olho Esquerdo</b></td>
                                <td class="ambos hidden"><b>Ambos os olhos</b></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <tr>
                <td>Grau Esférico</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="grauEsfericoD" required="required" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o grau ---</option>                                     
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloEsferico($id) as $var2) {
                                                echo "<option value=".$var2['grauEsferico'].">".$var2['grauEsferico']."</option>";
                                            }                                     
                                      ?>                                    
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="grauEsfericoE" name="grauEsfericoE" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o grau ---</option>                                     
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloEsferico($id) as $var2) {
                                                echo "<option value=".$var2['grauEsferico'].">".$var2['grauEsferico']."</option>";
                                            }                                     
                                      ?>                                    
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>              
              <?php if($var['torica']) { ?>
              <tr>
                <td>Grau Cilindro</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="grauCilindroD" required="required" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o cilindro ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloCilindro($id) as $var2) {
                                                echo "<option value=".$var2['grauCilindro'].">".$var2['grauCilindro']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="grauCilindroE" name="grauCilindroE" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o cilindro ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloCilindro($id) as $var2) {
                                                echo "<option value=".$var2['grauCilindro'].">".$var2['grauCilindro']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <tr>
                <td>Eixo</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="eixoD" required="required" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o eixo ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloEixo($id) as $var2) {
                                                echo "<option value=".$var2['eixo'].">".$var2['eixo']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="eixoE" name="eixoE" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o eixo ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloEixo($id) as $var2) {
                                                echo "<option value=".$var2['eixo'].">".$var2['eixo']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <?php } ?>
              <tr>
                <td>Curva Base</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="curvaBaseD" required="required" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione a curva base ---</option>                                     
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloCurvaBase($id) as $var2) {
                                                echo "<option value=".$var2['curvaBase'].">".$var2['curvaBase']."</option>";
                                            }                                     
                                      ?>                                    
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="curvaBaseE" name="curvaBaseE" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione a curva base ---</option>                                     
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloCurvaBase($id) as $var2) {
                                                echo "<option value=".$var2['curvaBase'].">".$var2['curvaBase']."</option>";
                                            }                                     
                                      ?>                                    
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <tr>
                <td>Diâmetro</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="diametroD" required="required" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o diâmetro ---</option>                                     
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloDiametro($id) as $var2) {
                                                echo "<option value=".$var2['diametro'].">".$var2['diametro']."</option>";
                                            }                                     
                                      ?>                                    
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="diametroE" name="diametroE" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione o diâmetro ---</option>                                     
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloDiametro($id) as $var2) {
                                                echo "<option value=".$var2['diametro'].">".$var2['diametro']."</option>";
                                            }                                     
                                      ?>                                    
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <?php if($var['multifocal']) { ?>
              <tr>
                <td>Adição</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="grauAdicaoD" required="required" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione a adição ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloAdicao($id) as $var2) {
                                                echo "<option value=".$var2['grauAdicao'].">".$var2['grauAdicao']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="grauAdicaoE" name="grauAdicaoE" data-size="10" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione a adição ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloAdicao($id) as $var2) {
                                                echo "<option value=".$var2['grauAdicao'].">".$var2['grauAdicao']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <tr>
                <td>Olho Dominante</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td><div class="radio"><label><input type="radio" name="olho" value="direito" checked="checked"><span>Direito</span></label></div></td>
                                <td><div class="radio"><label><input type="radio" name="olho" value="esquerdo"><span>Esquerdo</span></label></div></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <?php } ?>
              <?php if($var['colorida']) { ?>
              <tr>
                <td>Cor</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="corD" required="required" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione uma cor ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloCor($id) as $var2) {
                                                echo "<option value=".$var2['cor'].">".$var2['cor']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="corE" name="corE" data-live-search="true" data-width="170px">
                                      <option value="">--- Selecione uma cor ---</option>
                                      <?php                                     
                                            foreach ($produto->funcaoGetIntervaloCor($id) as $var2) {
                                                echo "<option value=".$var2['cor'].">".$var2['cor']."</option>";
                                            }                                     
                                      ?> 
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>
              <?php } ?>
              <tr>
                <td>Quantidade</td>
                <td>
                    <table class="table ajustar">
                        <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker" name="quantidadeD" required="required" data-width="170px">
                                      <option value="">--- Selecione uma quantidade ---</option>
                                      <?php
                                        for($i = 1; $i <= 10; $i++) {
                                            echo "<option value=".$i.">".$i."</option>";
                                        }
                                      ?>
                                    </select>
                                </td>
                                <td class="mesmoG">
                                    <select class="selectpicker" id="quantidadeE" name="quantidadeE" data-width="170px">
                                      <option value="">--- Selecione uma quantidade ---</option>
                                      <?php
                                        for($i = 1; $i <= 10; $i++) {
                                            echo "<option value=".$i.">".$i."</option>";
                                        }
                                      ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
              </tr>              
            </tbody>
          </table>         
          <center>
            <button class="btn btn-theme m-b-1" type="submit"><i class="fa fa-shopping-cart"></i> Adicionar ao carrinho</button>
          </center>
          </form>
        </div>

        <div class="col-md-12">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#desc" aria-controls="desc" role="tab" data-toggle="tab">Descrição</a></li>
            <li role="presentation"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detalhes</a></li>
            <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Avaliações</a></li>
          </ul>
          <!-- End Nav tabs -->

          <!-- Tab panes -->
          <div class="tab-content tab-content-detail">

              <!-- Description Tab Content -->
              <div role="tabpanel" class="tab-pane active" id="desc">
                <div class="well">
                  <p>
                      <?php echo $var['descricao']; ?>
                  </p>
                </div>
              </div>
              <!-- End Description Tab Content -->

              <!-- Detail Tab Content -->
              <div role="tabpanel" class="tab-pane" id="detail">
                <div class="well">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>Marca</td>
                        <td><?php echo $var['marca']; ?></td>
                      </tr>
                      <tr>
                        <td>Fabricante</td>
                        <td>
                        <?php 
                            foreach ($fornecedor->getFornecedor($var['idFornecedor']) as $var2) {
                                echo $var2['razaoSocial'];
                            }
                         ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Material</td>
                        <td><?php echo $var['material']; ?></td>
                      </tr>
                      <tr>
                        <td>Tipo</td>
                        <td><?php echo $var['tipo']; ?></td>
                      </tr>
                      <tr>
                        <td>Visitint</td>
                        <td><?php echo $var['visitint']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php } ?>              
              <!-- End Detail Tab Content -->

              <!-- Review Tab Content -->
              <div role="tabpanel" class="tab-pane" id="review">
                <div class="well scroll-avaliacoes">
                    
                    <?php

                        $sql = "SELECT * FROM avaliacao WHERE `idProduto` = $id";
                        $consulta = DB::PDO($sql);

                        $consulta->execute();
                        $consulta = $consulta->fetchAll();

                        foreach($consulta as $var) {
                    ?>
                    
                  <div class="media">
                    <div class="media-left">
                        <!--<img class="media-object img-thumbnail" alt="64x64" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+">-->
                        <img src="./controls/controlUsuario.php?getImagem=<?php echo $var['idUsuario']; ?>" alt="" class="media-object img-thumbnail" width="64" height="64"/>
                      <div class="product-rating">
                          
                          
                          <?php      
                                for ($i = 0; $i <= 4; $i++) {
                                    
                                    if ($var['nota'] >= $i && $var['nota'] > ($i + 0.5)) {
                                        ?><i class="fa fa-star"></i><?php
                                    }
                                    else if ($var['nota'] == ($i + 0.5)) {
                                        ?><i class="fa fa-star-half-o"></i><?php
                                    }
                                    else {
                                        ?><i class="fa fa-star-o"></i><?php
                                    } 
                                }
                            ?>

                      </div>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading"><strong><?php foreach ($usuario->getUsuario($var['idUsuario']) as $var2) { echo $var2['nome']." ".$var2['sobrenome']; } ?></strong></h5>
                        <?php echo $var['opiniao']; ?>
                    </div>
                  </div>
                    
                    <?php } ?>

                </div>
              </div>
              <!-- End Review Tab Content -->

          </div>
          <!-- End Tab panes -->

        </div>
      </div>
    </div>
    <!-- End Main Content -->

    <!-- Footer -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="title-footer"><span>Sobre</span></div>
            <ul>
              <li>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et doloremmagna aliqua. Ut enim ad minim... <a href="#">Ler mais</a>
              </li>
            </ul>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="title-footer"><span>Informações</span></div>
            <ul>
              <li><i class="fa fa-angle-double-right"></i> <a href="suporte.html">Suporte</a></li>
            </ul>
          </div>
          <div class="clearfix visible-sm-block"></div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="title-footer"><span>Nossa Loja</span></div>
            <ul class="footer-icon">
              <li><span><i class="fa fa-map-marker"></i></span> Rua Candido Lopes, 205</li>
              <li><span><i class="fa fa-phone"></i></span> +55 (41) 3223-0749</li>
              <li><span><i class="fa fa-envelope"></i></span> <a href="mailto:cs@domain.tld">contato@elentes.com</a></li>
            </ul>
          </div>
          <div class="clearfix visible-sm-block"></div>
          <div class="col-md-6 col-sm-6">
            <div class="title-footer"><span>Formas de Pagamento</span></div>
            <p></p>
            <img src="images/payment-1.png" alt="Payment-1">
            <img src="images/payment-2.png" alt="Payment-2">
            <img src="images/payment-3.png" alt="Payment-3">
            <img src="images/payment-4.png" alt="Payment-4">
            <img src="images/payment-5.png" alt="Payment-5">
          </div>
        </div>
      </div>
      <div class="text-center copyright">
        Copyright &copy; 2017 ELentes Todos os direitos reservados
      </div>
    </div>
    <!-- End Footer -->

    <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
      <i class="fa fa-angle-double-up"></i>
    </a>

    <div class="chooser chooser-hide">
      <div class="chooser-toggle"><button class="btn btn-warning" type="button"><i class="fa fa-paint-brush bigger-130"></i></button></div>
      <div class="chooser-content">
        <label>Cor</label>
        <select name="color-chooser" id="color-chooser" class="form-control input-sm selectpicker">
          <option value="indigo">Roxo</option>
          <option value="red">Vermelho</option>
          <option value="teal">Turquesa</option>
          <option value="brown">Marrom</option>
        </select>
        <label class="m-t-1">Style</label>
        <select name="style-chooser" id="style-chooser" class="form-control input-sm selectpicker">
          <option value="flat">Quadrado</option>
          <option value="rounded">Arredondado</option>
        </select>
      </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="consultarFrete" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Consultar Frete</h4>
          </div>
          <div class="modal-body">
            <!--<p>Some text in the modal.</p>-->
            
            <form>
              <div class="form-group col-sm-6">
                <input type="text" class="form-control" id="nameInput" placeholder="Insira aqui seu CEP">
              </div>
              <div class="form-group col-sm-6">
                <button type="button" class="btn btn-success">Consultar Frete</button>
              </div>
            </form>
              <div class=" col-sm-12">
              <big>R$ 20,00</big>
              </div>
              <br/>
              <br/>
              <br/>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-theme" data-dismiss="modal">Fechar</button>
          </div>
        </div>

      </div>
    </div>

    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.ez-plus.js"></script>
    <script src="js/jquery.bootstrap-touchspin.js"></script>
    <script src="js/jquery.raty-fa.js"></script>
    <script src="js/bootstrap3-typeahead.js"></script>
    <script src="js/bootstrap-toolkit.js"></script>
    <script src="js/mimity.js"></script>
    <script src="js/mimity.detail.js"></script>
  </body>
</html>
<?php

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['carrinho']);
        unset($_SESSION['usuario']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}

function retirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function getIDUrl() {

    $p = array();

    if (isset($_GET['id'])) {

        $p = $_GET['id'];

        $p = rtrim($p, '/');
        $p = filter_var($p, FILTER_SANITIZE_URL);

        $p = explode('-', $p);
    }

    return $p;
}