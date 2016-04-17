<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "";


        $film = resultFromQuery(getMovieByWikipediaID($id))["results"]["bindings"][0];
        $label =    isset($film["label"]) ? $film["label"]["value"] : "N/A";
        $wikiLink = isset($film["wikiLink"]) ? $film["wikiLink"]["value"] : "N/A";
        $released = isset($film["released"]) ? " (".$film["released"]["value"].")" : "";
        $abstract = isset($film["abstract"]) ? $film["abstract"]["value"] : "N/A";
        $producer = isset($film["producer"]) && filter_var($film["producer"]["value"], FILTER_VALIDATE_URL) ? $film["producer"]["value"] : "N/A";

        if ($producer != "N/A"){
            // Requête
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
                    <a href="<?php echo $wikiLink; ?>">
                        <figure class="large">
                            <img src="<?php echo "" ?>"/>
                            <figcaption><?php echo $label.$released; ?></figcaption>
                        </figure>
                    </a>
                </td>

                <td>
                    <p class="resume">
                        <?php echo $abstract; ?>
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>

                        Producteur(s) :
                        <?php echo $producer; ?>
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                    <p>
                        Directeur :
                    </p>
                </td>
            </tr>
        </table>
    </section>
</div>
