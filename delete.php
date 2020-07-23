<?php
require_once 'codigo.php';
require_once 'estudiantesPOO.php';
require_once 'estuServicesCookies.php';


$service = new estuServicesCookies();
$isContaintId= isset($_GET['id']);

if($isContaintId){
    $estudiantesId=$_GET['id'];
    $service->Delete($estudiantesId);
   }

header("Location:Estudiantes.php");
exit();

?>