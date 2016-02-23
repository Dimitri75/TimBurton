<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="/timburton/stylesheet/main.css">
        <link rel="icon" type="image/png" href="/timburton/resources/favicon.png" />
        <title>8INF830 - Tim Burton</title>
    </head>

    <body>
        <header>
            <nav>

                <?php if(!isset($_SESSION['login'])){ ?>
                    <a href="?main">
                        <h2>Timothy Walter Button</h2>
                    </a>

                    <span>
                        <a href="?admin_signin">
                            <span class="glyphicon glyphicon-log-in" aria-hidden="true"><b> Connexion</b></span>
                        </a>
                        <a href="/timburton/?gallery">
                            <span class="glyphicon glyphicon-film" aria-hidden="true"><b> Filmographie</b></span>
                        </a>
                    </span>
                <?php }

                else { ?>
                    <a href="?admin_userTable">
                        <h2>Timothy Walter Button</h2>
                    </a>

                    <span>
                        <a href="?admin_disconnection">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"><b> Déconnexion</b></span>
                        </a>

                        <a href="/timburton/?gallery">
                            <span class="glyphicon glyphicon-film" aria-hidden="true"><b> Filmographie</b></span>
                        </a>
                    </span>
                <?php } ?>

            </nav>
        </header>
