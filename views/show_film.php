<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "";

        $film = resultFromQuery(getMovieByWikipediaID($id))["results"]["bindings"][0];
    }
?>

<div id="main">
    <section>
        <h3><?php echo $film["label"]["value"] ?></h3>
        <br/><br/>

        <table>
            <tr>
                <td>
                    <a href="<?php echo $film["wikiLink"]["value"]; ?>">
                        <figure class="large">
                            <img src="<?php echo "" ?>"/>
                            <figcaption><?php echo $film["label"]["value"]." (".$film["released"]["value"] ?>)</figcaption>
                        </figure>
                    </a>
                </td>

                <td>
                    <p class="resume">
                        <?php echo $film["abstract"]["value"] ?>
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
