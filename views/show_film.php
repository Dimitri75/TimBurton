<?php
    if (isset($_GET['film'])) {
        $movie = $_GET['film'];

        $film = resultFromQuery(getMovieDetails($movie))["results"]["bindings"][0];
        $actors = resultFromQuery(getActorsByMovie($movie, 5));
        $producers = resultFromQuery(getProducersByMovie($movie, 5));

        $label = isset($film["label"]) ? removeStringInParentheses($film["label"]["value"]) : ActionEnum::NO_RESULT;
        $wikiLink = isset($film["wikiLink"]) ? $film["wikiLink"]["value"] : ActionEnum::NO_RESULT;
        $released = isset($film["released"]) ? $film["released"]["value"] : ActionEnum::NO_RESULT;
        $director = isset($film["director"]) && filter_var($film["director"]["value"], FILTER_VALIDATE_URL) ? $film["director"]["value"] : ActionEnum::NO_RESULT;
        $distributor = isset($film["distributor"]) && filter_var($film["distributor"]["value"], FILTER_VALIDATE_URL) ? $film["distributor"]["value"] : ActionEnum::NO_RESULT;
        $compositor = isset($film["compositor"]) && filter_var($film["compositor"]["value"], FILTER_VALIDATE_URL) ? $film["compositor"]["value"] : ActionEnum::NO_RESULT;
        $actors = isset($actors["results"]["bindings"]) ? $actors["results"]["bindings"] : ActionEnum::NO_RESULT;
        $producers = isset($producers["results"]["bindings"]) ? $producers["results"]["bindings"] : ActionEnum::NO_RESULT;

        $directorName = ActionEnum::NO_RESULT;
        if ($director != ActionEnum::NO_RESULT) {
            $directorName = resultFromQuery(getLabel($director));
            if (isset($directorName["results"]["bindings"][0]["label"]["value"]))
                $directorName = $directorName["results"]["bindings"][0]["label"]["value"];
            else $directorName = ActionEnum::NO_RESULT;

            $filmsFromDirector = resultFromQuery(getMoviesByDirector($director, 5));
        }

        $distributorName = ActionEnum::NO_RESULT;
        if ($distributor != ActionEnum::NO_RESULT) {
            $distributorName = resultFromQuery(getLabel($distributor));
            if (isset($distributorName["results"]["bindings"][0]["label"]["value"]))
                $distributorName = $distributorName["results"]["bindings"][0]["label"]["value"];
            else $distributorName = ActionEnum::NO_RESULT;
        }

        $compositorName = ActionEnum::NO_RESULT;
        if ($compositor != ActionEnum::NO_RESULT) {
            $compositorName = resultFromQuery(getLabel($compositor));
            if (isset($compositorName["results"]["bindings"][0]["label"]["value"]))
                $compositorName = $compositorName["results"]["bindings"][0]["label"]["value"];
            else $compositorName = ActionEnum::NO_RESULT;
        }

        $abstract = ActionEnum::NO_RESULT;
        if (isset($film["abstractFr"]))
            $abstract = $film["abstractFr"]["value"];
        else if (isset($film["abstractEn"]))
            $abstract = $film["abstractEn"]["value"];

        $comment = ActionEnum::NO_RESULT;
        if (isset($film["commentFr"]))
            $comment = $film["commentFr"]["value"];
        else if (isset($film["commentEn"]))
            $comment = $film["commentEn"]["value"];

        $poster = resultFromQueryForImages(getMoviePoster($label));
        $image = getRandomImage(ImageEnum::POSTER_FOLDER);
        if (isset($poster->Poster)) {
            $poster = $poster->Poster;
            $imageResult = resultFromQueryForImages(getMoviePoster($label));
            if (strcmp($imageResult->Response, "True") == 0 && $imageResult->Poster != ActionEnum::NO_RESULT)
                $image = $imageResult->Poster;
        }
    }
?>

<div id="main">
    <section>
        <h3><?php echo $label; ?></h3>
        <br/><br/>

        <table>
            <tr>
                <td>
                    <a href="<?php echo $wikiLink; ?>" target="_blank">
                        <figure class="large">
                            <img src="<?php echo $image ?>"/>
                            <figcaption>
                                <?php
                                    $date = ($released != ActionEnum::NO_RESULT) ? " (".cleanDate($released).")" : "";
                                    echo $label.$date;
                                ?>
                            </figcaption>
                        </figure>
                    </a>
                </td>
                <td>
                    <?php
                        if (!is_array($directorName) && $directorName != ActionEnum::NO_RESULT) {
                            echo
                                "<p>
                                <b>Réalisateur :</b><br/>
                                <a href='/timburton/?action=main&subject=" . urlencode($director) . "&role=" . urlencode(ActionEnum::DIRECTOR) . "'>" .
                                $directorName .
                                "</a>
                            </p>";
                        }

                        if (strcmp($comment, $abstract) != 0){
                            echo "
                                <p class='resume'>
                                    <b>À propos :</b><br/>
                                    ".$comment."
                                </p>";
                        }
                    ?>
                    <p class="resume">
                        <b>Synopsis :</b><br/>
                        <?php echo $abstract; ?>
                    </p>
                    <?php
                        if (isset($filmsFromDirector)) {
                            echo
                            "<p>
                            <b>Film(s) du même réalisateur :</b><br/>";
                            foreach ($filmsFromDirector["results"]["bindings"] as $data) {
                                echo "<a href='/timburton/?action=show_film&film=" . urlencode($data["film"]["value"]) . "'>" .
                                        removeStringInParentheses($data["label"]["value"]) .
                                    "</a><br/>";
                            }
                            echo "</p>";
                        }

                        if ($producers != ActionEnum::NO_RESULT && !empty($producers)) {
                            $listProducers = array();

                            echo
                                "<p>
                                    <b>Producteur(s) :</b><br/>";
                                    foreach($producers as $prod){
                                        $listProducers[] = removeUrl($prod["producer"]["value"]);
                                        echo "<a href='/timburton/?action=main&subject=" . urlencode($prod["producer"]["value"]) . "&role=" . urlencode(ActionEnum::PRODUCER) . "'>" .
                                            removeStringInParentheses($prod["producerName"]["value"]) .
                                        "</a><br/>";
                                    }
                            echo "</p>";

                            $filmsFromProducers = resultFromQuery(getMoviesByProducers($listProducers, 5));
                        }

                        if (isset($filmsFromProducers["results"]["bindings"]) && !empty($filmsFromProducers["results"]["bindings"])) {
                            $filmsFromProducers = $filmsFromProducers["results"]["bindings"];
                            echo "
                                <p>
                                    <b>Film(s) des mêmes producteurs :</b><br/>";
                                    foreach ($filmsFromProducers as $data) {
                                        echo "<a href='/timburton/?action=show_film&film=" . urlencode($data["film"]["value"]) . "'>" .
                                                removeStringInParentheses($data["label"]["value"]) .
                                            "</a><br/>";
                                    }
                            echo "</p>";
                        }

                        if ($actors != ActionEnum::NO_RESULT && !empty($actors)) {
                            echo "<p>
                                <b>Acteur(s) :</b><br/>";

                            foreach ($actors as $actor) {
                                echo "<a href='/timburton/?action=main&subject=" . urlencode($actor["actor"]["value"]) . "&role=" . urlencode(ActionEnum::ACTOR) . "'>" .
                                        removeStringInParentheses($actor["actorName"]["value"]) .
                                    "</a><br/>";
                            }
                            echo "</p>";
                        }
                    ?>
                    <p>
                        <b>Distributeur :</b><br/>
                        <?php
                            if (!is_array($distributorName))
                            echo $distributorName;
                        ?>
                    </p>
                    <p>
                        <b>Compositeur(s) :</b><br/>
                        <?php echo $compositorName; ?>
                    </p>
                    <p>
                        <b>Date de sortie :</b><br/>
                        <?php
                            echo cleanDate($released);
                        ?>
                    </p>
                </td>
            </tr>
        </table>
    </section>
</div>