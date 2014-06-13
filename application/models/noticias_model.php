<?php
class Noticias_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_noticias($per_page,$segmento)
    {
        $sql = $this->db->get('noticias',$per_page,$segmento);
        return $sql->result_array();
    }
    
    public function total_filas()
    {
        $sql = $this->db->get('noticias');
        return $sql->num_rows();
    }
}