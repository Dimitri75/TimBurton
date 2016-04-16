<?php
    $movies = resultFromQuery(getMovies(SparqlEnum::TIM_BURTON));
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
            </ul>
            <p>
                <?php
                    foreach($movies["results"]["bindings"] as $data){
                        var_dump($data["film"]["value"]);
                        echo "<li>".$data["film"]["value"]."</li>";

                        $depiction = resultFromQuery(getDepiction($data["film"]["value"]));
                        var_dump($depiction);

                        //echo   "<li><img src='".$depiction["depiction"]["value"]."'/></li>";
                    }
                ?>
            </p>
    </section>
</div>