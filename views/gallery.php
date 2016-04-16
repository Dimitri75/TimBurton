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
            <ul>
                <?php
                    foreach($movies["results"]["bindings"] as $data){
                        echo    "<li>
                                    <a href='/timburton/?action=show_film&id=".$data["wiki"]["value"]."'>
                                        <figure class='tiny'>
                                            <img src='".$data["wiki"]["value"]."'/>
                                            <figcaption>".$data["label"]["value"]."</figcaption>
                                        </figure>
                                    </a>
                                </li>";

                        //echo "<li>".$data["label"]["value"]."</li>";
                        //var_dump($data);

//                        $depiction = resultFromQuery(getDepiction($data["film"]["value"]["results"]["bindings"][0]));
//                        var_dump($depiction);

                        //echo "<img src='" . $depiction["results"]["bindings"][0]["depiction"]["value"] . "'/>";
                    }
                ?>
            </ul>
    </section>
</div>