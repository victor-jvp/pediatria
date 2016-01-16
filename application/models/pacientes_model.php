<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function cargar_campos()
    {
        $fields = array(
            'campo',
            'valor',
            'texto',
            );
        $clause = array(
            'campo' => 'producto',
            'campo' => 'obtenido_por'
            );
        $result = $this->db->select($fields)
            ->from('pacientes_campos')
            ->get()
            ->result_array();

        return $result;
    }

    function nuevo_paciente()
    {
        $this->db->trans_start();

        $data['paciente'] = $this->input->post('paciente');
        $data['titular'] = $this->input->post('titular');
        $data['cedula_titular'] = $this->input->post('cedula_titular');
        $data['fecha_nacimiento'] = date("Y-m-d", strtotime($this->input->post('fecha_nacimiento')));
        $data['ant_prenatales'] = $this->input->post('ant_prenatales');
        $data['producto'] = $this->input->post('producto');
        $data['complicaciones'] = $this->input->post('complicaciones');
        $data['obtenido_por'] = $this->input->post('obtenido_por');
        $data['semanas'] = $this->input->post('semanas');
        $data['pan'] = $this->input->post('pan');
        $data['tan'] = $this->input->post('tan');
        $data['ant_personales'] = $this->input->post('ant_personales');
        $data['ant_familiares'] = $this->input->post('ant_familiares');
        $data['vacunas'] = $this->input->post('vacunas');

        //print_r($data);
        //die();

        $this->db->insert('pacientes', $data);

        $this->db->trans_complete();

        //Managing Errors
        if ($this->db->trans_status() === FALSE)
            return FALSE;
        else
            return TRUE;
    }

    function modificar_paciente($id_paciente=NULL)
    {
        $this->db->trans_start();

        $data['paciente'] = $this->input->post('paciente');
        $data['titular'] = $this->input->post('titular');
        $data['cedula_titular'] = $this->input->post('cedula_titular');
        $data['fecha_nacimiento'] = date("Y-m-d", strtotime($this->input->post('fecha_nacimiento')));
        $data['ant_prenatales'] = $this->input->post('ant_prenatales');
        $data['producto'] = $this->input->post('producto');
        $data['complicaciones'] = $this->input->post('complicaciones');
        $data['obtenido_por'] = $this->input->post('obtenido_por');
        $data['semanas'] = $this->input->post('semanas');
        $data['pan'] = $this->input->post('pan');
        $data['tan'] = $this->input->post('tan');
        $data['ant_personales'] = $this->input->post('ant_personales');
        $data['ant_familiares'] = $this->input->post('ant_familiares');
        $data['vacunas'] = $this->input->post('vacunas');

        $this->db->where('id_paciente', $id_paciente);
        $this->db->update('pacientes', $data);

        $this->db->trans_complete();

        //Managing Errors
        if ($this->db->trans_status() === FALSE)
            return FALSE;
        else
            return TRUE;
    }

    function listar_pacientes()
    {

        $campos = array(
            'id_paciente',
            'paciente',
            'fecha_nacimiento',
            'cedula_titular',
            'titular',
        );

        $result = $this->db->select($campos)
            ->from('pacientes')
            ->get()
            ->result_array();

        return $result;
    }

    function get_paciente_by_id($id_paciente){

        $campos = array(
            'id_paciente',
            'paciente',
            'fecha_nacimiento',
            'cedula_titular',
            'titular',
            'ant_prenatales',
            'producto',
            'complicaciones',
            'obtenido_por',
            'semanas',
            'pan',
            'tan',
            'ant_personales',
            'ant_familiares',
            'vacunas'
        );
        $clause = array(
            "id_paciente" => $id_paciente
        );
        $result = $this->db->select($campos)
            ->from('pacientes')
            ->where($clause)
            ->get()
            ->result_array();

        //echo $this->db->last_query();
        return $result;
    }
}

/* End of file pacientes.php */
/* Location: ./application/models/pacientes.php */