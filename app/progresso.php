
<?php
require_once __DIR__ . "/banco/crud.php";
require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

// IDENTIFICAÇÃO DO USUÁRIO
$user = $_GET['user'] ?? '';

if ($user === '') {
    die("Usuário não identificado.");
}

// BUSCA OS DADOS DO USUÁRIO
$dadosUser = database()->prepare("
    SELECT * FROM usuarios
    WHERE nome_usuario = :user
");

$dadosUser->execute(['user' => $user]);

$usuario = $dadosUser->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

// BUSCA O AVATAR DO USUÁRIO
$dadosAvatar = database()->prepare("
    SELECT personagem, acessorio
    FROM personagens
    WHERE nome_usuario = :user
");

$dadosAvatar->execute(['user' => $user]);

$avatar = $dadosAvatar->fetch(PDO::FETCH_ASSOC);

// IMAGEM PADRÃO DO PERSONAGEM
$imagemPersonagem = "./imgs/avatarexemplo.png";

// IMAGEM DO ACESSÓRIO
$imagemAcessorio = null;

// IDENTIFICA O PERSONAGEM E O ACESSÓRIO
if ($avatar) {

    $personagemId = (string) $avatar['personagem'];

    if (isset($personagens[$personagemId])) {
        $imagemPersonagem = $personagens[$personagemId];
    }

    if ($avatar['acessorio'] !== null && $avatar['acessorio'] !== '') {

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

    <link rel="stylesheet" href="css/progresso.css">

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

    <!-- CONTEÚDO PRINCIPAL -->

    <main class="card-principal">

        <header>
        </header>

        <header class="ft-perfil">
            <img class="img-perfil" src="imgs-le/img-perfil.png" alt="">
        </header>

        <header class="secao-top">

            <!-- AVATAR DO USUÁRIO -->

            <div class="avatar">

                <img
                    class="personagemPerfil"
                    src="<?= htmlspecialchars($imagemPersonagem, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Personagem do usuário"
                >

                <?php if ($imagemAcessorio !== null): ?>

                    <img
                        class="acessorioPerfil"
                        src="<?= htmlspecialchars($imagemAcessorio, ENT_QUOTES, 'UTF-8') ?>"
                        alt=""
                    >

                <?php endif; ?>

            </div>

            <!-- TEMPO DE ATIVIDADE -->

            <div class="atividade">

                <h2>Tempo de atividade</h2>

                <div class="atividade-box">

                    <div class="tempo">

                        <svg class="clock-icon large" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <polyline points="12 7 12 12 15 14"></polyline>
                        </svg>

                    </div>

                    <div>
                        <p class="horas">10 Horas</p>
                    </div>

                    <div>
                        <p class="materias-mais">Matematica Biologia</p>
                    </div>

                    <div class="materias"></div>

                </div>

            </div>

        </header>

        <!-- METAS ALCANÇADAS -->

        <section class="metas">

            <h1>Metas alcançadas</h1>

            <div class="metas-container">

                <div class="progresso-barra">

                    <div class="sequencia">Sequência de 7 dias</div>

                    <div class="seque-porcentagem">60%</div>

                    <div class="progresso-indicator"></div>

                </div>

                <div class="grade-dias">

                    <div class="day-card">

                        <p class="day-nome">seg</p>

                        <img class="icons" src="imgs-le/iconnaturais.png" alt="">

                        <div class="dia">

                            <img class="relogio" src="imgs-le/personalização de usuário.png" alt="">

                            <div class="day-horas">
                                <p>5h</p>
                            </div>

                            <img class="patas" src="imgs-le/PATA.png" alt="">

                        </div>

                    </div>

                    <div class="day-card">

                        <p class="day-nome">ter</p>

                        <img class="icons" src="imgs-le/iconlinguagens.png" alt="">

                        <div class="dia">

                            <img class="relogio" src="imgs-le/personalização de usuário.png" alt="">

                            <div class="day-horas">
                                <p>5h</p>
                            </div>

                            <img class="patas" src="imgs-le/PATA-2.png" alt="">

                        </div>

                    </div>

                    <div class="day-card">

                        <p class="day-nome">qua</p>

                        <img class="icons" src="imgs-le/iconnaturais.png" alt="">

                        <div class="dia">

                            <img class="relogio" src="imgs-le/personalização de usuário.png" alt="">

                            <div class="day-horas">
                                <p>5h</p>
                            </div>

                            <img class="patas" src="imgs-le/PATA-3.png" alt="">

                        </div>

                    </div>

                    <div class="day-card">

                        <p class="day-nome">qui</p>

                        <img class="icons" src="imgs-le/iconhumanas.png" alt="">

                        <div class="dia">

                            <img class="relogio" src="imgs-le/personalização de usuário.png" alt="">

                            <div class="day-horas">
                                <p>5h</p>
                            </div>

                            <img class="patas" src="imgs-le/PATA-4.png" alt="">

                        </div>

                    </div>

                    <div class="day-card">

                        <p class="day-nome">sex</p>

                        <div class="dia">

                            <img class="relogio" src="imgs-le/personalização de usuário.png" alt="">

                            <div class="day-horas">
                                <p>5h</p>
                            </div>

                        </div>

                    </div>

                    <div class="day-card">

                        <p class="day-nome">sab</p>

                        <div class="dia">

                            <img class="relogio" src="imgs-le/personalização de usuário.png" alt="">

                            <div class="day-horas">
                                <p>5h</p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <!-- RODAPÉ -->

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

        <div class="redesSociais">

            <nav>
                <ul>

                    <li><a href=""><img src="/img-yasmin/git.png" alt=""></a></li>

                    <li><a href=""><img src="/img-yasmin/insta.png" alt=""></a></li>

                </ul>
            </nav>

        </div>

        <p class="direitos">
            © 2026 StudyMatch - Todos os direitos reservados
        </p>

    </div>

</body>
</html>

