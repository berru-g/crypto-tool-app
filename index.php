<!DOCTYPE html>
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
        <body>
        
        <div class="login-form">
             <?php 
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;
                    }
                }
                ?> 
            
            <form action="connexion.php" method="post">
                <h2 class="text-center">Crypto tool Connexion</h2>       
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Connexion</button> 
                    
                </div>   
                <p class="text-center"><a href="inscription.php">Inscription</a></p>
            </form>
            <br>
            <p class="text-center"><a href="https://crypto-free-tools.netlify.app/">Utiliser l'app sans inscription.</a></p>
        </div>
        <style>
            body{ 
                background-color: #f1f1f1;
                width: 100%;
                height: auto;
            }
            .login-form {
                width: 300px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
                border-radius: 8px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
                background-color: #ab9ff2;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        </style>
        </body>
</html>