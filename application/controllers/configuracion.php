<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('configuracion_model');
	}

	public function medicamentos()
	{
		if (isset($_POST) && !empty($_POST['medicamento'])) {
			// si hay post modificar orden

			$id_medicamento = $this->input->post('id_medicamento');

			$result = $this->configuracion_model->guardar_medicamento($id_medicamento);

			if($result == TRUE){
				redirect(base_url().'configuracion/medicamentos');
			}else{
				//mensaje de error
			}
		}

		$medicamentos = $this->configuracion_model->load_medicamentos();
        $datos['medicamentos'] = $medicamentos;

        //----Cargar Css y Js del Form----
        //Agregar Css
        $datos['cssFiles'] = array(
            base_url('assets/bower_components/chosen/chosen.css'),
        );
        //Agregar Js
        $datos['jsFiles'] = array(
            base_url('assets/bower_components/chosen/chosen.jquery.js'),
            base_url('assets/js/modulos/configuracion/medicamentos.js'),
        );
        //---------------------------------
        //Datos de pacientes para el chosen
        //$result = $this->pacientes_model->listar_pacientes();
        //Arreglo para el chosen
        //$datos['pacientes'] = $result;

        //print_r($datos);
        //die();

        $datos['titulo'] = "Panel de Configuración de Datos.";
        $datos['contenido'] = "medicamentos.php";
        $this->load->view('plantillas/plantilla', $datos);
	}

	public function ajax_medicamento_info(){

		//Just Allow ajax request
		if ($this->input->is_ajax_request()) {
			$id_med = $this->input->post('id_med');

			$response = $this->configuracion_model->get_medicamento_by_id($id_med);

			$json = '{"results":[' . json_encode($response) . ']}';
			echo $json;
			exit;
		}
	}
}

/* End of file configuracion.php */
/* Location: ./application/controllers/configuracion.php */