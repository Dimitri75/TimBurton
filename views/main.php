<?php
    $depiction = resultFromQuery(getDepiction(SparqlEnum::SUBJECT_TIM_BURTON));
    $abstract = resultFromQuery(getAbstract(SparqlEnum::SUBJECT_TIM_BURTON));
    $birthName = resultFromQuery(getLabel(SparqlEnum::SUBJECT_TIM_BURTON));
    $birthYear = resultFromQuery(getBirthYear(SparqlEnum::SUBJECT_TIM_BURTON));
?>
<div id="main">
    <section>
        <h3>Welcome aboard !</h3>
        <br/><br/>

        <figure class="medium">
            <img src="<?php echo $depiction["results"]["bindings"][0]["depiction"]["value"]; ?>"/>
            <figcaption>
                <?php
                    echo $birthName["results"]["bindings"][0]["label"]["value"].
                        " (".$birthYear["results"]["bindings"][0]["birthYear"]["value"].")";
                ?>
            </figcaption>
        </figure>

        <p class="resume">
            <?php echo $abstract["results"]["bindings"][0]["abstract"]["value"]; ?>
        </p>
    </section>
</div>