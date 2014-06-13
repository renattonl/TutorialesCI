<?php
class Pdf extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library("mpdf");
    }
    
    public function index(){
        //Especificamos algunos parametros del PDF
        $this->mpdf->mPDF('utf-8','A4');
        //CONTENIDO DEL PDF
        $html = "<h1>HOLA BIENVENIDOS</h1>";
        //ESCRIBIMOS AL PDF
        $this->mpdf->WriteHTML($html,2);
        //SALIDA DE NUESTRO PDF
        $this->mpdf->Output();
    }
    
    public function vista(){
        $this->mpdf->mPDF('utf-8','A4');
        
        //PASAMOS LA RUTA DONDE ESTA EL ESTILO 
        $stylesheet = file_get_contents('public/pdf/pdf.css');
        //cargamos el estilo CSS
        $this->mpdf->WriteHTML($stylesheet,1);
        //CARGAMOS LOS PARAMETROS
        $data['nombre'] = "Renatto NL";
        //OBTENEMOS LA VISTA EN HTML
        $html = $this->load->view('pdf/index_view.php', $data, true);
        //ESCRIBIMOS AL PDF
        $this->mpdf->WriteHTML($html,2);
        //SALIDA DE NUESTRO PDF
        $this->mpdf->Output();
    }
}