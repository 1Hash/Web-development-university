<?php

    session_start();

    require_once("./models/ModelEstoque.class.php");
    require_once("./classes/Estoque.class.php");
    
    require_once("./models/ModelProduto.class.php");
    require_once("./classes/Produto.class.php");
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    $estoque = new Estoque(null, null, null, null, null, null, null, null, null, null, null);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Consultar Estoque - ELentes</title>
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
              <li><a href="index-admin">Home</a></li>
            </ul>
          </div>
      </div>
    </nav>
    <!-- End Navigation Bar -->

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index-admin">Home</a></li>
          <li class="active">Consultar Estoque</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Register Form -->
        <div class="col-sm-12 m-b-3">
           
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#consultaEstoque">Consulta de Estoque</a></li>
            <li><a data-toggle="tab" href="#produtosPendentes">Produtos Pendentes</a></li>
          </ul>
            
          <div class="col-xs-12"><br/></div>
            
          <div class="tab-content">
          <div id="consultaEstoque" class="tab-pane fade in active">           
          <div class="title"><span>Consultar Estoque</span></div>
            <div class="row">
              <center>
                  <div class="panel-body table-scroll-estoque nopaddintop">
                      <table class="table table-bordered table-hover table-striped hd-center">
                        <thead>
                          <tr>
                              <th>Nome</th><th>Esférico</th><th>Cilíndro</th><th>Eixo</th><th>Curva Base</th><th>Diâmetro</th><th>Adição</th><th>Cor</th><th>Olho</th><th>Quantidade</th><th><center>Editar</center></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($estoque->funcaoGetTodosEstoque() as $var) {
                            ?>
                          <tr>
                              <td><?php foreach ($produto->getProduto($var['idProduto']) as $var2) { echo $var2['nome']; } ?></td>
                              <td><?php echo $var['grauEsferico']; ?></td>
                              <td><?php if ($var['grauCilindro'] != null) { echo $var['grauCilindro']; }else { echo "-"; } ?></td>
                              <td><?php if ($var['eixo'] != null) { echo $var['eixo']; }else { echo "-"; } ?></td>
                              <td><?php echo $var['curvaBase']; ?></td>
                              <td><?php echo $var['diametro']; ?></td>
                              <td><?php if ($var['grauAdicao'] != null) { echo $var['grauAdicao']; }else { echo "-"; } ?></td>
                              <td><?php if ($var['cor'] != null) { echo $var['cor']; }else { echo "-"; } ?></td>
                              <td><?php if ($var['olho'] != null) { if ($var['olho'] == 1) { echo "Dominante"; }else { echo "Não dominante"; } }else { echo "-"; } ?></td>
                              <td><?php echo $var['quantidade']; ?></td>
                              <td><center>
                              <form method="POST" action="./editar-estoque">
                                  <input type="text" name="idEstoque" class="hidden" value="<?php echo $var['idEstoque']; ?>"/>
                                  <button type="submit" class="fafabotao" data-toggle="tooltip" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil-square-o"></i></button>
                              </form>
                              </center></td>
                          </tr>
                            <?php } ?>
                        <tbody>
                      </table>
                  </div>
                </center>
                <hr>
              <div class="col-xs-12">
                  <button style="float: right;" onClick="location.href='pedido-fornecedor'" type="button" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> &MediumSpace; Fazer Pedido ao Fornecedor</button>
                  <button onClick="location.href='adicionar-estoque'" type="button" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> &MediumSpace; Adicionar Produto no Estoque</button>
              </div>
              </div>
              </div>
              <div id="produtosPendentes" class="tab-pane fade">
                  <div class="title"><span>Produtos Pendentes</span></div>
                    <div class="row">
                      <center>
                          <div class="panel-body table-scroll-estoque nopaddintop">
                              <table class="table table-bordered table-hover table-striped hd-center">
                                <thead>
                                    <tr>
                                        <th>Data</th><th>Pedido</th><th>Nome</th><th>Esférico</th><th>Cilíndro</th><th>Eixo</th><th>Curva Base</th><th>Diâmetro</th><th>Adição</th><th>Cor</th><th>Olho</th><th>Quantidade</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php 
                                      foreach ($estoque->funcaoGetTodosEstoquePendentes() as $var) {
                                          if ($var['esfericoD'] == $var['esfericoE'] && $var['cilindroD'] == $var['cilindroE'] && $var['eixoD'] == $var['eixoE'] && $var['curvaBaseD'] == $var['curvaBaseE'] && $var['diametroD'] == $var['diametroE'] && $var['corD'] == $var['corE'] && $var['adicaoD'] == $var['adicaoE']) {
                                      ?>
                                    <tr>
                                        <td><?php echo $var['data']; ?></td>
                                        <td><?php echo $var['idPedido']; ?></td>
                                        <td><?php foreach ($produto->getProduto($var['idProduto']) as $var2) { echo $var2['nome']; } ?></td>
                                        <td><?php echo $var['esfericoD']; ?></td>
                                        <td><?php if ($var['cilindroD'] != null) { echo $var['cilindroD']; }else { echo "-"; } ?></td>
                                        <td><?php if ($var['eixoD'] != null) { echo $var['eixoD']; }else { echo "-"; } ?></td>
                                        <td><?php echo $var['curvaBaseD']; ?></td>
                                        <td><?php echo $var['diametroD']; ?></td>
                                        <td><?php if ($var['adicaoD'] != null) { echo $var['adicaoD']; }else { echo "-"; } ?></td>
                                        <td><?php if ($var['corD'] != null) { echo $var['corD']; }else { echo "-"; } ?></td>
                                        <td><?php if ($var['olhoDominante'] != null) { if ($var['olhoDominante'] == 1) { echo "Dominante"; }else { echo "Não dominante"; } }else { echo "-"; } ?></td>
                                        <td><?php echo $var['qtdePendente']; ?></td>
                                    </tr>
                                      <?php 
                                        }
                                        else {                                            
                                      ?>
                                           
                                        <tr>
                                            <td><?php echo $var['data']; ?></td>
                                            <td><?php echo $var['idPedido']; ?></td>
                                            <td><?php foreach ($produto->getProduto($var['idProduto']) as $var2) { echo $var2['nome']; } ?></td>
                                            <td><?php echo $var['esfericoD']; ?></td>
                                            <td><?php if ($var['cilindroD'] != null) { echo $var['cilindroD']; }else { echo "-"; } ?></td>
                                            <td><?php if ($var['eixoD'] != null) { echo $var['eixoD']; }else { echo "-"; } ?></td>
                                            <td><?php echo $var['curvaBaseD']; ?></td>
                                            <td><?php echo $var['diametroD']; ?></td>
                                            <td><?php if ($var['adicaoD'] != null) { echo $var['adicaoD']; }else { echo "-"; } ?></td>
                                            <td><?php if ($var['corD'] != null) { echo $var['corD']; }else { echo "-"; } ?></td>
                                            <td><?php if ($var['olhoDominante'] != null) { if ($var['olhoDominante'] == 1) { echo "Dominante"; }else { echo "Não dominante"; } }else { echo "-"; } ?></td>
                                            <td><?php echo $var['qtdePendente']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td><?php echo $var['data']; ?></td>
                                            <td><?php echo $var['idPedido']; ?></td>
                                            <td><?php foreach ($produto->getProduto($var['idProduto']) as $var2) { echo $var2['nome']; } ?></td>
                                            <td><?php echo $var['esfericoE']; ?></td>
                                            <td><?php if ($var['cilindroE'] != null) { echo $var['cilindroE']; }else { echo "-"; } ?></td>
                                            <td><?php if ($var['eixoE'] != null) { echo $var['eixoE']; }else { echo "-"; } ?></td>
                                            <td><?php echo $var['curvaBaseE']; ?></td>
                                            <td><?php echo $var['diametroE']; ?></td>
                                            <td><?php if ($var['adicaoE'] != null) { echo $var['adicaoE']; }else { echo "-"; } ?></td>
                                            <td><?php if ($var['corE'] != null) { echo $var['corE']; }else { echo "-"; } ?></td>
                                            <td><?php if ($var['olhoDominante'] != null) { if ($var['olhoDominante'] == 1) { echo "Dominante"; }else { echo "Não dominante"; } }else { echo "-"; } ?></td>
                                            <td><?php echo $var['qtdePendente']; ?></td>
                                        </tr>
                                                
                                      <?php                                                
                                        }
                                      }                                     
                                      ?>
                                  <tbody>
                              </table>
                          </div>
                        </center>
                        <hr>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <!-- End Register Form -->

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

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['admin']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}