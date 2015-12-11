<?php
$this->load->view('plantillas/front_end/header');
$this->load->view('plantillas/front_end/topbar');
$this->load->view('plantillas/front_end/sidebar');
$this->load->view($contenido);
$this->load->view('plantillas/front_end/footer');

?>