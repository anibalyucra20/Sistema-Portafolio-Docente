<?php
include '../../include/conexion.php';
include '../include/busquedas.php';


$id_est = $_POST['id'];

	$ejec_cons = buscarCarrerasById($conexion, $id_est);

		$cadena = '<option></option>';
		while ($mostrar=mysqli_fetch_array($ejec_cons)) {
			$cadena=$cadena.'<option value='.$mostrar['id'].' selected >'. $mostrar['nombre'].'</option>';
		}
		echo $cadena;

?>