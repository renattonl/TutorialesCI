<?php
class Codigo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->helper('text');
        $string = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- SEO PREMIUM-->
    <title>Graficos En Codeigniter Con Google Chart</title>
    <link rel="canonical" href="http://www.renato.16mb.com/tutorial-codeigniter-google-chart" />
    <meta name="description" content="Si bien existen una variedad d librerías que nos ayudan a generar gráficos hoy vamos aprender a usar google Char en Codeigniter. Pues lo primero que nada es revisar la librería Google Chart y ver la documentación de esta. Existen ejemplos sencillos q" />
    <meta name="keywords" content="Chart Codeigniter,Gráficos Codeigniter,Google Chart Codeigniter,generar gráficos en codeigniter,tutorial codeigniter"/> 
    <meta name="news_keywords" content="Chart Codeigniter,Gráficos Codeigniter,Google Chart Codeigniter,generar gráficos en codeigniter,tutorial codeigniter" />
    <meta name="application-name" content="Renato NL" />
    <meta name="date" content="2013-11-08"/>
';
        echo "<div style='overflow: auto;'>".highlight_code(utf8_decode($string))."</div>";
    }
    
    public function date()
    {
        $this->load->helper('date');
        
        //$now = time();
        //$human = unix_to_human($now);
        //$unix = human_to_unix($human);
        //echo $unix;
        
 
        $post_date = '1384360440';
        $now = time();
        echo '<meta charset="utf-8">';
        echo "Publicado Hace ".timespan($post_date, $now)."<br>";
        //echo time();
        //$mifecha = strtotime(date('2013-07-17 14:07:45'));
        //echo "Publicado Hace ".timespan($mifecha, $now)."<br>";
        echo $this->time_passed('2012-11-13 12:08:00');
    }
    
    private function time_passed($datetime)
    {
        $datetime = round((time() - strtotime($datetime)) / 60);
        if($datetime < 1)
            return 'Hace unos segundos.';
        if($datetime == 1)
            return 'Hace 1 minuto.';
        if($datetime < 60)
            return 'Hace ' . $datetime . ' minutos.';
        if($datetime >= 60) 
        {
            $datetime = round($datetime / 60);
            if($datetime == 1)
                return 'Hace 1 hora.';
            if($datetime < 24)
                return 'Hace ' . $datetime . ' horas.';
            if($datetime >= 24) 
            {
                $datetime = round($datetime / 24);
                if($datetime == 1)
                    return 'Ayer';
                if($datetime < 7)
                    return 'Hace ' . $datetime . ' días.';
                if($datetime >= 7)
                {
                    $datetime = round($datetime / 7);
                    if($datetime == 1)
                        return 'Hace 1 semana.';
                    if($datetime < 4)
                        return 'Hace '.$datetime.' semanas';
                    if($datetime == 4)
                        return 'Hace 1 Mes';
                    if($datetime < 52 && $datetime>=4)
                        return 'Hace '.round($datetime/4).' Meses';
                }
                if($datetime==52)
                {
                    return "Hace 1 Año";
                }
                else
                {
                    return "Hace ".$datetime." Años";
                }
            }
        }
    }
 
}