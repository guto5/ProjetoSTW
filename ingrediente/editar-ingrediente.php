<h1>Editar Ingrediente</h1>

<?php

$sql = "SELECT * FROM ingredientes WHERE id_ingrediente=" . $_REQUEST["id"];
$res = $conn->query($sql);

if ($res && $res->num_rows > 0) {
    $row = $res->fetch_object();
    ?>

    <form action="?page=salvaring" method="POST">
        <input type="hidden" name="acaoing" value="editaring">
        <input type="hidden" name="id" value="<?php echo $row->id_ingrediente; ?>">
        <div class="mb-3">
            <label for="">Nome</label>
            <input type="text" name="nome" value="<?php echo $row->nome; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Código</label>
            <input type="text" name="codigo" value="<?php echo $row->codigo; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" name="editar_ingrediente" class="btn btn-primary">Salvar</button>
        </div>
    </form>

    <?php
} else {
    echo "<p>Ingrediente não encontrada.</p>";
}
?>