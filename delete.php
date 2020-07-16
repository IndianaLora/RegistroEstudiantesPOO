<?php
include 'codigo.php';
session_start();
$estudiantes = $_SESSION['estudiantes'];
if(isset($_GET['id'])){
    $estudiantesId=$_GET['id'];
    $elementIndex=delete($estudiantes,'id',$estudiantesId);
    unset($estudiantes[$elementIndex]);
    $_SESSION['estudiantes']=$estudiantes;
   }

header("Location:Estudiantes.php");
exit();

?>