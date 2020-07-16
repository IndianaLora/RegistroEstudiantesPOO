<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registros</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>


<body>
  <?php

  include('header.php');
  include('codigo.php');
  session_start();
  //verbos HTTP
  //Si es usado 
  if($_SERVER['REQUEST_METHOD']==='POST')
  {
    procesarRegistro();
  }
  ?>
<div class="registro">
  <div id="container">

    <div class="formulario center">
      <h1 class="text-center">Registro de estudiantes itla </h1>
      <div class="form-group">
        <!--Get Post redirect-->
        <form action="registro.php" method="POST" name="estudiantes">
          <!--POST se utiliza para los form siempre -->
          </br>
          <table align="center">
            <th><label for="">Nombre</label>
            <td><input type="text" name="nombre" id="" class="form-control"></td>
            <tr>


              <th><label for="">Apellido</label>
              <td><input type="text" name="apellido" class="form-control"></td>
            <tr>
              <th><label for="">Status</label>
              <td><input type="text" name="status" class="form-control" rows="3"></td>
            <tr>
              <th><label for="">Carrera</label>
              <td><select name="carrera" id="carrera">

                  <?php foreach ($carreras as $id => $text) : ?>

                    <option value="<?php echo $text ?>"><?php echo "{$text}" ?></option>
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
</body>


</html>