<?php require_once('index.php'); ?>
<?php
	
	session_start();
	unset($_SESSION['MM_Username']);
	session_destroy();
	
    header('Location: ../index.php');
?>