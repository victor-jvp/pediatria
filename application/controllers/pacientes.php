<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pacientes_model');
	}

	public function nuevo_paciente(){

		if(isset($_POST) && !empty($_POST)) {

			$this->form_validation->set_rules('paciente', 'Nombre del paciente', 'trim|required|xss_clean');
			$this->form_validation->set_rules('titular', 'Nombre del titular', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cedula_titular', 'Cédula del titular', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fecha_nacimiento', 'Fecha de nacimiento', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ant_prenatales', 'Antecedentes prenatales', 'trim|required|xss_clean');
			$this->form_validation->set_rules('complicaciones', 'Complicaciones al nacer', 'trim|required|xss_clean');
			$this->form_validation->set_rules('semanas', 'Semanas de gestación', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pan', 'Peso al nacer', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tan', 'Tamaño al nacer', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ant_personales', 'Antecedentes personales', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ant_familiares', 'Antecedentes familiares', 'trim|required|xss_clean');
			$this->form_validation->set_rules('vacunas', 'Vacunas', 'trim|required|xss_clean');

			//$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>', '</strong></div>');

			$this->form_validation->set_message('required', 'El campo %s es requerido.');

			if ($this->form_validation->run() == TRUE)
			{
				$result = $this->pacientes_model->nuevo_paciente();
				if($result == TRUE){

					redirect(base_url().'ordenes/nueva-orden');
				}
			}
		}

		//Cargar Datos de campos
		$campos = $this->pacientes_model->cargar_campos();
		$datos['campos'] = $campos;

		//----Cargar Css y Js del Form----
		//Agregar Css
		$datos['cssFiles'] = array(
			base_url('assets/css/default/bootstrap-datetimepicker.css'),
		);

		//Agregar Js
		$datos['jsFiles'] = array(
			base_url('assets/js/default/moment.js'),
			base_url('assets/js/default/bootstrap-datetimepicker.js'),
			base_url('assets/js/modulos/pacientes/crear_paciente.js'),

		);
		//---------------------------------

		$datos['titulo'] = "Sistema de Ordenes Médicas. Pacientes";
		$datos['contenido'] = "nuevo_paciente";
		$this->load->view('plantillas/plantilla', $datos);
		//$this->Pacientes_model->nuevo_paciente($data);

	}

	public function ajax_modificar_paciente(){

		//Just Allow ajax request
		if($this->input->is_ajax_request())
		{
			$id_paciente = $this->input->post('id_paciente');
			$response =  $this->pacientes_model->get_pacientes_by_id($id_paciente);
			
			$json = '{"results":['.json_encode($response).']}';
			echo $json;
			exit;
		}
	}

	public function modificar_paciente()
	{
		if(isset($_POST) && !empty($_POST['id_paciente'])) {

			// si hay post modificar paciente
			$id_paciente = $this->input->post('id_paciente');

			$result = $this->pacientes_model->modificar_paciente($id_paciente);

			if($result == TRUE){
				redirect(base_url().'pacientes/modificar-paciente');
			}
		}

		//Cargar Datos de campos
		$campos = $this->pacientes_model->cargar_campos();
		$datos['campos'] = $campos;

		//----Cargar Css y Js del Form----
		//Agregar Css
		$datos['cssFiles'] = array(
			base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'),
			base_url('assets/bower_components/datatables-responsive/css/dataTables.responsive.css'),
			base_url('assets/css/default/bootstrap-datetimepicker.css'),
		);

		//Agregar Js
		$datos['jsFiles'] = array(
			base_url('assets/bower_components/datatables/media/js/jquery.dataTables.min.js'),
			base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'),
			base_url('assets/js/default/moment.js'),
			base_url('assets/js/default/bootstrap-datetimepicker.js'),
			base_url('assets/js/modulos/pacientes/editar_paciente.js'),
		);
		//---------------------------------

		//Datos de pacientes para la tabla
		$result = $this->pacientes_model->listar_pacientes();
		//Arreglo para la tabla
		$datos['data'] = $result;

		//print_r($datos);
		//die();

		//Cargar vista
		$datos['titulo'] = "Sistema de Ordenes Médicas. Pacientes";
        $datos['contenido'] = "modificar_paciente";
        $this->load->view('plantillas/plantilla', $datos);
	}
}

/* End of file pacientes.php */
/* Location: ./application/controllers/pacientes.php */