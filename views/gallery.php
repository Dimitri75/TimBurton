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

    $label = resultFromQuery(getLabel($subject));
    $label = isset($label["results"]["bindings"][0]["label"]["value"]) ? " de ".$label["results"]["bindings"][0]["label"]["value"] : "";

?>

<div id="main">
    <section>
        <h3>
            Filmographie<?php echo $label; ?>
        </h3>
        <br/><br/>
            <ul>
                <?php
                    foreach($movies["results"]["bindings"] as $data) {
                        $label = removeStringInParentheses($data["label"]["value"]);
                        $moviePosterQuery = getMoviePoster($label);
                        $searchResult = resultFromQueryForImages($moviePosterQuery);

                        if (strcmp($searchResult->Response, "True") == 0 && strcmp($searchResult->Poster, "N/A") != 0)
                            $image = $searchResult->Poster;
                        else
                            $image = getRandomImage(ImageEnum::POSTER_FOLDER);

                        echo    "<li>
                                    <a href='/timburton/?action=show_film&film=".$data["film"]["value"]."'>
                                        <figure class='tiny'>
                                            <img src='".$image."'/>
                                            <figcaption>".$label."</figcaption>
                                        </figure>
                                    </a>
                                </li>";
                    }
                ?>
            </ul>
    </section>
</div>