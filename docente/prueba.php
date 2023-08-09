<?php
include("../include/conexion.php");
include("include/busquedas.php");
include("include/funciones.php");
session_start();

$b_per = buscarProgramacionByIdPeriodo($conexion, $_SESSION['periodo']);
while ($r_b_per = mysqli_fetch_array($b_per)) {
    $b_silabo = buscarSilaboByIdProgramacion($conexion, $r_b_per['id']);
    $r_b_silabo =mysqli_fetch_array($b_silabo);
    
}   
$cont_prog = mysqli_num_rows($b_per);
echo $_SESSION['periodo'];
echo $cont_prog;
?>