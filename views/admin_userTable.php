<div id="main">
    <section>
        <h3>Affichage table 'user'</h3>
        <br/><br/>
        <table border="1">
            <th>Identifiant</th>
            <th>Mot de passe</th>
        <?php
            $result = $db->query('SELECT * from user');
            while ($data = $result->fetch()){
                echo "<tr><td>".$data['login']."</td><td>".$data['password']."</td></tr>";
            }
        ?>
        </table>
    </section>
</div>
