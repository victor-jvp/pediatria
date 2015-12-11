<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pacientes Registrados</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Cuerpo de la Tabla-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Listado de Pacientes Registrados
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="tabla_pacientes">
                                <thead>
                                <tr>
                                    <th>Nro. Historia</th>
                                    <th>Nombre de Paciente</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Cédula de Titular</th>
                                    <th>Nombre de Titular</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($data) and !empty($data)) {
                                    foreach ($data as $row) {
                                        ?>
                                        <tr class="odd gradeA">
                                            <td><?php echo $row['id_paciente']; ?></td>
                                            <td><?php echo $row['paciente']; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($row['fecha_nacimiento'])); ?></td>
                                            <td><?php echo $row['cedula_titular']; ?></td>
                                            <td><?php echo $row['titular']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!--                         <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_paciente" >
                            Probando Modal
                        </button> -->
                        <!-- Modal -->
                        <div class="modal fade" id="modal_paciente" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Editar Paciente</h4>
                                    </div>
                                    <form method="post" role="form" id="modificarPaciente" action="<?php echo base_url(); ?>pacientes/modificar-paciente">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Nombre del Paciente</label>
                                                        <input class="form-control" name="paciente" id="paciente"
                                                               value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Nro. Historia</label>
                                                        <input class="form-control" name="id_paciente" id="id_paciente" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Fecha de Nacimiento</label>

                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input class="form-control" name="fecha_nacimiento"
                                                               id="fecha_nacimiento"
                                                               value="<?php echo set_value('fecha_nacimiento'); ?>"
                                                               readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Titular</label>
                                                        <input class="form-control" name="titular" id="titular" value=""
                                                               required>
                                                    </div>

                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Cédula Titular</label>
                                                        <input class="form-control" name="cedula_titular"
                                                               id="cedula_titular" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Antecedentes Pre-Natales</label>
                                                        <input class="form-control" name="ant_prenatales"
                                                               id="ant_prenatales" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Producto de</label>
                                                        <select class="form-control" name="producto" id="producto">
                                                            <?php
                                                            foreach ($campos as $value) {
                                                                if ($value['campo'] == "producto") {
                                                                    ?>
                                                                    <option
                                                                        value="<?php echo $value['valor']; ?>"><?php echo $value['texto']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Complicaciones al Nacer</label>
                                                        <input class="form-control" name="complicaciones"
                                                               id="complicaciones" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Obtenido por</label>
                                                        <select class="form-control" name="obtenido_por"
                                                                id="obtenido_por">
                                                            <?php
                                                            foreach ($campos as $value) {
                                                                if ($value['campo'] == "obtenido_por") {
                                                                    ?>
                                                                    <option
                                                                        value="<?php echo $value['valor']; ?>"><?php echo $value['texto']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Semanas de Gestación</label>
                                                        <input class="form-control" name="semanas" id="semanas" value=""
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="form-group">
                                                        <label>Peso al Nacer</label>
                                                        <input class="form-control" name="pan" id="pan" value=""
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">

                                                    <div class="form-group">
                                                        <label>Tamaño al Nacer</label>
                                                        <input class="form-control" name="tan" id="tan" value=""
                                                               required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Antecedentes Personales</label>
                                                        <input class="form-control" name="ant_personales"
                                                               id="ant_personales" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">

                                                    <div class="form-group">
                                                        <label>Antecedentes Familiares</label>
                                                        <input class="form-control" name="ant_familiares"
                                                               id="ant_familiares" value="" required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Vacunas</label>
                                                        <input class="form-control" name="vacunas" id="vacunas" value=""
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type=reset class="btn btn-default" data-dismiss="modal">Cerrar
                                            </button>
                                            <button type="submit" class="btn btn-outline btn-success" id="modificar">
                                                Guardar Cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
