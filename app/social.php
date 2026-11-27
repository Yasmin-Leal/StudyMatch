<?php

require_once __DIR__ . "/banco/crud.php";
require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

// CONEXÃO COM O BANCO
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


// BUSCA O AVATAR DO USUÁRIO
$dadosAvatar = $pdo->prepare("
    SELECT personagem, acessorio
    FROM personagens
    WHERE nome_usuario = :user
");

$dadosAvatar->execute([
    ':user' => $user
]);

$avatar = $dadosAvatar->fetch(PDO::FETCH_ASSOC);


// IMAGEM PADRÃO DO PERSONAGEM
$imagemPersonagem = "./imgs/avatarexemplo.png";

// IMAGEM PADRÃO DO ACESSÓRIO
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

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMatch</title>

    <link rel="stylesheet" href="css/social.css?v=2">

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

                <!-- PERSONAGEM -->

                <img
                    class="personagemCabecalho"
                    src="<?= htmlspecialchars($imagemPersonagem, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Foto de perfil"
                >

                <!-- ACESSÓRIO -->

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

    <div class="tituloGrupos">
        Grupos de Estudo
    </div>


    <!-- CAIXA DOS GRUPOS -->

    <div class="caixaGrupos">


        <!-- IMAGENS DOS GRUPOS -->

        <div class="areaFotos">

            <div class="fotoGrupos">
                <img src="./img-giovana/espaco1.png" alt="Grupo de estudo">
            </div>

            <div class="fotoGrupos">
                <img src="./img-giovana/espaco2.png" alt="Grupo de estudo">
            </div>

            <div class="fotoGrupos">
                <img src="./img-giovana/espaco3.png" alt="Grupo de estudo">
            </div>

        </div>


        <!-- USUÁRIOS DOS GRUPOS -->

        <div class="areaLinhas">

            <div class="linhaUsers">

                <div class="fotoUsers">
                    <img src="imgs/pfp1.png" alt="Foto de perfil">
                </div>

                <div class="fotoUsers">
                    <img src="imgs/pfp3.png" alt="Foto de perfil">
                </div>

                <div class="fotoUsers">
                    <img src="imgs/pfp5.png" alt="Foto de perfil">
                </div>

                <div class="fotoUsers">
                    <img src="imgs/pfp4.png" alt="Foto de perfil">
                </div>

            </div>


            <div class="linhaUsers">

                <div class="fotoUsers">
                    <img src="imgs/pfp2.png" alt="Foto de perfil">
                </div>

                <div class="fotoUsers">
                    <img src="imgs/pfp1.png" alt="Foto de perfil">
                </div>

                <div class="fotoUsers">
                    <img src="imgs/pfp3.png" alt="Foto de perfil">
                </div>

            </div>


            <div class="linhaUsers">

                <div class="fotoUsers">
                    <img src="imgs/pfp3.png" alt="Foto de perfil">
                </div>

                <div class="fotoUsers">
                    <img src="imgs/pfp5.png" alt="Foto de perfil">
                </div>

            </div>

        </div>


        <!-- AMIZADES -->

        <div class="tituloAmizades">
            <p>Amizades</p>
        </div>


        <div class="caixaAmizades">


            <div class="fotoAmizades">

                <img src="imgs/pfp3.png" alt="Foto de perfil">

                <p class="nomeAmizades">Waddles</p>

                <div class="botaoPerfil">
                    <button type="button">Perfil</button>
                </div>

            </div>


            <div class="fotoAmizades">

                <img src="imgs/pfp4.png" alt="Foto de perfil">

                <p class="nomeAmizades">Pinnut$</p>

                <div class="botaoPerfil">
                    <button type="button">Perfil</button>
                </div>

            </div>


            <div class="fotoAmizades">

                <img src="imgs/pfp2.png" alt="Foto de perfil">

                <p class="nomeAmizades">P0pC0rn</p>

                <div class="botaoPerfil">
                    <button type="button">Perfil</button>
                </div>

            </div>
            

            

        </div>

        <div class="procurarPerfis">
                <a href="procuraperfis.php?user=<?= urlencode($user) ?>">Procurar Perfis</a>
            </div>

    </div>



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
