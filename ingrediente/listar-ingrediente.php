<h1>Listar Ingredientes</h1>
<?php
$sql = "SELECT * FROM ingredientes";
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
        echo "<td>" . $row->id_ingrediente . "</td>";
        echo "<td>" . $row->nome . "</td>";
        echo "<td>" . "#" . $row->codigo . "</td>";
        echo "<td>";
        echo "<a href='?page=editaring&id=" . $row->id_ingrediente . "' class='btn btn-success btn-md m-1'><i class='bi bi-pencil'></i></a>";
        echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvaring&acaoing=excluir&id=" . $row->id_ingrediente . "';}else{return false;}\" class='btn btn-danger btn-md m-1'><i class='bi bi-trash'></i></button>";
        echo "</td>";
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
    $(document).ready(function () { $('#myTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>
</body>

</html>