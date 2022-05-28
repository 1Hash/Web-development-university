<?php

session_start();

require_once("./models/ModelEC.class.php");
require_once("./classes/EC.class.php");

require_once("./models/ModelProduto.class.php");
require_once("./classes/Produto.class.php");

require_once("./models/ModelUsuario.class.php");
require_once("./classes/Usuario.class.php");

$usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);

$produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Sobre - ELentes</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/style.teal.flat.css" rel="stylesheet" id="theme">
    
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/mask.js"></script>
    <script src="js/jquery.validate.js"></script>
  
    <script type="text/javascript">

    $(document).ready(function(){

          // Login

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

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Sobre</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Content -->
        <div class="col-sm-12">
          <div class="title"><span>Sobre</span></div>
          <p class="desc">

          <div class="panel-group faq-panel m-t-2" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    PROPOSTA DA EMPRESA
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    Garantir o acesso e a reposição de suas lentes de contato e de todos os itens de primeira necessidade para a correção da visão, com o máximo de conveniência e segurança.</div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    POSICIONAMENTO DA MARCA
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    Na ELentes, você tem facilidade, rapidez e segurança para adquirir exatamente as lentes de contato e soluções de assepsia receitadas pelo médico oftalmologista. Você também encontra uma grande variedade de lentes de contato coloridas e exóticas, com finalidade estética.</div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    VISÃO
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    Proporcionar a melhor experiência de compra de produtos para a saúde ocular, através do uso de tecnologia e excelência em processos, afim de estreitar o relacionamento com clientes, médicos e parceiros de negócios. </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    MISSÃO
                  </a>
                </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    Melhorar a vida das pessoas através da melhoria da visão. </div>
            </div>
          </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    VALORES
                  </a>
                </h4>
              </div>
              <div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
                <div class="panel-body">
                    Respeito aos clientes, funcionários e fornecedores. Atuação idônea em todos os níveis, na certeza de que só ações pautadas na transparência fazem empresas duradouras. Pensamento grande, sem perder o foco nos detalhes. </div>
            </div>
          </div>
        </div>
        <!-- End Content -->

        <div class="clearfix visible-xs m-b-2"></div>

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

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- Plugins -->
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap3-typeahead.js"></script>
    <script src="js/bootstrap-toolkit.js"></script>
    <script src="js/mimity.js"></script>
  </body>
</html>
<?php

function retirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['carrinho']);
        unset($_SESSION['usuario']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}