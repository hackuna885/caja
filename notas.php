<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

$btn = $_GET['btn'];

$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
$cs = $con->query("SELECT prenda, importe FROM catPrendas WHERE prenda = '$btn'");

$res = $cs -> fetchArray();
$con -> close();



$btnEli = substr($btn, -5, 2);

if ($btnEli == "P0") {
	$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
	$eli = $con -> query("DELETE FROM prendasTMP WHERE id = '$btn'");
	$con -> close();

	$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
	$cs3 = $con -> query("SELECT * FROM prendasTMP");

	$cs4 = $con -> query("SELECT SUM(importe) FROM prendasTMP");
	$res4 = $cs4 -> fetchArray();


	echo '
	<table>';

	while ($res3 = $cs3 -> fetchArray()) {

		echo '

			<tr>
				<td class="p1">'.$res3[1].'</td>
				<td class="p2">$'.$res3[2].'</td>
				<td class="p3"><button class="eliminar" type="button" value="'.$res3[0].'" onclick="ejecutarAjax(this.value)">Eliminar</button></td>
			</tr>

		';
	}
	$con -> close();

	echo '
		<div class="cTotal">
		Total: '.$res4[0].'
		</div>
	</table>';

}else{

if ($res[1] > 0) {

	$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
	$cs2 = $con -> query("SELECT COUNT(id), MAX(id) FROM prendasTMP");
	$res2 = $cs2 -> fetchArray();
		$count = $res2[0];
		$max = $res2[1];
	$con -> close();

	if ($count == 0) {

		$idIns = "P0001";
		$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
		$insert = $con -> query("INSERT INTO prendasTMP VALUES('$idIns','$res[0]','$res[1]')");
		$con -> close();
	}else{
		$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
		$idIns = "P".substr((substr($max, 1) + 10001), 1);
		$insert = $con -> query("INSERT INTO prendasTMP VALUES('$idIns','$res[0]','$res[1]')");
		$con -> close();
	}
	// echo "Prenda: ".$res[0]."Importe: ".$res[1];
}

$con = new SQLite3("data/tienda.db") or die("Problemas para conectar");
$cs3 = $con -> query("SELECT * FROM prendasTMP");

$cs4 = $con -> query("SELECT SUM(importe) FROM prendasTMP");
	$res4 = $cs4 -> fetchArray();

echo '
<table>';

while ($res3 = $cs3 -> fetchArray()) {

	echo '

		<tr>
			<td class="p1">'.$res3[1].'</td>
			<td class="p2">$'.$res3[2].'</td>
			<td class="p3"><button class="eliminar" type="button" value="'.$res3[0].'" onclick="ejecutarAjax(this.value)">Eliminar</button></td>
		</tr>

	';
}
$con -> close();

echo '
		<div class="cTotal">
		Total: '.$res4[0].'
		</div>
</table>';



}


 ?>