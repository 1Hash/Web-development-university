<?php require_once('connections/conexao.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "cadusuario")) {
  $insertSQL = sprintf("INSERT INTO usuario (userNome, userNasc, userEmail, userSenha, userCidade, userEstado, userPais) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userNome'], "text"),
                       GetSQLValueString($_POST['userNasc'], "date"),
                       GetSQLValueString($_POST['userEmail'], "text"),
                       GetSQLValueString($_POST['userSenha'], "text"),
                       GetSQLValueString($_POST['userCidade'], "text"),
                       GetSQLValueString($_POST['userEstado'], "text"),
                       GetSQLValueString($_POST['userPais'], "text"));

  mysql_select_db($database_testelogin, $testelogin);
  $Result1 = mysql_query($insertSQL, $testelogin) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php
// *** Requisição de validação de login no site.
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_REQUEST["erro"])){
	$L = "Usuario ou senha inválidos!";
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['userEmailL'])) {
  $loginUsername=$_POST['userEmailL'];
  $password=$_POST['userSenhaL'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "paginas/index.php";
  $MM_redirectLoginFailed = "index.php?erro";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_testelogin, $testelogin);
  
  $LoginRS__query=sprintf("SELECT userEmail, userSenha FROM usuario WHERE userEmail=%s AND userSenha=%s", GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $testelogin) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	    

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
	header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Teste Login - Index</title>
		<!--ink rel="stylesheet" type="text/css" href="css/normalize.css"!-->
		<link rel="stylesheet" type="text/css" href="css/styleindex.css">
		<script>
			
			function cTrig(box) {
				
				if (box.checked) {
					
					alert("Função não implementada!");
				}
			}
			
		</script>
	</head>
	<body onload="colocar();">
		<div class="cortopo">
			<div class="container clearfix">
				<header class="header">
					<h1><a href="index.php" class="logo">tLogin</a></h1>
					<nav class="menu">
						<ul>
							<li class="login">
								<form action="<?php echo $loginFormAction; ?>" method="POST" name="login">
									<input class="textb" name="userEmailL" type="text" placeholder="Email">
									<input class="textb" name="userSenhaL" type="password" placeholder="Senha">
									<input class="botlog" name="login" type="submit" value="Entrar">
									<div class="caixa">
										<br><input id="check" type="checkbox" name="box" value="1" onchange="cTrig(this)">Mantenha-me conectado.<?php echo "<li style='font-size: 15px; color:#E03838; max-width: 1128px; margin: 0 auto; float: right; padding-top: 2px; font-weight: bold;'>$L</li>";?></br>
									</div>
								</form>
							</li>
						</ul>
					</nav>
				</header>
			</div>
		</div>
		<div class="cadastro tam">
			<section>
				<aside>
					<p style="font-size: 25px; text-transform: uppercase;">Cadastre-se</p>
					<form action="<?php echo $editFormAction; ?>" method="POST" name="cadusuario">
						<input class="textcad" name="userNome" type="text" placeholder="Nome"><br>
						<input class="textcaddate" name="userNasc" type="date"><br>
						<input class="textcad" name="userEmail" type="email" placeholder="Email"><br>
						<input class="textcad" name="userSenha" type="password" placeholder="Senha"><br>
						<input class="textcad" name="userCidade" type="text" placeholder="Cidade"><br>
						<input class="textcad" name="userEstado" type="text" placeholder="Estado"><br>
						<input class="textcad"name="userPais" type="text" placeholder="Pais"><br>
						<!--select name="cidade"><option value="1">Curitiba</option></select><br>
						<select name="estado"><option value="1">Paraná</option></select><br>
						<select name="pais"><option value="1">Brasil</option></select><br!-->
						<input class="botcad" name="cadastro" type="submit" value="Cadastrar">
						<input type="hidden" name="MM_insert" value="cadusuario">
					</form>
				</aside>
			</section>
		</div>
	</body>
</html>