<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pacientes_model', 'ordenes_model');
	}

	public function nueva_orden()
	{
		$datos['titulo'] = "Sistema de Ordenes Médicas. Orden Nueva";
		$datos['contenido'] = "nueva_orden";
		$this->load->view('plantillas/plantilla', $datos);
	}
}

/* End of file ordenes.php */
/* Location: ./application/controllers/ordenes.php */