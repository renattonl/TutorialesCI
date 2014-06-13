<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="www.renato.16mb.com" />
    <meta charset="utf-8" />
	<title>Páginacion AJAX JQUERY Demo  Codeigniter - Renato NL</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $().ready(function(){
            $.ajax({
               type: 'POST',
               url: '<?= base_url("paginacion/get_noticias")?>',
               success: function(data){
                    $("#div_noticias").html(data);
               }
            });
        })
    </script>
</head>

<body>

    <div id="div_noticias"></div>

</body>
</html>