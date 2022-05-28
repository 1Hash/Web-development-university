<?php

session_start();

require_once("./conexao.class.php");

require_once("./models/ModelFornecedor.class.php");
require_once("./models/ModelEC.class.php");

require_once("./classes/Fornecedor.class.php");
require_once("./classes/EC.class.php");

if (!isset($_SESSION['admin'])) {
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
    <title>Consultar Fornecedor - ELentes</title>
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
          <li class="active">Consultar Fornecedor</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Register Form -->
        <div class="col-sm-12 m-b-3">
          <div class="title"><span>Consultar Fornecedor</span></div>
          <div class="row">
            <center>
                <div class="panel-body table-scroll-estoque nopaddintop">
                    <table class="table table-bordered table-hover table-striped hd-center">
                      <thead>
                        <tr>
                            <th>Razão Social</th><th>CEP</th><th>Endereço</th><th>Número</th><th>Complemento</th><th>Bairro</th><th>Telefone</th><th>Cidade</th><th>Estado</th><th><center>Editar</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $fornecedor = new Fornecedor(null, null, null, null, null, null, null, null, null, null, null, null, null);
                        $ec = new EC();
                        
                        foreach($fornecedor->getTodosFornecedores() as $var) {
                            ?>
                            <tr>
                                <td><?php echo $var['razaoSocial']; ?></td>
                                <td><?php echo $var['cep']; ?></td>
                                <td><?php echo $var['endereco']; ?></td>
                                <td><?php echo $var['numero']; ?></td>
                                <td><?php echo $var['complemento']; ?></td>
                                <td><?php echo $var['bairro']; ?></td>
                                <td><?php echo $var['telefone']; ?></td>
                                <td><?php foreach($ec->ConsultarNomeCidade($var['idCidade']) as $var2) { echo $var2['cidNome']; } ?></td>
                                <td><?php foreach($ec->ConsultarNomeEstado($var['idEstado']) as $var2) { echo $var2['estNome']; } ?></td>                               
                                <td>
                                    <form method="POST" action="alterar-fornecedor">
                                        <input type="text" class="hidden" name="idFornecedor" value="<?php echo $var['idFornecedor']; ?>"/>
                                        <center>
                                        <button type="submit" class="fafabotao" data-toggle="tooltip" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        </center>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        
                        ?>
                      <tbody>
                    </table>
                </div>
              </center>
              <hr>
            <div class="col-xs-12">
                <button onClick="location.href='cadastrar-fornecedor'" type="button" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> &MediumSpace; Cadastrar Fornecedor</button>
            </div>
          </div>
        </div>
        <!-- End Register Form -->

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
