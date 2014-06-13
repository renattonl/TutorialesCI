<?php
class Frutas_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    //Obtenemos todas las filas de la tabla frutas
    public function getFrutas(){
        $sql = $this->db->get("frutas");
        return $sql->result_array();
    }
}