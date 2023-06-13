<?php
$sql = "SELECT * FROM receita";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    echo "<div class='table-responsive'>";
    echo "<table id='myTable' class='table'>";
    echo "<thead class='thead-light'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nome</th>";
    echo "<th>Código</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $res->fetch_object()) {
        echo "<tr onmouseover=\"this.style.backgroundColor='#f2f2f2';\" onmouseout=\"this.style.backgroundColor='transparent';\">";
        echo "<td>" . $row->id . "</td>";
        echo "<td>" . $row->nome . "</td>";
        echo "<td>" . "#" . $row->codigo . "</td>";
        echo "<td>
                <a href='?page=visualizar&id=" . $row->id . "' class='btn btn-primary btn-md m-1'><i class='bi bi-eye'></i></a>
                <a href='?page=editar&id=" . $row->id . "' class='btn btn-success btn-md m-1'><i class='bi bi-pencil'></i></a>
                <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar&acao=excluir&id=" . $row->id . "'; }else{return false;}\" class='btn btn-danger btn-md m-1'><i class='bi bi-trash'></i></button>
               </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<p class='alert alert-danger'>Não foram encontrados resultados!</p>";
}



?>


<!-- Coloque o script do DataTables aqui -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="caminho/para/datatables.lang.pt-br.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>
</body>

</html>

<?php
if (isset($_REQUEST["id"])) {
    $idReceita = $_REQUEST["id"]; // ID da receita selecionada

    // Consultar as informações da receita
    $sql = "SELECT * FROM receita WHERE id = $idReceita";
    $res = $conn->query($sql);

    if ($res && $res->num_rows > 0) {
        $receita = $res->fetch_assoc();

        // Consultar os ingredientes associados a essa receita
        $sqlIngredientes = "SELECT i.nome, ri.ordem, ri.previsto_kg FROM ingredientes AS i
    INNER JOIN receita_ingredientes AS ri ON i.id = ri.ingrediente_id
    WHERE ri.receita_id = $idReceita";
        $resIngredientes = $conn->query($sqlIngredientes);

        if ($resIngredientes && $resIngredientes->num_rows > 0) {
            echo "<h2>Receita: {$receita['nome']}</h2>";
            echo "<h3>Ingredientes:</h3>";
            echo "<ul>";
            while ($rowIngrediente = $resIngredientes->fetch_assoc()) {
                echo "<li>{$rowIngrediente['nome']} - Ordem: {$rowIngrediente['ordem']}, Previsto em Kg:
            {$rowIngrediente['previsto_kg']}</li>";
            }
            echo "</ul>";
        } else {
            echo "Nenhum ingrediente encontrado para esta receita.";
        }
    } else {
        echo "Receita não encontrada.";
    }
}
?>