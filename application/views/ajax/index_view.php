<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Ejemplo Ajax - Codeigniter</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <style>
        label,.submit{display: block; margin-bottom: 5px;}
        .submit{cursor: pointer; margin-top: 5px;}
    </style>
    <script>
        $(document).ready(function(){
            load();
            $("#form").submit(function(){
                operar();
                return false;
            });
        });
        function load()
        {
            $.ajax({
                type: 'POST',
                url: '<?= base_url().'ajax/get'?>',
                success: function(data){
                    $("#load").html(data);
                }
            });
        }
        function operar()
        {
            $("input[type=submit]").attr("disabled", "disabled");
            $.ajax({
                type: 'POST',
                url: '<?= base_url().'ajax/operar'?>',
                data: $("#form").serialize(),
                success: function(data){
                    $("#mensaje").html(data);
                    load();
                    $("input[type=submit]").removeAttr("disabled");
                }
            });
        }
        function cargar_datos(id)
        {
            $.ajax({
                type: 'POST',
                url: '<?= base_url().'ajax/get_dato'?>',
                data: {'id': id},
                success: function(data){
                    data = $.parseJSON(data);
                    $("#nombre").val(data.nombre);
                    $("#apellidos").val(data.apellidos);
                    $("#edad").val(data.edad);
                    $("#estado").val('edit');
                    $("#submit").val('Editar');
                    $("#id").val(data.id);
                }
            });
        }
        function eliminar(id)
        {
            $.ajax({
                type: 'POST',
                url: '<?= base_url().'ajax/delete'?>',
                data: {'id': id},
                success: function(data){
                    $("#mensaje").html(data);
                    load();
                    limpiaForm("#form");
                }
            });  
        }
        function nuevo()
        {
            limpiaForm("#form");
            $("#mensaje").html('');
            $("#estado").val('add');
            $("#submit").val('Agregar');  
        }
        function limpiaForm(miForm) 
        {
            $(':input', miForm).each(function() {
            var type = this.type;
            var tag = this.tagName.toLowerCase();
            if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'hidden')
            this.value = "";
            else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
            else if (tag == 'select')
            this.selectedIndex = 0;
            });
        }
    </script>
</head>
<body>
    <div id="mensaje"></div>
    
    <form id="form">
        <label>Nombre: </label>
        <input type="text" name="nombre" id="nombre" />
        <label>Apellidos: </label>
        <input type="text" name="apellidos" id="apellidos" />
        <label>Edad: </label>
        <input type="text" name="edad" id="edad" />
        <input type="hidden" name="estado" id="estado" value="add" />
        <input type="hidden" name="id" id="id" value="" />
        <input type="submit" value="Agregar" id="submit" class="submit" />
        <input type="button" onclick="nuevo()" value="Nuevo" />
    </form>
    
    <div id="load"></div>
</body>
</html>