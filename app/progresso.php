<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudyMatch | progresso</title>
  <link rel="stylesheet" href="./css/progresso.css">
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
    <main class="card-principal">
        
        <header class="secao-top">
            <div class="avatar"></div>
            
            <div class="atividade">
                <h2>Tempo de atividade</h2>
                <div class="atividade-box">
                    <div class="tempo">
                        <!-- icone do Reloginho provisorio-->
                        <svg class="clock-icon large" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <polyline points="12 7 12 12 15 14"></polyline>
                        </svg>
                    </div>
                    <div class="materias"></div>
                </div>
            </div>
        </header>

    
        <section class="metas">
            <h1>Metas alcançadas</h1>
            
            <div class="metas-container">
                <div class="progresso-barra">
                    <div class="progresso-indicator"></div>
                </div>

                
                <div class="grade-dias">
                    <div class="day-card">
                        <p class="day-nome">seg</p>
                        <div class="dia">
                            <svg class="clock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"></circle>
                                <polyline points="12 7 12 12 15 14"></polyline>
                            </svg>
                  
                        </div>
                    </div>

                    <div class="day-card">
                        <p class="day-nome">ter</p>
                        <div class="dia">
                            <svg class="clock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"></circle>
                                <polyline points="12 7 12 12 15 14"></polyline>
                            </svg>
                            
                        </div>
                    </div>

                    <div class="day-card">
                        <p class="day-nome">qua</p>
                        <div class="dia">
                            <svg class="clock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"></circle>
                                <polyline points="12 7 12 12 15 14"></polyline>
                            </svg>
                           
                        </div>
                    </div>

                    <div class="day-card">
                        <p class="day-nome">qui</p>
                        <div class="dia">
                            <svg class="clock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"></circle>
                                <polyline points="12 7 12 12 15 14"></polyline>
                            </svg>
                            
                        </div>
                    </div>

                    <div class="day-card">
                        <p class="day-nome">sex</p>
                        <div class="dia">
                            <svg class="clock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"></circle>
                                <polyline points="12 7 12 12 15 14"></polyline>
                            </svg>
                           
                        </div>
                    </div>

                    <div class="day-card">
                        <p class="day-nome">sab</p>
                        <div class="dia">
                            <svg class="clock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"></circle>
                                <polyline points="12 7 12 12 15 14"></polyline>
                            </svg>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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