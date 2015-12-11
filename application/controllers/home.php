<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		//----Cargar Css y Js del Form----
		//Agregar Css
		$datos['cssFiles'] = array(
			//base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')
			
		);

		//Agregar Js
		$datos['jsFiles'] = array(
			base_url('assets/js/jquery.knob.js'),
			//base_url('assets/dist/js/jquery.knob.min.js'),
			base_url('assets/js/torta.js'),
		);
		//---------------------------------

        $datos['titulo'] = "Sistema de Ordenes Médicas. Pediatria V-2.0";
        $datos['contenido'] = "index";
        $this->load->view('plantillas/plantilla', $datos);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */