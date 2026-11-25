<?php

require_once __DIR__ . "/banco/crud.php";
require_once __DIR__ . "/banco/database.php";
require_once __DIR__ . "/locais.php";

// IDENTIFICAÇÃO DO USUÁRIO E DO GRUPO
$user = $_GET['user'] ?? '';
$nomeGrupo = $_GET['grupo'] ?? '';

if ($user === '') {
    die("Usuário não identificado.");
}

// BUSCA O AVATAR SALVO NO BANCO
$stmtAvatar = database()->prepare("
    SELECT personagem, acessorio
    FROM personagens
    WHERE nome_usuario = :user
");

$stmtAvatar->execute([
    ':user' => $user
]);

$avatarBanco = $stmtAvatar->fetch(PDO::FETCH_ASSOC);

// VERIFICA SE EXISTE UM PERSONAGEM CADASTRADO
if (!$avatarBanco) {
    die("Não foi encontrado um personagem cadastrado para este usuário.");
}

// RECUPERA O PERSONAGEM
$idPersonagem = (string) $avatarBanco['personagem'];

$personagemSelecionado = isset($personagens[$idPersonagem])
    ? $idPersonagem
    : "1";

// RECUPERA O ACESSÓRIO
$idAcessorio = (string) ($avatarBanco['acessorio'] ?? '');

$acessorioSelecionado = (
    $idAcessorio !== '' &&
    isset($acessorios[$idAcessorio])
)
    ? $idAcessorio
    : '';

$imagemPersonagem = $personagens[$personagemSelecionado];
$imagemAcessorio = $acessorioSelecionado !== ''
    ? $acessorios[$acessorioSelecionado]
    : null;

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyMatch</title>
    <link rel="stylesheet" href="css/salaminigame.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&display=swap" rel="stylesheet">
</head>

<body>
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

        <!-- AVATAR DO USUÁRIO -->

        <a href="perfil.php?user=<?= urlencode($user) ?>">

            <div class="fotoConta">

                <!-- PERSONAGEM -->

                <img
                    class="personagemCabecalho"
                    src="<?= htmlspecialchars($imagemPersonagem, ENT_QUOTES, 'UTF-8') ?>"
                    alt="Personagem do perfil"
                >

                <!-- ACESSÓRIO -->

                <?php if ($imagemAcessorio !== null): ?>

                    <img
                        class="acessorioCabecalho"
                        src="<?= htmlspecialchars($imagemAcessorio, ENT_QUOTES, 'UTF-8') ?>"
                        alt="Acessório do personagem"
                    >

                <?php endif; ?>

            </div>

        </a>

    </div>
       <div class="titulosSala">
        
        <div class="materia"><p>Ciências Humanas</p></div>
        
        <div class="tempo"><div class="css-stopwatch" role="img" aria-label="CSS timer counting from zero to five minutes">
  <div class="css-stopwatch__window">
    <div class="css-stopwatch__column css-stopwatch__minutes-tens">
      <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span>
    </div>
  </div>
  <div class="css-stopwatch__window">
    <div class="css-stopwatch__column css-stopwatch__minutes-ones">
      <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span>
      <span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
    </div>
  </div>

  <span class="css-stopwatch__colon">:</span>

  <div class="css-stopwatch__window">
    <div class="css-stopwatch__column css-stopwatch__seconds-tens">
      <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
    </div>
  </div>
  <div class="css-stopwatch__window">
    <div class="css-stopwatch__column css-stopwatch__seconds-ones">
      <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span>
      <span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
    </div>
  </div>
</div></div>
       
        
        </div>
     <main class="vila-game">
      <header>
        
       
      </header>
      <section
        id="scene"
        aria-label="Local explorável. Use setas ou WASD para andar; aperte E perto da mesa para sentar."
      >
        <div class="grass"></div>
        <div class="path h"></div>
        <div class="path v"></div>
        <div class="path cross"></div>
        <div class="house">
          <div class="chimney"></div>
          <div class="roof"></div>
          <div class="window"></div>
          <div class="door"></div>
          <div class="porch"></div>
          <div class="sign">Biblioteca</div>
        </div>
        <div class="tree t1">🌳</div>
        <div class="tree t2">🌲</div>
        <div class="tree t3">🌳</div>
        <div class="tree t4">🌲</div>
        <div class="bush b1">🌼🌿</div>
        <div class="bush b2">🌷</div>
        <div class="pond"><span class="pond-lily">🪷</span></div>
        
        <div class="fence lower"></div>
        <div class="lamp">🏮</div>
        <div class="mailbox">📮</div>
        <div class="bench"></div>
        <div class="flowerbed">🌸🌼🌷</div>
        <div class="stones"><i></i><i></i><i></i></div>
        <span class="shell s1">🐚</span><span class="shell s2">✨</span
        ><span class="shell s3">🍄</span>
        <div class="study-zone" id="study-zone">
          <div class="study-rug"></div>
          <!-- COLOCAR FOTOS DOS NPCS AQUI-->
          <div
            class="student one npc"
            data-name="username"
            data-talk="Estudando...Tempo na sala: 00:28:27"
          >
            <img src="imgs/bunny-removebg-preview.png"  />
          </div>
          <div
            class="student two npc"
            data-name="username"
            data-talk="Descansando. Tempo na sala: 00:41:43"
          >
            <img src="imgs/dog-removebg-preview.png" />
          </div>
          <div
            class="student three npc"
            data-name="username"
            data-talk="Estudando...Tempo na sala: 01:02:32"
          >
            <img src="imgs/Esquilo.png"  />
          </div>
          <div class="book b1">📗</div>
          <div class="book b2">📘</div>
          <div class="book b3">📙</div>
          <div class="pencil">✏️</div>
          <div class="study-table"></div>
          <div class="seat" id="seat"></div>
          <div class="table-invite">clube de estudos · sente-se!</div>
        </div>
        <!-- colocar AQUI!!!!!!!! o avatar do user -->
        <div class="person" id="hero" style="left: 45%; top: 73%">
          <img class="hero-sprite" src="imgs/cat-removebg-preview.png" alt="Sua personagem" />
        </div>
        <div class="bubble" id="bubble" role="status">
          <strong id="bubble-name"></strong>
          <p id="bubble-text"></p>
          <small>Pressione E ou toque para fechar</small>
        </div>
      </section>
      <div class="footer">
        <div class="help">
          Ande com <b>← ↑ → ↓</b> ou <b>WASD</b>.Chegue à cadeira e aperte <b>E</b> para sentar / levantar.
        </div>
        <div class="pad" aria-label="Controles direcionais">
          <button data-d="up" aria-label="Cima">▲</button
          ><button data-d="left" aria-label="Esquerda">◀</button
          ><button data-d="down" aria-label="Baixo">▼</button
          ><button data-d="right" aria-label="Direita">▶</button>
        </div>
        <button id="sit-button">🪑 Sentar à mesa</button>
      </div>
    </main>
    <script>
      // No external libraries. Keep style.css and your character image(s) beside index.html, or update their relative paths.
      (() => {
        const scene = document.querySelector("#scene"),
          hero = document.querySelector("#hero"),
          bubble = document.querySelector("#bubble"),
          seat = document.querySelector("#seat"),
          status = document.querySelector("#status"),
          sitButton = document.querySelector("#sit-button");
        let x = scene.clientWidth * 0.45,
          y = scene.clientHeight * 0.73,
          sitting = false;
        const held = new Set(),
          speed = 2.8;
        const keyMap = {
          ArrowUp: "up",
          w: "up",
          W: "up",
          ArrowDown: "down",
          s: "down",
          S: "down",
          ArrowLeft: "left",
          a: "left",
          A: "left",
          ArrowRight: "right",
          d: "right",
          D: "right",
        };
        function dimensions() {
          return { w: scene.clientWidth, h: scene.clientHeight };
        }
        function center(el) {
          const a = el.getBoundingClientRect(),
            b = scene.getBoundingClientRect();
          return { x: a.left - b.left + a.width / 2, y: a.top - b.top + a.height / 2 };
        }
        function draw() {
          hero.style.left = x + "px";
          hero.style.top = y + "px";
        }
        function show(name, text) {
          document.querySelector("#bubble-name").textContent = name;
          document.querySelector("#bubble-text").textContent = text;
          bubble.classList.add("show");
        }
        function hide() {
          bubble.classList.remove("show");
        }
        function interact() {
          if (sitting) {
            sitting = false;
            seat.classList.remove("sat");
            hero.style.transform = "";
            status.textContent = "🌤️ Dia ensolarado · clube de estudos";
            sitButton.textContent = "🪑 Sentar à mesa";
            hide();
            return;
          }
          const h = center(hero),
            c = center(seat);
          if (Math.hypot(h.x - c.x, h.y - c.y) < 128) {
            sitting = true;
            held.clear();
            x = c.x - 27;
            y = c.y - 63;
            draw();
            hero.style.transform = "rotate(8deg)";
            seat.classList.add("sat");
            status.textContent = "📚 Você se juntou ao clube de estudos";
            sitButton.textContent = "Levantar";
            show(
              "Clube de estudos",
              "Aperte E para levantar.",
            );
            return;
          }
          let near = null,
            dist = Infinity;
          document.querySelectorAll(".student").forEach((n) => {
            const p = center(n),
              d = Math.hypot(h.x - p.x, h.y - p.y);
            if (d < dist) {
              near = n;
              dist = d;
            }
          });
          if (near && dist < 120) {
            show(near.dataset.name, near.dataset.talk);
            return;
          }
          show("Dica", "Explore a vila e aproxime-se da cadeira para sentar à mesa.");
        }
        function loop() {
          if (!sitting) {
            let dx = (held.has("right") ? 1 : 0) - (held.has("left") ? 1 : 0),
              dy = (held.has("down") ? 1 : 0) - (held.has("up") ? 1 : 0);
            if (dx || dy) {
              const m = Math.hypot(dx, dy);
              x += (dx / m) * speed;
              y += (dy / m) * speed;
              const { w, h } = dimensions();
              x = Math.max(0, Math.min(w - 54, x));
              y = Math.max(0, Math.min(h - 86, y));
              hero.style.transform = dx < 0 ? "scaleX(-1)" : "";
              draw();
            }
          }
          requestAnimationFrame(loop);
        }
        window.addEventListener("keydown", (e) => {
          if (keyMap[e.key]) {
            e.preventDefault();
            if (!sitting) held.add(keyMap[e.key]);
          }
          if (e.key === "e" || e.key === "E") {
            e.preventDefault();
            interact();
          }
          if (e.key === "Escape") hide();
        });
        window.addEventListener("keyup", (e) => {
          if (keyMap[e.key]) held.delete(keyMap[e.key]);
        });
        window.addEventListener("blur", () => held.clear());
        document.querySelectorAll("[data-d]").forEach((b) => {
          const d = b.dataset.d;
          b.addEventListener("pointerdown", (e) => {
            e.preventDefault();
            if (!sitting) held.add(d);
            b.setPointerCapture(e.pointerId);
          });
          const stop = () => held.delete(d);
          b.addEventListener("pointerup", stop);
          b.addEventListener("pointercancel", stop);
          b.addEventListener("lostpointercapture", stop);
        });
        sitButton.addEventListener("click", interact);
        bubble.addEventListener("click", hide);
        document
          .querySelectorAll(".student")
          .forEach((n) =>
            n.addEventListener("click", () => show(n.dataset.name, n.dataset.talk)),
          );
        window.addEventListener("resize", () => {
          const { w, h } = dimensions();
          x = Math.min(x, w - 54);
          y = Math.min(y, h - 86);
          draw();
        });
        draw();
        loop();
      })();
    </script>
    <div class="boxConteudo">
      <p>Conteúdo</p>
      <h1>+</h1>

      <div class="conteudos"><img src="imgs/exhumanas1.png"> <img src="imgs/exhumanas2.png">  <img src="imgs/exhumanas3.png"></div>

      
    </div>
    <div class="notasEchat">
      <div class="notas">
      <p>Notas</p>
      <div class="notepad">
        <textarea id="notas"></textarea>
      </div>

      </div>
      <div class="chat">
        <div class="chat-placeholder">
  <div class="chat-header">Chat da Sala</div>

  <div class="chat-messages">
    <div class="message received">Bem vindo!</div>
    <div class="message sent">Obrigado</div>
    <div class="message received">A matéria tá bem tranquila</div>
    <div class="message sent">Ai que bom</div>
  </div>

  <div class="chat-input">
    <span>Digite uma mensagem...</span>
    <button type="button" aria-label="Enviar">➤</button>
  </div>
</div>
      </div>
    </div>

  <div class="prof"><img src="imgs/prof gi.png"></div>

























        

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