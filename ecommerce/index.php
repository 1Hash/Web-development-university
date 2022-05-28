<?php
    
session_start();

require_once("conexao.class.php");

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
 
 
/*
try {

$data['nCdEmpresa'] = '';
 $data['sDsSenha'] = '';
 $data['sCepOrigem'] = '04546001';
 $data['sCepDestino'] = '82310420';
 $data['nVlPeso'] = '1';
 $data['nCdFormato'] = '1';
 $data['nVlComprimento'] = '16';
 $data['nVlAltura'] = '5';
 $data['nVlLargura'] = '11';
 $data['nVlDiametro'] = '0';
 $data['sCdMaoPropria'] = 's';
 $data['nVlValorDeclarado'] = '100';
 $data['sCdAvisoRecebimento'] = 'n';
 $data['StrRetorno'] = 'xml';
 //$data['nCdServico'] = '40010';
 $data['nCdServico'] = '04510,04014,40215';
 $data = http_build_query($data);

 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

 $curl = curl_init($url . '?' . $data);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

 $result = curl_exec($curl);
 $result = simplexml_load_string($result);
 foreach($result -> cServico as $row) {
 //Os dados de cada serviço estará aqui
 if($row -> Erro == 0) {
     echo $row -> Codigo . '<br>';
     echo $row -> Valor . '<br>';
     echo $row -> PrazoEntrega . '<br>';
     echo $row -> ValorMaoPropria . '<br>';
     echo $row -> ValorAvisoRecebimento . '<br>';
     echo $row -> ValorValorDeclarado . '<br>';
     echo $row -> EntregaDomiciliar . '<br>';
     echo $row -> EntregaSabado;
 } else {
     echo $row -> MsgErro;
 }
 echo '<hr>';
 }   
} catch (Exception $ex) {

}*/

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
    <title>Home - ELentes</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.css" rel="stylesheet">
    <link href="css/owl.theme.default.css" rel="stylesheet">
    <link href="css/EL.css" rel="stylesheet">
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
              <li class="active"><a href="index">Home</a></li>
              <li><a href="produtos">Produtos</a></li>
              <li><a href="noticias">Notícias</a></li>
              <li><a href="dicas">Dicas</a></li>
              <li><a href="sobre">Sobre</a></li>
            </ul>
          </div>
      </div>
    </nav>
    <!-- End Navigation Bar -->

    <!-- Main Content -->
    <div class="container m-t-2">
      <div class="row">
        <div class="clearfix visible-sm visible-xs"></div>
          <div class="col-md-12">
              <div class="title"><span>Produtos</span></div>
          </div>        
        <div class="col-md-12">

          <!-- Featured -->
                    
          <?php
          
            $urlSite = 'http://localhost/ecommerce';
            
            $getPaginas = getPagina();
            
            $sql = "SELECT * FROM produtos WHERE `status` IS NULL";
            $totalProdutos = DB::PDO($sql);
            $totalProdutos->execute();
            $totalProdutos = $totalProdutos->rowCount();
            
            $totalProdutosPorPagina = 12;
            $totalProdutosPorLinha = 4;
            $totalLinhasPorPagina = 3;
            
            $totalLinhas = ceil($totalProdutos / $totalProdutosPorLinha);
            
            if (!empty($getPaginas)) {
                $pagina = (int)$getPaginas[0];
            }
            else {
                
                $pagina = 1;
            }
            
            $inicioPagina = $pagina - 1;
            
            $numeroSelecao = $inicioPagina * $totalProdutosPorPagina;
            
            $sqlProdutos = "SELECT * FROM produtos WHERE `status` IS NULL LIMIT $numeroSelecao,$totalProdutosPorPagina";
            $consulta = DB::PDO($sqlProdutos);
            $consulta->execute();
            $consulta = $consulta->fetchAll();

                foreach ($consulta as $var) {
                
                    if ($var % 4 == 0) {
                        ?>
                        <div class="clearfix visible-sm visible-xs"></div>
                        <?php
                    }
              ?>          
              <div class="col-xs-6 col-sm-3 col-lg-3 box-product-outer">
                <div class="box-product">
                  <div class="img-wrapper">
                      
                    <?php                      
                        $url = $var['nome']."-".$var['idProduto'];
                        $url = strtolower($url);
                        $url = retirarAcentos($url);
                        $url = str_replace(' ', '-', $url);
                    ?>
  
                    <a href="<?php echo "$urlSite/detalhes/$url"; ?>">
                        <img src="./controls/controlUsuario.php?getImagemP=<?php echo $var['idProduto']; ?>" alt="">                      
                    </a>
                    <!--<div class="tags">
                      <span class="label-tags"><span class="label label-default arrowed">Featured</span></span>
                    </div>
                    <div class="tags tags-left">
                      <span class="label-tags"><span class="label label-danger arrowed-right">Sale</span></span>
                    </div>-->
                    <div class="option">
                        <a href="<?php echo "$urlSite/detalhes/$url"; ?>" data-toggle="tooltip" title="Adicionar ao Carrinho"><i class="fa fa-shopping-cart"></i></a>
                    </div>
                  </div>
                  <h6><a href="detalhes.html"><?php echo $var['nome']; ?></a></h6>
                  <div class="price">
                    <div>R$ <?php echo $var['valorUnit']; ?> <span class="label-tags"><!--<span class="label label-default">-10%</span>--></span></div>
                    <!--<span class="price-old">R$ 92,00</span>-->
                  </div>
                  <div class="rating">
                    
                    <?php
                    
                    $sql = "SELECT * FROM avaliacao WHERE `idProduto` = ".$var['idProduto']."";
                    $consulta = DB::PDO($sql);

                    $consulta->execute();
                    $consulta = $consulta->fetchAll();
                    
                    $quantidade = 0;
                    $soma = 0;
                    $media = 0;
                    $mediaFinal = 0;
                    
                    foreach($consulta as $var2) {
                        
                        $quantidade++;
                        $soma += $var2['nota'];
                    }
                    
                    if ($quantidade > 0) {
                        $media = $soma / $quantidade;
                        
                        
                       
                    
                    $p = explode('.', $media);


                    if (isset($p[1])) {

                    }
                    else {
                       $p[1] = 0;
                    }

                   $p2 = str_split ($p[1], 1);

                    
                    if ($p2[0] > 2 && $p2[0] < 8) {
                        $p[1] = 5;
                    }
                    else if($p2[0] <= 2) {
                        $p[1] = 0;
                    }
                    else if($p2[0] >= 8) {
                        $p[1] = 0;
                        $p[0]++;
                    }
                    
                    $mediaFinal = floatval($p[0].".".$p[1]);
                    
                    }
                    
                    for ($i = 0; $i <= 4; $i++) {
                                    
                        if ($mediaFinal >= $i && $mediaFinal > ($i + 0.5)) {
                            ?><i class="fa fa-star"></i><?php
                        }
                        else if ($mediaFinal == ($i + 0.5)) {
                            ?><i class="fa fa-star-half-o"></i><?php
                        }
                        else {
                            ?><i class="fa fa-star-o"></i><?php
                        } 
                    }
                    
                    ?>
                    
                    <a href="<?php echo "$urlSite/detalhes/$url"; ?>">(<?php echo $quantidade; if($quantidade == 1) { ?> avaliação) <?php }else { ?> avaliações)<?php } ?></a>
                  </div>
                </div>
              </div>          
          <?php
                }
          
          ?>
        </div>     
        <div class="col-xs-12 text-center">
          <nav aria-label="Page navigation">
            <?php echo paginacao( $totalProdutos, $totalProdutosPorPagina, 5 ); ?>
          </nav>
        </div>
      </div>

      <!-- Brand & Clients -->
      <div class="row">
        <div class="col-xs-12 m-t-1">
          <div class="title text-center"><span>Fornecedores</span></div>
          <div class="brand-slider owl-carousel owl-theme owl-controls-top-offset">
            <div class="brand">
              <a href=""><img src="images/demo/brand1.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand2.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand3.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand1.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand2.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand3.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand1.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand3.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand2.png" alt=""></a>
            </div>
            <div class="brand">
              <a href=""><img src="images/demo/brand1.png" alt=""></a>
            </div>
          </div>
        </div>
      </div>
      <!-- End Brand & Clients -->

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

function getPagina() {

    $p = array();
    
    //echo $_GET['p'];

    if (isset($_GET['p'])) {

        $p = $_GET['p'];

        $p = rtrim($p, '/');
        $p = filter_var($p, FILTER_SANITIZE_URL);

        $p = explode('/', $p);
    }

    return $p;
}

function paginacao($totalProdutos, $totalProdutosPorPagina, $offset) {

    global $getPaginas;

    $numeroPaginas = ceil( $totalProdutos / $totalProdutosPorPagina );
    
    //$numeroPaginas = (totalItens / itensPagina)

    $paginaAtual = 1;

    $urlSite = 'http://localhost/ecommerce';

    if (!empty($getPaginas)) {
        $paginaAtual = (int)$getPaginas[0];
    }

    $paginas = null;

    $paginas .= "<ul class='pagination'>";
    
    if ($paginaAtual == 1) {
        $paginas .= "<li class='disabled'><span>&laquo;</span></li>";
        $paginas .= "<li class='disabled'><span>&lsaquo;</span></li>";
    }
    else {
        $p = $paginaAtual - 1;
        $paginas .= "<li><a href='$urlSite/pagina/1'><span>&laquo;</span></a></li>";
        $paginas .= "<li><a href='$urlSite/pagina/$p'><span>&lsaquo;</span></a></li>";
    }
    
    $var = 0;
    
    if ($paginaAtual >= 5) {
        $var = $paginaAtual - 3;
    }
    else {
        $var = 1;
    }
    
    $var2 = 0;
    
    if (!isset($getPaginas[0])) {
        $var2 = 1;
    }
    else {
        $var2 = $getPaginas[0];
    }
   

    for ($i = $var; $i < ($paginaAtual - 1) + $offset; $i++ ) {

      if ($i <= $numeroPaginas && $i >= 1) {

            $página = $i;
         
            if ($i == $var2) {
                $paginas .= " <li class='active'><a href='$urlSite/pagina/$página'>$página</a></li> ";
            }
            else {
                $paginas .= " <li><a href='$urlSite/pagina/$página'>$página</a></li> ";
            }
        }
    }

    if ($paginaAtual == $numeroPaginas) {
        $paginas .= "<li class='disabled'><span>&rsaquo;</span></li>";
        $paginas .= "<li class='disabled'><span>&raquo;</span></li>";
    }
    else {
        $p2 = $paginaAtual + 1;
        $paginas .= "<li><a href='$urlSite/pagina/$p2'><span>&rsaquo;</span></a></li>";
        $paginas .= "<li><a href='$urlSite/pagina/$numeroPaginas'><span>&raquo;</span></a></li>";
    }
    
    $paginas .= "</ul>";

    return $paginas;
}

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
