<?php
require_once 'Iservices.php';
class estuServicesCookies implements Iservices
{
    private $codigo;
    private $cookieName;

    public function __construct()
    {
        $this->codigo = new Codigo();
        $this->cookieName = 'estudiantes';
    }
    public function GetList()
    {

        $listadoEstudiantes = array();
        if (isset($_COOKIE[$this->cookieName])) {
            $listadoEstudiantesDecode = json_decode($_COOKIE[$this->cookieName], false);
            foreach ($listadoEstudiantesDecode as $elementDecode) {
                $element = new estudiantesPOO();
                $element->set($elementDecode);
                array_push($listadoEstudiantes, $element);
            }
        } else {
            setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->codigo->GetCookieTime(), "/");
        }
        return $listadoEstudiantes;
    }
    public function GetbyId($id)
    {
        $listadoEstudiantes = $this->GetList();
        $elementDecode = $this->codigo->edit($listadoEstudiantes, 'id', $id)[0];
        $estudiantes = new estudiantesPOO();
        $estudiantes->set($elementDecode);
        return $estudiantes;
    }
    public function Add($entity)
    {

        $listadoEstudiantes = $this->GetList();
        $estudiantesId = 1;
        if (!empty($listadoEstudiantes)) {
            $ultimoEstudiante = $this->codigo->ultimaPosicion($listadoEstudiantes);
            $estudiantesId = $ultimoEstudiante->id + 1;
        }
        $entity->id = $estudiantesId;
        $entity->profilephoto = "";

        $photoFile = $_FILES['profilePhoto'];
        if (isset($photoFile)) {


            if ($photoFile['error'] == 4) {
                $entity->profilePhoto = "";
            } else {
                $typeReplace = str_replace("image/","", $photoFile['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $nombre = "img/estudiantes/" . $estudiantesId . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $succes = $this->codigo->uploadImage('img/estudiantes/', $nombre, $tmpname, $type, $size);

                if ($succes) {
                    $entity->profilePhoto =$nombre;
                }
            }
        }
        array_push($listadoEstudiantes, $entity);
        setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->codigo->GetCookieTime(), "/");
    }
    public  function Update($id, $entity)
    {

        $element = $this->GetbyId($id);
        $listadoEstudiantes = $this->GetList();

        $elementIndex = $this->codigo->delete($listadoEstudiantes, 'id', $id);

        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];
            if ($photoFile['error'] == 4) {
                $entity->profilePhoto = $element->profilePhoto;
            }

            $typeReplace = str_replace("image/", "",$photoFile['type']);
            $type = $photoFile['type'];
            $size = $photoFile['size'];
            $nombre = "img/estudiantes/" .$id . '.' . $typeReplace;
            $tmpname = $photoFile['tmp_name'];

            $succes = $this->codigo->uploadImage('img/estudiantes/', $nombre, $tmpname, $type, $size);

            if ($succes) {
                $entity->profilePhoto = $nombre;
            }
        }

        $listadoEstudiantes[$elementIndex] = $entity;

        setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->codigo->GetCookieTime(), "/");
    }
    public function Delete($id)
    {
        $listadoEstudiantes = $this->GetList();
        $elementIndex = $this->codigo->delete($listadoEstudiantes, 'id', $id);
        unset($listadoEstudiantes[$elementIndex]);
        $listadoEstudiantes = array_values($listadoEstudiantes);
        setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->codigo->GetCookieTime(), "/");
    }
}
