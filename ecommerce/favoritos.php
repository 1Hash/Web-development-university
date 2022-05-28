<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Favoritos - ELentes</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/font-awesome.css" rel="stylesheet">
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
              <li class="hidden-xs"><a href="ajuda.html"><i class="fa fa-question-circle"></i> Ajuda</a></li>
              <li class="hidden-xs"><a href="#"><i class="fa fa-phone"></i>  +55 (41) 3223-0749</a></li>
              <li class="hidden-xs"><a href="#"><i class="fa fa-truck"></i> Consultar Frete</a></li>
              <li>
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-user"></i> Entrar <span class="caret"></span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-login" aria-labelledby="dropdownLogin">
                    <form>
                      <div class="form-group">
                        <label for="username">E-mail ou CPF</label>
                        <input type="text" class="form-control" id="username" placeholder="E-mail ou CPF">
                      </div>
                      <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" placeholder="Senha">
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><span> Lembre-me</span>
                        </label>
                      </div>
                      <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-long-arrow-right"></i> Entrar</button>
                      <a class="btn btn-default btn-sm pull-right" href="registrar.html" role="button">Cadastrar-se</a>
                    </form>
                  </div>
                </div>
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
            <div class="input-group">
              <input type="text" class="form-control search-input" aria-label="Busque aqui..." placeholder="Busque aqui...">
              <div class="input-group-btn">
                <button type="button" class="btn btn-default btn-search"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-3 cart-btn hidden-xs m-t-2">
            <a href="" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-shopping-cart"></i> 4 <span class="caret"></span></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-cart">
              <div class="media">
                <div class="media-left">
                  <a href="detalhes.html"><img class="media-object img-thumbnail" src="images/demo/necagrossa.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detalhes.html" class="media-heading">Optoflex Asférica</a>
                  <div>x 1 R$ 92,50 </div>
                </div>
                <div class="media-right"><a href="#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="media">
                <div class="media-left">
                  <a href="detalhes.html"><img class="media-object img-thumbnail" src="images/demo/necagrossa.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detalhes.html" class="media-heading">Optoflex Asférica</a>
                  <div>x 1 R$ 92,50</div>
                </div>
                <div class="media-right"><a href="#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="media">
                <div class="media-left">
                  <a href="detalhes.html"><img class="media-object img-thumbnail" src="images/demo/necagrossa.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detalhes.html" class="media-heading">Optoflex Asférica</a>
                  <div>x 1 R$ 92,50 </div>
                </div>
                <div class="media-right"><a href="#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="media">
                <div class="media-left">
                  <a href="detalhes.html"><img class="media-object img-thumbnail" src="images/demo/necagrossa.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detalhes.html" class="media-heading">Optoflex Asférica</a>
                  <div>x 1 R$ 92,50</div>
                </div>
                <div class="media-right"><a href="#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="subtotal-cart">Total: <span>R$ 370,00 </span></div>
              <div class="text-center">
                  <div class="btn-group" role="group" aria-label="View Cart and Checkout Button">
                    <a href="carrinho.html" class="btn btn-default btn-sm" type="button"><i class="fa fa-shopping-cart"></i> Ver Carrinho</a>
                    <a href="confirmar-compra.html" class="btn btn-default btn-sm" type="button"><i class="fa fa-check"></i> Finalizar</a>
                  </div>
              </div>
            </div>
            <a href="favoritos.html" class="btn btn-theme" data-toggle="tooltip" title="Favoritos" data-placement="bottom"><i class="fa fa-heart"></i>3</a>
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
            <a href="carrinho.html" class="btn btn-default btn-cart-xs visible-xs pull-right">
              <i class="fa fa-shopping-cart"></i> Carrinho : 4
            </a>
            <a href="favoritos.html" class="btn btn-default btn-cart-xs visible-xs pull-right">
              <i class="fa fa-heart"></i> Favoritos : 3
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="produtos.html">Produtos</a></li>
              <li><a href="noticias.html">Notícias</a></li>
              <li><a href="dicas.html">Dicas</a></li>
              <li><a href="sobre.html">Sobre</a></li>
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
          <li class="active">Favoritos</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">
        <div class="col-xs-12">
          <div class="title"><span>Meus Favoritos</span></div>
          <div class="table-responsive">
            <table class="table table-bordered table-cart">
              <thead>
                <tr>
                  <th>Produto</th>
                  <th>Descrição</th>
                  <th>Data</th>
                  <th>Disponibilidade</th>
                  <th>Preço</th>
                  <th>Opção</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="img-cart">
                    <a href="detalhes.html">
                      <img alt="Product" src="images/demo/necagrossa.jpg" class="img-thumbnail">
                    </a>
                  </td>
                  <td>
                    <p><a href="detalhes.html" class="d-block">Optoflex Asferica</a></p>
                    <p><small>Optoflex Asferica</small></p>
                  </td>
                  <td>21-10-2017 </td>
                  <td><span class="label label-success arrowed">Em Estoque</span></td>
                  <td class="unit">R$ 92,50 </td>
                  <td class="action">
                    <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="Adicionar no carrinho"><i class="fa fa-shopping-cart"></i></a>&nbsp;
                    <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" data-original-title="Remover"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
                <tr>
                  <td class="img-cart">
                    <a href="detalhes.html">
                      <img alt="Product" src="images/demo/necagrossa.jpg" class="img-thumbnail">
                    </a>
                  </td>
                  <td>
                    <p><a href="detalhes.html" class="d-block">Optoflex Asferica</a></p>
                    <p><small>Optoflex Asferica</small></p>
                  </td>
                  <td>21-10-2017 </td>
                  <td><span class="label label-success arrowed">Em Estoque</span></td>
                  <td class="unit">R$ 92,50</td>
                  <td class="action">
                    <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="Adicionar no carrinho"><i class="fa fa-shopping-cart"></i></a>&nbsp;
                    <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" data-original-title="Remover"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
                <tr>
                  <td class="img-cart">
                    <a href="detalhes.html">
                      <img alt="Product" src="images/demo/necagrossa.jpg" class="img-thumbnail">
                    </a>
                  </td>
                  <td>
                    <p><a href="detalhes.html" class="d-block">Optoflex Asferica</a></p>
                    <p><small>Optoflex Asferica</small></p>
                  </td>
                  <td>21-10-2017</td>
                  <td><span class="label label-success arrowed">Em Estoque</span></td>
                  <td class="unit">R$ 92,50 </td>
                  <td class="action">
                    <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="Adicionar no carrinho"><i class="fa fa-shopping-cart"></i></a>&nbsp;
                    <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top" data-original-title="Remover"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <nav aria-label="Shopping Cart Next Navigation">
            <ul class="pager">
              <li class="previous"><a href="produtos.html"><span aria-hidden="true">&larr;</span> Continuar Comprando</a></li>
              <li class="next"><a href="carrinho.html">Meu Carrinho <span aria-hidden="true">&rarr;</span></a></li>
            </ul>
          </nav>
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
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et doloremmagna aliqua. Ut enim ad minim... <a href="#">Read More</a>
              </li>
            </ul>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="title-footer"><span>Informações</span></div>
            <ul>
              <li><i class="fa fa-angle-double-right"></i> <a href="ajuda.html">Ajuda</a></li>
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
        <label>Color</label>
        <select name="color-chooser" id="color-chooser" class="form-control input-sm selectpicker">
          <option value="indigo">Indigo</option>
          <option value="red">Red</option>
          <option value="teal">Teal</option>
          <option value="brown">Brown</option>
        </select>
        <label class="m-t-1">Style</label>
        <select name="style-chooser" id="style-chooser" class="form-control input-sm selectpicker">
          <option value="flat">Flat</option>
          <option value="rounded">Rounded</option>
        </select>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- Plugins -->
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap3-typeahead.js"></script>
    <script src="js/bootstrap-toolkit.js"></script>
    <script src="js/mimity.js"></script>
  </body>
</html>