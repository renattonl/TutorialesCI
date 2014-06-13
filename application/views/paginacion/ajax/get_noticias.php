<table>
    <tr>
        <th>ID</th>
        <th>TITULO</th>
        <th>CONTENIDO</th>
    </tr>
    <?php foreach($noticias as $noticia):?>
    <tr>
        <td><?= $noticia['id']?></td>
        <td><?= $noticia['titulo']?></td>
        <td><?= $noticia['cuerpo']?></td>
    </tr>
    <?php endforeach;?>
</table>

<?= $paginacion?>