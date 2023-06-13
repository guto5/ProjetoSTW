<?php
switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $nome = $_POST["nome"];
        $codigo = $_POST["codigo"];
        $ingredientes = $_POST["ingredientes"];
        $ordens = $_POST["ordens"];
        $previstos_kg = $_POST["previstos_kg"];

        // Inserir a nova receita
        $sql = "INSERT INTO receita (nome, codigo) VALUES ('$nome', '$codigo')";
        $res = $conn->query($sql);

        if ($res) {
            $idReceita = $conn->insert_id; // Obter o último ID gerado

            // Inserir os ingredientes na tabela receita_ingredientes
            $success = true; // Flag para verificar se todas as inserções foram bem-sucedidas
            for ($i = 0; $i < count($ingredientes); $i++) {
                $ingrediente = $ingredientes[$i];
                $ordem = $ordens[$i];
                $previsto_kg = $previstos_kg[$i];

                $sqli = "INSERT INTO receita_ingredientes (receita_id, ingrediente_id, ordem, previsto_kg) VALUES ($idReceita, $ingrediente, $ordem, $previsto_kg)";

                $result = $conn->query($sqli);

                if (!$result) {
                    $success = false;
                    break; // Se uma inserção falhar, interrompe o loop
                }
            }

            if ($success) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                echo "<script>location.href='?page=listar';</script>";
            } else {
                echo "<script>alert('Não foi possível efetuar o cadastro');</script>";
                echo "<script>location.href='?page=listar';</script>";
            }
        }
        break;



    case 'editar':
        $nome = $_POST["nome"];
        $codigo = $_POST["codigo"];
        $id = $_REQUEST["id"];

        $ingredientes = $_POST["ingredientes-edit"];
        $ordens = $_POST["ordens-edit"];
        $previstos_kg = $_POST["previstos_kg-edit"];

        $sql_receita = "UPDATE receita SET nome = '{$nome}', codigo = '{$codigo}' WHERE id = {$id}";
        $res_receita = $conn->query($sql_receita);



        if ($res_receita) {
            // Deletar ingredientes existentes da tabela receita_ingredientes
            $sql_delete = "DELETE FROM receita_ingredientes WHERE receita_id = '{$id}'";
            $result_delete = $conn->query($sql_delete);

            if (!$result_delete) {
                echo "<script>alert('Não foi possível excluir os ingredientes existentes.');</>";
                echo "<script>location.href='?page=listar';</script>";
                break;
            }

            // Inserir os novos ingredientes na tabela receita_ingredientes
            $success = true; // Flag para verificar se todas as inserções foram bem-sucedidas
            for ($i = 0; $i < count($ingredientes); $i++) {
                $ingrediente = $ingredientes[$i];
                $ordem = $ordens[$i];
                $previsto_kg = $previstos_kg[$i];



                $sql_insert = "INSERT INTO receita_ingredientes (receita_id, ingrediente_id, ordem, previsto_kg) VALUES ($id, $ingrediente, $ordem, $previsto_kg)";
                $result_insert = $conn->query($sql_insert);

                if (!$result_insert) {
                    $success = false;
                    break; // Se uma inserção falhar, interrompe o loop
                }
            }

            if ($success) {
                echo "<script>alert('Edição realizada com sucesso!');</script>";
                echo "<script>location.href='?page=listar';</script>";
            } else {
                echo "<script>alert('Não foi possível efetuar a edição.');</script>";
                echo "<script>location.href='?page=listar';</script>";
            }
        }
        break;

    case 'excluir':
        $id = $_REQUEST["id"];

        // Excluir os registros da tabela receita_ingredientes associados à receita
        $sqlExcluirIngredientes = "DELETE FROM receita_ingredientes WHERE receita_id = {$id}";
        $resExcluirIngredientes = $conn->query($sqlExcluirIngredientes);

        // Excluir o registro da tabela receita
        $sqlExcluirReceita = "DELETE FROM receita WHERE id = {$id}";
        $resExcluirReceita = $conn->query($sqlExcluirReceita);

        if ($resExcluirReceita && $conn->affected_rows > 0) {
            print "<script>alert('Receita Excluída com Sucesso!');</script>";
            print "<script>location.href='?page=listar'</script>";
        } else {
            print "<script>alert('Não foi possível excluir a receita');</script>";
            print "<script>location.href='?page=listar'</script>";
        }

        break;
}
?>