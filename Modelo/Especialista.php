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
    private $Nombres;
    private $Apellidos;
    private $Documento;
    private $TipoDocumento;
    private $Direccion;
    private $Email;
    private $Genero;
    private $Telefono;

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
            $this->Nombres = "";
            $this->Apellidos = "";
            $this->Documento = "";
            $this->TipoDocumento = "";
            $this->Direccion = "";
            $this->Email = "";
            $this->Genero = "";
            $this->Telefono = "";

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
    public function getNombres()
    {
        return $this->Nombres;
    }

    /**
     * @param mixed $Nombres
     */
    public function setNombres($Nombres)
    {
        $this->Nombres = $Nombres;
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

    protected static function buscarForId($id)
    {
        $Espec = new Especialista();
        if ($id > 0){
            $getrow = $Espec->getRow("SELECT * FROM odontologos.Especialista WHERE idEspecialista =?", array($id));
            $Espec->idEspecialista = $getrow['idEspecialista'];
            $Espec->Tipo = $getrow['Tipo'];
            $Espec->Nombres = $getrow['Nombres'];
            $Espec->Apellidos = $getrow['Apellidos'];
            $Espec->Documento = $getrow['Documento'];
            $Espec->TipoDocumento = $getrow['TipoDocumento'];
            $Espec->Direccion = $getrow['Direccion'];
            $Espec->Email = $getrow['Email'];
            $Espec->Genero = $getrow['Genero'];
            $Espec->Telefono= $getrow['Telefono'];
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
            $Espec->Nombres = $valor['Nombres'];
            $Espec->Apellidos = $valor['Apellidos'];
            $Espec->Documento = $valor['Documento'];
            $Espec->TipoDocumento = $valor['TipoDocumento'];
            $Espec->Direccion = $valor['Direccion'];
            $Espec->Email = $valor['Email'];
            $Espec->Genero = $valor['Genero'];
            $Espec->Telefono = $valor['Telefono'];
            array_push($arrEspecialistas, $Espec);
        }
        $tmp->Disconnect();
        return $arrEspecialistas;
    }

    protected static function getAll()
    {
        return Especialista::buscar("SELECT * FROM odontologos.Especialista");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO odontologos.Especialista VALUES ('NULL', ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->Tipo,
                $this->Nombres,
                $this->Apellidos,
                $this->Documento,
                $this->TipoDocumento,
                $this->Direccion,
                $this->Email,
                $this->Genero,
                $this->Telefono
            )
        );
        $this->Disconnect();
    }

    protected function editar()
    {

        $arrUser = (array) $this;
        $this->updateRow("UPDATE odontologos.Especialista SET Nombre = ?, Apellidos = ?, Documento = ?, TipoDocumento = ?, Direccion = ?, Email = ?, Genero = ?, $this->Telefono = ? WHERE idEspecialista = ?", array(
            $this->idEspecialista,
            $this->Tipo,
            $this->Nombres,
            $this->Apellidos,
            $this->Documento,
            $this->TipoDocumento,
            $this->Direccion,
            $this->Email,
            $this->Genero,
            $this->Telefono
        ));
        $this->Disconnect();

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