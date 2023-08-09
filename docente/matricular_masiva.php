<?php 
$archivo = $_FILES['my_file_input'];
$archivo = file_get_contents($archivo['tmp_name']);
$archivo = explode("/n", $archivo);
$archivo = array_filter($archivo);
foreach ($archivo as $estudiante) {
    $ests[] = explode(",", $estudiante);
}

print_r($ests);



?>