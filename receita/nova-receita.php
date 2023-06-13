<h1>Nova Receita</h1>

<form action="?page=salvar" method="POST">
  <input type="hidden" name="acao" value="cadastrar">
  <div class="mb-3">
    <label for="">Nome</label>
    <input type="text" name="nome" class="form-control" required>
  </div>
  <div class="mb-3">
    <label for="">Código</label>
    <input type="text" name="codigo" class="form-control" required>
  </div>
  <div class="mb-3">
    <h3>Ingredientes</h3>
    <div id="ingredientes-container">
      <div class="mb-3 row">
        <div class="col-sm-5">
          <select name="ingredientes[]" class="form-select" required>
            <option value="">Selecione um ingrediente</option>
            <?php
            include 'config.php';

            $queryIngredientes = "SELECT id_ingrediente, nome FROM ingredientes";
            $resultIngredientes = $conn->query($queryIngredientes);

            if ($resultIngredientes->num_rows > 0) {
              while ($rowIngrediente = $resultIngredientes->fetch_assoc()) {
                echo '<option value="' . $rowIngrediente['id_ingrediente'] . '">' . $rowIngrediente['nome'] . '</option>';
              }
            } else {
              echo '<option value="">Nenhum ingrediente cadastrado</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-sm-3">
          <input type="text" name="ordens[]" class="form-control" type="number" placeholder="Ordem" required>
        </div>
        <div class="col-sm-3">
          <input type="text" name="previstos_kg[]" class="form-control" type="number" placeholder="Previsto em Kg"
            required>
        </div>
        <div class="col-sm-1 d-flex justify-content-center align-items-center">
          <span class="textF-danger border border-danger rounded-pill p-1 px-4" style="cursor: pointer;"
            onclick="removeIngrediente(this.parentNode.parentNode)">
            <i class="bi bi-trash"></i>
          </span>
        </div>
      </div>
    </div>
    <button type="button" class="btn btn-secondary mb-3" onclick="adicionarIngrediente()">Adicionar
      Ingrediente</button>
    <div class="mb-3">
      <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</form>

<script>
  function adicionarIngrediente() {
    var container = document.getElementById("ingredientes-container");
    var novoItem = document.createElement("div"); // criar uma nova div para os ingredientes

    novoItem.innerHTML = `
      <div class="mb-3 row">
        <div class="col-sm-5">
          <select name="ingredientes[]" class="form-select" required>
            <option value="">Selecione um ingrediente</option>
            <?php
            include 'config.php';

            $queryIngredientes = "SELECT id_ingrediente, nome FROM ingredientes";
            $resultIngredientes = $conn->query($queryIngredientes);

            if ($resultIngredientes->num_rows > 0) {
              while ($rowIngrediente = $resultIngredientes->fetch_assoc()) {
                echo '<option value="' . $rowIngrediente['id_ingrediente'] . '">' . $rowIngrediente['nome'] . '</option>';
              }
            } else {
              echo '<option value="">Nenhum ingrediente cadastrado</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-sm-3">
          <input type="text" name="ordens[]" class="form-control" type="number" placeholder="Ordem" required>
        </div>
        <div class="col-sm-3">
          <input type="text" name="previstos_kg[]" class="form-control" type="number" placeholder="Previsto em Kg" required>
        </div>
        <div class="col-sm-1 d-flex justify-content-center align-items-center">
          <span class="textF-danger border border-danger rounded-pill p-1 px-4" style="cursor: pointer;"
              onclick="removeIngrediente(this.parentNode.parentNode)">
              <i class="bi bi-trash"></i>
          </span>
        </div>
      </div>
    `;

    container.appendChild(novoItem); // adiciona a nova div ao container de ingredientes
  }

  function removeIngrediente(element) {
    element.remove();
  }
</script>