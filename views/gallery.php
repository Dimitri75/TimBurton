<?php
    if (isset($_GET['subject']))
        $subject = $_GET['subject'];
    else $subject = SparqlEnum::TIM_BURTON;

    $movies = resultFromQuery(getMoviesByDirector($subject, 100));
?>
<div id="main">
    <section>
        <h3>Filmographie</h3>
        <br/><br/>
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
                    }
                ?>
            </ul>
    </section>
</div>