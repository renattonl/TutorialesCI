<?php
class Crud extends CI_Controller
{
    public function __construct()
    {
        //Cargamos El Constructor
        parent::__construct();
        //Cargamos El modelo usuarios
        $this->load->model('usuarios_model');
        //Cargamos la libreria Form_validation para nuestro formulario
        $this->load->library('form_validation');
        //cargamos el helper url para utlizar el base_url
        $this->load->helper('url');
    }
    
    public function index()
    {
        //Si Existe Post y es igual a uno
        if($this->input->post('post') && $this->input->post('post')==1)
        {
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|xss_clean');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|trim|xss_clean');
            $this->form_validation->set_rules('edad', 'Edad', 'required|numeric|trim|xss_clean');
            
            $this->form_validation->set_message('required','El Campo <b>%s</b> Es Obligatorio');
            $this->form_validation->set_message('numeric','El Campo <b>%s</b> Solo Acepta Números');
            if ($this->form_validation->run() == TRUE)
            {
                $nombre = $this->input->post('nombre');
                $apellidos = $this->input->post('apellidos');
                $edad = $this->input->post('edad');
                $this->usuarios_model->agregar_usuario($nombre,$apellidos,$edad);                
            }
        }
        //obtenemos todos los usuarios
        $usuarios = $this->usuarios_model->get_usuarios();
        //creamos una variable usuarios para pasarle a la vista
        $data['usuarios'] = $usuarios;
        //cargamos nuestra vista
        $this->load->view('crud/index_view.php',$data);
    }
    
    public function editar($id=0)
    {
        //verificamos si existe el id
        $respuesta = $this->usuarios_model->get_usuario($id);
        //si nos retorna FALSE le mostramos la pag 404
        if($respuesta==false)
        show_404();
        else
        {
            //Si existe el post para editar
            if($this->input->post('post') && $this->input->post('post')==1)
            {
                $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|xss_clean');
                $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|trim|xss_clean');
                $this->form_validation->set_rules('edad', 'Edad', 'required|numeric|trim|xss_clean');
                
                $this->form_validation->set_message('required','El Campo <b>%s</b> Es Obligatorio');
                $this->form_validation->set_message('numeric','El Campo <b>%s</b> Solo Acepta Números');
                if ($this->form_validation->run() == TRUE)
                {
                    $nombre = $this->input->post('nombre');
                    $apellidos = $this->input->post('apellidos');
                    $edad = $this->input->post('edad');
                    $this->usuarios_model->actualizar_usuario($id,$nombre,$apellidos,$edad);
                    //redireccionamos al controlador CRUD
                    redirect('crud');                
                }
            }
            //devolvemos los datos del usuario
            $data['dato'] = $respuesta;
            //cargamos la vista
            $this->load->view('crud/editar_view.php',$data);
        }
    }
    
    public function eliminar($id=0)
    {
        //verificamos si existe el id
        $respuesta = $this->usuarios_model->get_usuario($id);
        //si nos retorna FALSE mostramos la pag 404.
        if($respuesta==false)
        show_404();
        else
        {
            //si existe eliminamos el usuario
            $this->usuarios_model->eliminar_usuario($id);
            //redireccionamos al controlador CRUD
            redirect('crud');  
        }
    }
}