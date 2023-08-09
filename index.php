<?php
$nombre_fichero = "include/conexion.php";

if (file_exists($nombre_fichero)) {
	echo "<script> window.location.replace('docente/'); </script>";
} else {

	if (isset($_POST['host'])) {$host = $_POST['host'];}else{$host = '';}
	if (isset($_POST['db'])) {$db = $_POST['db'];}else{$db = '';}
	if (isset($_POST['usuario'])) {$usuario = $_POST['usuario'];}else{$usuario = '';}
	if (isset($_POST['password'])) {$password = $_POST['password'];}else{$password = '';}

	if ($host != '' && $db != '') {
		$conexion = mysqli_connect($host,$usuario,$password,$db);
		if ($conexion) {
			$fh = fopen("include/conexion.php", 'w') or die("Se produjo un error al crear el archivo");
			$texto = '<?php';
			$texto .= '
$host = "'.$host.'";
$db = "'.$db.'";
$user_db = "'.$usuario.'";
$pass_db = "'.$password.'";

$conexion = mysqli_connect($host,$user_db,$pass_db,$db);

if ($conexion) {
	date_default_timezone_set("America/Lima"); 
}else{
	echo "error de conexion a la base de datos";
	
}
$conexion->set_charset("utf8");
';
		$texto .= '?>';
		fwrite($fh, $texto) or die("No se pudo escribir en el archivo");
		fclose($fh);
		echo "<script>
			alert('Conexión Exitosa');
			window.location.replace('index.php');
		</script>
		";
		
		}else{
			echo "<script>
			alert('Error de Conexión a la Base de datos, Intenta Nuevamente');
			window.history.back();
		</script>
		";
	
		}
		
	}

?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Inicio - Sispa</title>

		<!-- Bootstrap -->
		<link href="Gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="Gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="Gentella/vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- Animate.css -->
		<link href="Gentella/vendors/animate.css/animate.min.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="Gentella/build/css/custom.min.css" rel="stylesheet">
	</head>

	<body class="login">
		<div>
			<br>
			<br>
			<center>
				<h1>SISTEMA DE PORTAFOLIO ACADÉMICO</h1>
			</center>
			<center>
				<h2>Formulario de Activación</h2>
			</center>
			<div class="login_wrapper">
				<!--<center><img src="img/logo.png" width="150px"></center>-->
				<form role="form" action="" class="form-horizontal form-label-left input_mask" method="POST">

					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" name="host" required="required" placeholder="Servidor (Host)" value="<?php echo $host; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" name="db" required="required" placeholder="Nombre de Base de Datos" value="<?php echo $db; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" name="usuario" placeholder="Usuario (Base de Datos)" value="<?php echo $usuario; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" name="password" placeholder="Contraseña (Base de Datos)" value="<?php echo $password; ?>">

						</div>
					</div>
					<div class="separator">
						
						
						
					</div>

					<div align="center">
						<button type="submit" class="btn btn-primary">Verificar Conexión y Guardar</button>
					</div>



			</div>



			<div class="clearfix"></div>

			<div class="separator">


				<div class="clearfix"></div>
				<br />

				<div>
					<center>
						<h2>Copiright</h2>
					</center>
					<p></p>
				</div>
			</div>
			</form>
			<section class="">

			</section>



		</div>
		</div>
	</body>

	</html>

<?php
}










/*

$ud="ud"; //variable para nombre de arrays de uds
$nud = "ud"; //variable para crear objetos en array
$unidades_did = array(); //array para guardar uds con sus notas
for ($i=1; $i <= 2; $i++) { // bucle para generar los array para cada ud
	$nom_ud = $ud.$i;
	$nud = $ud.$i;
	$nom_ud= array();
	for ($j=1; $j <= 5; $j++) {  // bucle para generar las notas de la ud
		$nom_ud["nota".$j] = "".$j;
	}
	$unidades_did[$nud] = $nom_ud;  // agregamos el array de ud al array de uds
}

foreach ($unidades_did as $key => $value) { // codigo para mostrar el array de uds
	echo "$key: <br>";
	//if ($key == "ud2") {
			foreach ($value as $llave => $valor) {
		echo "$llave es $valor <br>";
		
	}
	//	}
	
}
$sarray = json_encode($unidades_did);
$dd = strval($sarray);
echo $dd;
$ssql = "INSERT INTO prueba (array_bid) VALUES ('$dd')";

if (mysqli_query($con, $ssql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $ssql . "<br>" . mysqli_error($con);
}
print_r($unidades_did);



$persona1 = array();
$apellido1 = "yucra";
$apellido2 = "curo";
$nombre = "anibal";
$persona1["ap1"]=$apellido1;
$persona1["ap2"]=$apellido2;
$persona1["nom"]=$nombre;
foreach ($persona1 as $key => $value) {
		echo "$key is $value <br>";
}


$persona2 = array();
$apel1 = "torres";
$apel2 = "lozano";
$nomb = "juan carlos";
$persona2["ap1"]=$apel1;
$persona2["ap2"]=$apel2;
$persona2["nom"]=$nomb;
foreach ($persona2 as $key => $value) {
		echo "$key is $value <br>";
}

$personas = array();
$personas["per1"] = $persona1;
$personas["per2"] = $persona2;
foreach ($personas as $key_per => $per) {
		$person = "$key_per";
		echo "$key_per: <br>";
		foreach ($per as $dato => $valor) {
			echo "$dato = $valor <br>";
		}
}
*/
?>