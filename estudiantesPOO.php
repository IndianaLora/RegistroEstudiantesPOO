<?php
class estudiantesPOO
{
    public $id;
    public $nombre;
    public $apellido;
    public $status;
    public $carrera;
    public $carreraId;
    public $profilePhoto;

    private $codigo;
    public function __construct()
    {
        $this->codigo = New codigo();
    }
    public function InicializeData($id, $nombre,$apellido, $status, $carrera,$profilePhoto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->status = $status;
        $this->carrera = $carrera;
       
        // $this->estudiantesId=$estudiantesId;
    }
    public function set($data){
        foreach($data as $key => $value) $this ->{$key }= $value;

        
    }
}
