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
                        <td><a href='#'><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></a></td>
                        <td><a href='#'><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td>
                    </tr>";
            }
        ?>
        </table>
    </section>
</div>
