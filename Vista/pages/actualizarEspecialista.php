<<?php
session_start();
require "../../Modelo/Especialista.php";
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
                <h1 class="page-header">Actualizar Especialista</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos Especialista
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div id="alertas">
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "correcto"){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        La informacion del especialista se ha actualizado correctamente. Puede administrar los especialistas desde <a href="adminEspecialista.php" class="alert-link">Aqui</a> .
                                    </div>
                                <?php } ?>
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "error"){ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        No se pudo actualizar especialista. <a href="#" class="alert-link">Error: <?php echo $_GET["Mensaje"] ?></a> .
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if(!isset($_GET["IdEspecialista"])){ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    No se pudo actualizar al especialista <strong>Error: no se encontro informacion del especialista.</strong> Puede administrar los especialistas desde <a href="adminEspecialista.php" class="alert-link">Aqui</a>.
                                </div>
                            <?php }else{
                                $IdEspecialista = $_GET["IdEspecialista"];
                                $_SESSION["IdEspecialista"] = $IdEspecialista;
                                $ObjeEspecialista = Especialista::buscarForId($IdEspecialista);

                                ?>

                                <div class="col-lg-12">
                                    <form role="form" method="post" action="../../Controlador/especialistaController.php?action=editar">

                                        <div class="form-group">
                                            <label>Tipo Especialista</label>
                                            <select required id="Tipo" name="Tipo" class="form-control">
                                                <option>Seleccione</option>

                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Ortodoncista") ? "selected" : ""; ?>  value="Ortodoncista">Ortodoncista</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Endodoncista") ? "selected" : ""; ?>  value="Endodoncista">Endodoncista</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Anastesiologo") ? "selected" : ""; ?>  value="Anastesiologo">Anastesiologo</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Periodoncista") ? "selected" : ""; ?>  value="Periodoncista">Periodoncista</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Higienista Oral") ? "selected" : ""; ?>  value="Higienista Oral">Higienista Oral</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Protesista") ? "selected" : ""; ?>  value="Protesista">Protesista</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Cirujano Oral") ? "selected" : ""; ?>  value="Cirujano Oral">Cirujano Oral</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Ortodoncista") ? "selected" : ""; ?>  value="Ortodoncista">Ortodoncista</option>
                                                <option <?php echo ($ObjeEspecialista->getTipo() == "Odontopediatra") ? "selected" : ""; ?>  value="Odontopediatra">Odontopediatra</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input required value="<?php echo $ObjeEspecialista->getNombre(); ?>" data-toggle="tooltip" title="Sin Signos de puntuación o caracteres especiales" data-placement="top" maxlength="60" id="Nombre" name="Nombre" minlength="2" class="form-control newTooltip" placeholder="Ingrese Sus Nombres Completos">
                                        </div>
                                        <div class="form-group">
                                            <label>Apellido</label>
                                            <input required value="<?php echo $ObjeEspecialista->getApellido(); ?>" maxlength="60" id="Apellido" name="Apellido" minlength="2" class="form-control" placeholder="Ingrese Sus Apellidos Completos">
                                        </div>
                                        <div class="form-group">
                                            <label>Documento</label>
                                            <input required value="<?php echo $ObjeEspecialista->getDocumento(); ?>" type="number" required max="3000000000" min="1000000" maxlength="12" id="Documento" name="Documento" minlength="7" class="form-control" placeholder="Ingrese Documento Completo">
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo Documento</label>
                                            <select required id="TipoDocumento" name="TipoDocumento" class="form-control">
                                                <option>Seleccione</option>
                                                <option <?php echo ($ObjeEspecialista->getTipoDocumento() == "C.C") ? "selected" : ""; ?>  value="C.C">Cedula de Ciudadania</option>
                                                <option <?php echo ($ObjeEspecialista->getTipoDocumento() == "C.E") ? "selected" : ""; ?> value="C.E">Cedula de Extranjeria</option>
                                                <option <?php echo ($ObjeEspecialista->getTipoDocumento() == "T.I") ? "selected" : ""; ?> value="T.I">Tarjeta de Identidad</option>

                                                <option <?php echo ($ObjeEspecialista->getTipoDocumento() == "RegistroCivil") ? "selected" : ""; ?> value="RegistroCivil">Registro Civil</option>
                                                <option <?php echo ($ObjeEspecialista->getTipoDocumento() == "RUT") ? "selected" : ""; ?> value="RUT">Registro Unico Tributario</option>
                                                <option <?php echo ($ObjeEspecialista->getTipoDocumento() == "Otro") ? "selected" : ""; ?> value="Otro">Otro</option>
                                            </select>
                                        </div>
                                        <label>Email</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input value="<?php echo $ObjeEspecialista->getEmail(); ?>" type="email" required maxlength="45" id="Email" name="Email" minlength="7" class="form-control" placeholder="Ingrese su correo electronico">
                                        </div>

                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input required value="<?php echo $ObjeEspecialista->getDireccion(); ?>" maxlength="60" id="Direccion" name="Direccion" minlength="7" class="form-control" placeholder="Ingrese su direccion de residencia">
                                        </div>


                                        <div class="form-group">
                                            <label>Genero</label>
                                            <select required id="Genero" name="Genero" class="form-control">
                                                <option>Seleccione</option>
                                                <option <?php echo ($ObjeEspecialista->getGenero() == "Masculino") ? "selected" : ""; ?> value="Masculino">Masculino</option>
                                                <option <?php echo ($ObjeEspecialista->getGenero() == "Femenino") ? "selected" : ""; ?> value="Femenino">Femenino</option>
                                                <option <?php echo ($ObjeEspecialista->getGenero() == "Indefinido") ? "selected" : ""; ?> value="Indefinido">Indefinido</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input required value="<?php echo $ObjeEspecialista->getTelefono(); ?>" maxlength="60" id="Telefono" name="Telefono" minlength="7" class="form-control" placeholder="Ingrese su telefono  de contacto">
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
