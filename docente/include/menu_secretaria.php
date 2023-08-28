<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
   <!-- <div class="navbar nav_title" style="border: 0;">
      <a href="index.php" class=""><i class=""></i> <span>Biblioteca</span></a>
    </div>-->
    <?php 
    $busc_user_sesion = buscarDocenteById($conexion, $id_docente_sesion);
    $res_b_u_sesion = mysqli_fetch_array($busc_user_sesion);
    $b_m_per_act = buscarPresentePeriodoAcad($conexion);
    $r_b_m_per_act = mysqli_fetch_array($b_m_per_act);
    $id_per_act_m = $r_b_m_per_act['id_periodo_acad'];
    ?>
    <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../img/logo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo $res_b_u_sesion['apellidos_nombres']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu de Navegación</h3>
                <ul class="nav side-menu">
                  <li><a href="../docente/"><i class="fa fa-home"></i>Inicio</a>
                  </li>
                  <li><a><i class="fa fa-calendar"></i> Planificacion <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="periodo_academico.php">Periodos Academicos</a></li>
                      <li><a href="presente_periodo.php">Datos del Presente Academico</a></li>
                      <li><a href="programacion.php">Programacion de Clases</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-check-square-o"></i> Matrículas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="matriculas.php">Registro de Matrícula</a></li>
                      <li class="sub_menu"><a href="licencias.php">Licencias</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> Docentes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="docentes.php">Relación de Docentes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-graduation-cap"></i> Estudiantes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="estudiante.php">Relación de Estudiantes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Evaluación <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="calificaciones_unidades_didacticas.php">Registro de Evaluación</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-gears"></i>Mantenimiento<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="datos.php">Datos Institucionales</a></li>
                      <li><a href="programa_estudio.php">Programas de estudio</a></li>
                      <li><a href="modulo_formativo.php">Módulos Formativos</a></li>
                      <li><a href="semestre.php">Semestre</a></li>
                      <li><a href="unidad_didactica.php">Unidades Didacticas</a></li>
                      <li><a href="competencias.php">Competencias</a></li>
                      <li><a href="capacidades.php">Capacidades</a></li>
                      <li><a href="cargo.php">Cargos</a></li>
                      <li><a href="sistema.php">Sistema</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons 
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Configuración" href="sistema.php">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="../../include/cerrar_sesion.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            /menu footer buttons -->
  </div>
</div>
<!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../img/no-image.jpeg" alt=""><?php echo $res_b_u_sesion['apellidos_nombres']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <a href="login/enviar_correo.php"> Cambiar mi contraseña</a></li>
                    <li><a href="../include/cerrar_sesion.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                  </ul>
                </li>
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php 
                    $busc_per_id = buscarPeriodoAcadById($conexion, $_SESSION['periodo']);
                    $res_busc_per_id = mysqli_fetch_array($busc_per_id);
                    echo $res_busc_per_id['nombre']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <?php
                    $buscar_periodos = buscarPeriodoAcademicoInvert($conexion);
                    while ($res_busc_periodos = mysqli_fetch_array($buscar_periodos)) {
                      ?>
                    <li><a href="operaciones/actualizar_sesion_periodo.php?dato=<?php echo $res_busc_periodos['id']; ?>"><?php if($res_busc_periodos['id']==$id_per_act_m){ echo "<b>";}?><?php echo $res_busc_periodos['nombre']; ?><?php if($res_busc_periodos['id']==$id_per_act_m){ echo "</b>";}?></a></li>
                      <?php
                    }
                    ?>
                  </ul>
                </li>
                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->