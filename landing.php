<?php 
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
   
?>
<html lang="fr">
<!-- 
    ============================================
       Developed by : https://github.com/berru-g/
       Project : crypto-free-tools is the simple fibonacci retracement tool
       Date : 20/01/2025
       Version : 1.0.2  | 16/02/25
       Mise à jour article : Weekly
       Licence : The MIT License (MIT)
       Copyright (c) 2025 Berru
       Contact : https://savoir-relatif-et-absolu.netlify.app/#espace-commentaire
    ============================================
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Free Tools - Analyse Fibonacci, MA et Comparateur de Charts</title>
    <link rel="shortcut icon" href="./img/logo.png" />
    <link rel="apple-touch-icon" href="./img/logo.png" />
    <meta name="description"
        content="Découvrez crypto-free-tools et analyser le potentiel des crypto avec des tools basé sur le retracement de Fibonacci, un comparateur de chart, une alarmes de prix, Recevoir des notif des moyennes mobiles pour anticiper les gros mouvements et bien plus..">
    <meta name="keywords"
        content="comparateur de chart crypto, momentum alarme, Fibonacci retracement, Fiboscope, Recevoir des notif des moyennes mobiles pour anticiper les gros mouvements, crypto price alarm, multi charts, crypto investment, free crypto tools, crypto growth potential, crypto ATH, crypto technical analysis, gael leberruyer">
    <meta name="author" content="Gael Berru.">
    <meta name="robots" content="noai">
    <!-- Balises Open Graph pour les réseaux sociaux -->
    <meta property="og:title" content="Crypto Free Tools - Analyse Fibonacci, MA et Comparateur de Charts">
    <meta property="og:description" content="Optimisez vos analyses crypto avec des outils gratuits et intuitifs.">
    <meta property="og:image" content="https://crypto-free-tools.netlify.app/img/logo.png">
    <meta property="og:url" content="https://crypto-free-tools.netlify.app">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:type" content="tool">
    <link rel="canonical" href="https://crypto-free-tools.netlify.app/" />
    <link rel="manifest" href="/manifest.json">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.3.0/build/global/luxon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon"></script>
    <script src="https://cdn.plot.ly/plotly-2.24.1.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="new.css">
    <!--script type="application/ld+json"-->
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "Crypto Free Tools",
          "url": "https://crypto-free-tools.netlify.app",
          "description": "Outils gratuits pour l'analyse crypto : Fibonacci, alarmes de prix, comparateur de charts et notifications de moyennes mobiles.",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://crypto-free-tools.netlify.app/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
        </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y5GVLEC0TV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-Y5GVLEC0TV');
    </script>
    <script src="momentum.js" defer></script>

</head>

    <?php include_once('header.php'); ?>

    <body>
    <div id="intro">
        <h1>Crypto tools</h1><br>
        <button id="installApp">Install the app <i class="fa-solid fa-download"></i></button>

        <script>
            let deferredPrompt;

            window.addEventListener("beforeinstallprompt", (event) => {
                console.log("beforeinstallprompt détecté !");
                event.preventDefault();
                deferredPrompt = event;
                document.getElementById("installApp").style.display = "block";

                document.getElementById("installApp").addEventListener("click", () => {
                    console.log("Bouton cliqué !");
                    deferredPrompt.prompt();
                    deferredPrompt.userChoice.then((choiceResult) => {
                        if (choiceResult.outcome === "accepted") {
                            console.log("L’utilisateur a installé l’application !");
                        }
                        deferredPrompt = null;
                    });
                });
            });
            //Vérifier l'enregistrement du Service Worker 
            /*
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js')
                        .then(registration => {
                            console.log('Service Worker enregistré avec succès:', registration);
                            alert('Service Worker enregistré avec succès:', registration);
                        })
                        .catch(error => {
                            console.error('Erreur lors de l\'enregistrement du Service Worker:', error);
                            alert('Notre service \'🔔 Notif Moyenne Mobile\' est indisponble pour le moment. Merci', error);
                        });
                });
            }
             permission de notif
            if ('Notification' in window) {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        console.log('Permission accordée pour les notifications.');
                        alert('Permission accordée pour les notifications.');
                    } else {
                        console.warn('Permission refusée pour les notifications.');
                        alert('Permission refusée pour les notifications.');
                    }
                });
            } */
        </script>
    </div>
    <section id="features">
        <h2>Nos Outils</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-chart-line"></i>
                <h3>Retracement de Fibonacci</h3>
                <p>Identifiez les token loin de leur potentiel max.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-bell"></i>
                <h3>Alarme de Prix</h3>
                <p>Recevez des alertes en temps réel.</p>
            </div>
            <div class="feature-card">
                <!--<i class="fas fa-chart-area"></i>-->
                <i class="fa-solid fa-chart-area"></i>
                <h3>Comparateur de Chart</h3>
                <p>Comparez plusieurs cryptos en un clin d'œil.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-wave-square"></i>
                <h3>Momentum Live</h3>
                <p>Suivez la force du marché en direct.</p>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-timeline"></i>
                <h3>Moyenne mobile</h3>
                <p>Recevez des notifs lors de mouvements majeur.</p>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-chart-gantt"></i>
                <h3>Indicateur Tech</h3>
                <p>Affichage du RSI, MACD et Bollinger Bands.</p>
            </div>
        </div>
    </section>
    <br>
    <section>
        <script src="https://widgets.coingecko.com/gecko-coin-list-widget.js"></script>
        <gecko-coin-list-widget locale="en" transparent-background="true" coin-ids=""
            initial-currency="usd"></gecko-coin-list-widget>
    </section>
    <br>
    <section id="crash-detector">
        <h2>🚀 Momentum Live :</h2>
        <br>
        <p> Suivez en un coup d'œil la force du marché ! Le point de couleur sur le logo indique la tendance actuelle :
        </p><br>
        <ul>
            <p>🟢 Bullish,</p>
            <p>🟠 Ralentissement,</p>
            <p>🔴 Risque de retournement.</p>
        </ul><br>
        <a href="#momentum-indicator"><button>voir momentum</button></a>
    </section>
    <br>
    <section id="crash-detector">
        <h2>Notification de moyenne mobile</h2>
        <p>Recevoir des notif des MA pour anticiper les gros mouvements.</p>
        <br>
        <p><strong>Pourquoi utiliser MA50 et MA200 ?</strong></p>
        <br>
        <p>Ce sont les deux indicateurs les plus utilisés en trading pour repérer un changement de tendance majeur.
        </p><br>
        <ul>
            <p>Death Cross (MA50 passe sous MA200) = 📉</p>
            <p>Golden Cross (MA50 passe au-dessus de MA200) = 📈</p>
        </ul>
        <br>
        <div class="ma-values">
            <p><strong>MA50 :</strong> <span id="ma50">⏳</span> $</p>
            <p><strong>MA200 :</strong> <span id="ma200">⏳</span> $</p>
        </div>
        <div id="alert-box" class="hidden">
            <div id="alert-history" style="display:none;"></div>
            ⚠ <strong>Alerte :</strong> Death Cross détecté ! Risque de chute du marché !
        </div>
        <br>
        <button onclick="requestPushPermission()">🔔 Activer les notifications</button>
    </section>
    <br>
    <section>
        <div id="partner">
            <p>Providing the data</p>
            <br>
            <a href="https://www.coingecko.com"><img
                    src="https://github.com/berru-g/crypto-tool/blob/main/img/CoinGecko.png?raw=true"
                    alt="coingecko API"></a>
            <a href="https://www.tradingview.com/"><img
                    src="https://github.com/berru-g/crypto-tool/blob/main/img/TradingView.png?raw=true"
                    alt="tradingview API"></a>
            <a href="https://www.binance.info/activity/referral-entry/CPA?ref=CPA_00U44FY1PQ" rel="noopener"
                target="_blank"><img src="https://github.com/berru-g/crypto-tool/blob/main/img/Binance.png?raw=true"
                    alt="Binance API"></a>
        </div>
    </section>
    <br>
    <section>
        <h2>Annexe</h2>
        <br>
        <p>Ce site et l'app sont open source, vous pouvez accéder au code sur <a
                href="https://github.com/berru-g/crypto-tool/"><i class="fa-brands fa-github"></i> Github.</a></p>
        <br>
        <p style="font-style: italic;">Pour les
            développeurs qui veulent participer au dev de cette app n'hésitez pas à me contacter. Merci</p>
        <br>
        <ul>
            <li>✅ Si vous souhaitez des explications sur le retracement de fibonacci <a href="https://medium.com/@gael-berru/fibonacci-retracement-a56d53d5863d"
                    target="_blank" rel="noopener">medium.com</a>.</li><br>
            <li>✅ Si vous êtes débutant, lisez cet article, <a
                    href="https://savoir-relatif-et-absolu.netlify.app/comment-choisir-un-bon-token">comment choisir
                    un bon token ?</a></li><br>
            <li>✅ Lire la checklist de<a
                    href="https://medium.com/@gael-berru/checklist-de-v%C3%A9rification-dun-airdrop-anti-scam-5e12ec55ca53">
                    vérification d'un AIRDROP antiscam</a> 🚩</li><br>
            <li>🪙 Si cet outil vous est utile et que <a href="https://berru-g.github.io/berru-g/blog/donation.html"
                    target="_blank" rel="noopener">vous souhaitez faire un don</a>, </li><br>
            <li>⚙️ ou <a href="https://savoir-relatif-et-absolu.netlify.app/index.html/#espace-commentaire">une
                    remarque pour une amélioration</a> du tool. ⬇️</li>
        </ul>
    </section>

    <section id="formulaire">
        <h2>📩 Contact</h2><br>
        <p class="form-subtitle">Une question, une suggestion ? Envoyez-nous un message !</p><br>

        <form action="https://formspree.io/f/xdkaqozr" method="POST">
            <label for="email"></label>
            <input type="email" name="email" id="email" placeholder="contact@email.com" required>

            <label for="message"></label>
            <textarea name="message" id="message" placeholder="Écrivez votre message ici..." required></textarea>

            <button type="submit">Envoyer <i class="fa-solid fa-paper-plane"></i></button>
        </form>
    </section>
    <br>
    <div id="pub">
        <a href="https://shop.ledger.com/pages/ledger-nano-s-plus/?r=97b532808e9b"><img id="pub"
                src="https://affiliate.ledger.com/image/850/420/French"></a>
    </div>
    <br>
    <?php include_once('nav-bar.php'); ?>
    <?php include_once('footer.php'); ?>
    <script src="new.js"></script>
    <script src="MA50.js"></script>
  </body>
</html>
