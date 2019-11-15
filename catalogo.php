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

if (!$datosCorrectos){
	$http="Location: inicio.php?mensaje=".urlencode("Se necesitan un usuario y contraseña válidos");
	$http.="&usuario=".urlencode($usuario)."&pass=".urlencode($pass);
	header($http);
	exit;
}

?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metagame</title>
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
        <div class="blanco"></div>
        <div id="folleto">
            <div class="prod">
                <img src="imagenes/black.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/darkest.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/death.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/dont.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/halo.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/life.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/planet.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/pokemon.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/war.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div class="prod">
                <img src="imagenes/witcher.jpg" class="imagen">
                <input type="number" class="cantidad">
            </div>
            <div id="comprar">
                <input type="submit" value="Comprar" />
            </div>
        </div>
        <div class="blanco"></div>
    </main>
    <footer>
        <p>Daniel Crespo Martínez</p>
        <p>Copyright © Todos los Derechos Reservados</p>
    </footer>
</body>
</html>
