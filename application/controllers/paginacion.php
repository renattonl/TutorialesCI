<?php
class Paginacion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Cargamos nuestro modelo de noticias
        $this->load->model('noticias_model');
        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }
    
    public function index()
    {
        //cargamos la libreria pagination
        $this->load->library('pagination');
        //cargamos la librearia table
        $this->load->library('table');
        
        //la url de mi paginacion
        $config['base_url'] = base_url().'paginacion';
        //le decimos cual es la url del primer link (1)
        $config['first_url'] = base_url().'paginacion/';
        //Agregamos un prefix page (SEO)
        $config['prefix'] = '/page/';
        //Habilitamos esta opcion para que los link sean page/1,page/2,etc (SEO)
        $config['use_page_numbers'] = TRUE;
        //Le indicamos el numero total de filas
        $config['total_rows'] = $this->noticias_model->total_filas();
        //cuantas noticias vamos a mostrar por página
        $config['per_page'] = '4';
        //cantidad de link a mostrar en la paginacion
        $config['num_links'] = 4;
        //la uri de donde se encuentra nuestra pagina /paginacion/page/1
        $config['uri_segment'] = 3;
        
        $config['first_link'] = 'Primero';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Siguiente';
        $config['prev_link'] = 'Anterior';
        
        //Logica para obtener el limit
        $inicio = 0;
        if($this->uri->segment(3))
        $inicio = ($this->uri->segment(3)-1)*$config['per_page'];
        
        //cargamos la configuracion en la paginacion
        $this->pagination->initialize($config);
        //las noticias por pagina
        $noticias = $this->noticias_model->get_noticias($config['per_page'],$inicio);
        
        //configuramos la cabecera de mi tabla
        $this->table->set_heading('ID', 'TITULO', 'CONTENIDO');
        //almacenamos el contenido en una variable 
        $data['tabla'] = $this->table->generate($noticias); 
        //alamacenamos los link en una variable
        $data['link'] = $this->pagination->create_links(); 
        //cargamos nuestra vista
        $this->load->view('paginacion/index_view.php',$data);
    }
    
    public function ajax()
    {
        //Cargamos la vista ajax
        $this->load->view('paginacion/ajax_view.php');
    }
    
    public function get_noticias($offset=0)
    {
        if($this->input->is_ajax_request())
        {
            $this->load->library('Jquery_pagination');
            
            //configuramos la url de la paginacion
            $config['base_url'] = base_url('paginacion/get_noticias/');
            //configuramos el DIV html
            $config['div'] = '#div_noticias';
            //en true queremos ver Viendo 1 a 10 de 52
            $config['show_count'] = true;
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $config['total_rows'] = $this->noticias_model->total_filas();
            //el numero de filas por pagina
            $config['per_page'] = 4;
            //el numero de links visibles
            $config['num_links'] = 4;
            
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
            
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
            
            //obtemos los valores
            $noticias = $this->noticias_model->get_noticias($config['per_page'],$offset);
            $paginacion = $this->jquery_pagination->create_links();
    
            $data = array(
                'noticias' => $noticias,
                'paginacion' => $paginacion
            );
            //cargamos nuestra vista
            $this->load->view('paginacion/ajax/get_noticias.php',$data);
        }
        else
        show_404();
    }
}