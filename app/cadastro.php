<?php
    require_once __DIR__ . "/banco/crud.php"; 
    require_once __DIR__ . "/banco/database.php"; 

    $usuarios = readAll(database(), "usuarios");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(!isset($_POST['nomeEx']) || $_POST['nomeEx'] == "" ||
        !isset($_POST['nomeUs']) || $_POST['nomeUs'] == "" ||
        !isset($_POST['email']) || $_POST['email'] == "" ||
        !isset($_POST['ano']) || $_POST['ano'] == "" ||
        !isset($_POST['senha']) || $_POST['senha'] == "" ||
        !isset($_POST['data']) || $_POST['data'] == ""){
            header('Location: cadastro.php?erro=Espaço vázio');
            exit;
        }

        foreach($usuarios as $u){
            //verificações nome de usuário
            if($_POST['nomeUs'] == $u['nome_usuario']){
                header('Location: cadastro.php?erro=Esse nome de usuário já está sendo utilizado');
                exit;
            }
            if (strpos($_POST['nomeUs'], ' ') !== false) {
                header('Location: cadastro.php?erro=O campo do nome de usuário não pode conter espaços.');
                exit;
            }

            //verificações email
            if($_POST['email'] == $u['email']){
                header('Location: cadastro.php?erro=Esse email já está cadastrado');
                exit;
            }
            if (strpos($_POST['email'], ' ') !== false) {
                header('Location: cadastro.php?erro=O campo do email não pode conter espaços.');
                exit;
            }
            if (strpos($_POST['email'], '@') === false) {
                header('Location: cadastro.php?erro=Email inválido');
                exit;
            }

            //verificações telefone
            if($_POST['telefone'] != "" && $_POST['telefone'] == $u['telefone']){
                header('Location: cadastro.php?erro=Esse telefone já está cadastrado');
                exit;
            }

            //verificações data de nasc.   
            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = new DateTime();
            $dataInformada = new DateTime($_POST['data']);
            $idade = $dataAtual->diff($dataInformada);

            if($dataAtual < $dataInformada){
                header("Location: cadastro.php?erro=Data incorreta");
                exit;
            }

            if($idade->y < 9){
                header("Location: cadastro.php?erro=O usuário deve ter no mínimo 9 anos completos");
                exit;
            }

            //verificações senha
            if(strlen($_POST['senha']) > 10 || strlen($_POST['senha']) < 6){
            header("Location: cadastro.php?erro=Senha insuficiente (mín. 6 e máx. 10)");
            exit;
            }
            if (strpos($_POST['senha'], ' ') !== false) {
                header('Location: cadastro.php?erro=O campo da senha não pode conter espaços.');
                exit;
            }
            if (!preg_match('/[A-Z]/', $_POST['senha']) ||
            !preg_match('/[a-z]/', $_POST['senha']) ||
            !preg_match('/[0-9]/', $_POST['senha'])) {
                header('Location: cadastro.php?erro=O campo da senha precisa conter letras maiúsculas, minúsculas e números.');
                exit;
            }
        }
        
        
        create(database(), "usuarios", [
            "nome" => $_POST['nomeEx'],
            "nome_usuario" => $_POST['nomeUs'],
            "email" => $_POST['email'],
            "telefone" => $_POST['telefone'],
            "ano_escolar" => $_POST['ano'],
            "senha" => $_POST['senha'],
            "data_nascimento" => $_POST['data'],
        ]);
        header('Location: login.php');
        exit;
        }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyMatch</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="cabecalho">
        <div class="img-cabecalho"><a href="homelogin.php"><img src="imgs/logo.png" alt=""></a></div>
        <nav>
            <ul>
                <li><a href="login.php">
                        <p>Matérias</p>
                    </a></li>
                <li><a href="login.php">
                        <p>Social</p>
                    </a></li>
                <li><a href="login.php">
                        <p>Progresso</p>
                    </a></li>
            </ul>
        </nav>
        <div class="login"><a href="login.php">
                <div class="loginTitulo">
                    <p>login</p>
                </div>
            </a></div>
    </div>
    <div class="areaForm">

        <div class="img-login"><img src="imgs/personalização de usuário.png" alt=""></div>
        <div class="form">
            <div class="titu"><p>Cadastre-se</p></div>
            <form action="" method="post">
                <input type="text" name="id" hidden>
                <br>
                <label for="nomeEx"></label>
                <input type="text" name="nomeEx" placeholder="Nome de Exibição" id="nomeEx">
                <br>
                <label for="nomeUs"></label>
                <input type="text" name="nomeUs" placeholder="Nome de Usuário" id="nomeUs">
                <br>
                <label for="email"></label>
                <input type="text" name="email" placeholder="E-Mail" id="email">
                <p>Data de Nasc.</p>
                <div class="display-flex">
                    <label for="data"></label>
                    <input type="date" name="data" placeholder="Data de Nasc." id="data">

                    <label for="ano"></label>
                    <input type="text" name="ano" placeholder="Escolaridade" id="ano">
                </div>
                <br>
                <label for="telefone"></label>
                <input type="text" name="telefone" placeholder="Telefone" id="telefone">
                <br>
                <label for="senha"></label>
                <input type="text" name="senha" placeholder="Senha" id="senha">
                <p>A Senha deve tem máx. 10 e mín. 6 caracteres, contendo:<br>
                    -Letra maiúsculas<br>
                    -Letra minúsculas<br>
                    -Número<br>
                </p>
                <div class="erro">
                <?php
                if(isset($_GET['erro']) && $_GET['erro'] != ""){
                    echo "<p>{$_GET['erro']} </P>";
                }
                ?>
                </div>
                <div class="center"><p>Já possui uma conta? <a href="login.php">Faça login aqui.</a></p></div>
                <button type="submit">Criar Conta</button>

                

            </form>
        </div>

    </div>
    <div class="rodape">
        <div class="img-rodape"><a href="homelogin.php"><img src="imgs/logo.png" alt=""></a></div>
        <table cellpadding="3">
            <tr>
                <td><a href="pedidos.html">
                        <p>Matérias</p>
                    </a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href="bolos.html">
                        <p>Social</p>
                    </a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href="suporte.html">
                        <p>Progresso</p>
                    </a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href="docinhos-trufas.html">
                        <p>Suporte</p>
                    </a></td>
            </tr>
            <tr>
                <td><a href="kit-festa.html">
                        <p>Termos</p>
                    </a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href="tortinhas-cupcakes.html">
                        <p>Contato</p>
                    </a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href="">
                        <p>Customização</p>
                    </a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href=""></a></td>
                <td><a href="brownies-cookies.html">
                        <p>Configuração</p>
                    </a></td>
            </tr>
        </table>
        <div class="redesSociais">
            <nav>
                <ul>
                    <li><a href=""><img src="imgs/git.png" alt=""></a></li>
                    <li><a href=""><img src="imgs/insta.png" alt=""></a></li>
                </ul>
            </nav>
        </div>
</body>

</html>