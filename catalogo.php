<?php
$datosCorrectos = true;

$usuario="";
if (isset($_POST['usuario'])){
	$usuario=strip_tags(trim($_POST['usuario']));
}
if (empty($usuario)){
	$datosCorrectos=false;
}

$pass="";
if (isset($_POST['pass'])){
	$pass=strip_tags(trim($_POST['pass']));
}
if (empty($pass)){
	$datosCorrectos=false;
}

$j1=0;
if (isset($_POST['j1'])){
	$j1=strip_tags(trim($_POST['j1']));
}

if (!$datosCorrectos){
	$http="Location: inicio.php?mensaje=".urlencode("Se necesitan un usuario y contraseña válidos");
	$http.="&usuario=".urlencode($usuario)."&pass=".urlencode($pass);
	header($http);
	exit;
}


function erroneo($datoCorrecto){
	if ($datoCorrecto=="f"){
		return "*";
	}
	return "";
}

$mensaje="";
if (isset($_GET['mensaje'])){
	$mensaje=strip_tags($_GET['mensaje']);
}

$j1=0;
	
if(isset($_GET['j1'])){
	$j1=strip_tags($_GET['j1']);
}

$j1Correcto="";
if (isset($_GET['j1Correcto'])){
	$j1Correcto=strip_tags($_GET['j1Correcto']);
}

$j2=0;
	
if(isset($_GET['j2'])){
	$j2=strip_tags($_GET['j2']);
}

$j2Correcto="";
if (isset($_GET['j2Correcto'])){
	$j2Correcto=strip_tags($_GET['j2Correcto']);
}

$j3=0;
	
if(isset($_GET['j3'])){
	$j3=strip_tags($_GET['j3']);
}

$j3Correcto="";
if (isset($_GET['j3Correcto'])){
	$j3Correcto=strip_tags($_GET['j3Correcto']);
}

$j4=0;
	
if(isset($_GET['j4'])){
	$j4=strip_tags($_GET['j4']);
}

$j4Correcto="";
if (isset($_GET['j4Correcto'])){
	$j4Correcto=strip_tags($_GET['j4Correcto']);
}

$j5=0;
	
if(isset($_GET['j5'])){
	$j5=strip_tags($_GET['j5']);
}

$j5Correcto="";
if (isset($_GET['j5Correcto'])){
	$j5Correcto=strip_tags($_GET['j5Correcto']);
}

$j6=0;
	
if(isset($_GET['j6'])){
	$j6=strip_tags($_GET['j6']);
}

$j6Correcto="";
if (isset($_GET['j6Correcto'])){
	$j6Correcto=strip_tags($_GET['j6Correcto']);
}

$j7=0;
	
if(isset($_GET['j7'])){
	$j7=strip_tags($_GET['j7']);
}

$j7Correcto="";
if (isset($_GET['j7Correcto'])){
	$j7Correcto=strip_tags($_GET['j7Correcto']);
}

$j8=0;
	
if(isset($_GET['j8'])){
	$j8=strip_tags($_GET['j8']);
}

$j8Correcto="";
if (isset($_GET['j8Correcto'])){
	$j8Correcto=strip_tags($_GET['j8Correcto']);
}

$j9=0;
	
if(isset($_GET['j9'])){
	$j9=strip_tags($_GET['j9']);
}

$j9Correcto="";
if (isset($_GET['j9Correcto'])){
	$j9Correcto=strip_tags($_GET['j9Correcto']);
}

$j10=0;
	
if(isset($_GET['j10'])){
	$j10=strip_tags($_GET['j10']);
}

$j10Correcto="";
if (isset($_GET['j10Correcto'])){
	$j10Correcto=strip_tags($_GET['j10Correcto']);
}

?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metagame catálogo</title>
    <link rel="stylesheet" href="css/estilo2.css">
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
			<?php
			
			include "./seguridad/datosBD.php";
			$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
			if (!$canal){
				echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
				exit;
			}
			mysqli_set_charset($canal,"utf8");
			
			//Consulta
			$sql="select usuario from cliente where usuario=? and password=?";
			$consulta=mysqli_prepare($canal,$sql);
		
			if (!$consulta){
				echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
				exit;
			}
			
			mysqli_stmt_bind_param($consulta,"ss",$usu,$contra);
			$usu = $usuario;
			$contra = $pass;
			mysqli_stmt_execute($consulta);
			mysqli_stmt_bind_result($consulta,$usuario);
			
			mysqli_stmt_store_result($consulta);
			$n=mysqli_stmt_num_rows($consulta);

			if ($n!=1){
				header("Location:inicio.php?mensaje=".urlencode("Login incorrecto."));
				exit;
			}
			mysqli_stmt_close($consulta);
			mysqli_close($canal);
			
			?>
			
			¡Bienvenido de nuevo <?=$usuario?>!
		</div>
    </header>
    <main>
        <div class="blanco">
			<?=$mensaje?>
		</div>
        <form id="folleto" action="factura.php?usuario=<?=$usuario?>&pass=<?=$pass?>" method="post">
            <div class="prod">
                <img src="imagenes/black.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j6"><?=erroneo($j6Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/darkest.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j7"><?=erroneo($j7Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/death.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j3"><?=erroneo($j3Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/dont.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j1"><?=erroneo($j1Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/halo.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j5"><?=erroneo($j5Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/life.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j8"><?=erroneo($j8Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/planet.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j10"><?=erroneo($j10Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/pokemon.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j4"><?=erroneo($j4Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/war.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j9"><?=erroneo($j9Correcto)?>
            </div>
            <div class="prod">
                <img src="imagenes/witcher.jpg" class="imagen">
				<div class="etiqueta">Cantidad: </div>
                <input type="number" class="cantidad" min="0" value="0" name="j2"><?=erroneo($j2Correcto)?>
            </div>
            <div>
                <input type="submit" value="Comprar" id="comprar" />
            </div>
        </form>
        <div class="blanco"></div>
    </main>
    <footer>
        <p>Daniel Crespo Martínez</p>
        <p>Copyright © Todos los Derechos Reservados</p>
    </footer>
</body>
</html>
