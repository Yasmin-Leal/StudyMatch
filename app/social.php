
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyMatch</title>
    <link rel="stylesheet" href="css/social.css">
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
                <li><a href="social.php">
                        <p>Social</p>
                    </a></li>
                <li><a href="progresso.php">
                        <p>Progresso</p>
                    </a></li>
            </ul>
        </nav>
        <a href="perfil.php?user=<?= $user ?>"><div class="fotoConta"></div></a>
        </div>
    </div>




    <div class="tituloGrupos">Grupos de Estudo</div>
    <div class="caixaGrupos">
   
 
        <div class="areaFotos">
            <div class="fotoGrupos"> <img src="imgs/grupoex.png"></div>
            <div class="fotoGrupos"> <img src="imgs/grupoex.png"></div>
            <div class="fotoGrupos"> <img src="imgs/grupoex.png"></div>
        </div>
        <div class="areaLinhas">

           <div class="linhaUsers">
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
            </div>
            <div class="linhaUsers">
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
        
            </div>

             <div class="linhaUsers">
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
                <div class="fotoUsers"> <img src="imgs/fotoperfilex.png"></div>
        
            </div>
        </div>


        <div class="tituloAmizades"><p>Amizades</p></div>
        <div class="caixaAmizades">
            <div class="fotoAmizades">
                <img src="imgs/fotoperfilex.png">
                <p class="nomeAmizades">placeholder</p>
                   <div class="botaoPerfil">
                    <button type="submit">Perfil</button>
                </div>
            </div>
            <div class="fotoAmizades">
                <img src="imgs/fotoperfilex.png">
                <p class="nomeAmizades">placeholder</p>
                   <div class="botaoPerfil">
                    <button type="submit">Perfil</button>
                </div>
            </div>
            <div class="fotoAmizades">
                <img src="imgs/fotoperfilex.png">
                <p class="nomeAmizades">placeholder</p>
                <div class="botaoPerfil">
                    <button type="submit">Perfil</button>
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
                    <li><a href=""><img src="imgs/git.png" alt=""></a></li>
                    <li><a href=""><img src="imgs/insta.png" alt=""></a></li>
                </ul>
                </nav>
            </div>
            <p class="direitos">© 2026 StudyMatch - Todos os direitos reservados</p>
    </div>
</body>
</html>