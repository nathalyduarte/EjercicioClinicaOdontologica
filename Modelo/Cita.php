<?php

/**
 * Created by PhpStorm.
 * User: Jeimy
 * Date: 20/02/2017
 * Time: 10:31 PM
 */
require_once('db_abstract_class.php');

class Cita extends db_abstract_class
{

    private $idCita;
    private $Fecha;
    private $Codigo;
    private $Estado;
    private $Valor;
    private $NConsultorio;
    private $Observaciones;
    private $Motivo;
    private $idPaciente;
    private $idEspecialista;



    public function __construct($Odontologos_data=array())
    {
        parent::__construct();
        if(count($Odontologos_data)>1){
            foreach ($Odontologos_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idCita = "";
            $this->Fecha = "";
            $this->Codigo = "";
            $this->Estado = "";
            $this->Valor = "";
            $this->NConsultorio = "";
            $this->Observaciones = "";
            $this->Motivo = "";

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
    public function getidCita()
    {
        return $this->idCita;
    }

    /**
     * @param mixed $idCita
     */
    public function setidCita($idCita)
    {
        $this->idCita = $idCita;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * @param mixed $Fechas
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->Codigo;
    }

    /**
     * @param mixed $Codigo
     */
    public function setCodigo($Codigo)
    {
        $this->Codigo = $Codigo;
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

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->Valor;
    }

    /**
     * @param mixed $Valor
     */
    public function setValor($Valor)
    {
        $this->Valor = $Valor;
    }

    /**
     * @return mixed
     */
    public function getNConsultorio()
    {
        return $this->NConsultorio;
    }

    /**
     * @param mixed $NConsultorio
     */
    public function setNConsultorio($NConsultorio)
    {
        $this->NConsultorio = $NConsultorio;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->Observaciones;
    }

    /**
     * @param mixed $Observaciones
     */
    public function setObservaciones($Observaciones)
    {
        $this->Observaciones = $Observaciones;
    }

    /**
     * @return mixed
     */
    public function getMotivo()
    {
        return $this->Motivo;
    }

    /**
     * @param mixed $Motivo
     */
    public function setMotivo($Motivo)
    {
        $this->Motivo = $Motivo;
    }

    /**
     * @return mixed
     */


    protected static function buscarForId($id)
    {
        $pacien = new Cita();
        if ($id > 0){
            $getrow = $pacien->getRow("SELECT * FROM Odontologos.Cita WHERE idCita =?", array($id));
            $pacien->idCita = $getrow['idCita'];
            $pacien->Fecha = $getrow['Fecha'];
            $pacien->Codigo = $getrow['Codigo'];
            $pacien->Estado = $getrow['Estado'];
            $pacien->Valor = $getrow['Valor'];
            $pacien->NConsultorio = $getrow['NConsultorio'];
            $pacien->Observaciones = $getrow['Observaciones'];
            $pacien->Motivo = $getrow['Motivo'];
            $pacien->Disconnect();
            return $pacien;
        }else{
            return NULL;
        }
    }

    protected static function buscar($query)
    {
        $arrCitas = array();
        $tmp = new Cita();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $pacien = new Cita();
            $pacien->idCita = $valor['idCita'];
            $pacien->Fecha = $valor['Fecha'];
            $pacien->Codigo = $valor['Codigo'];
            $pacien->Estado = $valor['Estado'];
            $pacien->Valor = $valor['Valor'];
            $pacien->NConsultorio = $valor['NConsultorio'];
            $pacien->Observaciones = $valor['Observaciones'];
            $pacien->Motivo = $valor['Motivo'];
            array_push($arrCitas, $pacien);
        }
        $tmp->Disconnect();
        return $arrCitas;
    }

    protected static function getAll()
    {
        return Cita::buscar("SELECT * FROM Odontologos.Cita");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO Odontologos.Cita VALUES ('NUL', ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->Fecha,
                $this->Codigo,
                $this->Estado,
                $this->Valor,
                $this->NConsultorio,
                $this->Observaciones,
                $this->Motivo,
                $this->idPaciente,
                $this->idEspecialista,

            )
        );
        $this->Disconnect();
    }

    protected function editar()
    {
        $arrUser = (array) $this;
        $this->updateRow("UPDATE odontologos.Cita SET Fecha = ?, Codigo = ?, Estado = ?, Valor = ?, NConsultorio = ?, Observaciones = ?, Motivo = ?, WHERE idCita = ?", array(
            $this->idCita,
            $this->Fecha,
            $this->Codigo,
            $this->Estado,
            $this->Valor,
            $this->NConsultorio,
            $this->Observaciones,
            $this->Motivo,


        ));
        $this->Disconnect();

    }

    public function getObjectPaciente(){
        return Paciente::buscarForId($this->idPaciente);
    }
    public function getObjectEspecialista(){
        return Especialista::buscarForId($this->idEspecialista);
    }

    protected function eliminar($id)
    {
        if ($id > 0){
            return $this->deleteRow("DELETE FROM odontologos.Cita WHERE id = ?", array($id));
        }else{
            return false;
        }
    }



}