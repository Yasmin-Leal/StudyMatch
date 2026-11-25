<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudyMatch | progresso</title>
  <link rel="stylesheet" href="progresso.css">
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
        <div class="login"><a href="login.php">
                <div class="loginTitulo">
                    <p>login</p>
                </div>
            </a></div>
    </div>
    <div class="inicialLogin">
        <img src="/img-yasmin/login-img.png" alt="">
        <div class="formLogin">
            <div class="titulo"><p>Login</p></div>
            <form action="" method="post">
                <input type="hidden" name="id_usuario">

                <input type="text" name="email" id="email" placeholder="E-Mail">

                <input type="password" name="senha" id="senha" placeholder="Senha">

                <div class="erro">
                <?php
                if(isset($_GET['erro']) && $_GET['erro'] != ""){
                    echo "<p>{$_GET['erro']}</p>";
                }
                ?>
                </div>

                <p>Não possui uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>

                <button type="submit">Acessar Conta</button>
            </form>
        </div>
    </div>
    <!--_________________________________________________________________________________________________-->


    <main class="card-principal">
    
        <header>
           
        </header>

         <header class="ft-perfil">
            <img class="img-perfil" src="imgs-le/img-perfil.png" alt="">   
        </header>

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

<!------------------------------------------------------------------------------------------------------------------------>
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