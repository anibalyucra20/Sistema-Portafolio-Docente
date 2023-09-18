<?php
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");

include("include/verificar_sesion_estudiante.php");

if (!verificar_sesion($conexion)) {
    echo "<script>
                alert('Error Usted no cuenta con permiso para acceder a esta página');
                window.location.replace('index.php');
    		</script>";
} else {

    $id_estudiante_sesion = buscar_estudiante_sesion($conexion, $_SESSION['id_sesion_est'], $_SESSION['token']);
    $b_estudiante = buscarEstudianteById($conexion, $id_estudiante_sesion);
    $r_b_estudiante = mysqli_fetch_array($b_estudiante);
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Language" content="es-ES">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ficha Estudiante<?php include("../include/header_title.php"); ?></title>
        <!--icono en el titulo-->
        <link rel="shortcut icon" href="../img/favicon.ico">
        <!-- Bootstrap -->
        <link href="../Gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../Gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../Gentella/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../Gentella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
        <link href="../Gentella/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="../Gentella/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="../Gentella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- starrr -->
        <link href="../Gentella/vendors/starrr/dist/starrr.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../Gentella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


        <!-- Custom Theme Style -->
        <link href="../Gentella/build/css/custom.min.css" rel="stylesheet">
        <!-- Script obtenido desde CDN jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <!--menu-->
                <?php
                include("include/menu.php"); ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">

                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="">
                                        <h2 align="center">Ficha de Estudiante</h2>
                                        <br>
                                        <p>(*) Campos Obligatorios </p>
                                        <p style="color: red;">El presente documento tiene carácter de DECLARACIÓN JURADA, lo que significa que en caso de verificarse que la información declarada no se ajusta a la verdad, el declarante queda sujeto a proceso disciplinario sancionador por parte del IESTP HUANTA.</p>
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">DATOS GENERALES DEL ESTUDIANTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3"><b>Apellidos y Nombres</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><input type="text" class="form-control" disabled></td>
                                                </tr>
                                                <tr>
                                                    <td>DNI</td>
                                                    <td>Fecha de Nacimiento</td>
                                                    <td>Género</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">Dirección (*)</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><input type="text" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>Correo Electrónico</td>
                                                    <td>Teléfono</td>
                                                    <td>Discapacidad</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                    <td>
                                                        <select name="" id="" class="form-control" disabled>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Año de Ingreso</td>
                                                    <td>Programa de Estudios</td>
                                                    <td>Semestre</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                    <td><input type="text" class="form-control" disabled></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                    <th colspan="5">DATOS FAMILIARES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Miembros de mi familia</th>
                                                    <th>Edad</th>
                                                    <th>Apellidos y Nombres</th>
                                                    <th>Grado de Instrucción Ocupación</th>
                                                    <th>A que se Dedica?</th>
                                                </tr>
                                                <tr>
                                                    <th>Esposo(sa) o conviviente</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>1er Hijo</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>2do Hijo</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>Padre</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>Madre</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>1er Hermano</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>2do Hermano</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>3er Hermano</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>4to Hermano</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>5to Hermano</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                                <tr>
                                                    <th>6to Hermano</th>
                                                    <th><input type="number" class="form-control"></th>
                                                    <th><input type="text" class="form-control"></th>
                                                    <th>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select></th>
                                                    <th><input type="text" class="form-control"></th>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">COMO APOYA TU FAMILIA TU ROL COMO ESTUDIANTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="60%">a). Me orientan y aconsejan</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). No me dicen nada, parece que no les importa</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Se preocupan más por el dinero que pueda llevar a casa</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). No tengo familiares que me apoyen</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Otros (Mencionar)</td>
                                                    <td><input type="text" class="form-control" placeholder="Mencionar"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">HABITOS DE ESTUDIO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Gestionas adecuadamente tus tiempos y horarios de estudio</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tienes un lugar para estudiar</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Prefieres estudiar con música</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Después de leer haces un esquema o resumen de lo leído</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Comparas sus anotaciones con la de otros/as compañeros/as</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Mantienes la concentración hasta terminar el trabajo o lectura que te has propuesto</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Usas fichas bibliograficas para tomar apuntes</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Usas el diccionario para buscar el significado de las palabras que no conoces</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Manejas programas de busqueda de infromacion por internet</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Buscas informacion en bibliotecas</td>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                            <option value="">SI</option>
                                                            <option value="">NO</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">CUAL ES LA RAZON MAS IMPORTANTE POR LA QUE QUIERES ESTUDIAR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="60%">a). Para ayudar a mi familia</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Para mejorar personal y profesionalmente</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Para ayudar en el desarrollo de mi comunidad y Región</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Otros (Mencionar)</td>
                                                    <td><input type="text" class="form-control" placeholder="Mencionar"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">QUE COSAS AFECTAN TU APRENDIZAJE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="60%">a). Las necesidades economicas</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). El no tener familia</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). El idioma</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Otros (Mencionar)</td>
                                                    <td><input type="text" class="form-control" placeholder="Mencionar"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">PRINCIPALES PASATIEMPOS, HOBBIES, ETC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="60%">a). Deporte: vóley, futbol, etc.</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Pasear, caminar.</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). La música.</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Ver peliculas, el cine.</td>
                                                    <td><input type="checkbox" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>a). Otros (Mencionar)</td>
                                                    <td><input type="text" class="form-control" placeholder="Mencionar"></td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />



                                        <div class="x_panel">


                                            <div class="x_content">
                                                <br />
                                                <form role="form" action="operaciones/actualizar_estudiante.php" class="form-horizontal form-label-left input_mask" method="POST" enctype="multipart/form-data">






                                                    <div align="center">
                                                        <a class="btn btn-danger" href="estudiante.php"> Cancelar</a>
                                                        <button type="submit" class="btn btn-success">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <?php
                include("../include/footer.php");
                ?>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="../Gentella/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../Gentella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../Gentella/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../Gentella/vendors/nprogress/nprogress.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../Gentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../Gentella/vendors/iCheck/icheck.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../Gentella/vendors/moment/min/moment.min.js"></script>
        <script src="../Gentella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="../Gentella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../Gentella/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../Gentella/vendors/google-code-prettify/src/prettify.js"></script>
        <!-- jQuery Tags Input -->
        <script src="../Gentella/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <!-- Switchery -->
        <script src="../Gentella/vendors/switchery/dist/switchery.min.js"></script>
        <!-- Select2 -->
        <script src="../Gentella/vendors/select2/dist/js/select2.full.min.js"></script>
        <!-- Parsley -->
        <script src="../Gentella/vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Autosize -->
        <script src="../Gentella/vendors/autosize/dist/autosize.min.js"></script>
        <!-- jQuery autocomplete -->
        <script src="../Gentella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <!-- starrr -->
        <script src="../Gentella/vendors/starrr/dist/starrr.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../Gentella/build/js/custom.min.js"></script>


        <!--prueba tabla-->

        <script src="../include/tabla/jquery.dataTables.min.js"></script>
        <script src="../include/tabla/dataTables.bootstrap.min.js"></script>

        <!--script para obtener los modulos dependiendo de la carrera que seleccione-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#carrera_m').change(function() {
                    recargarlista();
                });
            })
        </script>
        <script type="text/javascript">
            function recargarlista() {
                $.ajax({
                    type: "POST",
                    url: "operaciones/obtener_modulos.php",
                    data: "id_carrera=" + $('#carrera_m').val(),
                    success: function(r) {
                        $('#modulo').html(r);
                    }
                });
            }
        </script>

        <?php mysqli_close($conexion); ?>
    </body>

    </html>
<?php
}
