<?php
    require_once __DIR__ . "/banco/crud.php"; 
    require_once __DIR__ . "/banco/database.php"; 

    $user = $_GET['user'];

    //$dadosUser = database()->prepare('
    //SELECT * FROM usuarios WHERE nome_usuario = :user');
    //$dadosUser->execute(['user' => $user]);

    //$usuario = $dadosUser->fetch(PDO::FETCH_ASSOC);

    //$usuarios = readAll(database(), "usuarios");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(!isset($_POST['nomeEx']) || $_POST['nomeEx'] == "" ||
        !isset($_POST['email']) || $_POST['email'] == "" ||
        !isset($_POST['data']) || $_POST['data'] == ""){
            header('Location: perfil.php?erro=Espaço vazio');
            exit;
        }

        foreach($usuarios as $u){
            if($_POST['email'] != $usuario['email'] && $_POST['email'] == $u['email']){
                header('Location: perfil.php?erro=Esse email já está cadastrado');
                exit;
            }
            if (strpos($_POST['email'], ' ') !== false) {
                header('Location: perfil.php?erro=O campo do email não pode conter espaços.');
                exit;
            }
            if (strpos($_POST['email'], '@') === false) {
                header('Location: perfil.php?erro=Email inválido');
                exit;
            }

            //verificações telefone
            if($_POST['telefone'] != $usuario['telefone'] && $_POST['telefone'] != "" && $_POST['telefone'] == $u['telefone']){
                header('Location: perfil.php?erro=Esse telefone já está cadastrado');
                exit;
            }

            //verificações data de nasc.   
            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = new DateTime();
            $dataInformada = new DateTime($_POST['data']);
            $idade = $dataAtual->diff($dataInformada);

            if($dataAtual < $dataInformada){
                header("Location: perfil.php?erro=Data incorreta");
                exit;
            }

            if($idade->y < 9){
                header("Location: perfil.php?erro=O usuário deve ter no mínimo 9 anos completos");
                exit;
            }
        }

        $id = $_POST['id'];
        $nome = $_POST['nomeEx'];
        $email = $_POST['email'];
        $data = $_POST['data'];
        $telefone = $_POST['telefone'];

        
        //$consulta = database()->prepare('
        //UPDATE usuarios SET nome = :nome, email = :email, data_nascimento = :data_nascimento, telefone = :telefone WHERE id_usuario = :id_usuario;
        //');
        //$consulta->execute(['nome' => $nome, 'email' => $email, 'data_nascimento' => $data, 'telefone' => $telefone, 'id_usuario' => $id]);
        header("Location: perfil.php?user={$user}");
        exit;

    }

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMatch</title>

    <link rel="stylesheet" href="css/perfil.css">

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
                    <a href="social.php">
                        <p>Social</p>
                    </a>
                </li>

                <li>
                    <a href="progresso.php">
                        <p>Progresso</p>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- FOTO DE PERFIL DO CABEÇALHO -->

        <a href="perfil.php?user=<?= urlencode($user) ?>">

            <div class="fotoConta">

                <img
                    src="<?= htmlspecialchars($imagemPerfil, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Foto de perfil"
                >

            </div>

        </a>

    </div>

    <!-- ÁREA DO PERFIL -->

    <div class="fundo">

        <div class="perfilbox">

            <div class="bannerperfil"></div>

            <!-- FOTO DO PERSONAGEM -->

            <div class="fotoperfil">

                <img
                    src="<?= htmlspecialchars($imagemPerfil, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Personagem do perfil"
                >

            </div>

            <!-- BOTÃO DE EDITAR FOTO -->

            <a href="editaravatar.php?user=<?= urlencode($user) ?>">
                <div class="editarfoto"></div>
            </a>

            <!-- INFORMAÇÕES DO PERFIL -->

            <div class="infoperfil">

                <div class="form">

                    <form action="perfil.php?user=<?= urlencode($user) ?>" method="post">

                        <input
                            type="hidden"
                            name="id"
                            value="<?= htmlspecialchars((string)$usuario['id_usuario'], ENT_QUOTES, 'UTF-8') ?>"
                        >

                        <label for="nomeEx"></label>

                        <input
                            type="text"
                            name="nomeEx"
                            id="nomeEx"
                            value="<?= htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8') ?>"
                        >

                        <label for="nomeUs"></label>

                        <input
                            type="text"
                            name="nomeUs"
                            id="nomeUs"
                            value="<?= htmlspecialchars($usuario['nome_usuario'], ENT_QUOTES, 'UTF-8') ?>"
                            readonly
                        >

                        <label for="email"></label>

                        <input
                            type="text"
                            name="email"
                            id="email"
                            value="<?= htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8') ?>"
                        >

                        <label for="data"></label>

                        <input
                            type="date"
                            name="data"
                            id="data"
                            value="<?= htmlspecialchars($usuario['data_nascimento'], ENT_QUOTES, 'UTF-8') ?>"
                        >

                        <label for="telefone"></label>

                        <input
                            type="text"
                            name="telefone"
                            id="telefone"
                            placeholder="Telefone"
                            value="<?= htmlspecialchars($usuario['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        >

                        <!-- MENSAGENS -->

                        <div class="erro">

                            <?php if (isset($_GET['erro']) && $_GET['erro'] !== ''): ?>

                                <p>
                                    <?= htmlspecialchars($_GET['erro'], ENT_QUOTES, 'UTF-8') ?>
                                </p>

                            <?php endif; ?>

                        </div>

                        <?php if (isset($_GET['atualizado'])): ?>

                            <p class="sucesso">
                                Perfil atualizado com sucesso!
                            </p>

                        <?php endif; ?>

                        <button type="submit">
                            Editar Perfil
                        </button>

                    </form>

                </div>

            </div>

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
                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="social.php"><p>Social</p></a></td>

                <td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="progresso.php"><p>Progresso</p></a></td>

                <td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="suporte.php"><p>Suporte</p></a></td>

            </tr>

            <tr>

                <td><a href="termos.php"><p>Termos</p></a></td>
                <td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="contato.php"><p>Contato</p></a></td>

                <td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td>

                <td><a href="customizacao.php"><p>Customização</p></a></td>

                <td></td><td></td><td></td><td></td><td></td>
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