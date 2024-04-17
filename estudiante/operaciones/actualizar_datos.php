<?php
$pass = $_POST['contrasenia'];
$pass2 = $_POST['contrasenia2'];

if ($pass !== $pass2) {
    echo "<script>
                alert('Error, las contraseñas no coinciden');
                window.history.back();
    		</script>";
} else {
    include("../../include/conexion.php");
    include("../../include/busquedas.php");
    include("../../include/funciones.php");

    include("../include/verificar_sesion_estudiante.php");

    if (!verificar_sesion($conexion)) {
        echo "<script>
                alert('Error Usted no cuenta con permiso para acceder a esta página');
                window.location.replace('../index.php');
    		</script>";
    } else {


        $id_estudiante_sesion = buscar_estudiante_sesion($conexion, $_SESSION['id_sesion_est'], $_SESSION['token']);
        $b_estudiante = buscarEstudianteById($conexion, $id_estudiante_sesion);
        $r_b_estudiante = mysqli_fetch_array($b_estudiante);
        $id_est = $r_b_estudiante['id'];

        $pass_secure = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "UPDATE estudiante SET password='$pass_secure' WHERE id='$id_est'";
        $ejec_consulta = mysqli_query($conexion, $sql);
        if ($ejec_consulta) {
            echo "<script>
            alert('Contraseña actualizada correctamente');
			window.location= '../index.php';
		</script>
	";
        } else {
            echo "<script>
			alert('Error al Actualizar Contraseña, por favor contacte con el administrador');
			window.history.back();
		</script>
	";
        }
    }
}
