<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('home_model');
	}
	public function index()
	{

		$data = $this->home_model->data_info();
		$datos['ordenes'] 	= $data['ordenes'];
		$datos['pacientes'] = $data['pacientes'];

		//----Cargar Css y Js del Form----
		//Agregar Css
		$datos['cssFiles'] = array(
			//base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')
		);

		//Agregar Js
		$datos['jsFiles'] = array(
			//base_url('assets/js/jquery.knob.js'),
			//base_url('assets/dist/js/jquery.knob.min.js'),
			//base_url('assets/js/torta.js'),
		);
		//---------------------------------

        $datos['titulo'] = "Inicio - Sistema de Ordenes Médicas.";
        $datos['contenido'] = "index";
        $this->load->view('plantillas/plantilla', $datos);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */