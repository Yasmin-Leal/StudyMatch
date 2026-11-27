<?php
require_once __DIR__ . "/banco/crud.php";
require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

// IDENTIFICAÇÃO DO USUÁRIO
$user = $_GET['user'] ?? $_POST['user'] ?? '';

if ($user === '') {
    die("Usuário não identificado.");
}

// IDENTIFICAÇÃO DO GRUPO
$idGrupo = $_GET['id'] ?? $_POST['id'] ?? '';

if ($idGrupo === '') {
    die("Grupo não identificado.");
}

// BUSCA AS INFORMAÇÕES DO GRUPO
$stmtGrupo = database()->prepare("
    SELECT *
    FROM grupos_estudos
    WHERE id_grupo = :id
");

$stmtGrupo->execute([':id' => $idGrupo]);
$grupo = $stmtGrupo->fetch(PDO::FETCH_ASSOC);

if (!$grupo) {
    die("Grupo não encontrado.");
}

// BUSCA O AVATAR DO USUÁRIO
$stmtAvatar = database()->prepare("
    SELECT personagem, acessorio
    FROM personagens
    WHERE nome_usuario = :user
");

$stmtAvatar->execute([':user' => $user]);
$avatarBanco = $stmtAvatar->fetch(PDO::FETCH_ASSOC);

// PERSONAGEM
$idPersonagem = (string) ($avatarBanco['personagem'] ?? '1');

$imagemPersonagem = $personagens[$idPersonagem] ?? $personagens['1'];

// ACESSÓRIO
$idAcessorio = (string) ($avatarBanco['acessorio'] ?? '');

$imagemAcessorio = (
    $idAcessorio !== '' &&
    isset($acessorios[$idAcessorio])
)
    ? $acessorios[$idAcessorio]
    : null;

// VERIFICAÇÃO DA SENHA DO GRUPO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'entrar') {

    if (strtolower($grupo['status_grupo']) === 'privado') {

        if (empty($_POST['senha'])) {
            header(
                "Location: saladetalhes.php?user=" .
                urlencode($user) .
                "&id=" . urlencode($idGrupo) .
                "&erro=" .
                urlencode("Este grupo é privado, só é possível acessar com senha")
            );
            exit;
        }

        if ($_POST['senha'] !== $grupo['senha']) {
            header(
                "Location: saladetalhes.php?user=" .
                urlencode($user) .
                "&id=" . urlencode($idGrupo) .
                "&erro=" . urlencode("Senha incorreta")
            );
            exit;
        }

        if($grupo['nome_area'] == "Exatas"){
        header("Location: salaexatas.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
        if($grupo['nome_area'] == "Ciências Naturais"){
        header("Location: salanaturais.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
        if($grupo['nome_area'] == "Ciências Humanas"){
        header("Location: salahumanas.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
        if($grupo['nome_area'] == "Linguagens"){
        header("Location: salalinguagens.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
    }
    if (strtolower($grupo['status_grupo']) === 'publico') {
        if($grupo['nome_area'] == "Exatas"){
        header("Location: salaexatas.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
        if($grupo['nome_area'] == "Ciências Naturais"){
        header("Location: salanaturais.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
        if($grupo['nome_area'] == "Ciências Humanas"){
        header("Location: salahumanas.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
        if($grupo['nome_area'] == "Linguagens"){
        header("Location: salalinguagens.php?user=" . urlencode($user) . "&grupo=" . urlencode($grupo['nome_grupo']));
        exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMatch</title>

    <link rel="stylesheet" href="css/saladetalhes.css">

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

        <!-- FOTO DE PERFIL COM PERSONAGEM E ACESSÓRIO -->
        <a href="perfil.php?user=<?= urlencode($user) ?>">

            <div class="fotoConta">

                <img
                    class="personagemCabecalho"
                    src="<?= htmlspecialchars($imagemPersonagem, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Personagem do perfil"
                >

                <?php if ($imagemAcessorio !== null): ?>

                    <img
                        class="acessorioCabecalho"
                        src="<?= htmlspecialchars($imagemAcessorio, ENT_QUOTES, 'UTF-8') ?>"
                        alt="Acessório do personagem"
                    >

                <?php endif; ?>

            </div>

        </a>

    </div>


    <!-- TÍTULO -->
    <div class="titulo">

        <p>
            Você acessou o
            <?= htmlspecialchars($grupo['nome_grupo'], ENT_QUOTES, 'UTF-8') ?>!
        </p>

        <p>Confira as informações a seguir antes de entrar na sala.</p>

    </div>


    <!-- CONTEÚDO PRINCIPAL -->
    <div class="principal">

        <div class="bloco1">

            <img
                src="<?= htmlspecialchars($locais[$grupo['id_imagem']] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                alt="Imagem do grupo"
                width="700"
                height="440"
            >

            <div class="quebra">

                <div class="titulo2">

                    <p>
                        <?= htmlspecialchars($grupo['nome_grupo'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                </div>

                <div class="info">

                    <p>
                        Área de conhecimento:
                        <?= htmlspecialchars($grupo['nome_area'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p>
                        Matéria:
                        <?= htmlspecialchars($grupo['nome_materia'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p>
                        Criador(a):
                        <?= htmlspecialchars($grupo['criador'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p>
                        Data de criação:
                        <?= htmlspecialchars($grupo['data_criacao'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <div class="status">

                        <label>
                            <input
                                type="radio"
                                name="status"
                                value="privado"
                                disabled
                                <?= strtolower($grupo['status_grupo']) === 'privado' ? 'checked' : '' ?>
                            >
                            Privado
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="status"
                                value="publico"
                                disabled
                                <?= strtolower($grupo['status_grupo']) === 'publico' ? 'checked' : '' ?>
                            >
                            Público
                        </label>

                    </div>

                </div>

            </div>

        </div>


        <!-- FORMULÁRIO -->
        <div class="form">

            <form
                action="saladetalhes.php?user=<?= urlencode($user) ?>&id=<?= urlencode($idGrupo) ?>"
                method="POST"
            >
            <input type="hidden" name="acao" value="entrar">

                <input
                    type="hidden"
                    name="user"
                    value="<?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?>"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= htmlspecialchars($idGrupo, ENT_QUOTES, 'UTF-8') ?>"
                >

                <input
                    type="password"
                    name="senha"
                    placeholder="Digite a senha fornecida pelo(a) criador(a):"
                >

                <div class="erro">

                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] !== '') {
                        echo "<p>" .
                            htmlspecialchars($_GET['erro'], ENT_QUOTES, 'UTF-8') .
                            "</p>";
                    }
                    ?>

                </div>

                <button type="submit" class="button">
                    <p>Entrar</p>
                </button>

            </form>

        </div>

    </div>


    <div class="rodape">

        <div class="img-rodape">

            <a href="homelogin.php">
                <img src="/img-yasmin/logo.png" alt="">
            </a>

        </div>

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
