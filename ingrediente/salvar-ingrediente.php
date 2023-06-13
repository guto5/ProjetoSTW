<?php
if (isset($_REQUEST["acaoing"])) {
    $acaoing = $_REQUEST["acaoing"];
    switch ($_REQUEST["acaoing"]) {
        case 'cadastraring':
            $nome = $_POST["nome"];
            $codigo = $_POST["codigo"];

            $sql = "INSERT INTO ingredientes (nome, codigo, id_receita) VALUES ('{$nome}', '{$codigo}', NULL)";

            $res = $conn->query($sql);

            if ($res == true) {
                echo "<script>alert('Ingrediente cadastrado com sucesso!');</script>";
                echo "<script>location.href='?page=listaring'</script>";
            } else {
                echo "<script>alert('Não foi possível cadastrar o ingrediente.');</script>";
                echo "<script>location.href='?page=listaring'</script>";
            }
            break;

        case 'editaring':
            $nome = $_POST["nome"];
            $codigo = $_POST["codigo"];
            $id_ingrediente = $_REQUEST["id"];

            $sql_ing = "UPDATE ingredientes SET nome='{$nome}', codigo='{$codigo}', id_receita='12' WHERE id_ingrediente=" . $id_ingrediente;
            $res_ing = $conn->query($sql_ing);

            if ($res_ing) {
                echo "<script>alert('Ingrediente Editado com Sucesso!');</script>";
                echo "<script>location.href='?page=listaring'</script>";
            } else {
                echo "<script>alert('Não foi possível efetuar a edição. Erro: " . $conn->error . "');</script>";
                echo "<script>location.href='?page=listaring'</script>";
            }
            break;

        case 'excluir':
            $id_ingrediente = $_GET["id"];
            $sqli = "DELETE FROM receita_ingredientes WHERE ingrediente_id = '$id_ingrediente'";
            $res2 = $conn->query($sqli);
            $sql = "DELETE FROM ingredientes WHERE id_ingrediente = " . $id_ingrediente;
            $res = $conn->query($sql);

            if ($res2 && $res) {
                echo "<script>alert('Ingrediente excluído com sucesso!');</script>";
                echo "<script>window.location.href = '?page=listaring';</script>";
            } else {
                echo "<script>alert('Não foi possível excluir o ingrediente!');</script>";
                echo "<script>window.location.href = '?page=listaring';</script>";
            }
            break;
    }

}



?>