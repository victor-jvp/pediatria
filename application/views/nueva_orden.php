<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $titulo;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <form method="post" role="form" id="nuevaOrden" action="<?php echo base_url(); ?>ordenes/nueva-orden">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Datos del Paciente
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <label>Paciente</label>

                                    <div class="form-group">
                                        <select class="chosen-select" id="paciente" required>
                                            <option value="0">Seleccione...</option>
                                            <?php
                                            foreach ($pacientes as $paciente) {
                                                ?>
                                                <option
                                                    value="<?php echo $paciente['id_paciente']; ?>"><?php echo $paciente['paciente']; ?></option>
                                                <?php
                                            }
                                            ?>s
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>Fecha de Nacimiento</label>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input class="form-control" type="text" name="fecha_nacimiento"
                                               id="fecha_nacimiento"
                                               value="<?php echo set_value('fecha_nacimiento'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Edad</label>
                                        <input class="form-control" name="edad" id="edad" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Nro. Historia</label>
                                        <input class="form-control" name="id_paciente" id="id_paciente" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Datos de la orden
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Fecha de la Consulta</label>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input class="form-control" name="fecha_consulta" id="fecha_consulta">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Peso</label>
                                        <input class="form-control" name="peso" id="peso">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Altura</label>
                                        <input class="form-control" name="altura" id="altura">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>C.C.</label>
                                        <input class="form-control" name="cc" id="cc">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Síntomas del paciente</label>
                                        <textarea class="form-control" rows="2" name="sintomas"
                                                  id="sintomas"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Diagnóstico</label>
                                        <textarea class="form-control" rows="2" name="diagnostico"
                                                  id="diagnostico"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Tratamiento e Indicaciones
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="tablaMed">
                                            <thead>
                                            <tr>
                                                <th>Medicamentos</th>
                                                <th>Indicaciones</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr id="heredar0">
                                                <td>
                                                    <select class="form-control" name="recipes[0][id_medicamento]" id="medicamento0">
                                                        <option value="0">Seleccione...</option>
                                                        <?php
                                                        foreach ($medicamentos as $medicamento) {
                                                            ?>
                                                            <option
                                                                value="<?php echo $medicamento['id_medicamento']; ?>"><?php echo $medicamento['medicamento']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select></td>
                                                <td>
                                                    <input class="form-control" name="recipes[0][indicacion]" id="indicacion0">
                                                </td>
                                                <td>
                                                    <button class="btn btn-success" type="button" id="agregar"
                                                            value="0">Agregar
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea class="form-control" rows="2" name="observaciones"
                                                  id="observaciones"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline btn-success" name="guardar" id="guardar">Guardar Orden</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->