
<?php

require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

// CONEXÃO COM O BANCO
$pdo = database();

// IDENTIFICAÇÃO DO USUÁRIO ATUAL
$user = $_GET['user'] ?? '';

if ($user === '') {
    die("Usuário não identificado.");
}

// PESQUISA DIGITADA
$pesquisa = trim($_GET['pesquisa'] ?? '');


// BUSCA OS PERFIS CADASTRADOS
// EXCLUINDO O USUÁRIO ATUAL
$sql = "
    SELECT
        u.id_usuario,
        u.nome,
        u.nome_usuario,
        p.personagem,
        p.acessorio
    FROM usuarios u

    LEFT JOIN personagens p
        ON p.nome_usuario = u.nome_usuario

    WHERE u.nome_usuario LIKE :pesquisa
    AND u.nome_usuario != :usuarioAtual

    ORDER BY u.nome_usuario ASC
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':pesquisa' => '%' . $pesquisa . '%',
    ':usuarioAtual' => $user
]);

$perfis = $stmt->fetchAll(PDO::FETCH_ASSOC);


// BUSCA O AVATAR DO USUÁRIO ATUAL
$imagemAtual = "./imgs/avatarexemplo.png";
$acessorioAtual = null;

$stmtAtual = $pdo->prepare("
    SELECT personagem, acessorio
    FROM personagens
    WHERE nome_usuario = :user
");

$stmtAtual->execute([
    ':user' => $user
]);

$avatarAtual = $stmtAtual->fetch(PDO::FETCH_ASSOC);

if ($avatarAtual) {

    $idPersonagem = (string) $avatarAtual['personagem'];

    if (isset($personagens[$idPersonagem])) {
        $imagemAtual = $personagens[$idPersonagem];
    }

    $idAcessorio = (string) ($avatarAtual['acessorio'] ?? '');

    if ($idAcessorio !== '' && isset($acessorios[$idAcessorio])) {
        $acessorioAtual = $acessorios[$idAcessorio];
    }
}


// LINK DO PERFIL ATUAL
$linkPerfilAtual = "perfil.php?user=" . urlencode($user);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMatch</title>

    <link rel="stylesheet" href="css/procuraperfis.css?v=2">

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

        <!-- FOTO DE PERFIL DO CABEÇALHO -->

        <a href="perfil.php?user=<?= urlencode($user) ?>">

            <div class="fotoConta">

                <img
                    class="personagemCabecalho"
                    src="<?= htmlspecialchars($imagemAtual, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Foto de perfil"
                >

                <?php if ($acessorioAtual !== null): ?>

                    <img
                        class="acessorioCabecalho"
                        src="<?= htmlspecialchars($acessorioAtual, ENT_QUOTES, 'UTF-8') ?>"
                        alt=""
                    >

                <?php endif; ?>

            </div>

        </a>

    </div>



    <!-- ÁREA DE PESQUISA -->
    <main class="blocoPesquisa">


        <form class="barraPesquisa" action="" method="get">

            <!-- MANTÉM O USUÁRIO ATUAL NA PESQUISA -->
            <input
                type="hidden"
                name="user"
                value="<?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?>"
            >


            <button class="button" type="submit">

                <img src="./img-giovana/lupa.png" alt="Pesquisar">

            </button>


            <input
                type="text"
                name="pesquisa"
                placeholder="À procura de amigos?"
                aria-label="Pesquisar amigos"
                value="<?= htmlspecialchars($pesquisa, ENT_QUOTES, 'UTF-8') ?>"
            >

        </form>



        <!-- RESULTADOS DA PESQUISA -->
        <div class="listaUsuarios">


            <?php if (count($perfis) > 0): ?>


                <?php foreach ($perfis as $perfil): ?>

                    <?php

                    // IMAGEM DO PERSONAGEM
                    $imagemPersonagem = "./imgs/avatarexemplo.png";

                    $idPersonagem = (string) ($perfil['personagem'] ?? '');

                    if (
                        $idPersonagem !== '' &&
                        isset($personagens[$idPersonagem])
                    ) {
                        $imagemPersonagem = $personagens[$idPersonagem];
                    }


                    // IMAGEM DO ACESSÓRIO
                    $imagemAcessorio = null;

                    $idAcessorio = (string) ($perfil['acessorio'] ?? '');

                    if (
                        $idAcessorio !== '' &&
                        isset($acessorios[$idAcessorio])
                    ) {
                        $imagemAcessorio = $acessorios[$idAcessorio];
                    }


                    // LINK PARA O PERFIL ENCONTRADO
                    $linkPerfil = "perfil.php?user=" . urlencode($perfil['nome_usuario']);

                    ?>


                    <div class="usuario">


                        <!-- AVATAR -->
                        <div class="fotoUsuario">

                            <img
                                class="personagemUsuario"
                                src="<?= htmlspecialchars($imagemPersonagem, ENT_QUOTES, 'UTF-8') ?>"
                                alt="Avatar de <?= htmlspecialchars($perfil['nome_usuario'], ENT_QUOTES, 'UTF-8') ?>"
                            >

                            <?php if ($imagemAcessorio !== null): ?>

                                <img
                                    class="acessorioUsuario"
                                    src="<?= htmlspecialchars($imagemAcessorio, ENT_QUOTES, 'UTF-8') ?>"
                                    alt=""
                                >

                            <?php endif; ?>

                        </div>


                        <!-- NOME DO USUÁRIO -->
                        <p class="nomeUsuario">
                            <?= htmlspecialchars($perfil['nome_usuario'], ENT_QUOTES, 'UTF-8') ?>
                        </p>



                        <!-- BOTÃO ADICIONAR -->
                        <button
                            class="adicionarUsuario"
                            type="button"
                            aria-label="Adicionar amigo"
                        >

                            +

                        </button>


                    </div>


                <?php endforeach; ?>


            <?php else: ?>


                <p class="nenhumResultado">
                    Nenhum usuário encontrado.
                </p>


            <?php endif; ?>


        </div>

    </main>



    <!-- IMAGEM DECORATIVA -->
    <div class="personagens">

        <img src="./img-giovana/personagens.png" alt="Personagens StudyMatch">

    </div>



    <!-- RODAPÉ -->
    <div class="rodape">


        <div class="img-rodape">

            <a href="homelogin.php">
                <img src="/img-yasmin/logo.png" alt="Logo StudyMatch">
            </a>

        </div>



        <table cellpadding="3">

            <tr>

                <td><a href="materias.php"><p>Matérias</p></a></td>

                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="social.php"><p>Social</p></a></td>

                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="progresso.php"><p>Progresso</p></a></td>

                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="suporte.php"><p>Suporte</p></a></td>

            </tr>


            <tr>

                <td><a href="termos.php"><p>Termos</p></a></td>

                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="contato.php"><p>Contato</p></a></td>

                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="customizacao.php"><p>Customização</p></a></td>

                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

                <td><a href="configuracao.php"><p>Configuração</p></a></td>

            </tr>

        </table>



        <div class="redesSociais">

            <nav>

                <ul>

                    <li>
                        <a href="">
                            <img src="/img-yasmin/git.png" alt="GitHub">
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <img src="/img-yasmin/insta.png" alt="Instagram">
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
