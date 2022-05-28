<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: ./index.php');
}
else {

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Home Admin - ELentes</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/EL.css" rel="stylesheet">
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
              <li>
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-user"></i> Oi, Admin <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUser">
                    <li><a href="?go=sair">Sair</a></li>
                  </ul>
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
            <a href="index-admin"><img alt="Logo" src="images/logo-teal.png" class="img-responsive" data-text-logo="ELentes-logo" /></a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Header -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-default shadow-navbar" role="navigation">
      <div class="container">
          <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index-admin">Home</a></li>
            </ul>
          </div>
      </div>
    </nav>
    <!-- End Navigation Bar -->

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Home</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Content -->
        <div class="col-xs-12 col-sm-12 text-center botaoadmin vmd">
          <div class="col-xs-6 col-md-3">
              <a href="consultar-produto" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Consultar Produto</a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="consultar-estoque" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Consultar Estoque</a>
          </div>
          <div class="col-sm-3 visible-md visible-lg">
            <a href="consultar-fornecedor" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Consultar Fornecedor</a>
          </div>
          <div class="col-sm-3 visible-md visible-lg">
            <a href="pedidos-aprovados" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Consultar Pedidos Aprovados</a>
          </div>
        </div>
        <div class="col-xs-12 text-center hidden-md hidden-lg botaoadmin vmd">
          <div class="col-xs-6 col-md-3">
            <a href="cadastrar-fornecedor" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Cadastrar Forncecedor</a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="consultar-pedidos" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Consultar Pedidos Aprovados</a>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 text-center botaoadmin vmd">
          <div class="col-xs-6 col-md-3">
            <a href="publicar-noticia" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Publicar Noticias</a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="publicar-dica" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Publicar Dicas</a>
          </div>
          <div class="col-sm-3 visible-md visible-lg">
            <a href="relatorio-vendas" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Emitir Relatórios de Vendas</a>
          </div>
          <div class="col-sm-3 visible-md visible-lg">
            <a href="relatorio-compras" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Emitir Relatórios de Compras</a>
          </div>
        </div>
        <div class="col-xs-12 text-center hidden-md hidden-lg botaoadmin vmd">
          <div class="col-xs-6 col-md-3">
            <a href="relatorio-vendas" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Emitir Relatórios de Vendas</a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="relatorio-compras" class="btn btn-theme bg-botao bg-botaoadmin tambotao bg-vertical">Emitir Relatórios de Compras</a>
          </div>
        </div>
        <!-- End Content -->

      </div>
    </div>
    <!-- End Main Content -->

    <!-- Footer -->
    <div class="footer">
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

<?php
}

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['admin']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}