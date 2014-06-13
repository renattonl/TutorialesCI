<?php
class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $this->load->view('ajax/index_view.php');
    }
    
    public function operar()
    {
        if($this->input->is_ajax_request())
        {
            if($this->input->post('estado')=='add')
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
                    echo "Usuario Agregado";              
                }
                else
                {
                    echo validation_errors();
                }
            }
            if($this->input->post('estado')=='edit' && is_numeric($this->input->post('id')))
            {
                $respuesta = $this->usuarios_model->get_usuario($this->input->post('id'));
                if($respuesta==false)
                echo "Usuario Inválido (No Existe)";
                else
                {
                    $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('edad', 'Edad', 'required|numeric|trim|xss_clean');
                    $this->form_validation->set_rules('id', 'ID', 'required|numeric|trim|xss_clean');
                    
                    $this->form_validation->set_message('required','El Campo <b>%s</b> Es Obligatorio');
                    $this->form_validation->set_message('numeric','El Campo <b>%s</b> Solo Acepta Números');
                    if ($this->form_validation->run() == TRUE)
                    {
                        $id = $this->input->post('id');
                        $nombre = $this->input->post('nombre');
                        $apellidos = $this->input->post('apellidos');
                        $edad = $this->input->post('edad');
                        $this->usuarios_model->actualizar_usuario($id,$nombre,$apellidos,$edad); 
                        echo "Usuario Editado";              
                    }
                    else
                    {
                        echo validation_errors();
                    }
                }
            }
        }
        else
        show_404();
    }
    
    public function get()
    {
        if($this->input->is_ajax_request())
        {
            $usuarios = $this->usuarios_model->get_usuarios();
            $tabla = '<table>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>EDAD</th>
                            <th>ACCIÓN</th>
                        </tr>';
                        foreach($usuarios as $usuario):
                        $tabla.='<tr>';
                            $tabla.='<td>'.$usuario->id.'</td>';
                            $tabla.='<td>'.$usuario->nombre.'</td>';
                            $tabla.='<td>'.$usuario->apellidos.'</td>';
                            $tabla.='<td>'.$usuario->edad.'</td>';
                            $tabla.='<td><a href="javascript:void(0)" onclick="cargar_datos('.$usuario->id.')">Editar</a>
                            | <a href="javascript:void(0)" onclick="eliminar('.$usuario->id.')">Eliminar</a>';
                        $tabla.='</tr>';
                        endforeach;
                    '</table>';
            echo $tabla;
        }
        else
        show_404();
    }
    
    public function delete()
    {
        if($this->input->is_ajax_request())
        {
            $respuesta = $this->usuarios_model->get_usuario($this->input->post('id'));
            if($respuesta==false)
            echo "Usuario Inválido (No Existe)";
            else
            {
                $this->usuarios_model->eliminar_usuario($this->input->post('id'));
                echo "Usuario Eliminado";
            }
        }
        else
        show_404();
    }
    
    public function get_dato()
    {
        if($this->input->is_ajax_request())
        {
            $respuesta = $this->usuarios_model->get_usuario($this->input->post('id'));
            if($respuesta==false)
            echo "Usuario Invpalido (No Existe)";
            else
            {
                echo json_encode($respuesta);
            }
        }
        else
        show_404();
    }
}