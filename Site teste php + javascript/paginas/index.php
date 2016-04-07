<?php require_once('../connections/conexao.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  $isValid = False; 

  if (!empty($UserName)) { 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_testelogin, $testelogin);
$query_usuario = sprintf("SELECT * FROM usuario WHERE userEmail = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $testelogin) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Index - tLogin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="../JavaScript/relogio.js"></script>
</head>
<body>
<?php/* include('menu.script.php') */?>
</body>
</html>
<?php
mysql_free_result($usuario);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Index - tLogin</title>
	<!--link rel="stylesheet" type="text/css" href="../css/normalize.css"!-->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="../JavaScript/relogio.js"></script>
	
</head>
<body onload="relogio();">
		<div class="cortopo">
			<li></li>
			<div class="container clearfix">
				<header class="header">
					<h1><a href="index.php" class="logo">tLogin</a></h1>
					<nav class="menu">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="">Sobre</a></li>
							<li><a href=""><a href="logout.php">Sair</a></a></li>
						</ul>
					</nav>
				</header>
			</div>
		</div>
		<div class="tam">
		<div id="relogio"></div>
	</div>
</body>
</html>
