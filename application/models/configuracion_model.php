<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function load_medicamentos_activos(){
        $fields = array(
            "id_medicamento",
            "medicamento",
        );

        $clause = array(
            "status" => "activo"
        );

        $result = $this->db->select($fields)
            ->from('medicamentos')
            ->where($clause)
            ->get()
            ->result_array();

        return $result;
    }

    function load_medicamentos(){
        $fields = array(
            "id_medicamento",
            "medicamento",
        );

        $result = $this->db->select($fields)
            ->from('medicamentos')
            ->order_by('medicamento', 'ASC')
            ->get()
            ->result_array();

        return $result;
    }

    function load_unidades(){
        $fields = array(
            "id_unidad",
            "unidad",
        );

        $result = $this->db->select($fields)
            ->from('unidades')
            ->order_by('unidad', 'ASC')
            ->get()
            ->result_array();

        return $result;
    }

    function load_unidades_activas(){
        $fields = array(
            "id_unidad",
            "unidad",
        );
        $clause = array(
            "status" => "activo"
        );

        $result = $this->db->select($fields)
            ->from('unidades')
            ->order_by('unidad', 'ASC')
            ->get()
            ->result_array();

        return $result;
    }

    function get_medicamento_by_id($id_med=NULL){

        $fields = array(
            "med.id_medicamento",
            "med.medicamento",
            "med.id_unidad",
            "med.status",
            "uni.unidad",
        );

        $clause = array(
            "id_medicamento" => $id_med,
        );

        $result = $this->db->select($fields)
            ->from('medicamentos AS med')
            ->join('unidades AS uni', 'uni.id_unidad = med.id_unidad')
            ->where($clause)
            ->get()
            ->result_array();

        return $result;
    }

    function guardar_medicamento($id_medicamento){

        $fields = array(
            "medicamento" => $this->input->post('medicamento',true),
            "status" => $this->input->post('status',true),
            "id_unidad" => $this->input->post('id_unidad',true),
        );

        $clause = array(
            "id_medicamento" => $id_medicamento,
        );

        // si el medicamento existe, actualiza
        if ($id_medicamento != 0){
            $this->db->where($clause);
            $this->db->update('medicamentos', $fields);

            return true;

        }else{ // sino crea uno nuevo
            $this->db->insert('medicamentos', $fields);

            return true;
        }

    }
}

/* End of file configuracion_model.php */
/* Location: ./application/models/configuracion_model.php */