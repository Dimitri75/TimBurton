<div id="main">
    <section class="left">
        <h3>Affichage table 'user'</h3>
        <br/><br/>
        <table border="1">
            <th>Identifiant</th>
            <th>Mot de passe</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        <?php
            $db = connectDB();
            $result = $db->query('SELECT * from user');
            while ($data = $result->fetch()){
                echo "<tr>
                        <td>".$data['login']."</td>
                        <td>".$data['password']."</td>
                        <td><a href='/timburton/?action=update_user&id=".$data['id']."'><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></a></td>
                        <td><a href='/timburton/?action=delete_user&id=".$data['id']."'><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td>
                    </tr>";
            }
        ?>
        </table>

        <br/><br/>
        <h3>Ajouter un utilisateur</h3>
        <form method="post" action="/timburton/?create_user">
            <table>
                <tr>
                    <td>Identifiant</td>
                    <td><input type="text" name="login"/></td>
                </tr><tr>
                    <td>Mot de passe</td>
                    <td><input type="password" name="password1"/></td>
                </tr><tr>
                    <td>Confirmation du mot de passe</td>
                    <td><input type="password" name="password2"/></td>
                </tr>
            </table>
            <br/>

            <button type="submit" class="btn btn-default">Ajouter</button>
        </form>
    </section>

    <section class="right">
        <h3>Affichage table 'film'</h3>
        <br/><br/>
        <table border="1">
            <th>Nom</th>
            <th>Synopsis</th>
            <th>Date</th>
            <th>Note</th>
            <th>Illustration</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            <?php
            $db = connectDB();
            $result = $db->query('SELECT * from film');
            while ($data = $result->fetch()){
                echo "<tr>
                        <td>".$data['name']."</td>
                        <td>".$data['resume']."</td>
                        <td>".$data['date']."</td>
                        <td>".$data['note']."</td>
                        <td>".$data['illustration']."</td>
                        <td><a href='/timburton/?action=update_film&id=".$data['id']."'><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></a></td>
                        <td><a href='/timburton/?action=delete_film&id=".$data['id']."'><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td>
                    </tr>";
            }
            ?>
        </table>

        <br/><br/>
        <h3>Ajouter un film</h3>
        <form method="post" action="/timburton/?create_film">
            <table>
                <tr>
                    <td>Nom</td>
                    <td><input type="text" name="name"/></td>
                </tr><tr>
                    <td>Synopsis</td>
                    <td><input type="text" name="resume"/></td>
                </tr><tr>
                    <td>Date</td>
                    <td><input type="text" name="date"/></td>
                </tr><tr>
                    <td>Note</td>
                    <td><input type="text" name="note"/></td>
                </tr><tr>
                    <td>Illustration</td>
                    <td><input type="text" name="illustration"/></td>
                </tr>
            </table>
            <br/>

            <button type="submit" class="btn btn-default">Ajouter</button>
        </form>
    </section>


</div>
