<?php
    include_once "models/sparql.php";
    $term ="Tim_Burton";
    $requestURL = getUrlDbpediaAbstract($term);
    $responseArray = json_decode(request($requestURL), true);
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
            echo $responseArray["results"]
            ["bindings"][0]
            ["abstract"]["value"]
            ?>
        </p>
    </section>
</div>