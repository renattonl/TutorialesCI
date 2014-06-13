<?php
class Usuarios_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //vamos a cargar todos los usuarios
    public function get_usuarios()
    {
        $sql = $this->db->get('usuarios');
        return $sql->result();
    }
    //agregamos un usuario
    public function agregar_usuario($nombre,$apellidos,$edad)
    {
        $this->db->insert('usuarios',array(
            'nombre'=> $nombre,
            'apellidos' => $apellidos,
            'edad' => $edad
        ));
    }
    //actualizamos los datos de un usuario por id
    public function actualizar_usuario($id,$nombre,$apellidos,$edad)
    {
        $this->db->where('id', $id);
        $this->db->update('usuarios',array(
            'nombre'=> $nombre,
            'apellidos' => $apellidos,
            'edad' => $edad
        ));
    }
    //eliminamos un usuario por id
    public function eliminar_usuario($id)
    {
        $this->db->delete('usuarios', array('id' => $id)); 
    }
    //Obtenemos los datos de un usuario por id
    public function get_usuario($id)
    {
        $sql = $this->db->get_where('usuarios',array('id'=>$id));
        return $sql->row_array();
    }
}