<?php
    $depiction = resultFromQuery(getDepiction(SparqlEnum::TIM_BURTON));
    $abstract = resultFromQuery(getAbstract(SparqlEnum::TIM_BURTON));
    $birthName = resultFromQuery(getBirthName(SparqlEnum::TIM_BURTON));
    $birthYear = resultFromQuery(getBirthYear(SparqlEnum::TIM_BURTON));
?>
<div id="main">
    <section>
        <h3>Welcome aboard !</h3>
        <br/><br/>

        <figure class="medium">
            <img src="<?php echo $depiction["results"]["bindings"][0]["depiction"]["value"]; ?>"/>
            <figcaption>
                <?php
                    echo $birthName["results"]["bindings"][0]["birthName"]["value"].
                        " (".$birthYear["results"]["bindings"][0]["birthYear"]["value"].")";
                ?>
            </figcaption>
        </figure>

        <p>
            <?php echo $abstract["results"]["bindings"][0]["abstract"]["value"]; ?>
        </p>
    </section>
</div>