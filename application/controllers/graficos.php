<?php
class Graficos extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        //Cargamos El modelo frutas_model
        $this->load->model("frutas_model");
        //Obtenemos el array en la variable $frutas
        $frutas = $this->frutas_model->getFrutas();
        //Creamos 2 variables que van a contener nuestros datos en un String
        //Nos guiamos la estructura del grafico a mostrar
        $grafico1 = "[";
        $grafico2 = "[['Frutas', 'Cantidad'],";
        //Recoremos el array en un foreach
        foreach($frutas as $row){
            $grafico1.="['".$row['nombre_fruta']."',".$row['cantidad']."],";
            $grafico2.="['".$row['nombre_fruta']."',".$row['cantidad']."],";
        }
        $grafico1 = $grafico1."]";
        $grafico2 = $grafico2."]";
        //pasamos las variables a las vista
        $data['grafico1'] = $grafico1;
        $data['grafico2'] = $grafico2;
        //Cargamos la vista con las variables ya mencionadas
        $this->load->view("graficos/index_view",$data);
    }
}