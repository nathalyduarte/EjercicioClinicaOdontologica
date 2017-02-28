<?php

/**
 * Created by PhpStorm.
 * User: CAPACITACION-PC
 * Date: 16/2/2017
 * Time: 22:07
 */
require_once('db_abstract_class.php');

class Especialista extends db_abstract_class
{

    private $idEspecialista;
    private $Tipo;
    private $Nombre;
    private $Apellido;
    private $Documento;
    private $TipoDocumento;
    private $Email;
    private $Direccion;
    private $Genero;
    private $Telefono;
    private $Estado;






    public function __construct($odontologos_data=array())
    {
        parent::__construct();
        if(count($odontologos_data)>1){
            foreach ($odontologos_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idEspecialista = "";
            $this->Tipo = "";
            $this->Nombre = "";
            $this->Apellido = "";
            $this->Documento = "";
            $this->TipoDocumento = "";
            $this->Email = "";
            $this->Direccion = "";
            $this->Genero = "";
            $this->Telefono = "";
            $this->Estado = "";

        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }

    /**
     * @return mixed
     */
    public function getIdEspecialista()
    {
        return $this->idEspecialista;
    }

    /**
     * @param mixed $idEspecialista
     */
    public function setIdEspecialista($idEspecialista)
    {
        $this->idEspecialista = $idEspecialista;
    }



    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * @param mixed $idEspecialista
     */
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;
    }
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombres
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * @param mixed $Apellido
     */
    public function setApellido($Apellido)
    {
        $this->Apellido = $Apellido;
    }

    /**
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->Documento;
    }

    /**
     * @param mixed $Documento
     */
    public function setDocumento($Documento)
    {
        $this->Documento = $Documento;
    }

    /**
     * @return mixed
     */
    public function getTipoDocumento()
    {
        return $this->TipoDocumento;
    }

    /**
     * @param mixed $TipoDocumento
     */
    public function setTipoDocumento($TipoDocumento)
    {
        $this->TipoDocumento = $TipoDocumento;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Direccion
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * @param mixed $Email
     */
    public function setDireccion($Direccion)
    {
        $this->Email = $Direccion;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->Genero;
    }

    /**
     * @param mixed $Genero
     */
    public function setGenero($Genero)
    {
        $this->Genero = $Genero;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param mixed $$this->Telefono
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }

    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param mixed $$this->Telefono
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    public static function buscarForId($id)
    {
        $Espec = new Especialista();
        if ($id > 0){
            $getrow = $Espec->getRow("SELECT * FROM odontologos.Especialista WHERE idEspecialista =?", array($id));
            $Espec->idEspecialista = $getrow['idEspecialista'];
            $Espec->Tipo = $getrow['Tipo'];
            $Espec->Nombre = $getrow['Nombre'];
            $Espec->Apellido = $getrow['Apellido'];
            $Espec->Documento = $getrow['Documento'];
            $Espec->TipoDocumento = $getrow['TipoDocumento'];
            $Espec->Email = $getrow['Email'];
            $Espec->Direccion = $getrow['Direccion'];
            $Espec->Genero = $getrow['Genero'];
            $Espec->Telefono= $getrow['Telefono'];
            $Espec->Estado= $getrow['Estado'];
            $Espec->Disconnect();
            return $Espec;
        }else{
            return NULL;
        }
    }

    protected static function buscar($query)
    {
        $arrEspecialistas = array();
        $tmp = new Especialista();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Espec = new Especialista();
            $Espec->idEspecialista = $valor['idEspecialista'];
            $Espec->Tipo = $valor['Tipo'];
            $Espec->Nombre = $valor['Nombre'];
            $Espec->Apellido = $valor['Apellido'];
            $Espec->Documento = $valor['Documento'];
            $Espec->TipoDocumento = $valor['TipoDocumento'];
            $Espec->Email = $valor['Email'];
            $Espec->Direccion = $valor['Direccion'];
            $Espec->Genero = $valor['Genero'];
            $Espec->Telefono = $valor['Telefono'];
            $Espec->Estado = $valor['Estado'];
            array_push($arrEspecialistas, $Espec);
        }
        $tmp->Disconnect();
        return $arrEspecialistas;
    }

    public static function getAll()
    {
        return Especialista::buscar("SELECT * FROM odontologos.Especialista");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO odontologos.Especialista VALUES ('NULL', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->Tipo,
                $this->Nombre,
                $this->Apellido,
                $this->Documento,
                $this->TipoDocumento,
                $this->Email,
                $this->Direccion,
                $this->Genero,
                $this->Telefono,
                $this->Estado,
            )
        );
        $this->Disconnect();
    }

public function editar()
    {

        $arrUser = (array) $this;
        $this->updateRow("UPDATE odontologos.Especialista SET Tipo=?, Nombre = ?, Apellido = ?, Documento = ?, TipoDocumento = ?, Email = ?, Direccion = ?,Genero = ?, Telefono = ?, Estado = ? WHERE idEspecialista = ?", array(

            $this->Tipo,
            $this->Nombre,
            $this->Apellido,
            $this->Documento,
            $this->TipoDocumento,
            $this->Email,
            $this->Direccion,
            $this->Genero,
            $this->Telefono,
            $this->Estado,
            $this->idEspecialista,
        ));
        $this->Disconnect();

    }



    public function getObjectPaciente(){
        return Paciente::buscarForId($this->idPaciente);
    }
    public function getObjectEspecialista(){
        return Especialista::buscarForId($this->idEspecialista);
    }

    function getCitas(){
        $arrCitas = "SELECT * FROM odontologos.cita WHERE idEspecialista=".$this->idEspecialista;
}

    protected function eliminar($id)
    {
        if ($id > 0){
            return $this->deleteRow("DELETE FROM odontologos.Especialista WHERE id = ?", array($id));
        }else{
            return false;
        }
    }





}