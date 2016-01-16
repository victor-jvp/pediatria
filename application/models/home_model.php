<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function data_info(){

        $result1 = $this->db->query('SELECT COUNT(id_orden) as ordenes FROM ordenes')->result_array();
        $result2 = $this->db->query('SELECT COUNT(id_paciente) as pacientes FROM pacientes')->result_array();

        $data['ordenes']     = $result1[0]['ordenes'];
        $data['pacientes']   = $result2[0]['pacientes'];

        return $data;
    }
}