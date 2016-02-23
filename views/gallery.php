<div id="main">
    <section>
        <h3>Filmographie</h3>
        <br/><br/>

            <ul class="gallery">
                <?php
                    $db = connectDB();
                    $result = $db->query('SELECT * from film');
                    while ($data = $result->fetch()){
                        echo "<a href='/web/?action=show_film&id=".$data['id']."'>
                                <li>
                                    <figure class='tiny'>
                                        <img src='/web/resources/film/".$data['illustration']."'/>
                                        <figcaption>".$data['name']." (".$data['date'].")</figcaption>
                                    </figure>
                                </li>
                        </a>";
                    }
                ?>
            </ul>

    </section>
</div>