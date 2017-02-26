<?php
session_start();
require_once (__DIR__.'/../Modelo/Especialista.php');

if(!empty($_GET['action'])){
    EspecialistaController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class EspecialistaController{

    static function main($action){
        if ($action == "crear"){
            EspecialistaController::crear();
        }else if ($action == "editar"){
            EspecialistaController::editar();
        }else if ($action == "selectPacientes"){
            pacienteController::selectPacientes();
        }else if ($action == "adminTablePacientes"){
            pacienteController::adminTablePacientes();
        }else if ($action == "InactivarPaciente"){
            pacienteController::CambiarEstado("Inactivo");
        }else if ($action == "ActivarPaciente"){
            pacienteController::CambiarEstado("Activo");

        }
        /*else if ($action == "buscarID"){
            EspecialistaController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arrayEspecialista = array();
            $arrayEspecialista['Tipo'] = $_POST['Tipo'];
            $arrayEspecialista['Nombre'] = $_POST['Nombre'];
            $arrayEspecialista['Apellido'] = $_POST['Apellido'];
            $arrayEspecialista['Documento'] = $_POST['Documento'];
            $arrayEspecialista['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayEspecialista['Email'] = $_POST['Email'];
            $arrayEspecialista['Direccion'] = $_POST['Direccion'];
            $arrayEspecialista['Genero'] = $_POST['Genero'];
            $arrayEspecialista['Telefono'] = $_POST['Telefono'];
            $arrayEspecialista['Estado'] = 'Activo';
            $Especialista = new Especialista ($arrayEspecialista);
            $Especialista->insertar();
           header("Location: ../Vista/pages/registroEspecialista.php?respuesta=correcto");
        } catch (Exception $e) {
           header("Location: ../Vista/pages/registroEspecialista.php?respuesta=error");
           //var_dump($e);
        }
    }
    static public function selectEspecialista ($isRequired=true, $id="idEspecialista", $nombre="idEspecialista", $class=""){
        $arrEspecialista = Especialista::getAll();  /*  */
        $htmlSelect = "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option >Seleccione Especialista</option>";
        if(count($arrEspecialista) > 0){
            foreach ($arrEspecialista as $Especialista)
                $htmlSelect .= "<option value='".$Especialista->getIdEspecialista()."'>".$Especialista->getNombre()." ".$Especialista->getApellido()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    static public function adminTableEspecialista(){
        $arrEspecialista = Especialista::getAll(); /*  */
        $tmpEspecialista = new Especialista();
        $arrColumnas = [/*"idEspecialista",*/"Tipo","Nombre", "Apellido","Documento"/*"TipoDocumento",*/,"Email","Direccion","Genero","Telefono","Estado"];
        $htmlTable = "<thead>";
        $htmlTable .= "<tr>";
        foreach ($arrColumnas as $NameColumna){
            $htmlTable .= "<th>".$NameColumna."</th>";
        }
        $htmlTable .= "<th>Acciones</th>";
        $htmlTable .= "</tr>";
        $htmlTable .= "</thead>";

        $htmlTable .= "<tbody>";
        foreach ($arrEspecialista as $ObjEspecialista){
            $htmlTable .= "<tr>";
            //$htmlTable .= "<td>".$ObjPaciente->getIdPaciente()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getTipo()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getNombre()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getApellido()."</td>";
            //$htmlTable .= "<td>".$ObjPaciente->getTipoDocumento()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getDocumento()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getEmail()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getDireccion()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getGenero()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getTelefono()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getEstado()."</td>";

            $icons = "";
            if($ObjEspecialista->getEstado() == "Activo"){
                $icons .= "<a data-toggle='tooltip' title='Inactivar Especialista' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' href='../../Controlador/especialistaController.php?action=InactivarEspecialista&IdEspecialista=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-times'></i></a>";
            }else{
                $icons .= "<a data-toggle='tooltip' title='Activar Especilaista' data-placement='top' class='btn btn-social-icon btn-success newTooltip' href='../../Controlador/especialistaController.php?action=ActivarEspecialista&IdEspecialista=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-check'></i></a>";
            }
            $icons .= "<a data-toggle='tooltip' title='Actualizar Especialista' data-placement='top' class='btn btn-social-icon btn-primary newTooltip' href='actualizarEspecialista.php?IdEspecialista=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-pencil'></i></a>";
            $icons .= "<a data-toggle='tooltip' title='Ver Especialista' data-placement='top' class='btn btn-social-icon btn-warning newTooltip' href='../../Controlador/especialistaController.php?action=InactivarEspecialista&IdEspecialista=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-eye'></i></a>";

            $htmlTable .= "<td>".$icons."</td>";
            $htmlTable .= "</tr>";
        }
        $htmlTable .= "</tbody>";
        return $htmlTable;
    }



    static public function editar (){
        try {
            $TmpObject = Especialista::buscarForId($_SESSION["IdEspecialista"]);
            $Estado = $TmpObject->getEstado();

            $arrayEspecialista = array();
            $arrayEspecialista['Tipo'] = $_POST['Tipo'];
            $arrayEspecialista['Nombre'] = $_POST['Nombre'];
            $arrayEspecialista['Apellido'] = $_POST['Apellido'];
            $arrayEspecialista['Documento'] = $_POST['Documento'];
            $arrayEspecialista['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayEspecialista['Email'] = $_POST['Email'];
            $arrayEspecialista['Direccion'] = $_POST['Direccion'];
            $arrayEspecialista['Genero'] = $_POST['Genero'];
            $arrayEspecialista['Telefono'] = $_POST['Telefono'];
            $arrayEspecialista['Estado'] = 'Activo';
            $Especialista = new Especialista ($arrayEspecialista);
            $Especialista->editar();
            unset($_SESSION["IdEspecialista"]);
            //          header("Location: ../Vista/pages/actualizarEspecialista.php?respuesta=correcto&IdEspecialista=".$arrayEspecialista['idEspecialista']);

        } catch (Exception $e) {

            $txtMensaje = $e->getMessage();
            //header("Location: ../Vista/pages/actualizarEspecialista.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }

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