<h1>Novo Ingrediente</h1>

<form action="?page=salvaring" method="POST">
    <input type="hidden" name="acaoing" value="cadastraring">
    <div class="mb-3">
        <label for="">Nome</label>
        <input type="text" name="nome" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Código</label>
        <input type="text" name="codigo" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</form>

<script type="text/javascript">
    var counter = 1;

    function addIngredient() {
        var newIngredient = document.createElement("div");
        newIngredient.innerHTML = "Ingrediente " + (counter + 1) + ": ";
        newIngredient.innerHTML += "<input type='text' name='ingredientes[]'>";
        document.getElementById("ingredientes").appendChild(newIngredient);
        counter++;
    }
</script>