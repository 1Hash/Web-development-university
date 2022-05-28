<!DOCTYPE html>
<html lang="en">
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
                    <li><a href="alterar-senha-admin.html">Alterar Senha</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Sair</a></li>
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
            <a href="index-admin.html"><img alt="Logo" src="images/logo-teal.png" class="img-responsive" data-text-logo="ELentes-logo" /></a>
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
              <li><a href="index-admin.html">Home</a></li>
            </ul>
          </div>
      </div>
    </nav>
    <!-- End Navigation Bar -->

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index-admin.html">Home</a></li>
          <li class="active">Alterar Senha</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Account Sidebar -->
        <div class="col-sm-4 col-md-3 m-b-3">
          <h4 class="text-center m-b-3">Admin</h4>
          <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="alterar-senha-admin.html">Alterar Senha</a></li>
            <li role="presentation"><a href="#">Sair</a></li>
          </ul>
        </div>
        <!-- End Account Sidebar -->

        <!-- My Profile Content -->
        <div class="col-sm-8 col-md-9">
          <div class="title m-b-2"><span>Alterar Senha</span></div>
          <div class="row">
            <div class="col-xs-12">
              <form>
                <div class="form-group">
                  <label for="oldInputPasswd">Senha Atual</label>
                  <input type="password" class="form-control" id="oldInputPasswd" placeholder="Senha Atual">
                </div>
                <div class="form-group">
                  <label for="newInputPasswd">Nova Senha</label>
                  <input type="password" class="form-control" id="newInputPasswd" placeholder="Nova Senha">
                </div>
                <div class="form-group">
                  <label for="retypeInputPasswd">Confirme sua Nova Senha</label>
                  <input type="password" class="form-control" id="retypeInputPasswd" placeholder="Confirme sua Nova Senha">
                </div>
                <button type="submit" class="btn btn-default btn-theme"><i class="fa fa-check"></i> Salvar</button>
              </form>
            </div>
          </div>
        </div>
        <!-- End My Profile Content -->

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
