
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/dist/js/sb-admin-2.js"></script>

    <!-- Js del Form -->
    <?php
        if(isset($jsFiles) && !empty($jsFiles)){
            foreach($jsFiles as $js){
                ?>
                <script type="text/javascript" src="<?php echo $js;?>"></script>
                <?php
            }
        }
    ?>

</body>

</html>
