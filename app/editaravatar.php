<?php

require_once __DIR__ . "/banco/crud.php";
require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

// IDENTIFICAÇÃO DO USUÁRIO
$user = $_GET['user'] ?? $_POST['user'] ?? '';

if ($user === '') {
    die("Usuário não identificado.");
}

// VALORES INICIAIS
$personagemSelecionado = "1";
$acessorioSelecionado = "";
$mensagem = "";

// BUSCA O AVATAR SALVO NO BANCO
$stmt = database()->prepare("
    SELECT personagem, acessorio
    FROM personagens
    WHERE nome_usuario = :user
");

$stmt->execute([
    ':user' => $user
]);

$avatarSalvo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$avatarSalvo) {
    die("Não foi encontrado um personagem cadastrado para este usuário.");
}

if (isset($personagens[(string)$avatarSalvo['personagem']])) {
    $personagemSelecionado = (string)$avatarSalvo['personagem'];
}

if (
    $avatarSalvo['acessorio'] !== null &&
    isset($acessorios[(string)$avatarSalvo['acessorio']])
) {
    $acessorioSelecionado = (string)$avatarSalvo['acessorio'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $personagem = $_POST['personagem'] ?? '';

    if (isset($personagens[$personagem])) {
        $personagemSelecionado = (string)$personagem;
    }

    $acessorio = $_POST['acessorio'] ?? '';

    if ($acessorio === '') {

        $acessorioSelecionado = '';

    } elseif (isset($acessorios[$acessorio])) {

        $acessorioSelecionado = (string)$acessorio;

    }

    // SALVAR NO BANCO DE DADOS
    if (isset($_POST['salvar_avatar'])) {

        $personagemBanco = (int)$personagemSelecionado;

        // SEM ACESSÓRIO: SALVA NULL
        $acessorioBanco = $acessorioSelecionado === ''
            ? null
            : (int)$acessorioSelecionado;

        // ATUALIZA O REGISTRO EXISTENTE
        $stmt = database()->prepare("
            UPDATE personagens
            SET personagem = :personagem,
                acessorio = :acessorio
            WHERE nome_usuario = :user
        ");

        $stmt->execute([
            ':personagem' => $personagemBanco,
            ':acessorio' => $acessorioBanco,
            ':user' => $user
        ]);

        // REDIRECIONA DEPOIS DE SALVAR
        header("Location: editaravatar.php?user=" . urlencode($user) . "&salvo=1");
        exit;
    }
}


// MENSAGEM DE SUCESSO
if (isset($_GET['salvo'])) {
    $mensagem = "Personagem salvo com sucesso!";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMatch</title>

    <link rel="stylesheet" href="css/editaravatar.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/folha.png" type="image/x-icon">
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

        <!-- AVATAR DO CABEÇALHO -->

        <a href="perfil.php?user=<?= urlencode($user) ?>">

            <div class="fotoConta">

                <!-- PERSONAGEM -->

                <img
                    class="personagemCabecalho"
                    src="<?= htmlspecialchars($personagens[$personagemSelecionado], ENT_QUOTES, 'UTF-8') ?>"
                    alt="Personagem do perfil"
                >

                <!-- ACESSÓRIO -->

                <?php if ($acessorioSelecionado !== ''): ?>

                    <img
                        class="acessorioCabecalho"
                        src="<?= htmlspecialchars($acessorios[$acessorioSelecionado], ENT_QUOTES, 'UTF-8') ?>"
                        alt="Acessório do personagem"
                    >

                <?php endif; ?>

            </div>

        </a>

    </div>


    <!-- TÍTULO -->

    <div class="editando">
        <p>Editando Personagem</p>
    </div>


    <!-- MENSAGEM DE SUCESSO -->

    <?php if ($mensagem !== ''): ?>

        <p class="sucesso">
            <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?>
        </p>

    <?php endif; ?>


    <!-- FORMULÁRIO DE PERSONALIZAÇÃO -->

    <form action="editaravatar.php?user=<?= urlencode($user) ?>" method="post">

        <input
            type="hidden"
            name="user"
            value="<?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?>"
        >


        <!-- PRIMEIRA CAIXA -->

        <div class="caixaMaior">

            <!-- PRÉ-VISUALIZAÇÃO -->

            <div class="caixaFundoAvatar">

                <div class="fundoAvatar">

                    <div class="avatar">

                        <!-- PERSONAGEM -->

                        <img
                            src="<?= htmlspecialchars($personagens[$personagemSelecionado], ENT_QUOTES, 'UTF-8') ?>"
                            width="500"
                            alt="Personagem selecionado"
                        >

                        <!-- ACESSÓRIO -->

                        <?php if ($acessorioSelecionado !== ''): ?>

                            <img
                                class="imagemAcessorioSelecionado"
                                src="<?= htmlspecialchars($acessorios[$acessorioSelecionado], ENT_QUOTES, 'UTF-8') ?>"
                                alt="Acessório selecionado"
                            >

                        <?php endif; ?>

                    </div>

                </div>


                <!-- BOTÕES -->

                <div class="salvar">

                    <button type="submit">
                        Atualizar prévia
                    </button>

                    <button
                        type="submit"
                        name="salvar_avatar"
                        value="1"
                    >
                        Salvar personagem
                    </button>

                </div>

            </div>


            <!-- ACESSÓRIOS -->

            <div class="caixaAcessorios">

                <div class="acessoriosTitulo">
                    <p>Acessórios</p>
                </div>


                <!-- SEM ACESSÓRIO -->

                <label class="boxAcc">

                    <input
                        type="radio"
                        name="acessorio"
                        value=""
                        <?= $acessorioSelecionado === '' ? 'checked' : '' ?>
                    >

                    <span>Sem acessório</span>

                </label>


                <!-- LISTA DE ACESSÓRIOS -->

                <?php foreach ($acessorios as $id => $imagem): ?>

                    <label class="boxAcc">

                        <input
                            type="radio"
                            name="acessorio"
                            value="<?= htmlspecialchars((string)$id, ENT_QUOTES, 'UTF-8') ?>"
                            <?= $acessorioSelecionado === (string)$id ? 'checked' : '' ?>
                        >

                        <div class="acessorio">

                            <img
                                src="<?= htmlspecialchars($imagem, ENT_QUOTES, 'UTF-8') ?>"
                                width="220"
                                alt="Acessório <?= htmlspecialchars((string)$id, ENT_QUOTES, 'UTF-8') ?>"
                            >

                        </div>

                    </label>

                <?php endforeach; ?>

            </div>

        </div>


        <!-- SEGUNDA CAIXA: PERSONAGENS -->

        <div class="caixaMaior">

            <div class="opcoesPerso">

                <?php foreach ($personagens as $id => $imagem): ?>

                    <label class="personagens">

                        <input
                            type="radio"
                            name="personagem"
                            value="<?= htmlspecialchars((string)$id, ENT_QUOTES, 'UTF-8') ?>"
                            <?= $personagemSelecionado === (string)$id ? 'checked' : '' ?>
                        >

                        <img
                            src="<?= htmlspecialchars($imagem, ENT_QUOTES, 'UTF-8') ?>"
                            width="300"
                            alt="Personagem <?= htmlspecialchars((string)$id, ENT_QUOTES, 'UTF-8') ?>"
                        >

                    </label>

                <?php endforeach; ?>

            </div>

        </div>

    </form>


    <!-- RODAPÉ -->

      <table cellpadding="3">

            <tr>

                <td><a href="selecionar-sala.php?user=<?= urlencode($user) ?>"><p>Salas</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="social.php?user=<?= urlencode($user) ?>"><p>Social</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="progresso.php?user=<?= urlencode($user) ?>"><p>Progresso</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="homeperfil.php?user=<?= urlencode($user) ?>"><p>Home</p></a></td>

            </tr>


            <tr>

                <td><a href="termos.php"><p>Termos</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="procuraperfis.php?user=<?= urlencode($user) ?>"><p>Pesquisar</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="editaravatar.php?user=<?= urlencode($user) ?>"><p>Customização</p></a></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="criarsala.php?user=<?= urlencode($user) ?>"><p>Criar Sala</p></a></td>

            </tr>

        </table>


        <!-- REDES SOCIAIS -->

        <div class="redesSociais">

            <nav>
                <ul>

                    <li>
                        <a href="">
                            <img src="imgs/git.png" alt="GitHub">
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <img src="imgs/insta.png" alt="Instagram">
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
