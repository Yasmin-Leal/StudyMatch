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

    <link rel="stylesheet" href="css/homeperfil.css">

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


    <!-- BANNER -->

    <div class="banner">

        <div class="bannerimg"></div>

    </div>


    <!-- SAUDAÇÃO -->

    <div class="bolhaSaudacao"></div>

    <div class="saudacao">

        <p>
            Aproveite,<br>
            <?= htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8') ?>!
        </p>

    </div>


    <!-- CAIXA DE METAS -->

    <div class="caixaMetas">

        <!-- FOTO GRANDE DO AVATAR -->

        <div class="fotoUserGrande">

            <img
                class="personagemPerfil"
                src="<?= htmlspecialchars($imagemPersonagem, ENT_QUOTES, 'UTF-8') ?>"
                alt="Avatar do usuário"
            >

            <?php if ($imagemAcessorio !== null): ?>

                <img
                    class="acessorioPerfil"
                    src="<?= htmlspecialchars($imagemAcessorio, ENT_QUOTES, 'UTF-8') ?>"
                    alt=""
                >

            <?php endif; ?>

        </div>


        <!-- LISTA DE METAS -->

        <div class="listaMetas">

            <div class="metas">
                <p>Metas</p>
            </div>

            <div class="fundoMetas">

                <p>Estude por 3hrs</p>

                <button type="button">Resgatar</button>

            </div>

            <div class="fundoMetas">

                <p>Veja 2 matérias</p>

                <button type="button">Resgatar</button>

            </div>

            <div class="fundoMetas">

                <p>Acesso de 7 dias</p>

                <button type="button">Resgatar</button>

            </div>

        </div>


        <!-- CALENDÁRIO -->

        <div class="areaCalendario">

            <div class="calendario">

                <h2 class="mes">Dezembro 2026</h2>

                <div class="dias">

                    <span>1</span><span>2</span><span>3</span><span>4</span>
                    <span>5</span><span>6</span><span>7</span><span>8</span>
                    <span>9</span><span>10</span><span>11</span><span>12</span>
                    <span>13</span><span>14</span><span>15</span><span>16</span>
                    <span>17</span><span>18</span><span>19</span><span>20</span>
                    <span>21</span><span>22</span><span>23</span><span>24</span>
                    <span>25</span><span>26</span><span>27</span><span>28</span>
                    <span>29</span><span>30</span>

                </div>

                <form class="lembrete-form" action="/reminders" method="post">

                    <label for="date">Data do Lembrete</label>

                    <input
                        id="date"
                        name="date"
                        type="date"
                        required
                    >

                    <label for="reminder">Lembrete</label>

                    <input
                        id="reminder"
                        name="reminder"
                        type="text"
                        placeholder="Descrição do seu lembrete"
                        required
                    >

                    <button type="submit">Salvar</button>

                </form>

            </div>

        </div>

    </div>


    <!-- NOME DO USUÁRIO -->

    <div class="nomeUser">

        <p>
            <?= htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8') ?>
        </p>

    </div>


    <!-- MATÉRIAS -->

    <div class="tituloMaterias">
        <p>Matérias</p>
    </div>

    <div class="listaMaterias">

        <div class="blocoExatas">

            <p>Exatas</p>

            <div class="iconMateriaE"></div>

        </div>

        <div class="blocoNaturais">

            <p>Naturais</p>

            <div class="iconMateriaN"></div>

        </div>

        <div class="blocoLinguagens">

            <p>Linguagens</p>

            <div class="iconMateriaL"></div>

        </div>

        <div class="blocoHumanas">

            <p>Humanas</p>

            <div class="iconMateriaH"></div>

        </div>

    </div>


    <!-- PROFESSORES -->

    <div class="areaProf">

        <div class="profYas"></div>
        <div class="profLe"></div>
        <div class="profMaia"></div>
        <div class="profGi"></div>

    </div>

    <div class="nomesProf">

        <div class="nomeYas">
            <p>Prof. Yas</p>
        </div>

        <div class="nomeLe">
            <p>Prof. Le</p>
        </div>

        <div class="nomeMaia">
            <p>Prof. Maia</p>
        </div>

        <div class="nomeGi">
            <p>Prof. Gi</p>
        </div>

    </div>


    <!-- RODAPÉ -->

    <div class="rodape">

        <div class="img-rodape">

            <a href="homelogin.php">
                <img src="imgs/logo.png" alt="Logo StudyMatch">
            </a>

        </div>

        <table cellpadding="3">

            <tr>

                <td><a href="materias.php"><p>Matérias</p></a></td>

                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="social.php"><p>Social</p></a></td>

                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="progresso.php"><p>Progresso</p></a></td>

                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="suporte.php"><p>Suporte</p></a></td>

            </tr>

            <tr>

                <td><a href="termos.php"><p>Termos</p></a></td>

                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="contato.php"><p>Contato</p></a></td>

                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="customizacao.php"><p>Customização</p></a></td>

                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="configuracao.php"><p>Configuração</p></a></td>

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
