<?php
    $movies = resultFromQuery(getMovies(SparqlEnum::TIM_BURTON));
echo getMovies(SparqlEnum::TIM_BURTON);
?>
<div id="main">
    <section>
        <h3>Filmographie</h3>
        <br/><br/>
            <ul>
                <?php
                    $db = connectDB();
                    $result = $db->query('SELECT * from film ORDER BY note DESC');

                    while ($data = $result->fetch()){
                        echo    "<li>
                                    <a href='/timburton/?action=show_film&id=".$data['id']."'>
                                        <figure class='tiny'>
                                            <img src='/timburton/resources/film/".$data['illustration']."'/>
                                            <figcaption>".$data['name']." (".$data['date'].")</figcaption>
                                        </figure>
                                    </a>
                                </li>";
                    }
                ?>

                <?php
                    var_dump($movies);
                    foreach($movies["results"]["bindings"] as $data){
                        echo    "<li>".$data["film"]["value"]."</li>";
                    }
                ?>
            </ul>
    </section>
</div>