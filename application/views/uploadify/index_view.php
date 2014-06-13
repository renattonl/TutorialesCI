<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Ejemplo Upload Ajax Con Uploadify | Renato NL</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url("public/uploadify")?>/jquery.uploadify.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?= base_url("public/uploadify")?>/uploadify.css"/>
        <style type="text/css">
        body {
        	font: 13px Arial, Helvetica, Sans-serif;
        }
        img { width: 150px; margin: 10px; border: 1px solid #808080; border-radius: 10px;}
        #mensaje {padding: 10px; width: 600px; height: 25px; background-color: #008000; color: #FFF; border-radius: 10px; display: none;}
        </style>
    </head>
    
    <body>
    	<h1>Subir Archivos</h1>
    	<form>
    		<div id="queue"></div>
    		<input id="userfile" name="userfile" type="file" multiple="true"/>
            <a href="javascript:$('#userfile').uploadify('upload')">Subir archivo</a>
    	</form>
        <div id="mensaje"></div>
        <div id="respuesta"></div>
        
        <script type="text/javascript">
    		$(function() {
    		      get_imagenes();
    			$('#userfile').uploadify({
    			     /*decimos que es por metodo post*/
                    'method' : 'post',
                    /*para que no cargue automaticamente el archivo pones false*/
                    'auto' : false,
                    /*la ruta donde verifica si el archivo existe o no (opcional))*/
                    'checkExisting' : '<?= base_url("uploadify/archivo_existe")?>',
                    /*tamaño máximo de subida*/
                    'fileSizeLimit' : '512KB',
                    /*tipo de archivos permitidos*/
                    'fileTypeExts' : '*.gif; *.jpg; *.png',
                    /*tipo de subida tambien existe en porcentaje*/
                    'progressData' : 'speed',
                    /*numero maximo en cola de subida*/
                    'queueSizeLimit' : 2,
                    /*parametros opcionales via post*/
                    'formData'     : {
                        'upload' : 'si'
                    },
                    /*cargamos el archivo flash*/
                    'swf'      : '<?= base_url("public/uploadify")?>/uploadify.swf',
                    /*ruta donde hace la subida del archivo*/
                    'uploader' : '<?= base_url("uploadify/upload_file")?>',
                    /*respuesta del servidor*/
                    'onUploadSuccess' : function(file, data, response) {
                        /*mostramos el mensaje*/
                        $("#mensaje").html('El archivo ' + file.name + ' devolvió una respuesta de ' + response + ':' + data);
                        /*mostramos el div (estuvo oculto)*/
                        $("#mensaje").css('display','block');
                        /*mosramos las imagenes via ajax*/
                        get_imagenes();
                        /*ocultamos el div mensaje en 5 seg*/
                        $("#mensaje").delay(5000).hide(600);
                    }
    			});
    		});
            
            /*funcion que se encarga de mostrar las imagenes via ajax*/
            function get_imagenes()
            {
                $.ajax({
                   type: 'post',
                   url :  '<?= base_url("uploadify/get_files")?>',
                   success: function(data){
                        $("#respuesta").html(data);
                   }
                });            
            }
    	</script>
    </body>
</html>