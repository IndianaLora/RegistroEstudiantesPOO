<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php

include('header.php');
require_once 'estuServicesCookies.php';
require_once 'estudiantesPOO.php';
require_once 'codigo.php';
$service = new estuServicesCookies();
$codigo = new Codigo();

if (isset($_GET['id'])) {
  $estudiantesId = $_GET['id'];

  $element=$service->GetbyId($estudiantesId);

  if (isset($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["status"]) && !empty($_POST["carrera"]&& !empty($_FILES["profilePhoto"]))) { //Verificamos que todos los elementos esten

       $updaEstu= new estudiantesPOO();
       $updaEstu->InicializeData($estudiantesId,$_POST["nombre"],$_POST["apellido"],$_POST["status"],$_POST["carrera"],$_FILES["profilePhoto"]);
       $service->Update($estudiantesId,$updaEstu);

    header("location:/RegistroItla/estudiantes.php");
  }
} else {
  header("location:estudiantes.php");
}
class editar{
  
}
?>
<div class="registro">
  <div id="container" style="background-color: rgb(129, 182, 129);">

    <div class="formulario center" style="background-color: rgb(78, 133, 78);">
      <h1 class="text-center">Edicion del registro </h1>
      <div class="form-group">
        <!--Get Post redirect-->
        <form action="editar.php?id=<?php echo $element->id ?>" enctype="multipart/form-data" method="POST" name="estudiantes">
          <!--POST se utiliza para los form siempre -->
          </br>
          <table align="center">
            <th><label for="">Nombre</label>
            <td><input type="text" value="<?php echo $element->nombre; ?>" name="nombre" id="" class="form-control"></td>
            <tr>


              <th><label for="">Apellido</label>
              <td><input type="text" value="<?php echo $element->apellido; ?>" name="apellido" class="form-control"></td>
            <tr>
              <th><label for="">Status</label>
              <td><input type="text" value="<?php echo $element->status; ?>" name="status" class="form-control" rows="3"></td>
            <tr>
              <th><label for="">Carrera</label>
              <td><select name="carrera" id="carrera">

                  <?php foreach ($codigo->carreras as $id => $text) : ?>
                    <?php if ($id == $element->carrera) : ?>
                      <option selected value="<?php echo $text ?>"><?php echo "{$text}" ?></option>
                    <?php else : ?>
                      <option value="<?php echo $text ?>"><?php echo "{$text}" ?></option>
                    <?php endif ?>

                  <?php endforeach; ?>

                </select>
              </td>
            <tr>
            <th>
              <tr>
              <th><label for="photo">Foto de perfil</label>
              <td><input type="file" name="profilePhoto" class="form-control" rows="3"></td>
            <tr>
              </th>
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