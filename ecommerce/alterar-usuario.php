<?php

session_start();

require_once("./conexao.class.php");

require_once("./models/ModelProduto.class.php");
require_once("./classes/Produto.class.php");

require_once("./models/ModelUsuario.class.php");
require_once("./models/ModelEC.class.php");

require_once("./classes/Usuario.class.php");
require_once("./classes/EC.class.php");

$usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);

$produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

$contCarrinho = 0;

if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $indice => $valor) {
        $contCarrinho++;
    }
}

if (!isset($_SESSION['usuario'])) {
    header('Location: ./index.php');
}
else {

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Alterar Meu Perfil - ELentes</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/EL.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/style.teal.flat.css" rel="stylesheet" id="theme">

    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/mask.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/jquery.form.js"></script>
    
    <script type="text/javascript">
        
    jQuery.validator.addMethod("cpf", function(value, element) {
        
        value = jQuery.trim(value);
        value = value.replace('.','');
        value = value.replace('.','');
        cpf = value.replace('-','');
        while(cpf.length < 11) cpf = "0"+ cpf;
        var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
        var a = [];
        var b = new Number;
        var c = 11;
        for (i=0; i<11; i++){
            a[i] = cpf.charAt(i);
            if (i < 9) b += (a[i] * --c);
        }
        if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
        b = 0;
        c = 11;
        for (y=0; y<10; y++) b += (a[y] * c--);
        if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

        var retorno = true;
        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

        return this.optional(element) || retorno;

     }, "Informe um CPF válido");

    $(document).ready(function(){

        $('#estadoInput').change(function(){

            $('#cidadeInput').load('listacidades.php?estado='+$('#estadoInput').val());
            getCidades();
            
        });
        
        $("#formulario").validate({
            rules: {
                nomeInput: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                sobrenomeInput: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                cepInput: {
                    required: true,
                    minlength: 8
                },
                cpfInput: {
                    required: true,
                    cpf: true
                },
                emailInput: {
                    required: true,
                    minlength: 3,
                    email: true
                },
                telefoneInput: {
                    required: true,
                    minlength: 10
                },
                enderecoInput: {
                    required: true,
                    maxlength: 100,
                    minlength: 5
                },
                numeroInput: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 1
                },
                complementoInput: {
                    maxlength: 50
                },
                bairroInput: {
                    required: true,
                    maxlength: 50,
                    minlength: 3
                },
                estadoInput: {
                    required: true
                },
                cidadeInput: {
                    required: true
                },
                senhaInput: {
                    required: true,
                    minlength: 8
                },                
                confirmarSenhaInput: {
                    required: true,
                    minlength: 8,
                    equalTo : "#senhaInput"
                }
            },
            messages: {
                nomeInput: {
                    required: "Insira seu nome!",
                    maxlength: "Por favor, utilize menos caracteres!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                sobrenomeInput: {
                    required: "Insira seu sobrenome!",
                    minlength: "Por favor, utilize mais caracteres!",
                    maxlength: "Por favor, utilize menos caracteres!"
                },
                cepInput: {
                    required: "Insira seu CEP!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                cpfInput: {
                    required: "Insira seu CPF!",
                    cpf: "CPF inválido!"
                },
                emailInput: {
                    required: "Insira seu e-mail!",
                    minlength: "Por favor, utilize mais caracteres!",
                    email: "Insira um e-mail válido!"
                },
                telefoneInput: {
                    required: "Insira seu telefone!",
                    number: "Utilize apenas números!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                enderecoInput: {
                    required: "Insira seu endereço!",
                    maxlength: "Por favor, utilize menos caracteres!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                numeroInput: {
                    required: "Insira seu número de endereço!",
                    number: "Utilize apenas números!",
                    maxlength: "Por favor, utilize menos caracteres!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                complementoInput: {
                    maxlength: "Por favor, utilize menos caracteres!"
                },
                bairroInput: {
                    required: "Insira seu bairro!",
                    maxlength: "Por favor, utilize menos caracteres!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                estadoInput: {
                    required: "Selecione um Estado!"
                },
                cidadeInput: {
                    required: "Selecione uma Cidade!"
                },
                senhaInput: {
                    required: "Insira sua senha!",
                    minlength: "Sua senha deve conter 8 caracteres ou mais!"
                },
                confirmarSenhaInput: {
                    required: "Confirme sua senha!",
                    minlength: "Sua senha deve conter 8 caracteres ou mais!",
                    equalTo: "Suas senhas não correspondem!"
                }
            }
        });
    });
    
    
    function getCidades(){        
        $.ajax({
            url: 'listacidades.php?estado='+$('#estadoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#cidadeInput').selectpicker('refresh');
            }
        });
    };

    jQuery(function($){
        $("#telefoneInput").mask("(99) 9999-9999");
    });
    
    jQuery(function($){
        $("#cpfInput").mask("999.999.999-99");
    });
    
    jQuery(function($){
        $("#cepInput").mask("99999-999");
    });

    // Quando carregado a página
    $(function ($) {

        // Quando enviado o formulário
        $('#formulario').on('submit', function () {

            if(!$("#formulario").valid()) {
                return false;
            }
            else {

                // Armazenando objetos em variáveis para utilizá-los posteriormente
                var formulario = $(this);
                var botao = $('#salvar');
                var mensagem = $('#mensagem');

                // Exibindo indicador de carregamento (Bootstrap)
                botao.button('Alterando...');

                // Enviando formulário
                $(this).ajaxSubmit({

                    // Definindo tipo de retorno do servidor
                    dataType: 'json',

                    // Se a requisição foi um sucesso
                    success: function (retorno) {

                        // Se cadastrado com sucesso
                        if (retorno.sucesso) {
                            // Definindo estilo da mensagem (sucesso)
                            mensagem.attr('class', 'alert alert-success alert-dismissable');

                            // Limpando formulário
                            //formulario.resetForm();
                            $('body,html').animate({scrollTop:0},500);
                        }
                        else {
                            // Definindo estilo da mensagem (erro)
                            mensagem.attr('class', 'alert alert-danger alert-dismissable');
                            $('body,html').animate({scrollTop:0},500);
                        }

                        // Exibindo mensagem
                        mensagem.html(retorno.mensagem);

                        // Escondendo indicador de carregamento
                        botao.button('reset');

                    },

                    // Se houver algum erro na requisição
                    error: function () {

                        // Definindo estilo da mensagem (erro)
                        mensagem.attr('class', 'alert alert-danger alert-dismissable');
                        $('body,html').animate({scrollTop:0},500);

                        // Exibindo mensagem
                        mensagem.html('Ops, ocorreu um erro');

                        // Escondendo indicador de carregamento
                        botao.button('reset');
                    }
                });

                return false;
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
                                      <a href="<?php echo "$urlSite/detalhes/$url"; ?>">
                                        <img src="./controls/controlUsuario.php?getImagemP=<?php echo $var['idProduto']; ?>" alt="" width="50" class="media-object img-thumbnail">
                                    </a>
                                    </div>
                                    <div class="media-body">
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

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Alterar Perfil</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Register Form -->
        <div class="col-sm-12 m-b-3">
            <div class="row">
                <div class="col-xs-12">
                    <div id="mensagem"></div>
                </div>
            </div> 
          <div class="title"><span>Alterar Meu Perfil</span></div>
          <div class="row">
              <form id="formulario" method="POST" action="./controls/controlUsuario.php">
                
                <?php                  
                    $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                    foreach($usuario->getUsuario($_SESSION['usuario']) as $var) {
                ?>
                
              <input type="text" class="form-control hidden" id="idInput" name="idInputEditar" value="<?php echo $var['idUsuario'] ?>">
                
              <div class="form-group col-sm-6">
                <label for="nomeInput">Nome</label>
                <input type="text" class="form-control" id="nomeInput" name="nomeInput" placeholder="Nome" value="<?php echo $var['nome'] ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="sobrenomeInput">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenomeInput" name="sobrenomeInput" placeholder="Sobrenome" value="<?php echo $var['sobrenome'] ?>">
              </div>
              <div class="form-group col-sm-12"></div>
              <div class="form-group col-sm-6">
                <label for="emailInput">E-mail</label>
                <input type="email" class="form-control" id="emailInput" name="emailInput" placeholder="E-mail" value="<?php echo $var['e-mail'] ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="cpfInput">CPF</label>
                <input type="text" class="form-control" id="cpfInput" name="cpfInput" placeholder="___.___.___-__" value="<?php echo $var['cpf'] ?>">
              </div>
              <div class="form-group col-sm-12"></div>
              <div class="form-group col-sm-6">
                <label for="telefoneInput">Telefone</label>
                <input type="text" class="form-control" id="telefoneInput" name="telefoneInput" placeholder="(__) ____-____" value="<?php echo $var['telefone'] ?>">
              </div>
              
                <hr style="width: 96%;" />
                
              <div class="form-group col-sm-6">
                <label for="cepInput">CEP</label>
                <input type="text" class="form-control" id="cepInput" name="cepInput" placeholder="_____-___" value="<?php echo $var['cep'] ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="enderecoInput">Endereço</label>
                <input type="text" class="form-control" id="enderecoInput" name="enderecoInput" placeholder="Endereço" value="<?php echo $var['endereço'] ?>">
              </div>
              <div class="form-group col-sm-12"></div>
              <div class="form-group col-sm-6">
                <label for="numeroInput">Número</label>
                <input type="text" class="form-control" id="numeroInput" name="numeroInput" placeholder="Número" value="<?php echo $var['numero'] ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="complementoInput">Complemento</label>
                <input type="text" class="form-control" id="complementoInput" name="complementoInput" placeholder="Complemento" value="<?php echo $var['complemento'] ?>">
              </div>
              <div class="form-group col-sm-12"></div>
              <div class="form-group col-sm-6">
                <label for="bairroInput">Bairro</label>
                <input type="text" class="form-control" id="bairroInput" name="bairroInput" placeholder="Bairro" value="<?php echo $var['bairro'] ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="estadoInput">Estado</label>
                <select class="form-control selectpicker" id="estadoInput" name="estadoInput">
                    <?php
                    
                        $ec = new EC();

			foreach($ec->ConsultarEstadoSelecionado($var['idEstado']) as $varEC) {
                            echo "<option value='".$varEC['idEstado']."'>".$varEC['estNome']."</option>";
			}	

			foreach($ec->ConsultarEstados($var['idEstado']) as $varEC) {
                            echo "<option value='".$varEC['idEstado']."'>".$varEC['estNome']."</option>";
			}
                    ?>
                </select>
              </div>
              <div class="form-group col-sm-12"></div>
              <div class="form-group col-sm-6">
                <label for="cidadeInput">Cidade</label>
                <select class="form-control selectpicker" id="cidadeInput" name="cidadeInput">
                    <?php
                    
                        $ec = new EC();

			foreach($ec->ConsultarCidadeSelecionada($var['idCidade']) as $varEC) {
                            echo "<option value='".$varEC['idCidade']."'>".$varEC['cidNome']."</option>";
			}	

			foreach($ec->ConsultarCidades($var['idEstado'], $var['idCidade']) as $varEC) {
                            echo "<option value='".$varEC['idCidade']."'>".$varEC['cidNome']."</option>";
			}
                    ?>
                </select>
              </div>
              
              <?php
              
                }
              
              ?>
                
              <div class="form-group col-sm-6"></div>
              <div class="form-group col-sm-12"></div>
              
              <div class="form-group col-sm-12">
                <label class="btn btn-theme">
                    <i class="fa fa-folder-open" aria-hidden="true"></i> &MediumSpace; Escolher imagem de perfil... <input type="file" id="foto" name="foto" hidden>
                </label>
              </div>
       
                <hr style="width: 96%;" />
               
              <div class="col-xs-12">
                <button type="submit" id="btnEditarPerfilUsuario" name="btnEditarPerfilUsuario" class="btn btn-theme btnEditarPerfilUsuario"><i class="fa fa-long-arrow-right"></i> Salvar</button>
              </div>
            </form>
          </div>
        </div>
        <!-- End Register Form -->

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
    <!-- Plugins -->
    <script src="js/bootstrap-select.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/bootstrap3-typeahead.js"></script>
    <script src="js/bootstrap-toolkit.js"></script>
    <script src="js/mimity.js"></script>
  </body>
</html>

<?php
}

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['carrinho']);
        unset($_SESSION['usuario']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}