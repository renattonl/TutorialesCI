<h1>Listado De Usuarios</h1>
<table>
    <tr>
        <th>ID</th>    
        <th>Nombre</th>  
        <th>Apellidos</th>  
        <th>Edad</th>  
        <th>Accion</th>  
    </tr>
    <?php foreach($usuarios as $usuario):?>
    <tr>
        <td><?= $usuario->id?></td>    
        <td><?= $usuario->nombre?></td>  
        <td><?= $usuario->apellidos?></td>  
        <td><?= $usuario->edad?></td>
        <td><a href="<?= base_url().'crud/editar/'.$usuario->id?>">Editar</a> | <a href="<?= base_url().'crud/eliminar/'.$usuario->id?>">Eliminar</a></td>
    </tr>
    <?php endforeach;?>
</table>
<hr />
<form method="POST">
    Nombre:<input type="text" name="nombre" value="<?= set_value('nombre');?>" /><br />
    Apellidos:<input type="text" name="apellidos" value="<?= set_value('apellidos');?>" /><br />
    Edad:<input type="text" name="edad" value="<?= set_value('edad');?>" /><br />
    <input type="hidden" name="post" value="1" />
    <input type="submit" value="Agregar" />
</form>
<hr />
<?= validation_errors(); ?>