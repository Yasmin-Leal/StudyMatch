<?php
    require_once __DIR__ . "/locais.php";

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
</head>

<body>
        <div class="cabecalho">
        <div class="img-cabecalho"><a href="homeperfil.php?user=<?= $user ?>"><img src="imgs/logo.png" alt=""></a></div>
        <nav>
            <ul>
                <li><a href="selecionar-sala.php?user=<?= $user ?>">
                        <p>Grupos de Estudo</p>
                    </a></li>
                <li><a href="login.php">
                        <p>Social</p>
                    </a></li>
                <li><a href="login.php">
                        <p>Progresso</p>
                    </a></li>
            </ul>
        </nav>
        <a href="perfil.php?user=<?= $user ?>"><div class="fotoConta"></div></a>
        </div>
    </div>
    
    <div class="editando">
        <p>Editando Personagem</p>
    </div>
    <div class="caixaMaior">
        <div class="caixaFundoAvatar">
            <div class="fundoAvatar">
                <div class="avatar">
                    <img src="<?= $personagens['5']?>" width="500px">
                </div>
            </div>
            <form action="" method="post">
            <div class="salvar"><button type="submit">Salvar</button></div></form>
        </div>
        <div class="caixaAcessorios">
            <div class="acessoriosTitulo"><p>Acessórios</p></div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['1']?>" width=220px></div>

            </div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['2']?>" width=220px></div>

            </div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['3']?>" width=220px></div>

            </div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['4']?>" width=220px></div>

            </div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['5']?>" width=220px></div>

            </div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['6']?>" width=220px></div>

            </div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['7']?>" width=220px></div>
                
            </div>
            <div class="boxAcc">
                <div class="acessorio"><img src="<?= $acessorios['8']?>" width=220px></div>

            </div>
        </div>
       
    </div>
    <div class="caixaMaior">
        <div class="opcoesPerso">
            <div class="personagens">
                <img src="<?= $personagens['1']?>" width="300" >
                
            </div>
            <div class="personagens">
                <img src="<?= $personagens['2']?>" width="280" >
            </div>
            <div class="personagens">
                <img src="<?= $personagens['3']?>" width="300" >
            </div>
            <div class="personagens">
                <img src="<?= $personagens['4']?>" width="300" >
            </div>
            <div class="personagens">
                <img src="<?= $personagens['5']?>" width="300" >
            </div>
            <div class="personagens">
                <img src="<?= $personagens['6']?>" width="300" >
            </div>
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