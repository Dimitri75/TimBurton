<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheet/main.css">
        <link rel="icon" type="image/png" href="resources/favicon.png" />
        <title>8INF830 - Tim Burton</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="/web">
                    <h2>Timothy Walter Button</h2>
                </a>

                <?php if(!isset($_SESSION['login'])){ ?>
                    <a href="?admin_connection">
                        <span class="glyphicon glyphicon-log-in" aria-hidden="true"><b> Connexion</b></span>
                <?php }else{ ?>
                    <a href="?admin_deconnection">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"><b> D&eacute;connexion</b></span>
                <?php } ?>

                </a>
            </nav>
        </header>
