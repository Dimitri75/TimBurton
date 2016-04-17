<?php
    $subject = SparqlEnum::SUBJECT_TIM_BURTON;
    if (isset($_GET['subject']))
        $subject = $_GET['subject'];

    $role = ActionEnum::DIRECTOR;
    if (isset($_GET['role']))
        $role = $_GET['role'];

    switch ($role) {
        case ActionEnum::DIRECTOR :
            $movies = resultFromQuery(getMoviesByDirector($subject, 100));
            break;
        case ActionEnum::PRODUCER :
            $movies = resultFromQuery(getMoviesByProducer($subject, 100));
            break;
        case ActionEnum::ACTOR :
            $movies = resultFromQuery(getMoviesByActor($subject, 100));
            break;
        default :
            $movies = resultFromQuery(getMoviesByDirector($subject, 100));
            break;
    }
?>

<div id="main">
    <section>
        <h3>
            Filmographie de
            <?php
                echo resultFromQuery(getLabel($subject))["results"]["bindings"][0]["label"]["value"];
            ?>
        </h3>
        <br/><br/>
            <ul>
                <?php
                    foreach($movies["results"]["bindings"] as $data){
                        $label = removeStringInParentheses($data["label"]["value"]);
                        $moviePosterQuery = getMoviePoster($label);
                        $searchResult = resultFromQueryForImages($moviePosterQuery);

                        $image = "#";
                        if(strcmp($searchResult->Response, "True") == 0)
                            $image = $searchResult->Poster;

                        echo    "<li>
                                    <a href='/timburton/?action=show_film&id=".$data["wiki"]["value"]."'>
                                        <figure class='tiny'>
                                            <img src='" . $image . "'/>
                                            <figcaption>".$label."</figcaption>
                                        </figure>
                                    </a>
                                </li>";
                    }

//                <img src='" . $image . "'/>
                ?>
            </ul>
    </section>
</div>