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
                            Configuración de Medicamentos
                        </div>
                        <form method="post" role="form" id="editMedicamento" action="<?php echo base_url(); ?>configuracion/medicamentos">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Seleccione el Medicamento</label>
                                    <div class="form-group">
                                        <select class="chosen-select" id="id_medicamento" name="id_medicamento">
                                            <option value="0">Seleccione...</option>
                                            <?php
                                            foreach ($medicamentos as $medicamento) {
                                                ?>
                                                <option
                                                    value="<?php echo $medicamento['id_medicamento']; ?>"><?php echo $medicamento['medicamento']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label>Presentación</label>
                                    <div class="form-group">
                                        <select class="form-control" id="id_unidad" name="id_unidad">
                                            <option value="0">Seleccione...</option>
                                            <?php
                                            foreach ($unidades as $unidad) {
                                                ?>
                                                <option
                                                    value="<?php echo $unidad['id_unidad']; ?>"><?php echo $unidad['unidad']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Nombre del Medicamento</label>
                                    <div class="form-group">
                                        <input class="form-control" name="medicamento" id="medicamento" required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label>Estado</label>
                                    <div class="form-group">
                                        <select class="form-control" name="status" id="status">
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <!-- <div class="text-center"> -->
                                    <button type="submit" class="btn btn-outline btn-success" name="guardar" id="guardar">Guardar</button>
                                    <button type="reset" class="btn btn-outline btn-warning" name="limpiar" id="limpiar">Limpiar</button>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->