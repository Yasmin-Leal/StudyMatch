<?php
    require_once __DIR__ . "/banco/crud.php"; 
    require_once __DIR__ . "/banco/database.php"; 

    $user = $_GET['user'];

    $sql = "SELECT * FROM usuarios WHERE nome_usuario = :user";
    $stmt = database()->prepare($sql);
    $stmt->bindValue(':user', $user);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $nome = $_POST['nomeEx'];
        $email = $_POST['email'];
        $data = $_POST['data'];
        $telefone = $_POST['telefone'];

        $consulta = database()->prepare('
        UPDATE usuarios SET nome = :nome, email = :email, data_nascimento = :data, telefone = :telefone WHERE id = :id;
        ');
        $consulta->execute(['nome' => $nome, 'email' => $email, 'data' => $data, 'telefone' => $telefone, 'id' => $id]);
        header("Location: perfil.php");
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
        <div class="fotoConta"><a href="perfil.php">
            </a></div>
    </div>
        <div class="fundo">
            <div class="perfilbox">
                
                <div class="bannerperfil"></div>
                <div class="fotoperfil"></div>
                <div class="editarfoto"></div>

                <div class="infoperfil">
                    <div class="form">
                        <form action="" method="post">
                        <input type="hidden" name="id">

                        <label for="nomeEx"></label>
                        <input type="text" name="nomeEx" id="nomeEx" value="<?=  $usuario['nome'] ?>">

                        <label for="nomeUs"></label>
                        <input type="text" name="nomeUs" id="nomeUs" value="<?=  $usuario['nome_usuario'] ?>">

                        <label for="email"></label>
                        <input type="text" name="email"  id="email" value="<?=  $usuario['email'] ?>">

                        <label for="data"></label>
                        <input type="date" name="data"  id="data" value="<?=  $usuario['data_nascimento'] ?>">

                        <label for="telefone"></label>
                        <input type="text" name="telefone"  id="telefone" placeholder="Telefone" value="<?=  $usuario['telefone'] ?>">

                        <button type="submit">Editar Perfil</button>
                        </form>
                    </div>
                </div>
                
        </div>
    </div>
    

    <div class="rodape">
        <div class="img-rodape"><a href="homelogin.php"><img src="/img-yasmin/logo.png" alt=""></a></div>
        <table cellpadding="3">
            <tr>
                <td><a href="materias.php"><p>Matérias</p></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="social.php"><p>Social</p></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="progresso.php"><p>Progresso</p></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="suporte.php"><p>Suporte</p></a></td>
            </tr>
            <tr>
                <td><a href="termos.php"><p>Termos</p></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="contato.php"><p>Contato</p></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="customizacao.php"><p>Customização</p></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="configuracao.php"><p>Configuração</p></a></td>
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
            <p class="direitos">© 2026 StudyMatch - Todos os direitos reservados</p>
    </div>
</body>
</html>