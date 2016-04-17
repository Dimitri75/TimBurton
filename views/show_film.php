<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $film = resultFromQuery(getMovieByWikipediaID($id))["results"]["bindings"][0];
        $label =    isset($film["label"]) ? $film["label"]["value"] : "N/A";
        $wikiLink = isset($film["wikiLink"]) ? $film["wikiLink"]["value"] : "N/A";
        $released = isset($film["released"]) ? " (".$film["released"]["value"].")" : "";
        $abstract = isset($film["abstract"]) ? $film["abstract"]["value"] : "N/A";
        $comment = isset($film["comment"]) ? $film["comment"]["value"] : "N/A";
        $producer = isset($film["producer"]) && filter_var($film["producer"]["value"], FILTER_VALIDATE_URL) ? $film["producer"]["value"] : "N/A";
        $director = isset($film["director"]) && filter_var($film["director"]["value"], FILTER_VALIDATE_URL) ? $film["director"]["value"] : "N/A";
        $distributor = isset($film["distributor"]) && filter_var($film["distributor"]["value"], FILTER_VALIDATE_URL) ? $film["distributor"]["value"] : "N/A";
        $compositor = isset($film["compositor"]) && filter_var($film["compositor"]["value"], FILTER_VALIDATE_URL) ? $film["compositor"]["value"] : "N/A";
        $starring = isset($film["actor"]) && filter_var($film["actor"]["value"], FILTER_VALIDATE_URL) ? $film["actor"]["value"] : "N/A";

        $producerName = "N/A";
        $directorName = "N/A";
        $distributorName = "N/A";
        $compositorName = "N/A";
        $starringName = "N/A";
        if ($producer != "N/A"){
            $producerName = resultFromQuery(getLabel($producer));
            if (isset($producerName["results"]["bindings"][0]["label"]["value"]))
                $producerName = $producerName["results"]["bindings"][0]["label"]["value"];

            $filmsFromProducer = resultFromQuery(getMoviesByProducer($producer, 5));
        }

        if ($director != "N/A"){
            $directorName = resultFromQuery(getLabel($director));
            if (isset($directorName["results"]["bindings"][0]["label"]["value"]))
                $directorName = $directorName["results"]["bindings"][0]["label"]["value"];

            $filmsFromDirector = resultFromQuery(getMoviesByDirector($director, 5));
        }

        if ($distributor != "N/A"){
            $distributorName = resultFromQuery(getLabel($distributor));
            if (isset($distributorName["results"]["bindings"][0]["label"]["value"]))
                $distributorName = $distributorName["results"]["bindings"][0]["label"]["value"];
        }

        if ($compositor != "N/A"){
            $compositorName = resultFromQuery(getLabel($compositor));
            if (isset($compositorName["results"]["bindings"][0]["label"]["value"]))
                $compositorName = $compositorName["results"]["bindings"][0]["label"]["value"];
        }

        if ($starring != "N/A"){
            $starringName = resultFromQuery(getLabel($starring));
            if (isset($starringName["results"]["bindings"][0]["label"]["value"]))
                $starringName = $starringName["results"]["bindings"][0]["label"]["value"];
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
                            <img src="<?php echo "" ?>"/>
                            <figcaption><?php echo $label.$released; ?></figcaption>
                        </figure>
                    </a>
                </td>
                <td>
                    <p>
                        <b>Directeur :</b>
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
                            echo "<b>Film(s) du même directeur :</b><br/>";
                            foreach ($filmsFromDirector["results"]["bindings"] as $data) {
                                echo "<a href='/timburton/?action=show_film&id=" . $data["wiki"]["value"] . "'>" .
                                    $data["label"]["value"] .
                                    "</a><br/>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <b>Producteur(s) :</b>
                        <?php
                            if (!is_array($producerName)) {
                                echo
                                    "<a href='/timburton/?action=main&subject=" . $producer . "'>" .
                                    $producerName .
                                    "</a>";
                            }
                            else echo "N/A";
                        ?>
                    </p>
                    <p>
                        <?php
                            if (isset($filmsFromProducer)) {
                                echo "<b>Film(s) du même producteur :</b><br/>";
                                foreach ($filmsFromProducer["results"]["bindings"] as $data) {
                                    echo "<a href='/timburton/?action=show_film&id=" . $data["wiki"]["value"] . "'>" .
                                        $data["label"]["value"] .
                                        "</a><br/>";
                                }
                            }
                        ?>
                    </p>
                    <p>
                        <b>Distributeur :</b>
                        <?php echo $distributorName; ?>
                    </p>
                    <p>
                        <b>Compositeur(s) :</b>
                        <?php echo $compositorName; ?>
                    </p>
                    <p>
                        <b>Acteur(s) :</b>
                        <?php echo $starringName; ?>
                    </p>
                    <p>
                        <b>Année de sortie :</b>
                        <?php echo $released; ?>
                    </p>
                </td>
            </tr>
        </table>
    </section>
</div>
