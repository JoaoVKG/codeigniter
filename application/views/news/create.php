

<?php echo form_open('news/create'); ?>

    <label for="title">Título</label>
    <input type="input" name="title" /><br />

    <label for="text">Texto</label>
    <textarea name="text"></textarea><br />

    <input type="submit" name="submit" value="Criar nova notícia" />
    <div style="color: red"><?php echo validation_errors(); ?></div>

</form>