<?php
class Bienvenido extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        echo "Hola mundo";
    }
    
    public function sin_parametros()
    {
        $this->load->view('sin_parametros_view.php');
    }
    
    public function con_parametros()
    {
        $datos['titulo'] = 'Hola desde la vista';
        $datos['contenido'] = 'Este es codigo HTML puro';
        $this->load->view('con_parametros_view.php',$datos);
    }
}