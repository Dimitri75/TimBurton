<?php
    include_once "models/sparql.php";
    include_once("enumerations/query_enum.php");
?>

<div id="main">
    <section>
        <h3>Welcome aboard !</h3>
        <br/><br/>

        <figure class="medium">
            <img src="/timburton/resources/timburton.png"/>
            <figcaption>Timothy Walter Button (1958)</figcaption>
        </figure>

        <p>
            <?php
                $responseArray = getAbstract(QueryEnum::TIM_BURTON);
                echo $responseArray["results"]["bindings"][0]["abstract"]["value"];
            ?>
        </p>
    </section>
</div>