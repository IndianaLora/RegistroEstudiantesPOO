<?php
$carreras = [1 => "software", 2 => "multimedia", 3 => "manufactura", 4 => "sonido", 5 => "mecatronica"];
$estudiantesId = 0; //inicializamos la variable $estudiantesId para asignarle un ID unico y autoincrementable

function procesarRegistro()
{
    $estudiantes = [];
    if (($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["status"]) && !empty($_POST["carrera"])) { //Verificamos que todos los elementos esten
        $_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array(); //Le damos nombre a la seccion y preguntamos si existe, debemos crear un array
        $estudiantes = $_SESSION['estudiantes']; //Almacenamos las sessiones ['estudiantes'] en el array $estudiantes


        if (!empty($estudiantes)) {
            $ultimaPosicion = ultimaPosicion($estudiantes);
            $estudiantesId = $ultimaPosicion['id'] + 1;
        }
        array_push($estudiantes, [
            'id' => $estudiantesId,
            'nombre' => $_POST["nombre"],
            'apellido' => $_POST["apellido"],
            'status' => $_POST["status"],
            'carrera' => $_POST["carrera"]
        ]);

        $_SESSION['estudiantes'] = $estudiantes; //Actualizamos la variable estudiante
        header("location: /RegistroItla/Estudiantes.php");
    }
}
//Analizar esto 
function getEstudiantes()
{
    return $_SESSION['estudiantes'];
}
//Para obtener la ultima posicion en un array

function ultimaPosicion($lista)
{
    $cuentaElementos = count($lista); //Haces una lista que cuente todos los elementos
    $ultimaPosicion = $lista[$cuentaElementos - 1]; //A ese ultimo elemento le restas uno ya que los arrays comienzan en [0]
    return $ultimaPosicion; //retornas el resultado

}

function delete($lista, $propiedad, $valor)
{

    $index = 0;
    foreach ($lista as $key  => $elemento) {
        if ($elemento[$propiedad] == $valor) {
            $index = $key;
        }
    }
    return $index;
}
function edit($array, $atributo, $value)
{

    $edit = [];
    foreach ($array as $objeto) {
        if ($objeto[$atributo] == $value) {
            array_push($edit,$objeto);
        }
    }
    return $edit;
}
?>

</div>