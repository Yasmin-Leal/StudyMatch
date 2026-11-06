<?php
    require_once __DIR__ . "/banco/crud.php"; 
    require_once __DIR__ . "/banco/database.php"; 

    $grupos = readAll(database(), "grupos_estudos");
    $areaConhecimento = readAll(database(), "area_conhecimento");
    $materias = readAll(database(), "materias");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyMatch</title>
    <link rel="stylesheet" href="css/selecionar-sala.css">
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
        <a href="perfil.php?user="><div class="fotoConta"></div>
    </div></a>
       
    <div class="aviso">
        <p>Selecione uma sala de estudos de seu interesse ou crie uma nova!</p>
    </div>
    
    <div class="pesquisaSalas">
        <form>
            <select name="areaConhecimento">
                <option value="">Área de Conhecimento</option>
                <?php foreach($areaConhecimento as $a): ?>
                <option value="<?= $a['nome_area'] ?>">
                <?= $a['nome_area'] ?>
                </option>
                <?php endforeach; ?>
            </select>
            <select name="materias">
                <option value="">Matérias</option>
                <?php foreach($materias as $m): ?>
                <option value="<?= $m['nome_materia'] ?>">
                <?= $m['nome_materia'] ?>
                </option>
                <?php endforeach; ?>
            </select>
            <br>
        </form>
        <div class="lupa"></div>
    </div>

    <div class="criarSala">
    <button type="submit">Criar uma sala de estudos</button>
    <div class="plus"></div>
    
    </div>
    

    <div class="exibirSalas">

        <?php foreach($grupos as $g): ?>
          <div class="boxLocal">
            <div class="imagemLocal">

            </div>

            <p><?= $g['nome_grupo'] ?>-<?= $g['nome_area'] ?>-<?= $g['nome_materia'] ?></p>

            <button type="button">Ver mais informações.</button>

        </div>  
        <?php endforeach; ?>
        <?php if(empty($grupos)): ?>
            <p>Nenhum Grupo Aberto</p>
        <?php endif; ?>
        
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