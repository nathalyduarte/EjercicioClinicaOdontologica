<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <?php include ("includes/imports.php"); ?>

    <?php include ("../../Controlador/pacienteController.php"); ?>
    <?php include ("../../Controlador/especialistaController.php"); ?>

</head>

<body>

<div id="wrapper">

    <?php include ("includes/barra-navegacion.php"); ?>

    <div id="page-wrapper">
        <div class="row">



            <div class="col-lg-12">
                <h1 class="page-header">Registro Cita</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos Basicos para solicitar cita
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div id="alertas">
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "correcto"){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        La informacion de la cita se ha registrado correctamente. Puede administrar las citas desde <a href="adminCitas.php" class="alert-link">Aqui</a> .
                                    </div>
                                <?php } ?>
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "error"){ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        No se pudo registrar  cita. <a href="#" class="alert-link">Error: <?php echo $_GET["Mensaje"] ?></a> .
                                    </div>
                                <?php } ?>


                            <div class="col-lg-12">
                                <form role="form" method="post" action="../../Controlador/citaController.php?action=crear">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="datetime-local"  id="Fecha" name="Fecha"  class="form-control" placeholder="Ingrese fecha y hora cita">
                                    </div>

                                    <div class="form-group">
                                        <label>Codigo</label>
                                        <input required maxlength="100" id="Codigo" name="Codigo" minlength="2" class="form-control" placeholder="Ingrese codigo">
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                            <select required id="Estado" name="Estado" class="form-control">
                                            <option>Seleccione</option>
                                            <option value="Solicitada">Solicitada</option>
                                            <option value="Cancelada">Cancelada</option>
                                            <option value="Activa">Activa</option>
                                            <option value="Finalizado">Finalizado</option>
                                            <option value="Suspendido">Suspendido</option>

                                        </select>


                                    </div>

                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input type="number" required max="60000" min="20000" maxlength="12" id="Valor" name="Valor" minlength="7" class="form-control" placeholder="Ingrese valor cita">


                                    </div>

                                    <div class="form-group">
                                        <label>Numero_Consultorio</label>
                                        <input type="number" required max="600" min="150" maxlength="5" id="NConsultorio" name="NConsultorio" minlength="3" class="form-control" placeholder="Ingrese numero consultorio">
                                    </div>

                                    <div class="form-group">
                                        <label>Observacion</label>
                                        <input type="text" required max="2000" min="10" maxlength="50" id="Obsarvaciones" name="Observaciones" minlength="3" class="form-control" placeholder="Ingrese obsarvaciones">

                                    </div>
                                    <div class="form-group">
                                        <label>Motivo</label>
                                        <input type="text" required max="1000" min="10" maxlength="60" id="Motivo" name="Motivo" minlength="5" class="form-control" placeholder="Motivo">
                                    </div>

                                    <div class="form-group">
                                        <label>Paciente</label>
                                        <?php echo pacienteController::selectPaciente (true,"idPaciente","idPaciente","form-control"); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Especialista</label>
                                        <?php echo EspecialistaController::selectEspecialista (true,"idEspecialista","idEspecialista","form-control"); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <button type="reset" class="btn btn-warning">Cancelar</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include ("includes/includes-footer.php"); ?>

</body>

</html>
