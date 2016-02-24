<div id="main">
    <section>
        <h3>Filmographie</h3>
        <br/><br/>
        <table>
            <tr>
                <?php
                    $db = connectDB();
                    $result = $db->query('SELECT * from film');

                    while ($data = $result->fetch()){
                        echo "<td>
                                <a href='/timburton/?action=show_film&id=".$data['id']."'>
                                    <figure class='tiny'>
                                        <img src='/timburton/resources/film/".$data['illustration']."'/>
                                        <figcaption>".$data['name']." (".$data['date'].")</figcaption>
                                    </figure>
                                </a>
                                </td>";
                    }
                ?>
            </tr>
        </table>
    </section>
</div>