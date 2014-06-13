<?php
class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //cargamos nuestro modelo usuarios
        $this->load->model('usuarios_model');
    }
    
    public function index()
    {
        //vamos a listar los usuarios:
        $usuarios = $this->usuarios_model->get_usuarios();
        foreach($usuarios as $usuario)
        {
            echo 'nombre: '.$usuario->nombre.'<br>';
            echo 'apellidos: '.$usuario->apellidos.'<br>';
            echo 'edad: '.$usuario->edad.'<br>';
        }
    }
}