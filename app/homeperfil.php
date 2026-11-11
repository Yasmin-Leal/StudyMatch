<?php
    require_once __DIR__ . "/banco/crud.php"; 
    require_once __DIR__ . "/banco/database.php"; 

    $user = $_GET['user'];

    $dadosUser = database()->prepare('
    SELECT * FROM usuarios WHERE nome_usuario = :user');
    $dadosUser->execute(['user' => $user]);

    $usuario = $dadosUser->fetch(PDO::FETCH_ASSOC);

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
</head>

<body>
    <div class="cabecalho">
        <div class="img-cabecalho"><a href="homeperfil.php?user=<?= $user ?>"><img src="imgs/logo.png" alt=""></a></div>
        <nav>
            <ul>
                <li><a href="">
                        <p>Matérias</p>
                    </a></li>
                <li><a href="">
                        <p>Social</p>
                    </a></li>
                <li><a href="">
                        <p>Progresso</p>
                    </a></li>
            </ul>
        </nav>
        <a href="perfil.php?user=<?= $user ?>"><div class="fotoConta"></div></a>
    </div>

    <div class="banner">
        <div class="bannerimg"></div>

    </div>
    <div class="bolhaSaudacao">
        
    </div>
    <div class="saudacao">
        <p>Aproveite,<br><?= $usuario['nome'] ?>!</p></div>

    <div class="caixaMetas">
        <div class="fotoUserGrande"></div>
        <div class="listaMetas">
            <div class="metas"><p>Metas</p></div>
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
        <div class="areaCalendario"></div>
    </div>
    <div class="nomeUser"><p><?= $usuario['nome'] ?></p></div>

    <div class="tituloMaterias"><p>Matérias</p></div>

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
    <div class="rodape">
        <div class="img-rodape"><a href="homelogin.php"><img src="imgs/logo.png" alt=""></a></div>
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
                    <li><a href=""><img src="imgs/git.png" alt=""></a></li>
                    <li><a href=""><img src="imgs/insta.png" alt=""></a></li>
                </ul>
                </nav>
            </div>
            <p class="direitos">© 2026 StudyMatch - Todos os direitos reservados</p>
    </div>
</body>
</html>