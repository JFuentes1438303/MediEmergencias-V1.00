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

          class Datos{
            public function mostrar($doc_perfil){

              include("../models/conexion.php");

              $_SESSION["documento"] = $doc_perfil;
              $cont = "0";

              $sql = "SELECT * FROM usuario_paciente WHERE documento = '$doc_perfil'";

              if(!$result = $db ->query($sql)){
                die ('Hay un error en la consulta [' .$db->error .']');
              }

              while($row = $result->fetch_assoc()){
                $ttipo_documento = stripcslashes($row["tipo_documento"]);
                $ddocumento = stripcslashes($row["documento"]);
                $pprimer_nombre = stripcslashes($row["primer_nombre"]);
                $ssegundo_nombre = stripcslashes($row["segundo_nombre"]);
                $pprimer_apellido = stripcslashes($row["primer_apellido"]);
                $ssegundo_apellido = stripcslashes($row["segundo_apellido"]);
                $ssexo = stripcslashes($row["sexo"]);
                $ffecha_nacimiento = stripcslashes($row["fecha_nacimiento"]);
                $ddireccion = stripcslashes($row["direccion"]);
                $ttelefono = stripcslashes($row["telefono"]);
                $cont=$cont+1;
              }

              if ($cont == "0") {
                include("../views/a_danger.html");
              }

              if ($cont!="0") {

?>        <div class="table-responsive">
          <form action='../controllers/actualizar.php' method='POST'>
          <table class='table table-bordered tabla'>
          <th colspan='10' class="th bg-dark">
            ACTUALIZAR INFORMACION DEL USUARIO 
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
          echo "<td class='td'><select class='' name='tipo_documento' >";

          $sql2 = "SELECT * FROM tipo_documento";

            if(!$result2 = $db ->query($sql2)){
              die ('Hay un error en la consulta [' .$db->error .']');
            }

            while($row2 = $result2->fetch_assoc()){
              $iid_tipo_documento = stripcslashes($row2["id_tipo_documento"]);
              $tttipo_documento = stripcslashes($row2["tipo_documento"]);

              if($iid_tipo_documento==$ttipo_documento){
                echo"<option value=$iid_tipo_documento SELECTED>$tttipo_documento</option>";
              } else{
                  echo"<option value=$iid_tipo_documento>$tttipo_documento</option>"; 
                }
            }
 ?>
              </td>

              <td class="td">
                <?php echo $ddocumento ?>
              </td>

              <td class="td">
                <input type="text" name="primer_nombre" value="<?php echo $pprimer_nombre ?>">
              </td>

              <td class="td">
                <input type="text" name="segundo_nombre" value="<?php echo $ssegundo_nombre ?>">
              </td>

              <td class="td">
                <input type="text" name="primer_apellido" value="<?php echo $pprimer_apellido ?>">
              </td>

              <td class="td">
                <input type="text" name="segundo_apellido" value="<?php echo $ssegundo_apellido ?>">
              </td>

<?php         
          echo "<td class='td'><select class='' name='sexo'>";

          $sql3 = "SELECT * FROM sexo";

            if(!$result3 = $db ->query($sql3)){
              die ('Hay un error en la consulta [' .$db->error .']');
            }

            while($row3 = $result3->fetch_assoc()){
              $iid_sexo = stripcslashes($row3["id_sexo"]);
              $ssexo = stripcslashes($row3["sexo"]);

              if($iid_sexo==$ssexo){
                echo"<option value=$iid_sexo SELECTED>$ssexo</option>";
              } else{
                  echo"<option value=$iid_sexo>$ssexo</option>"; 
                }
            }
 ?>
              </select>
              </td>

              <td class="td">
                <input type="date" name="fecha_nacimiento" value="<?php echo $ffecha_nacimiento ?>">
                
              </td>

              <td class="td">
                <input type="text" name="direccion" value="<?php echo $ddireccion ?>
">
              </td>

              <td class="td">
                <input type="text" name="telefono" value="<?php echo $ttelefono ?>">
                
              </td>

              <tr class="td">
                <td class="" colspan='10'>
                  <input class='btn btn-sm btn-dark' type='submit' value='Actualizar'></td>
                </td>
              </tr>
              </table>
              </form>
            <br>
<?php             
      } 
    }
  }
            $nuevo = new Datos();
            $nuevo->mostrar($_POST['doc_perfil']);   
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