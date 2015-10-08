<?php 

header("Content-Type: text/html; Charset=UTF-8");

		$txtNom = "";
		$txtDir = "";
		$txtTel = "";
		$txtFec = "";


if (isset($_POST['btn1'])) {
	$btn = $_POST['btn1'];

	if ($btn == "CANCELAR") {
		$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
		$eli = $con -> query("DELETE FROM prendasTMP ");
		$con -> close();
		
		echo "<script> alert('Venta CANCELADA!');</script>";
		echo "<script> window.location='index.php';</script>";
	}
	if ($btn == "TICKET") {
		$txtNom = $_POST['txtNom'];
		$txtDir = $_POST['txtDir'];
		$txtTel = $_POST['txtTel'];
		$txtFec = $_POST['txtFec'];

		echo $txtNom . "<br>";
		echo $txtDir . "<br>";
		echo $txtTel . "<br>";
		echo $txtFec . "<br>";
	}
}


 ?>