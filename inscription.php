<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--for connexion system by -- <meta name="author" content="NoS1gnal"/>-->
            <meta name="author" content="berru-g"/>
            <title>Crypto-tool Inscription</title>
  <link rel="shortcut icon" href="https://github.com/berru-g/All-in-one-dashboard/blob/main/img/icons8-wallet-100.png?raw=true" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="new.css">
        </head>
        <body>
        <div class="login-form">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email trop long
                            </div>
                        <?php 
                        break;

                        case 'pseudo_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> pseudo trop long
                            </div>
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte deja existant
                            </div>
                        <?php 

                    }
                }
                ?>
            
            <form action="inscription_traitement.php" method="post">
                <h2 class="text-center">Crypto Tool Inscription</h2>       
                <div class="form-group">
                    <input type="text" name="pseudo"  placeholder="Pseudo" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="email" name="email"  placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password"  placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password_retype"  placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Inscription</button>
                    
                </div> 
                <p><a href="connexion.php">Connexion</a></p>  
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
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
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
