<?php

require_once (__DIR__.'/../Modelo/Paciente.php');

if(!empty($_GET['action'])){
    pacienteController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class pacienteController{

    static function main($action){
        if ($action == "crear"){
            pacienteController::crear();
        }/*else if ($action == "editar"){
            pacienteController::editar();
        }else if ($action == "buscarID"){
            pacienteController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arrayPaciente = array();
            $arrayPaciente['Nombres'] = $_POST['Nombres'];
            $arrayPaciente['Apellidos'] = $_POST['Apellidos'];
            $arrayPaciente['Direccion'] = $_POST['Direccion'];
            $arrayPaciente['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayPaciente['Documento'] = $_POST['Documento'];
            $arrayPaciente['Email'] = $_POST['Email'];
            $arrayPaciente['Genero'] = $_POST['Genero'];
            $arrayPaciente['Estado'] = "Activo";
            $paciente = new Paciente ($arrayPaciente);
            $paciente->insertar();
            //header("Location: ../Vista/registroPaciente.php?respuesta=correcto");
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/registroPaciente.php?respuesta=error");
        }
    }
    /*
    static public function editar (){
        try {
            $arrayOdonto = array();
            $arrayOdonto['nombres'] = $_POST['nombres'];
            $arrayOdonto['apellidos'] = $_POST['apellidos'];
            $arrayOdonto['especialidad'] = $_POST['especialidad'];
            $arrayOdonto['direccion'] = $_POST['direccion'];
            $arrayOdonto['celular'] = $_POST['celular'];
            $arrayOdonto['user'] = $_POST['user'];
            $arrayOdonto['pass'] = $_POST['pass'];
            $arrayOdonto['estado'] = $_POST['estado'];
            $arrayOdonto['idodontologos'] = $_POST['idodontologos'];
            $odonto = new Odontologos ($arrayOdonto);
            $odonto->editar();
            header("Location: ../registroPaciente.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../registroPaciente.php?respuesta=error");
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