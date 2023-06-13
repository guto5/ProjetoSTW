<?php
$idReceita = $_GET['id']; // Obtenha o ID da receita da URL

// Consultar as informações da receita
$sql = "SELECT * FROM receita WHERE id = $idReceita";
$res = $conn->query($sql);

if ($res && $res->num_rows > 0) {
    $receita = $res->fetch_assoc();

    // Consultar os ingredientes associados a essa receita
    $sqlIngredientes = "SELECT ingredientes.nome, ingredientes.codigo, ingredientes.id_ingrediente, receita_ingredientes.ordem, receita_ingredientes.previsto_kg 
    FROM ingredientes
    INNER JOIN receita_ingredientes ON ingredientes.id_ingrediente = receita_ingredientes.ingrediente_id
    WHERE receita_ingredientes.receita_id = $idReceita
    ORDER BY receita_ingredientes.ordem";

    $resIngredientes = $conn->query($sqlIngredientes);

    if ($resIngredientes && $resIngredientes->num_rows > 0) {
        echo "<h2 class=''>{$receita['nome']}</h2>";
        //echo "<h5>Ingredientes:</h5>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered shadow'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>Nome Ingrediente</th>";
        echo "<th>Código</th>";
        echo "<th>ID do Ingrediente</th>";
        echo "<th>Ordem</th>";
        echo "<th>Previsto em Kg</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($rowIngrediente = $resIngredientes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$rowIngrediente['nome']}</td>";
            echo "<td>{$rowIngrediente['codigo']}</td>";
            echo "<td>{$rowIngrediente['id_ingrediente']}</td>";
            echo "<td>{$rowIngrediente['ordem']}</td>";
            echo "<td>{$rowIngrediente['previsto_kg']}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>Nenhum ingrediente encontrado para esta receita.</p>";
    }
} else {
    echo "<p>Receita não encontrada.</p>";
}

?>