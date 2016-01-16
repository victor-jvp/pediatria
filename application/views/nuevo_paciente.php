<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $titulo;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Datos del Paciente
                    </div>
                    <div class="panel-body">
                        <form method="post" role="form" id="nuevoPaciente" action="<?php echo base_url(); ?>pacientes/nuevo-paciente">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Nombre del Paciente</label>
                                        <input class="form-control" name="paciente"
                                               value="<?php echo set_value('paciente'); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Fecha de Nacimiento</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input class="form-control" type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo set_value('fecha_nacimiento');?>" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Titular</label>
                                        <input class="form-control" name="titular"
                                               value="<?php echo set_value('titular'); ?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Cédula Titular</label>
                                        <input class="form-control" name="cedula_titular"
                                               value="<?php echo set_value('cedula_titular'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Antecedentes Pre-Natales</label>
                                        <input class="form-control" name="ant_prenatales"
                                               value="<?php echo set_value('ant_prenatales'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Complicaciones al Nacer</label>
                                        <input class="form-control" name="complicaciones"
                                               value="<?php echo set_value('complicaciones'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
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
                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Semanas de Gestación</label>
                                        <input class="form-control" name="semanas"
                                               value="<?php echo set_value('semanas'); ?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Peso al Nacer</label>
                                        <input class="form-control" name="pan" value="<?php echo set_value('pan'); ?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Tamaño al Nacer</label>
                                        <input class="form-control" name="tan" value="<?php echo set_value('tan'); ?>" required>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Antecedentes Personales</label>
                                        <input class="form-control" name="ant_personales"
                                               value="<?php echo set_value('ant_personales'); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Antecedentes Familiares</label>
                                        <input class="form-control" name="ant_familiares"
                                               value="<?php echo set_value('ant_familiares'); ?>" required>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Vacunas</label>
                                        <input class="form-control" name="vacunas"
                                               value="<?php echo set_value('vacunas'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <?php echo validation_errors(); ?>
                            <button type="submit" class="btn btn-outline btn-success" name="guardar" id="guardar">Guardar Paciente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->