<?php
class uploadify extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //cargamos el helper url para usar el base_url()
        $this->load->helper('url');
    }
    
    public function index()
    {
        //cargamos nuestra vista donde contiene le formulario
        $this->load->view('uploadify/index_view');
    }
    
    public function archivo_existe()
    {
        //verificamos si existe el archivo
        if(!empty($_POST['filename'])):
            $targetFolder = '/public/archivos';
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename']))
                //si existe nos devuelve uno
                echo 1;
            else
                //de lo contrado cero
                echo 0;
        else:
            show_404();
        endif;
    }
    
    public function upload_file()
    {
        if(!empty($_FILES['Filedata']))
        {
            //configuramos nuestrs parametros antes del subir al servidor
            $config['upload_path'] = 'public/archivos/';
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['max_size']	= '1024';
    		$config['max_width']  = '2048';
    		$config['max_height']  = '2048';
    		$config['remove_spaces']  = TRUE;
            //el nombre del input file
            $field_name = "Filedata";
            
    		$this->load->library('upload', $config);
    	    //verificamos si existe errores
    		if (!$this->upload->do_upload($field_name))
    		{
    			$error = $this->upload->display_errors();
    			echo "Existen Errores";
    		}	
            //de loc ontrario nos muestra un mensaje de exito
    		else
    		{
    			echo 'Su archivo se guardó correctamente';
    		}
        }
        else
        show_404();
    }
    
    public function get_files()
    {
        //Vamos a mostrar todos los archivos que hemos subido
        $this->load->helper('file');
        $archivos = get_filenames('public/archivos/');
        $img = '';
        for($i=0;$i<count($archivos);$i++):
            $img .= '<a href="'.base_url().'public/archivos/'.$archivos[$i].'" target="_blank"><img src="'.base_url().'public/archivos/'.$archivos[$i].'" />';
        endfor;
        //devolvemos todas la imagenes en formato HTML
        echo $img;
    }
}