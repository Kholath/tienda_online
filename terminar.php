<?php
$usuario = $_GET['usuario'];
$j1 = $_GET['j1'];
$j2 = $_GET['j2'];
$j3 = $_GET['j3'];
$j4 = $_GET['j4'];
$j5 = $_GET['j5'];
$j6 = $_GET['j6'];
$j7 = $_GET['j7'];
$j8 = $_GET['j8'];
$j9 = $_GET['j9'];
$j10 = $_GET['j10'];
$resultado = $_GET['resultado'];

$todo=array($j1,$j2,$j3,$j4,$j5,$j6,$j7,$j8,$j9,$j10);

include "./seguridad/datosBD.php";
$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
if (!$canal){
	echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
	exit;
}
mysqli_set_charset($canal,"utf8");

$sql="select max(id) from pedido";
$consulta=mysqli_prepare($canal,$sql);

if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
	exit;
}

mysqli_stmt_execute($consulta);
mysqli_stmt_bind_result($consulta,$pedido);
if($pedido==null){
	$pedido=1;
}else{
	$pedido+=1;
}

mysqli_stmt_free_result($consulta);
unset($consulta);

$sql="insert into pedido (id,usuario,precio) values (?,?,?)";
$consulta=mysqli_prepare($canal,$sql);

if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
	exit;
}

mysqli_stmt_bind_param($consulta,"dsd",$idPedido,$user,$total);

$idPedido=$pedido;
$user=$usuario;
$total=$resultado;

mysqli_stmt_execute($consulta);

mysqli_stmt_free_result($consulta);
unset($consulta);

?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metagame factura</title>
    <link rel="stylesheet" href="css/estilo4.css">
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
		<div id="blanco1"></div>
		<div id="fin">
			<p>¡Gracias por comprar a través de Metagame!</p>
			<p>Recibirás tu pedido inmediatamente en tu correo. </p>
		</div>
		<div id="blanco2"></div>
    </main>
    <footer>
        <p>Daniel Crespo Martínez</p>
        <p>Copyright © Todos los Derechos Reservados</p>
    </footer>
</body>
</html>