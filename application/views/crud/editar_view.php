<form method="POST">
    Nombre:<input type="text" name="nombre" value="<?= set_value('nombre',$dato['nombre']);?>" /><br />
    Apellidos:<input type="text" name="apellidos" value="<?= set_value('apellidos',$dato['apellidos']);?>" /><br />
    Edad:<input type="text" name="edad" value="<?= set_value('edad',$dato['edad']);?>" /><br />
    <input type="hidden" name="post" value="1" />
    <input type="submit" value="Editar" />
</form>
<hr />
<?= validation_errors(); ?>