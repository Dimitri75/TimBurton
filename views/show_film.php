<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $film = resultFromQuery(getMovieByWikipediaID($id))["results"]["bindings"][0];
        $actors = resultFromQuery(getActorsByWikipediaID($id, 5));

        $label = isset($film["label"]) ? removeStringInParentheses($film["label"]["value"]) : ActionEnum::NO_RESULT;
        $wikiLink = isset($film["wikiLink"]) ? $film["wikiLink"]["value"] : ActionEnum::NO_RESULT;
        $released = isset($film["released"]) ? $film["released"]["value"] : ActionEnum::NO_RESULT;
        $producer = isset($film["producer"]) && filter_var($film["producer"]["value"], FILTER_VALIDATE_URL) ? $film["producer"]["value"] : ActionEnum::NO_RESULT;
        $director = isset($film["director"]) && filter_var($film["director"]["value"], FILTER_VALIDATE_URL) ? $film["director"]["value"] : ActionEnum::NO_RESULT;
        $distributor = isset($film["distributor"]) && filter_var($film["distributor"]["value"], FILTER_VALIDATE_URL) ? $film["distributor"]["value"] : ActionEnum::NO_RESULT;
        $compositor = isset($film["compositor"]) && filter_var($film["compositor"]["value"], FILTER_VALIDATE_URL) ? $film["compositor"]["value"] : ActionEnum::NO_RESULT;
        $actors = isset($actors["results"]["bindings"]) ? $actors["results"]["bindings"] : ActionEnum::NO_RESULT;

        $producerName = ActionEnum::NO_RESULT;
        if ($producer != ActionEnum::NO_RESULT) {
            $producerName = resultFromQuery(getLabel($producer));
            if (isset($producerName["results"]["bindings"][0]["label"]["value"]))
                $producerName = $producerName["results"]["bindings"][0]["label"]["value"];
            $producerName = ActionEnum::NO_RESULT;

            $filmsFromProducer = resultFromQuery(getMoviesByProducer($producer, 5));
        }

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

        $poster = "#";
        if ($poster != ActionEnum::NO_RESULT)
            $poster = resultFromQueryForImages(getMoviePoster($label))->Poster;

        $image = "#";
        $imageResult = resultFromQueryForImages(getMoviePoster($label));
        if(strcmp($imageResult->Response, "True") == 0 && $imageResult->Poster != ActionEnum::NO_RESULT)
            $image = $imageResult->Poster;
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
                                    $date = ($released != ActionEnum::NO_RESULT) ? " (".$released.")" : "";
                                    echo $label.$date;
                                ?>
                            </figcaption>
                        </figure>
                    </a>
                </td>
                <td>
                    <p>
                        <b>Réalisateur :</b>
                        <?php
                            echo
                                "<a href='/timburton/?action=main&subject=".$director."'>".
                                    $directorName.
                                "</a>";
                        ?>
                    </p>
                    <p class="resume">
                        <b>A propos :</b>
                        <?php echo $comment; ?>
                    </p>
                    <p class="resume">
                        <b>Synopsis :</b>
                        <?php echo $abstract; ?>
                    </p>
                    <p>
                        <?php
                        if (isset($filmsFromDirector)) {
                            echo "<b>Film(s) du même réalisateur :</b><br/>";
                            foreach ($filmsFromDirector["results"]["bindings"] as $data) {
                                echo "<a href='/timburton/?action=show_film&id=" . $data["wiki"]["value"] . "'>" .
                                    removeStringInParentheses($data["label"]["value"]) .
                                    "</a><br/>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <b>Producteur(s) :</b>
                        <?php
                            if (!is_array($producerName) && $producerName != ActionEnum::NO_RESULT) {
                                echo
                                    "<a href='/timburton/?action=main&subject=" . $producer . "&role=" . ActionEnum::PRODUCER . "'>" .
                                        $producerName .
                                    "</a>";
                            }
                            else echo ActionEnum::NO_RESULT;
                        ?>
                    </p>
                    <p>
                        <?php
                            if (isset($filmsFromProducer)) {
                                echo "<b>Film(s) du même producteur :</b><br/>";
                                foreach ($filmsFromProducer["results"]["bindings"] as $data) {
                                    echo "<a href='/timburton/?action=show_film&id=" . $data["wiki"]["value"] . "'>" .
                                            removeStringInParentheses($data["label"]["value"]) .
                                        "</a><br/>";
                                }
                            }
                        ?>
                    </p>
                    <p>
                        <b>Distributeur :</b>
                        <?php
                            if (!is_array($producerName))
                            echo $distributorName;
                        ?>
                    </p>
                    <p>
                        <b>Compositeur(s) :</b>
                        <?php echo $compositorName; ?>
                    </p>
                    <p>
                        <b>Acteur(s) :</b><br/>
                        <?php
                            if ($actors != ActionEnum::NO_RESULT) {
                                foreach ($actors as $actor) {
                                    echo "<a href='/timburton/?action=main&subject=" . $actor["actor"]["value"] . "&role=" . ActionEnum::ACTOR . "'>" .
                                        $actor["actorName"]["value"] .
                                        "</a><br/>";
                                }
                            }
                        ?>
                    </p>
                    <p>
                        <b>Date de sortie :</b>
                        <?php
                            echo $released;
                        ?>
                    </p>
                </td>
            </tr>
        </table>
    </section>
</div>