<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php
include('codigo.php');
include('header.php');
session_start();
if (isset($_GET['id'])) {
  $estudiantesId = $_GET['id'];

  $_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array(); //Le damos nombre a la seccion y preguntamos si existe, debemos crear un array
  $estudiantes = $_SESSION['estudiantes'];

  $editar = edit($estudiantes, 'id', $estudiantesId)[0];
  $editarIndex = delete($estudiantes, 'id', $estudiantesId);


  if (isset($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["status"]) && !empty($_POST["carrera"])) { //Verificamos que todos los elementos esten



    $estudianteEditado = [
      'id' => $estudiantesId,
      'nombre' => $_POST["nombre"],
      'apellido' => $_POST["apellido"],
      'status' => $_POST["status"],
      'carrera' => $_POST["carrera"]
    ];
    $estudiantes[$editarIndex] = $estudianteEditado;

    $_SESSION['estudiantes'] = $estudiantes; //Actualizamos la variable estudiante
    header("location: /RegistroItla/Estudiantes.php");
  }
} else {
  header("location:estudiantes.php");
}
?>
<div class="registro">
  <div id="container" style="background-color: rgb(129, 182, 129);">

    <div class="formulario center" style="background-color: rgb(78, 133, 78);">
      <h1 class="text-center">Edicion del registro </h1>
      <div class="form-group">
        <!--Get Post redirect-->
        <form action="editar.php?id=<?php echo $editar['id'] ?>" method="POST" name="estudiantes">
          <!--POST se utiliza para los form siempre -->
          </br>
          <table align="center">
            <th><label for="">Nombre</label>
            <td><input type="text" value="<?php echo $editar['nombre'] ?>" name="nombre" id="" class="form-control"></td>
            <tr>


              <th><label for="">Apellido</label>
              <td><input type="text" value="<?php echo $editar['apellido'] ?>" name="apellido" class="form-control"></td>
            <tr>
              <th><label for="">Status</label>
              <td><input type="text" value="<?php echo $editar['status'] ?>" name="status" class="form-control" rows="3"></td>
            <tr>
              <th><label for="">Carrera</label>
              <td><select name="carrera" id="carrera">

                  <?php foreach ($carreras as $id => $text) : ?>
                    <?php if ($id == $editar['carrera']) : ?>
                      <option selected value="<?php echo $text ?>"><?php echo "{$text}" ?></option>
                    <?php else : ?>
                      <option value="<?php echo $text ?>"><?php echo "{$text}" ?></option>
                    <?php endif ?>

                  <?php endforeach; ?>

                </select>
              </td>
            <tr>
              <th>
              </th>
          </table>
          <button type="submit" name="submit" class="btn btn-success float-right" onclick="estudiantes.php">Guardar</button>

        </form>
      </div>
    </div>
  </div>
</div>

<?php

include('footer.php');
?>