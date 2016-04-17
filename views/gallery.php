<?php
    $subject = SparqlEnum::TIM_BURTON;
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
        <h3>Filmographie</h3>
        <br/><br/>
            <ul>
                <?php
                    foreach($movies["results"]["bindings"] as $data){
                        $label = removeStringInParentheses($data["label"]["value"]);
                        $moviePosterQuery = getMoviePoster($label);
                        $searchResult = resultFromQueryForImages($moviePosterQuery);
                        echo    "<li>
                                    <a href='/timburton/?action=show_film&id=".$data["wiki"]["value"]."'>
                                        <figure class='tiny'>
                                            <img src='" . $searchResult->Poster . "'/>
                                            <figcaption>".$label."</figcaption>
                                        </figure>
                                    </a>
                                </li>";
                    }
                ?>
            </ul>
    </section>
</div>