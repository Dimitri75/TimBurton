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
                        echo "<li>".$data["film"]["value"]."</li>";
                        var_dump($data["same"]);

//                        $depiction = resultFromQuery(getDepiction($data["film"]["value"]["results"]["bindings"][0]));
//                        var_dump($depiction);

                        //echo "<img src='" . $depiction["results"]["bindings"][0]["depiction"]["value"] . "'/>";
                    }
                ?>
            </p>
    </section>
</div>