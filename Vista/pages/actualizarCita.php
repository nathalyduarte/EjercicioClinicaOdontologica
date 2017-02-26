<<?php
session_start();
require "../../Modelo/Cita.php";
?>



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

</head>

<body>

<div id="wrapper">

    <?php include ("includes/barra-navegacion.php"); ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Actualizar Cita</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos Cita
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div id="alertas">
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "correcto"){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        La informacion de la cita se ha actualizado correctamente. Puede administrar las citas desde <a href="adminCita.php" class="alert-link">Aqui</a> .
                                    </div>
                                <?php } ?>
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "error"){ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        No se pudo actualizar cita. <a href="#" class="alert-link">Error: <?php echo $_GET["Mensaje"] ?></a> .
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if(!isset($_GET["IdPaciente"])){ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    No se pudo actualizar cita <strong>Error: no se encontro informacion de la cita.</strong> Puede administrar las citas desde <a href="adminCita.php" class="alert-link">Aqui</a>.
                                </div>
                            <?php }else{
                                $IdEspecialista = $_GET["IdEspecialista"];
                                $_SESSION["IdEspecialista"] = $IdEspecialista;
                                $ObjeEspecialista = Especialista::buscarForId($IdEspecialista);
                                ?>
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="../../Controlador/citaController.php?action=editar">

                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input required value="<?php echo $ObjeCita->getFecha(); ?>" data-toggle="tooltip" title="" data-placement="top" maxlength="60" id="Fecha" name="Fecha" minlength="2" class="form-control newTooltip" placeholder="Ingrese fecha y hora cita">
                                        </div>

                                        <div class="form-group">
                                            <label>Codigo</label>
                                            <input required value="<?php echo $ObjeCita->getCodigo(); ?>" maxlength="60" id="Codigo" name="Codigo" minlength="2" class="form-control" placeholder="Ingrese codigo cita">
                                        </div>
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <input required value="<?php echo $ObjeCita->getEstado(); ?>" type="text" required max="3000" min="20" maxlength="12" id="Estado" name="Estado" minlength="7" class="form-control" placeholder="Ingrese estado">
                                        </div>

                                        <div class="form-group">
                                            <label>Valor</label>
                                            <input required value="<?php echo $ObjeCita->getValor(); ?>" type="number" required max="3000000000" min="1000000" maxlength="12" id="Valor" name="Valor" minlength="7" class="form-control" placeholder="Ingrese valor cita">
                                        </div>

                                        <div class="form-group">
                                            <label>NConsultorio</label>
                                            <input required value="<?php echo $ObjeCita->getNConsultorio(); ?>" type="number" required max="500" min="100" maxlength="12" id="NConsultorio" name="NConsultorio" minlength="7" class="form-control" placeholder="Ingrese numero de consultorio">
                                        </div>

                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <input required value="<?php echo $ObjeCita->getObsarvaciones(); ?>" type="text" required max="3000" min="50" maxlength="12" id="Observaciones" name="Observaciones" minlength="7" class="form-control" placeholder="Ingrese observaciones">
                                        </div>

                                        <div class="form-group">
                                            <label>Motivo</label>
                                            <input required value="<?php echo $ObjeCita->getMotivo(); ?>" type="text" required max="3000" min="50" maxlength="12" id="Motivo" name="Valor" minlength="7" class="form-control" placeholder="Ingrese motivo">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                        <button type="reset" class="btn btn-warning">Cancelar</button>
                                    </form>
                                </div>
                            <?php }?>
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
