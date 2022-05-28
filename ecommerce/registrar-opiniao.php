<?php

    session_start();
    
    require_once("./models/ModelProduto.class.php");
    require_once("./classes/Produto.class.php");
    
    require_once("./models/ModelFornecedor.class.php");
    require_once("./classes/Fornecedor.class.php");

    require_once("./models/ModelUsuario.class.php");
    require_once("./classes/Usuario.class.php");

    $usuario = new Usuario(null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    $contCarrinho = 0;

    if (isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $indice => $valor) {
            $contCarrinho++;
        }
    }
    
    $fornecedor = new Fornecedor(null, null, null, null, null, null, null, null, null, null, null, null, null);
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    if (!isset($_POST['idProduto'])) {
        header('Location: historico-compras');
    }
    else {
        
        $id = $_POST['idProduto'];

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Registrar Opinião - ELentes</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/EL.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/style.teal.flat.css" rel="stylesheet" id="theme">
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
          <li><a href="index.php">Home</a></li>
          <li><a href="historico-compras">Histórico de Compras</a></li>
          <li><a href="detalhes-pedido">Detalhes do Pedido</a></li>
          <li class="active">Registrar Opinião</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- My Profile Content -->
        <div class="col-sm-12 col-md-12">
            <div class="title m-b-2"><span>Registrar Opinião</span></div>
          <div class="row">
            
            <!-- Review Tab Content -->
              <div role="tabpanel" class="tab-pane" id="review">
                <div class="">  
                    <!-- Image List -->
                    <div class="text-center col-xs-12 col-sm-4 col-md-4">
                        
                        <img src="./controls/controlUsuario.php?getImagemP=<?php echo $id; ?>" data-zoom-image="./controls/controlUsuario.php?getImagemP=<?php echo $id; ?>" alt="" class="img-thumbnail">
                    </div><!--

                --><div class="col-xs-12 col-sm-8 col-md-8">
                      <table class="table table-bordered table-compare">
                        <tbody>
                            
                          <?php foreach ($produto->getProduto($id) as $var) { ?>
                            
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
                          
                          <?php } ?>
                          
                        </tbody>
                      </table>
                    </div><!--
                      
                    <div class="col-md-12">--
                 --><form method="POST" action="./controls/controlProduto.php">
                    <div class="form-group col-sm-12">
                       <br />
                      <label>Avaliação</label><div class="clearfix"></div>
                      <div class="input-rating"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        
                        <input type="text" class="hidden" name="idProduto" value="<?php echo $id; ?>" />
                        
                      <label for="Review">Sua Opinião</label>
                      <textarea style="resize: none;" id="Review" name="opiniao" class="form-control" rows="5" placeholder="Registre sua opinião"></textarea>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-theme">Registrar Opinião</button>
                    </div>                   
                  </form>
                    
                    
                    
                   <!-- </div>-->
                </div>
              </div>
              <!-- End Review Tab Content -->
          </div>
        </div>
        <!-- End My Profile Content -->

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
   
    <script src="js/jquery.js"></script>
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
}

function retirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}