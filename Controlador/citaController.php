<?php

require_once (__DIR__.'/../Modelo/Cita.php');

if(!empty($_GET['action'])){
    citaController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class citaController{

    static function main($action)
    {
        if ($action == "crear") {
            citaController::crear();
        } else if ($action == "editar") {
            pacienteController::editar();
        } else if ($action == "selectCita") {
            pacienteController::selectCita();
        } else if ($action == "adminTableCita") {
            pacienteController::adminTableCita();
        }
    }
    static public function editar (){
        try {
            $TmpObject = Cita::buscarForId($_SESSION["IdCita"]);
            $Estado = $TmpObject->getEstado();
            $arrayPaciente = array();
            $arrayPaciente['Fecha'] = $_POST['Fecha'];
            $arrayPaciente['Codigo'] = $_POST['Codigo'];
            $arrayPaciente['Documento'] = $_POST['Documento'];
            $arrayPaciente['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayPaciente['Direccion'] = $_POST['Direccion'];
            $arrayPaciente['Email'] = $_POST['Email'];
            $arrayPaciente['Genero'] = $_POST['Genero'];
            $arrayPaciente['Estado'] = $Estado;
            $arrayPaciente['idPaciente'] = $_SESSION["IdPaciente"];
            $paciente = new Paciente ($arrayPaciente);
            var_dump($arrayPaciente);
            $paciente->editar();
            unset($_SESSION["IdPaciente"]);
            header("Location: ../Vista/pages/actualizarPaciente.php?respuesta=correcto&IdPaciente=".$arrayPaciente['idPaciente']);

        } catch (Exception $e) {
            //var_dump($e);
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/actualizarPaciente.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }
        static public function adminTableCita (){
        $arrCita = Cita::getAll(); /*  */
        $tmpCita = new Cita();
        $arrColumnas = ["Fecha","Codigo","Estado","Valor","NConsultorio","Observaciones","Motivo"];
        $htmlTable = "<thead>";
        $htmlTable .= "<tr>";
        foreach ($arrColumnas as $NameColumna){
            $htmlTable .= "<th>".$NameColumna."</th>";
        }
        $htmlTable .= "<th>Acciones</th>";
        $htmlTable .= "</tr>";
        $htmlTable .= "</thead>";

        $htmlTable .= "<tbody>";
        foreach ($arrCita as $ObjCita){
            $htmlTable .= "<tr>";

            $htmlTable .= "<td>".$ObjCita->getFecha()."</td>";
            $htmlTable .= "<td>".$ObjCita->getCodigo()."</td>";
            $htmlTable .= "<td>".$ObjCita->getEstado()."</td>";
            $htmlTable .= "<td>".$ObjCita->getValor()."</td>";
            $htmlTable .= "<td>".$ObjCita->getNConsultorio()."</td>";
            $htmlTable .= "<td>".$ObjCita->getObservaciones()."</td>";
            $htmlTable .= "<td>".$ObjCita->getMotivo()."</td>";


            $htmlTable .= "</tr>";


        }
        $htmlTable .= "</tbody>";
        return $htmlTable;

            $icons .= "<a data-toggle='tooltip' title='Ver Cita' data-placement='top' class='btn btn-social-icon btn-warning newTooltip' href='../../Controlador/citaController.php?action=InactivarCita&IdCita=".$ObjCita->getIdCita()."'><i class='fa fa-eye'></i></a>";


        }
            /*else if ($action == "editar"){
                citaController::editar();
            }else if ($action == "buscarID"){
                citaController::buscarID(1);
            }*/
        }

        /* static public function crear (){
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
         }*/
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
}
?>