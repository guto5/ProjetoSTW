<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Receitas</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cadastro Receitas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=listar">Listar Receita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=nova">Nova Receita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=listaring">Listar Ingrediente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=novoing">Novo Ingrediente</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <?php
                include("config.php");

                if (isset($_REQUEST["page"])) {
                    switch ($_REQUEST["page"]) {
                        case "nova":
                            include("receita/nova-receita.php");
                            break;
                        case "listar":
                            include("receita/listar-receita.php");
                            break;
                        case "salvar":
                            include("receita/salvar-receita.php");
                            break;
                        case "editar":
                            include("receita/editar-receita.php");
                            break;
                        case "novoing":
                            include("ingrediente/novo-ingrediente.php");
                            break;
                        case "listaring":
                            include("ingrediente/listar-ingrediente.php");
                            break;
                        case "salvaring":
                            include("ingrediente/salvar-ingrediente.php");
                            break;
                        case "editaring":
                            include("ingrediente/editar-ingrediente.php");
                            break;
                        case "desconectar_ingrediente":
                            include("receita/desconectar-ingrediente.php");
                            break;
                        case "visualizar":
                            include("receita/visualizar-receita.php");
                            break;

                        default:
                            echo "<h1>Bem-vindo!</h1>";
                    }
                } else {
                    echo "<h1>Bem-vindo!</h1>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>