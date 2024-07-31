<?php
$id_docente = $_GET['data'];

include("../../include/conexion.php");
include("../../include/busquedas.php");
include("../../include/funciones.php");

include("../include/verificar_sesion_secretaria.php");

if (!verificar_sesion($conexion)) {
    echo "<script>
                alert('Error Usted no cuenta con permiso para acceder a esta página');
                window.location.replace('../index.php');
    		</script>";
} else {

    $pass = generar_password();

    $pass_secure = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE estudiante SET password='$pass_secure' WHERE id='$id_docente'";
    $ejec_consulta = mysqli_query($conexion, $sql);
    if ($ejec_consulta) {
        echo "<script>
            alert('Su contraseña  fue actualizada a la siguiente : ".$pass."');
			window.location= '../estudiante.php';
		</script>
	";
    } else {
        echo "<script>
			alert('Error al Actualizar Contraseña');
			window.history.back();
		</script>
	";
    }
}
