<?php

//Recepción de datos desde el catálogo.
$usuario = $_GET['usuario'];
$pass = $_GET['pass'];

$j1=0;
$j2=0;
$j3=0;
$j4=0;
$j5=0;
$j6=0;
$j7=0;
$j8=0;
$j9=0;
$j10=0;

$j1Correcto="v";
$j2Correcto="v";
$j3Correcto="v";
$j4Correcto="v";
$j5Correcto="v";
$j6Correcto="v";
$j7Correcto="v";
$j8Correcto="v";
$j9Correcto="v";
$j10Correcto="v";

if (isset($_POST['j1'])){
	$j1=strip_tags(trim($_POST['j1']));
}
if (isset($_POST['j2'])){
	$j2=strip_tags(trim($_POST['j2']));
}
if (isset($_POST['j3'])){
	$j3=strip_tags(trim($_POST['j3']));
}
if (isset($_POST['j4'])){
	$j4=strip_tags(trim($_POST['j4']));
}
if (isset($_POST['j5'])){
	$j5=strip_tags(trim($_POST['j5']));
}
if (isset($_POST['j6'])){
	$j6=strip_tags(trim($_POST['j6']));
}
if (isset($_POST['j7'])){
	$j7=strip_tags(trim($_POST['j7']));
}
if (isset($_POST['j8'])){
	$j8=strip_tags(trim($_POST['j8']));
}
if (isset($_POST['j9'])){
	$j9=strip_tags(trim($_POST['j9']));
}
if (isset($_POST['j10'])){
	$j10=strip_tags(trim($_POST['j10']));
}

//Creación de arrays con datos.
/* 	- $todo contiene las cantidades introducidas por el usuario.
	- $todoCorrecto contiene "v" o "f", según la cantidad del usuario esté en stock o no, respectivamente.
	- $cantidades contiene los valores definitivos: la mínima entre el stock disponible y lo introducido por el usuario.
	- $resultado almacena el coste total de la factura.*/
$todo=array($j1,$j2,$j3,$j4,$j5,$j6,$j7,$j8,$j9,$j10);
$todoCorrecto=array($j1Correcto,$j2Correcto,$j3Correcto,$j4Correcto,$j5Correcto,$j6Correcto,$j7Correcto,$j8Correcto,$j9Correcto,$j10Correcto);
$cantidades=array();
$resultado=0;

?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metagame factura</title>
    <link rel="stylesheet" href="css/estilo3.css">
</head>

<body>
    <header>
        <div id="logo">
            <img src="imagenes/logo.png" alt="Metagame"/>
        </div>
        <div id="eslogan">
            <p>Lo último en el mundo de los videojuegos</p>
        </div>
		<div id="bienvenida">
			¡Bienvenido de nuevo <?=$usuario?>!
		</div>
    </header>
	<main>
        <div id="blanco1">
		</div>
		<div id="factura">
			<p>FACTURA:<p>
			<?php
			
			include "./seguridad/datosBD.php";
			$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
			if (!$canal){
				echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
				exit;
			}
			mysqli_set_charset($canal,"utf8");
			
			//Consulta producto y comprobación de stock.
			for($i=1;$i<=10;$i++){
				$sql="select cantidad, precio, descripcion from productos where id=?";
				$consulta=mysqli_prepare($canal,$sql);
			
				if (!$consulta){
					echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
					exit;
				}
				
				mysqli_stmt_bind_param($consulta,"i",$juego);
				$juego = $i;
				mysqli_stmt_execute($consulta);
				mysqli_stmt_bind_result($consulta,$cantidad,$precio,$descripcion);
				mysqli_stmt_store_result($consulta);
				
				mysqli_stmt_fetch($consulta);
				
				if($todo[$i-1]>$cantidad){
					$todoCorrecto[$i-1]="f";
					$cantidades[$i-1]=$cantidad;
				}else{
					$individual=$todo[$i-1]*$precio;
					$resultado+=$individual;
					if($todo[$i-1]>0){
						echo "Producto ".$i." - ".$descripcion." / ".$todo[$i-1]." x ".$precio." = ".$individual."€<br>";
					}
					$cantidades[$i-1]=$todo[$i-1];
				}
				
				mysqli_stmt_free_result($consulta);
				unset($consulta);
				
			}
			
			//En caso de que algún producto no tenga tanto stock como el solicitado, se vuelve al catálogo indicando el máximo para ese producto.
			if(in_array("f",$todoCorrecto)){
				$http="Location: catalogo.php?mensaje=".urlencode("Productos fuera de stock (marcados con *). Seleccionada cantidad máxima.");
				$http.="&usuario=".urlencode($usuario)."&pass=".urlencode($pass);
				for($x=1;$x<=10;$x++){
					$http.="&j".urlencode($x)."=".urlencode($cantidades[$x-1]);
					$http.="&j".urlencode($x)."Correcto=".urlencode($todoCorrecto[$x-1]);					
				}
				header($http);
				exit;
			}
			echo "El coste total de la compra es: ".$resultado."€ (I.V.A. incluido).";
			?>
			<br>
			
			<form action="terminar.php?j1=<?=$cantidades[0]?>&j2=<?=$cantidades[1]?>&j3=<?=$cantidades[2]?>&j4=<?=$cantidades[3]?>&j5=<?=$cantidades[4]?>&j6=<?=$cantidades[5]?>&j7=<?=$cantidades[6]?>&j8=<?=$cantidades[7]?>&j9=<?=$cantidades[8]?>&j10=<?=$cantidades[9]?>&usuario=<?=$usuario?>&resultado=<?=$resultado?>" method="post">
				<button type="button" id="volver"><a href="inicio.php">Inicio</a></button>
				<input type="submit" id="comprar" value="Finalizar compra">
			</form>
		</div>
		<div id="blanco2"></div>
    </main>
    <footer>
        <p>Daniel Crespo Martínez</p>
        <p>Copyright © Todos los Derechos Reservados</p>
    </footer>
</body>
</html>