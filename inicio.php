<?php
//Código para recibir variables en caso de introducir datos incorrectos. 
$mensaje="";
if (isset($_GET['mensaje'])){
	$mensaje=strip_tags($_GET['mensaje']);
}

$usuario = "";
if (isset($_GET['usuario'])){
	$usuario=strip_tags(trim($_GET['usuario']));
}

$pass = "";
if (isset($_GET['pass'])){
	$pass=strip_tags(trim($_GET['pass']));
}

?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metagame</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <header>
        <div id="logo">
            <img src="imagenes/logo.png" alt="Metagame"/>
        </div>
        <div id="eslogan">
            <p>Lo último en el mundo de los videojuegos</p>
        </div>
        <form id="login" action="catalogo.php" method="post">
			<div id="error"><?=$mensaje?></div>
            <div id="user">
                <label>Usuario: </label>
                <input type="text" id="usuario" name="usuario" value="<?=$usuario?>" />
            </div>
            <div id="pass">
                <label>Contraseña: </label>
                <input type="password" id="contrasenia" name="pass" value="<?=$pass?>" />
            </div>
            <div id="entrar">
                <input type="submit" value="Entrar" />
            </div>
        </form>
    </header>
    <main>
        <h1>¡Compra las novedades para todas las plataformas al mejor precio!</h1>
        <div id="plataformas">
            <img src="imagenes/nintendo.png">
            <img src="imagenes/ps4.png">
            <img src="imagenes/xbox.png">
            <img src="imagenes/pc.png">
        </div>
    </main>
    <footer>
        <p>Daniel Crespo Martínez</p>
        <p>Copyright © Todos los Derechos Reservados</p>
    </footer>
</body>
</html>
