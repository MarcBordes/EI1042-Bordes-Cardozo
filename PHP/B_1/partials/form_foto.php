<main>
    <h1>Sube tu foto</h1>
    <form class="form_curso" action="?action=foto_uploading" method="POST" enctype="multipart/form-data">
        <input type="text" name="name_foto" id="name" class="item_requerid" size="20" maxlength="25">
        <input type="file" accept="image/*" name="foto_cliente" id="upload">
        <input type="submit" value="Enviar">
        <input type="reset" value="Deshacer">
    </form>
</main>