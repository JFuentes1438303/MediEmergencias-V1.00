<?php  
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>MediEmergencias</title>
      <!-- Bootstrap core CSS -->
      <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="../../css/simple-sidebar.css" rel="stylesheet">
      <link href="../../css/estilos.css" rel="stylesheet" >
      <script src="https:kit.fontawesome.com/2c36e9b7b1.js"></script>
    </head>

<body>

    <div class="d-flex toggled" id="wrapper">

      <!-- Sidebar -->
      <div class="border-right" id="sidebar-wrapper">

        <div style="text-align: center; border-bottom: 2px solid #818181; background: #000;">
            <img src="../../files/img/logoem2.jpg" style="width:240px; height: 61px">
        </div>

        <div class="list-group list-group-flush">
          <a href="../views/pacientes.php" class="list-group-item list-group-item-action enlaces">Paciente</a>
          <a href="#" class="list-group-item list-group-item-action enlaces">Historia clinica</a>
          <a href="#" class="list-group-item list-group-item-action enlaces">Cuerpo de atencion</a>
          <a href="#" class="list-group-item list-group-item-action enlaces">Enfermedades</a>
          <a href="#" class="list-group-item list-group-item-action enlaces">Alertas</a>
          <a href="#" class="list-group-item list-group-item-action enlaces">Examenes</a>
          <a href="#" class="list-group-item list-group-item-action enlaces">Antecedentes</a>
          <a href="#" class="list-group-item list-group-item-action enlaces">Sintomas</a>
          <div style="background: #f2f2f2; text-align: center;">
            <img src="../../files/img/logoEM.png" class="logo2">
          </div>
        </div>
      </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light" style="border-bottom: 2px solid #818181; background: #F70501">
        <button class="btn boton_menu" id="menu-toggle">
          <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link perfil boton_perfil" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Mi Perfil   <i class="fas fa-angle-double-down"></i>
              </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <p class="dropdown-item desplegable">
                <?php 
                  echo " ".$_SESSION["primer_nombre"]." ".$_SESSION["primer_apellido"];
                ?>
              </p>
              <a class="dropdown-item desplegable" href="../views/actualizar.php">Actualizar</a>
              <a class="dropdown-item desplegable" href="../models/cerrar_sesion.php">Cerrar Sesion</a>
            </div>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <?php  

          class Actualizacion{
            public function actualizar($tipo_documento, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $sexo, $fecha_nacimiento, $direccion, $telefono){

              include("../models/conexion.php");

              $doc_perfil = $_SESSION["documento"];

              $sql = "UPDATE usuario_paciente SET tipo_documento = '$tipo_documento', primer_nombre = '$primer_nombre', segundo_nombre = '$segundo_nombre', primer_apellido = '$primer_apellido', segundo_apellido = '$segundo_apellido', sexo = '$sexo', fecha_nacimiento = '$fecha_nacimiento', direccion = '$direccion', telefono = '$telefono' WHERE documento = '$doc_perfil'";

              if(!$result = $db ->query($sql)){
                die ('Hay un error en la consulta [' .$db->error .']');
              }

              $sql2 ="SELECT * FROM usuario_paciente WHERE documento = '$doc_perfil'";

              if(!$result2 = $db ->query($sql2)){
                die ('Hay un error en la consulta [' .$db->error .']');
              }

?>            <div class="table-responsive">
              <table class='table table-bordered tabla'>
              <th colspan='10' class="th bg-dark">
                REGISTRO ACTUALIZADO 
              </th>
              <tr>
              <td class="td">Tipo documento</th>
              <td class="td">Documento</th>
              <td class="td">Primer nombre</th>
              <td class="td">Segundo nombre</th>
              <td class="td">Primer apellido</th>
              <td class="td">Segundo apellido</th>
              <td class="td">Sexo</th>
              <td class="td">Fecha nacimiento</th>
              <td class="td">Direccion</th>
              <td class="td">Telefono</th>
              </tr>
              <tr>
<?php

              while($row2 = $result2->fetch_assoc()){
                $ttipo_documento = stripcslashes($row2["tipo_documento"]);
                $ddocumento = stripcslashes($row2["documento"]);
                $pprimer_nombre = stripcslashes($row2["primer_nombre"]);
                $ssegundo_nombre = stripcslashes($row2["segundo_nombre"]);
                $pprimer_apellido = stripcslashes($row2["primer_apellido"]);
                $ssegundo_apellido = stripcslashes($row2["segundo_apellido"]);
                $ssexo = stripcslashes($row2["sexo"]);
                $ffecha_nacimiento = stripcslashes($row2["fecha_nacimiento"]);
                $ddireccion = stripcslashes($row2["direccion"]);
                $ttelefono = stripcslashes($row2["telefono"]);

                echo "<tr>";
                echo "<td class='td'><select>";
                  $sql3 = "SELECT * FROM tipo_documento";
                  if(!$result3 = $db ->query($sql3)){
                    die ('Hay un error en la consulta [' .$db->error .']');
                  }
                  while($row3 = $result3->fetch_assoc()){
                    $iid_tipo_documento = stripcslashes($row3["id_tipo_documento"]);
                    $tttipo_documento = stripcslashes($row3["tipo_documento"]);

                    if($iid_tipo_documento==$ttipo_documento){
                      echo"<option value=$iid_tipo_documento SELECTED>$tttipo_documento</option>";
                    } 
                  }

                  echo "</select></td>";
                  echo "<td class='td'>$ddocumento</td>";
                  echo "<td class='td'>$pprimer_nombre</td>";
                  echo "<td class='td'>$ssegundo_nombre</td>";
                  echo "<td class='td'>$pprimer_apellido</td>";
                  echo "<td class='td'>$ssegundo_apellido</td>";
                  echo "<td class='td'><select class='' name='sexo'>";
                  $sql4 = "SELECT * FROM sexo";
                  if(!$result4 = $db ->query($sql4)){
                    die ('Hay un error en la consulta [' .$db->error .']');
                  }
                  while($row4 = $result4->fetch_assoc()){
                    $iid_sexo = stripcslashes($row4["id_sexo"]);
                    $sssexo = stripcslashes($row4["sexo"]);

                    if($iid_sexo==$ssexo){
                      echo"<option value=$iid_sexo SELECTED>$sssexo</option>";
                    } 
                  }
                  echo "</select></td>";
                  echo "<td class='td'>$ffecha_nacimiento</td>";
                  echo "<td class='td'>$ddireccion</td>";
                  echo "<td class='td'>$ttelefono</td>";
                 
              }
?>      
          <tr class="td">
          <td colspan="10">
            <a href="../views/home.php" class="btn btn-sm btn-dark">Volver</a>
          </td>
          </table>
          <br> 
            
<?php
        }
      }
            $nuevo = new Actualizacion();
            $nuevo->actualizar($_POST['tipo_documento'], $_POST["primer_nombre"], $_POST["segundo_nombre"], $_POST["primer_apellido"], $_POST["segundo_apellido"], $_POST["sexo"], $_POST["fecha_nacimiento"], $_POST["direccion"], $_POST["telefono"]); 

?>  
      <!-- Bootstrap core JavaScript -->
      <script src="../../vendor/jquery/jquery.min.js"></script>
      <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Menu Toggle Script -->
      <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
      </script>

  </body>
</html>