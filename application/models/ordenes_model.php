<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    function nueva_orden(){

        $fields = array(
            'fecha_consulta'    => date("Y-m-d", strtotime($this->input->post("fecha_consulta", true))),
            'id_paciente'       => $this->input->post("id_paciente", true),
            'peso'              => $this->input->post("peso", true),
            'altura'            => $this->input->post("altura", true),
            'sintomas'          => $this->input->post("sintomas", true),
            'diagnostico'       => $this->input->post("diagnostico", true),
            'cc'                => $this->input->post("cc", true),
            'observaciones'     => $this->input->post("observaciones", true),
        );

        $this->db->insert('ordenes', $fields);

        //agregar datos del recipe
        $id_orden = $this->db->insert_id();

        if(!empty($_POST['recipes'])){

            foreach ($_POST['recipes'] AS $recipe) {
                //Si es vacio continuar al siguiente telefono
                if(empty($recipe)){
                    continue;
                }
                    
                //Guardar datos
                $fieldset = array(
                    'id_orden' => $id_orden,
                    'id_medicamento' => $recipe["id_medicamento"],
                    'indicacion' => $recipe["indicacion"],
                );
                $this->db->insert('ordenes_recipes', $fieldset);
            }
        }
    }

    function modificar_orden($id_orden = NULL){

        $this->db->trans_start();

        $fields = array(
            'fecha_consulta'    => date("Y-m-d", strtotime($this->input->post("fecha_consulta", true))),
            'id_paciente'       => $this->input->post("id_paciente", true),
            'peso'              => $this->input->post("peso", true),
            'altura'            => $this->input->post("altura", true),
            'sintomas'          => $this->input->post("sintomas", true),
            'diagnostico'       => $this->input->post("diagnostico", true),
            'cc'                => $this->input->post("cc", true),
            'observaciones'     => $this->input->post("observaciones", true),
        );

        $this->db->where('id_orden', $id_orden);
        $this->db->update('ordenes', $fields);

        if(!empty($_POST['recipes'])){

            $this->db->where('id_orden', $id_orden);
            $this->db->delete('ordenes_recipes');

            foreach ($_POST['recipes'] AS $recipe) {
                //Si es vacio continuar al siguiente telefono
                if(empty($recipe)){
                    continue;
                }
                //Guardar datos
                $fieldset = array(
                    'id_orden' => $id_orden,
                    'id_medicamento' => $recipe["id_medicamento"],
                    'indicacion' => $recipe["indicacion"],
                );
                $this->db->insert('ordenes_recipes', $fieldset);
            }
        }

        $this->db->trans_complete();

        //Managing Errors
        if ($this->db->trans_status() === FALSE)
            return FALSE;
        else
            return TRUE;
    }

    function listar_ordenes(){

        $fields = array(
            'id_orden',
            'fecha_consulta',
            'ord.id_paciente',
            'pac.paciente'
            );

        $result = $this->db->select($fields)
            ->from('ordenes as ord')
            ->join('pacientes as pac', 'pac.id_paciente = ord.id_paciente', 'LEFT')
            ->get()
            ->result_array();

        return $result;
    }

    function get_orden_by_id($id_orden = NULL){

        $fields = array(
            'id_orden',
            'fecha_consulta',
            'id_paciente',
            'peso',
            'altura',
            'sintomas',
            'diagnostico',
            'cc',
            'observaciones',
            );

        $clause = array(
            'id_orden' => $id_orden
            );

        $result = $this->db->select($fields)
            ->from('ordenes')
            ->where($clause)
            ->get()
            ->result_array();

        $data[0]['id_orden']       = $result[0]['id_orden'];
        $data[0]['fecha_consulta'] = $result[0]['fecha_consulta'];
        $data[0]['id_paciente']    = $result[0]['id_paciente'];
        $data[0]['peso']           = $result[0]['peso'];
        $data[0]['altura']         = $result[0]['altura'];
        $data[0]['sintomas']       = $result[0]['sintomas'];
        $data[0]['diagnostico']    = $result[0]['diagnostico'];
        $data[0]['cc']             = $result[0]['cc'];
        $data[0]['observaciones']  = $result[0]['observaciones'];
        
        $fields = array(
            'id_orden',
            'id_medicamento',
            'indicacion',
            );

        $clause = array(
            'id_orden' => $id_orden
            );

        $result = $this->db->select($fields)
            ->from('ordenes_recipes')
            ->where($clause)
            ->get()
            ->result_array();

        $data[0]['recipe'] = $result;

        return $data;

    }

    function datos_recipe($id_orden = NULL){

        $fields = array(
            'id_orden',
            'id_medicamento',
            'med.medicamento',
            'indicacion',
            );

        $clause = array(
            'id_orden' => $id_orden,
            );

        $result = $this->db->select($fields)
            ->from('ordenes_recipes')
            ->join('medicamentos AS med', 'med.id_medicamento = id_medicamento', 'LEFT')
            ->where($clause)
            ->get()
            ->result_array();

        return $result;
    }

}