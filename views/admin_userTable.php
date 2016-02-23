<div id="main">
    <section>
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
</div>
