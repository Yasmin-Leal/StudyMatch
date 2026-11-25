
<?php

require_once __DIR__ . "/banco/crud.php";
require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

$pdo = database();

// IDENTIFICAÇÃO DO USUÁRIO
$user = $_GET['user'] ?? '';

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


// BUSCA OS DADOS DAS SALAS
$grupos = readAll(database(), "grupos_estudos");
$areaConhecimento = readAll(database(), "area_conhecimento");
$materias = readAll(database(), "materias");


// FILTRO DAS SALAS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $area = $_POST['areaConhecimento'] ?? '';
    $materia = $_POST['materias'] ?? '';

    if (empty($area)) {
        header("Location: selecionar-sala.php?user=" . urlencode($user) . "&erro=" . urlencode("Selecione uma área de conhecimento."));
        exit;
    }

    $materiasPorArea = [
        "Exatas" => ["Matemática", "Física", "Química"],
        "Ciências Naturais" => ["Biologia", "Geologia", "Astronomia", "Ecologia"],
        "Ciências Humanas" => ["História", "Geografia", "Filosofia", "Sociologia"],
        "Linguagens" => ["Língua Português", "Línguas Estrangeiras", "Literatura"]
    ];

    if (
        !empty($materia) &&
        !in_array($materia, $materiasPorArea[$area] ?? [], true)
    ) {
        header("Location: selecionar-sala.php?user=" . urlencode($user) . "&erro=" . urlencode("A matéria selecionada não faz parte dessa área de conhecimento."));
        exit;
    }

    if (!empty($materia)) {

        $grupos = readAll(
            database(),
            "grupos_estudos",
            "nome_area = ? AND nome_materia = ?",
            [$area, $materia]
        );

    } else {

        $grupos = readAll(
            database(),
            "grupos_estudos",
            "nome_area = ?",
            [$area]
        );
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMatch</title>

    <link rel="stylesheet" href="css/selecionar-sala.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&display=swap" rel="stylesheet">

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


    <!-- AVISO -->

    <div class="aviso">
        <p>Selecione uma sala de estudos de seu interesse ou crie uma nova!</p>
    </div>


    <!-- PESQUISA DE SALAS -->

    <div class="pesquisaSalas">

        <form action="selecionar-sala.php?user=<?= urlencode($user) ?>" method="post">

            <select name="areaConhecimento">

                <option value="">| Área de Conhecimento</option>

                <?php foreach ($areaConhecimento as $a): ?>

                    <option value="<?= htmlspecialchars($a['nome_area'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($a['nome_area'], ENT_QUOTES, 'UTF-8') ?>
                    </option>

                <?php endforeach; ?>

            </select>


            <select name="materias">

                <option value="">| Matérias</option>

                <?php foreach ($materias as $m): ?>

                    <option value="<?= htmlspecialchars($m['nome_materia'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($m['nome_materia'], ENT_QUOTES, 'UTF-8') ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <br>

            <div class="erro">

                <?php
                if (isset($_GET['erro']) && $_GET['erro'] != '') {
                    echo "<p>" . htmlspecialchars($_GET['erro'], ENT_QUOTES, 'UTF-8') . "</p>";
                }
                ?>

            </div>

            <button type="submit">Filtrar</button>

        </form>

        <div class="lupa"></div>

    </div>


    <!-- CRIAR SALA -->

    <div class="criarSala">

        <a href="criarsala.php?user=<?= urlencode($user) ?>">
            <button type="button">Criar uma sala de estudos</button>
        </a>

        <div class="plus"></div>

    </div>


    <!-- EXIBIR SALAS -->

    <div class="exibirSalas">

        <?php foreach ($grupos as $g): ?>

            <form action="saladetalhes.php?user=<?= urlencode($user) ?>" method="post" class="formSala">

                <input type="hidden" name="id" value="<?= htmlspecialchars($g['id_grupo'], ENT_QUOTES, 'UTF-8') ?>">

                <div class="boxLocal">

                    <div class="imagemLocal">

                        <img
                            src="<?= htmlspecialchars($locais[$g['id_imagem']] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                            alt=""
                        >

                    </div>

                    <p>
                        <?= htmlspecialchars($g['nome_grupo'], ENT_QUOTES, 'UTF-8') ?> -
                        <?= htmlspecialchars($g['nome_area'], ENT_QUOTES, 'UTF-8') ?> -
                        <?= htmlspecialchars($g['nome_materia'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <button type="submit">
                        Ver mais informações.
                    </button>

                </div>

            </form>

        <?php endforeach; ?>


        <?php if (empty($grupos)): ?>

            <p>Nenhum Grupo Aberto</p>

        <?php endif; ?>

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
