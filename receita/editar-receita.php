<h1>Editar Receita</h1>

<?php
$sql = "SELECT * FROM receita WHERE id=" . $_REQUEST["id"];
$res = $conn->query($sql);

if ($res && $res->num_rows > 0) {
  $row = $res->fetch_object();
  ?>

  <form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
    <div class="mb-3">
      <label for="">Nome</label>
      <input type="text" name="nome" value="<?php echo $row->nome; ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label for="">Código</label>
      <input type="text" name="codigo" value="<?php echo $row->codigo; ?>" class="form-control">
    </div>

    <!-- Lista de ingredientes da receita -->
    <div class="mb-3">
      <label for="">Ingredientes da Receita</label>

      <?php
      $ing_receita = "SELECT * FROM receita_ingredientes WHERE receita_id = {$row->id}";
      $res2 = $conn->query($ing_receita);

      if ($res2 && $res2->num_rows > 0) {
        while ($row2 = $res2->fetch_object()) {
          $ingredientes = "SELECT * FROM ingredientes WHERE id_ingrediente = {$row2->ingrediente_id}";
          $res3 = $conn->query($ingredientes);

          if ($res3 && $res3->num_rows > 0) {
            while ($row3 = $res3->fetch_object()) {
              ?>
              <div class="mb-3 row">
                <div class="col-sm-5">
                  <select name="ingredientes-edit[]" class="form-select" required>
                    <?php
                    include 'config.php';

                    $queryIngredientes = "SELECT id_ingrediente, nome FROM ingredientes";
                    $resultIngredientes = $conn->query($queryIngredientes);

                    if ($resultIngredientes->num_rows > 0) {
                      while ($rowIngrediente = $resultIngredientes->fetch_assoc()) {
                        $selected = ($rowIngrediente['id_ingrediente'] == $row2->ingrediente_id) ? 'selected' : '';
                        echo '<option value="' . $rowIngrediente['id_ingrediente'] . '" ' . $selected . '>' . $rowIngrediente['nome'] . '</option>';
                      }
                    } else {
                      echo '<option value="">Nenhum ingrediente cadastrado</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-3">
                  <input name="ordens-edit[]" class="form-control" type="number" placeholder="Ordem"
                    value="<?php echo $row2->ordem; ?>" />
                </div>
                <div class="col-sm-3">
                  <input name="previstos_kg-edit[]" class="form-control" type="number" placeholder="Previsto em kg"
                    value="<?php echo $row2->previsto_kg; ?>" />
                </div>
                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                  <span class="textF-danger border border-danger rounded-pill p-1 px-4" style="cursor: pointer;"
                    onclick="removeIngrediente(this.parentNode.parentNode)">
                    <i class="bi bi-trash"></i>
                  </span>
                </div>

              </div>
              <?php
            }
          }
        }
      }
      ?>
    </div>
    <div>
      <div id="ingredientes-container">
      </div>
      <button type="button" class="btn btn-secondary" onclick="adicionarIngrediente()">Adicionar Ingrediente</button>
      <button type="submit" name="editar_receita" class="btn btn-primary">Salvar</button>
  </form>


  <script>
    // Function to disconnect ingredient from recipe
    function disconnectIngrediente(idIngrediente) {
      if (confirm("Deseja retirar este ingrediente da receita?")) {
        window.location.href = "?page=desconectar_ingrediente&id=<?php echo $_REQUEST['id']; ?>&id_ingrediente=" + idIngrediente;
      }
    }

    function adicionarIngrediente() {
      var container = document.getElementById("ingredientes-container");
      var novoItem = document.createElement("div"); // criar uma nova div para os ingredientes

      novoItem.innerHTML = `
        <div class="mb-3 row">
          <div class="col-sm-5">
            <select name="ingredientes-edit[]" class="form-select" required>
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
              <input type="text" name="ordens-edit[]" class="form-control" type="number" placeholder="Ordem" required>
            </div>
            <div class="col-sm-3">
              <input type="text" name="previstos_kg-edit[]" class="form-control" type="number" placeholder="Previsto em Kg" required>
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


  <?php
} else {
  echo "<p>Receita não encontrada.</p>";
}
?>