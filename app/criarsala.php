<?php

require_once __DIR__ . "/banco/crud.php";
require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

$pdo = database();

// IDENTIFICAÇÃO DO USUÁRIO
$user = $_GET['user'] ?? $_POST['user'] ?? '';

if ($user === '') {
    die("Usuário não identificado.");
}


// BUSCA OS DADOS DO USUÁRIO
$dadosUser = $pdo->prepare("
    SELECT *
    FROM usuarios
    WHERE nome_usuario = :user
");

$dadosUser->execute([
    ':user' => $user
]);

$usuario = $dadosUser->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}


// BUSCA O PERSONAGEM E O ACESSÓRIO
$consultaAvatar = $pdo->prepare("
    SELECT personagem, acessorio
    FROM personagens
    WHERE nome_usuario = :user
");

$consultaAvatar->execute([
    ':user' => $user
]);

$avatar = $consultaAvatar->fetch(PDO::FETCH_ASSOC);


// IMAGENS PADRÃO
$imagemPersonagem = "./imgs/avatarexemplo.png";
$imagemAcessorio = null;


// IDENTIFICA O PERSONAGEM
if ($avatar) {

    $personagemId = (string) $avatar['personagem'];

    if (isset($personagens[$personagemId])) {
        $imagemPersonagem = $personagens[$personagemId];
    }

    // IDENTIFICA O ACESSÓRIO
    if ($avatar['acessorio'] !== null) {

        $acessorioId = (string) $avatar['acessorio'];

        if (isset($acessorios[$acessorioId])) {
            $imagemAcessorio = $acessorios[$acessorioId];
        }
    }
}


// BUSCA AS INFORMAÇÕES PARA O CADASTRO DA SALA
$materias = readAll(database(), "materias");
$area = readAll(database(), "area_conhecimento");
$grupo = readAll(database(), "grupos_estudos");


// CADASTRO DA SALA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $areaSelecionada = $_POST['area'] ?? '';
    $materia = $_POST['materias'] ?? '';
    $ambiente = $_POST['ambiente'] ?? '';
    $nome_sala = $_POST['nome_sala'] ?? '';
    $status = $_POST['status'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $criador = $usuario['nome_usuario'];
    $data = $_POST['data'] ?? date('Y-m-d');


    $materiasPorArea = [
        "Exatas" => ["Matemática", "Física", "Química"],
        "Ciências Naturais" => ["Biologia", "Geologia", "Astronomia", "Ecologia"],
        "Ciências Humanas" => ["História", "Geografia", "Filosofia", "Sociologia"],
        "Linguagens" => ["Língua Portuguesa", "Línguas Estrangeiras", "Literatura"]
    ];


    // VERIFICA CAMPOS VAZIOS
    if (
        $ambiente === '' ||
        $nome_sala === '' ||
        $areaSelecionada === '' ||
        $materia === '' ||
        $status === ''
    ) {

        header("Location: criarsala.php?user=" . urlencode($user) . "&erro=" . urlencode("Espaço vazio"));
        exit;
    }


    // VERIFICA SENHA DO GRUPO PRIVADO
    if ($status == "privado" && $senha == "") {

        header("Location: criarsala.php?user=" . urlencode($user) . "&erro=" . urlencode("Espaço vazio"));
        exit;
    }


    // VERIFICA TAMANHO DA SENHA
    if (strlen($senha) > 20) {

        header("Location: criarsala.php?user=" . urlencode($user) . "&erro=" . urlencode("Senha grande demais (máx. 20)"));
        exit;
    }


    // VERIFICA SE A MATÉRIA PERTENCE À ÁREA
    if (
        !in_array(
            $materia,
            $materiasPorArea[$areaSelecionada] ?? [],
            true
        )
    ) {

        header("Location: criarsala.php?user=" . urlencode($user) . "&erro=" . urlencode("A matéria selecionada não faz parte dessa área de conhecimento"));
        exit;
    }


    // VERIFICA SENHA EM GRUPO PÚBLICO
    if ($status == "publico" && $senha != "") {

        header("Location: criarsala.php?user=" . urlencode($user) . "&erro=" . urlencode("Só é possível cadastrar uma senha caso o grupo seja privado"));
        exit;
    }


    // CADASTRA A SALA
    create(database(), "grupos_estudos", [

        "nome_grupo" => $nome_sala,
        "data_criacao" => $data,
        "nome_area" => $areaSelecionada,
        "nome_materia" => $materia,
        "senha" => $senha,
        "status_grupo" => $status,
        "id_imagem" => $ambiente,
        "criador" => $criador,

    ]);

    if($areaSelecionada == "Exatas"){
    header("Location: salaexatas.php?user=" . urlencode($user) . "&grupo=" . urlencode($nome_sala));
    exit;
    }
    if($areaSelecionada == "Ciências Naturais"){
    header("Location: salanaturais.php?user=" . urlencode($user) . "&grupo=" . urlencode($nome_sala));
    exit;
    }
    if($areaSelecionada == "Ciências Humanas"){
    header("Location: salahumanas.php?user=" . urlencode($user) . "&grupo=" . urlencode($nome_sala));
    exit;
    }
    if($areaSelecionada == "Linguagens"){
    header("Location: salalinguagens.php?user=" . urlencode($user) . "&grupo=" . urlencode($nome_sala));
    exit;
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMatch</title>

    <link rel="stylesheet" href="css/criarsala.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>


    <!-- CABEÇALHO -->

    <div class="cabecalho">

        <div class="img-cabecalho">

            <a href="homeperfil.php?user=<?= urlencode($user) ?>">
                <img src="imgs/logo.png" alt="Logo StudyMatch">
            </a>

        </div>


        <nav>

            <ul>

                <li>
                    <a href="selecionar-sala.php?user=<?= urlencode($user) ?>">
                        <p>Grupos de Estudo</p>
                    </a>
                </li>

                <li>
                    <a href="social.php?user=<?= urlencode($user) ?>">
                        <p>Social</p>
                    </a>
                </li>

                <li>
                    <a href="progresso.php?user=<?= urlencode($user) ?>">
                        <p>Progresso</p>
                    </a>
                </li>

            </ul>

        </nav>


        <!-- AVATAR COM PERSONAGEM E ACESSÓRIO -->

        <a href="perfil.php?user=<?= urlencode($user) ?>">

            <div class="fotoConta">

                <img
                    class="personagemCabecalho"
                    src="<?= htmlspecialchars($imagemPersonagem, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Foto de perfil"
                >

                <?php if ($imagemAcessorio !== null): ?>

                    <img
                        class="acessorioCabecalho"
                        src="<?= htmlspecialchars($imagemAcessorio, ENT_QUOTES, 'UTF-8') ?>"
                        alt=""
                    >

                <?php endif; ?>

            </div>

        </a>

    </div>



    <!-- TÍTULO -->

    <div class="bloco1">

        <p>Crie sua própria sala de estudos!</p>

    </div>



    <!-- FORMULÁRIO PRINCIPAL -->

    <div class="principal">

        <div class="form">

            <form class="form2" method="post">

                <input
                    type="hidden"
                    name="user"
                    value="<?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?>"
                >


                <p>Escolha um ambiente:</p>


                <!-- PRIMEIRA LINHA DE AMBIENTES -->

                <div class="caixa1">

                    <div class="card">

                        <img src="<?= $locais['1'] ?>" alt="Ambiente 1" width="400">

                        <input type="radio" class="checkbox" name="ambiente" value="1">

                    </div>


                    <div class="card">

                        <img src="<?= $locais['2'] ?>" alt="Ambiente 2" width="400">

                        <input type="radio" class="checkbox" name="ambiente" value="2">

                    </div>


                    <div class="card">

                        <img src="<?= $locais['3'] ?>" alt="Ambiente 3" width="400">

                        <input type="radio" class="checkbox" name="ambiente" value="3">

                    </div>

                </div>



                <!-- SEGUNDA LINHA DE AMBIENTES -->

                <div class="caixa2">

                    <div class="card">

                        <img src="<?= $locais['4'] ?>" alt="Ambiente 4" width="400">

                        <input type="radio" class="checkbox" name="ambiente" value="4">

                    </div>


                    <div class="card">

                        <img src="<?= $locais['5'] ?>" alt="Ambiente 5" width="400">

                        <input type="radio" class="checkbox" name="ambiente" value="5">

                    </div>


                    <div class="card">

                        <img src="<?= $locais['6'] ?>" alt="Ambiente 6" width="400">

                        <input type="radio" class="checkbox" name="ambiente" value="6">

                    </div>

                </div>



                <p>Preencha as informações a seguir:</p>



                <!-- CAMPOS -->

                <div class="campos">

                    <input
                        type="text"
                        name="nome_sala"
                        placeholder="Nome da sala"
                    >


                    <input
                        type="text"
                        name="criador"
                        value="<?= htmlspecialchars($usuario['nome_usuario'], ENT_QUOTES, 'UTF-8') ?>"
                        readonly
                    >


                    <input
                        type="date"
                        name="data"
                        value="<?= date('Y-m-d') ?>"
                        readonly
                    >


                    <select name="area">

                        <option value="">Área de conhecimento</option>

                        <?php foreach ($area as $a): ?>

                            <option value="<?= htmlspecialchars($a['nome_area'], ENT_QUOTES, 'UTF-8') ?>">

                                <?= htmlspecialchars($a['nome_area'], ENT_QUOTES, 'UTF-8') ?>

                            </option>

                        <?php endforeach; ?>

                    </select>



                    <select name="materias">

                        <option value="">Matérias</option>

                        <?php foreach ($materias as $m): ?>

                            <option value="<?= htmlspecialchars($m['nome_materia'], ENT_QUOTES, 'UTF-8') ?>">

                                <?= htmlspecialchars($m['nome_materia'], ENT_QUOTES, 'UTF-8') ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>



                <!-- STATUS DA SALA -->

                <div class="status">

                    <label>
                        <input type="radio" class="checkbox" name="status" value="privado">
                        Privado
                    </label>

                    <label>
                        <input type="radio" class="checkbox" name="status" value="publico">
                        Público
                    </label>

                </div>



                <!-- SENHA -->

                <div class="campos">

                    <input
                        type="password"
                        name="senha"
                        placeholder="Senha da sala (Privado)"
                    >

                </div>



                <!-- ERRO -->

                <div class="erro">

                    <?php

                    if (isset($_GET['erro']) && $_GET['erro'] != "") {

                        echo "<p>" . htmlspecialchars($_GET['erro'], ENT_QUOTES, 'UTF-8') . "</p>";

                    }

                    ?>

                </div>



                <button type="submit" class="button">
                    Criar Sala
                </button>

            </form>

        </div>

    </div>



    <!-- RODAPÉ -->

    <div class="rodape">

        <div class="img-rodape">

            <a href="homelogin.php">
                <img src="/img-yasmin/logo.png" alt="">
            </a>

        </div>


        <table cellpadding="3">

            <tr>

                <td><a href="materias.php"><p>Matérias</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="social.php?user=<?= urlencode($user) ?>"><p>Social</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="progresso.php?user=<?= urlencode($user) ?>"><p>Progresso</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="suporte.php"><p>Suporte</p></a></td>

            </tr>


            <tr>

                <td><a href="termos.php"><p>Termos</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="contato.php"><p>Contato</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="customizacao.php?user=<?= urlencode($user) ?>"><p>Customização</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="configuracao.php"><p>Configuração</p></a></td>

            </tr>

        </table>



        <div class="redesSociais">

            <nav>

                <ul>

                    <li>
                        <a href="">
                            <img src="/img-yasmin/git.png" alt="">
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <img src="/img-yasmin/insta.png" alt="">
                        </a>
                    </li>

                </ul>

            </nav>

        </div>


        <p class="direitos">
            © 2026 StudyMatch - Todos os direitos reservados
        </p>

    </div>

</body>
</html>
