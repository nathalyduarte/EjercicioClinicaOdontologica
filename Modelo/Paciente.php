<?php

/**
 * Created by PhpStorm.
 * User: CAPACITACION-PC
 * Date: 16/2/2017
 * Time: 22:07
 */
require_once('db_abstract_class.php');

class Paciente extends db_abstract_class
{

    private $idPaciente;
    private $Nombre;
    private $Apellidos;
    private $Documento;
    private $TipoDocumento;
    private $Direccion;
    private $Email;
    private $Genero;
    private $Estado;


    public function __construct($Odontologos_data=array())
    {
        parent::__construct();
        if(count($Odontologos_data)>1){
            foreach ($Odontologos_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idPaciente = "";
            $this->Nombre = "";
            $this->Apellidos = "";
            $this->Documento = "";
            $this->TipoDocumento = "";
            $this->Direccion = "";
            $this->Email = "";
            $this->Genero = "";
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
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * @param mixed $idPaciente
     */
    public function setIdPaciente($idPaciente)
    {
        $this->idPaciente = $idPaciente;
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
    public function getApellidos()
    {
        return $this->Apellidos;
    }

    /**
     * @param mixed $Apellidos
     */
    public function setApellidos($Apellidos)
    {
        $this->Apellidos = $Apellidos;
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
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * @param mixed $Direccion
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
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
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param mixed $Estado
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    public static function buscarForId($id)
    {
        $pacien = new Paciente();
        if ($id > 0){
            $getrow = $pacien->getRow("SELECT * FROM Odontologos.paciente WHERE idPaciente =?", array($id));
            $pacien->idPaciente = $getrow['idPaciente'];
            $pacien->Nombre = $getrow['Nombre'];
            $pacien->Apellidos = $getrow['Apellidos'];
            $pacien->Documento = $getrow['Documento'];
            $pacien->TipoDocumento = $getrow['TipoDocumento'];
            $pacien->Direccion = $getrow['Direccion'];
            $pacien->Email = $getrow['Email'];
            $pacien->Genero = $getrow['Genero'];
            $pacien->Estado = $getrow['Estado'];
            $pacien->Disconnect();
            return $pacien;
        }else{
            return NULL;
        }
    }
//ho
    protected static function buscar($query)
    {
        $arrPacientes = array();
        $tmp = new Paciente();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $pacien = new Paciente();
            $pacien->idPaciente = $valor['idPaciente'];
            $pacien->Nombre = $valor['Nombre'];
            $pacien->Apellidos = $valor['Apellidos'];
            $pacien->Documento = $valor['Documento'];
            $pacien->TipoDocumento = $valor['TipoDocumento'];
            $pacien->Direccion = $valor['Direccion'];
            $pacien->Email = $valor['Email'];
            $pacien->Genero = $valor['Genero'];
            $pacien->Estado = $valor['Estado'];
            array_push($arrPacientes, $pacien);
        }
        $tmp->Disconnect();

        return $arrPacientes;
    }

    public static function getAll()
    {
        return Paciente::buscar("SELECT * FROM Odontologos.paciente");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO Odontologos.paciente VALUES ('NULL', ?, ?, ?, ?, ?, ?, ?,?)", array(
                $this->Nombre,
                $this->Apellidos,
                $this->Documento,
                $this->TipoDocumento,
                $this->Direccion,
                $this->Email,
                $this->Genero,
                $this->Estado,

            )
        );
        $this->Disconnect();
    }

    public function editar()
    {

        $arrUser = (array) $this;
        $this->updateRow("UPDATE odontologos.paciente SET Nombre = ?, Apellidos = ?, Documento = ?, TipoDocumento = ?, Direccion = ?, Email = ?, Genero = ?, Estado = ? WHERE idPaciente = ?", array(

            $this->Nombre,
            $this->Apellidos,
            $this->Documento,
            $this->TipoDocumento,
            $this->Direccion,
            $this->Email,
            $this->Genero,
            $this->Estado,
            $this->idPaciente

        ));
        $this->Disconnect();


    }






    function getCitas ()
    {
        $arrCitas = Cita::buscar("SELECT * FROM odontologos.cita WHEN idPaciente = " . $this->idPaciente);
        return $arrCitas;
    }
    protected function eliminar($id)
    {
        if ($id > 0){
            return $this->deleteRow("DELETE FROM odontologos.paciente WHERE id = ?", array($id));
        }else{
            return false;
        }
    }



}