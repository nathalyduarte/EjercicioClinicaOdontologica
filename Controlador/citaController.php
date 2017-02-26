<?php

require_once (__DIR__.'/../Modelo/Cita.php');

if(!empty($_GET['action'])){
    citaController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class citaController{

    static function main($action){
        if ($action == "crear"){
            citaController::crear();
        }/*else if ($action == "editar"){
            citaController::editar();
        }else if ($action == "buscarID"){
            citaController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arraycita = array();
            $arraycita['Fecha'] = $_POST['Fecha'];
            $arraycita['Codigo'] = $_POST['Codigo'];
            $arraycita['Estado'] = $_POST['Estado'];
            $arraycita['Valor'] = $_POST['Valor'];
            $arraycita['NConsultorio'] = $_POST['NConsultorio'];
            $arraycita['Observaciones'] = $_POST['Observaciones'];
            $arraycita['Motivo'] = $_POST['Motivo'];
            $arraycita['idPaciente'] = $_POST['idPaciente'];
            $arraycita['idEspecialista'] = $_POST['idEspecialista'];

            $cita = new cita ($arraycita);
            $cita->insertar();
            header("Location: ../Vista/pages/registroCita.php?respuesta=correcto");
        } catch (Exception $e) {
            //var_dump($e);
            header("Location: ../Vista/pages/registroCita.php?respuesta=error");
        }
    }
    /*
    static public function editar (){
        try {
            $arrayOdonto = array();
            $arrayOdonto['Fechas'] = $_POST['Fechas'];
            $arrayOdonto['Codigo'] = $_POST['Codigo'];
            $arrayOdonto['especialidad'] = $_POST['especialidad'];
            $arrayOdonto['NConsultorio'] = $_POST['NConsultorio'];
            $arrayOdonto['celular'] = $_POST['celular'];
            $arrayOdonto['user'] = $_POST['user'];
            $arrayOdonto['pass'] = $_POST['pass'];
            $arrayOdonto['estado'] = $_POST['estado'];
            $arrayOdonto['idodontologos'] = $_POST['idodontologos'];
            $odonto = new Odontologos ($arrayOdonto);
            $odonto->editar();
            header("Location: ../registrocita.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../registrocita.php?respuesta=error");
        }
    }*/

    /*
    static public function buscarID ($id){
        try {
            return Odontologos::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }

    public function buscarAll (){
        try {
            return Odontologos::getAll();
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }

    public function buscar ($campo, $parametro){
        try {
            return Odontologos::getAll();
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }*/

}
?>