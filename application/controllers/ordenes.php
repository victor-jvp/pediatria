<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ordenes_model');
        $this->load->model('pacientes_model');
        $this->load->model('configuracion_model');
    }

    public function nueva_orden()
    {
        if (isset($_POST) && !empty($_POST)) {

            /*
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

            if ($this->form_validation->run() == TRUE) {
                $result = $this->ordenes_model->nueva_orden();
                if ($result == TRUE) {

                    redirect(base_url() . 'ordenes/nueva-orden');
                }
            }*/

            $this->ordenes_model->nueva_orden();

        }

        //Cargar Datos de campos
        /*$campos = $this->pacientes_model->cargar_campos();
        $datos['campos'] = $campos;*/

        $medicamentos = $this->configuracion_model->load_medicamentos_activos();
        $datos['medicamentos'] = $medicamentos;
        $unidades = $this->configuracion_model->load_unidades_activas();
        $datos['unidades'] = $unidades;

        //----Cargar Css y Js del Form----
        //Agregar Css
        $datos['cssFiles'] = array(
            base_url('assets/bower_components/chosen/chosen.css'),
            base_url('assets/css/default/bootstrap-datetimepicker.css'),
        );
        //Agregar Js
        $datos['jsFiles'] = array(
            base_url('assets/bower_components/chosen/chosen.jquery.js'),
            base_url('assets/js/default/moment.js'),
            base_url('assets/js/default/bootstrap-datetimepicker.js'),
            base_url('assets/js/modulos/ordenes/nueva_orden.js'),
        );
        //---------------------------------
        //Datos de pacientes para el chosen
        $result = $this->pacientes_model->listar_pacientes();
        //Arreglo para el chosen
        $datos['pacientes'] = $result;

        //print_r($datos);
        //die();

        $datos['titulo'] = "Nueva Orden Médica.";
        $datos['contenido'] = "nueva_orden";
        $this->load->view('plantillas/plantilla', $datos);
    }

    

    public function modificar_orden(){

        if (isset($_POST) && !empty($_POST['id_orden'])) {
            // si hay post modificar orden

            $id_orden = $this->input->post('id_orden');

            $result = $this->ordenes_model->modificar_orden($id_orden);

            if($result == TRUE){
                redirect(base_url().'ordenes/modificar-orden');
            }else{

            }
        }

        //Cargar Datos de campos
        $campos = $this->pacientes_model->cargar_campos();
        $datos['campos'] = $campos;

        $medicamentos = $this->configuracion_model->load_medicamentos();
        $datos['medicamentos'] = $medicamentos;

        //----Cargar Css y Js del Form----
        //Agregar Css
        $datos['cssFiles'] = array(
            base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'),
            base_url('assets/bower_components/datatables-responsive/css/dataTables.responsive.css'),
            base_url('assets/bower_components/chosen/chosen.css'),
            base_url('assets/css/default/bootstrap-datetimepicker.css'),

        );
        //Agregar Js
        $datos['jsFiles'] = array(
            base_url('assets/bower_components/datatables/media/js/jquery.dataTables.min.js'),
            base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'),
            base_url('assets/bower_components/chosen/chosen.jquery.js'),
            base_url('assets/js/default/moment.js'),
            base_url('assets/js/default/bootstrap-datetimepicker.js'),
            base_url('assets/js/modulos/ordenes/modificar_orden.js'),
        );
        //---------------------------------
        //Datos de pacientes para el chosen
        $result = $this->pacientes_model->listar_pacientes();
        //Arreglo para el chosen
        $datos['pacientes'] = $result;

        //Datos de pacientes para la tabla
        $result = $this->ordenes_model->listar_ordenes();
        //Arreglo para la tabla
        $datos['data'] = $result;

        //print_r($datos);
        //die();

        $datos['titulo'] = "Modificar Orden Médica.";
        $datos['contenido'] = "modificar_orden";
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function ajax_tabla_ordenes(){

        //Just Allow ajax request
        if ($this->input->is_ajax_request()) {
            $id_orden = $this->input->post('id_orden');

            $response = $this->ordenes_model->get_orden_by_id($id_orden);

            $json = '{"results":[' . json_encode($response) . ']}';
            echo $json;
            exit;
        }
    }

    public function ajax_informacion_paciente()
    {

        //Just Allow ajax request
        if ($this->input->is_ajax_request()) {
            $id_paciente = $this->input->post('id_paciente');
            $response = $this->pacientes_model->get_paciente_by_id($id_paciente);

            $json = '{"results":[' . json_encode($response) . ']}';
            echo $json;
            exit;
        }
    }

    public function ajax_datos_recipe()
    {

        //Just Allow ajax request
        if ($this->input->is_ajax_request()) {
            $id_orden = $this->input->post('id_orden');
            $response = $this->ordenes_model->datos_recipe($id_orden);

            $json = '{"results":[' . json_encode($response) . ']}';
            echo $json;
            exit;
        }
    }
}

/* End of file ordenes.php */
/* Location: ./application/controllers/ordenes.php */