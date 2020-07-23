<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>

<body>
  <?php
  //////////////////si reinicio la pagina se repite el ultimo array en la lista de arrays
  include('header.php');
  require_once 'codigo.php';
  require_once 'estuServicesCookies.php';
  require_once 'estudiantesPOO.php';

  $codigo = new codigo();
  $service = new estuServicesCookies();
  $list = $service->GetList();


  if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["status"]) && isset($_POST["carrera"]) && isset($_FILES["profilePhoto"])) { //Verificamos que todos los elementos esten

    $newEstu = new estudiantesPOO();

    $newEstu->InicializeData(0, $_POST["nombre"], $_POST["apellido"], $_POST["status"], $_POST["carrera"], $_FILES["profilePhoto"]);

    $service->Add($newEstu);


    header("location:/RegistroItla/estudiantes.php");
  }
  ?>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Id#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Status</th>
        <th scope="col">Carrera</th>
        <th scope="col">Foto de perfil</th>
        <th scope="col">Editar</th>
        <th scope="col">Borrar</th>
        <th scope="col">
          <form action="Estudiantes.php" enctype="multipart/form-data" id="filtro" class="text-right">
            <select name="filtro" onchange="document.getElementById('filtro').submit();">
              <option value="">Filtrar por carrera</option>
              <?php foreach ($codigo->carreras as $id => $text) : ?>
                <option value="<?php echo $text ?>"><?php echo "{$text}" ?></option>"
              <?php endforeach ?>
            </select>
            <!-- <button type="submit" class="btn btn-success">Filtrar</button> -->
          </form>
        </th>

      </tr>
    </thead>
    <?php if (!empty($list)) : ?>

      <?php foreach ($list as $estudiante) : ?>
        <?php if (!isset($_GET['filtro'])  || $_GET['filtro'] === $estudiante->carrera) : ?>
        <!-- estudiar condicion 41 -->
        <tbodyd
          <tr>
            <th><?php echo $estudiante->id; ?></th>
            <td><?php echo $estudiante->nombre; ?></td>
            <td><?php echo $estudiante->apellido; ?></td>
            <td><?php echo $estudiante->status; ?></td>
            <td><?php echo $estudiante->carrera; ?></td>
            <td><img style="border: 5px solid grey;" src="<?php echo $estudiante->profilePhoto; ?>" width="160px" height="200px" aria-label="placeholder:Thumbnail"></td>

            <td><a href="editar.php?id=<?php echo $estudiante->id; ?>" class="btn btn-primary">editar</a></td>
            <td><a href="delete.php?id=<?php echo $estudiante->id; ?>" class="btn btn-danger">Borrar</a></td> 
        </tr>
        </tbody>
        <?php endif ?>
      <?php endforeach ?>
    <?php else : ?>
      <h2>No hay estudiantes</h2>
      <a href="registro.php" class="btn btn-warning">Crear nuevo estudiante</a>
    <?php endif ?>
   
  </table>

  </div>

</body>
<?php
include('footer.php');
?>

</html>