<?php
    $subject = SparqlEnum::SUBJECT_TIM_BURTON;
    if (isset($_GET['subject']))
        $subject = $_GET['subject'];

    $role = ActionEnum::DIRECTOR;
    if (isset($_GET['role']))
        $role = $_GET['role'];

    $depictionResult = resultFromQuery(getDepiction($subject));
    $abstractResult = resultFromQuery(getAbstract($subject));
    $birthNameResult = resultFromQuery(getLabel($subject));
    $birthYearResult = resultFromQuery(getBirthYear($subject));

    $depiction = isset($depictionResult["results"]["bindings"][0]["depiction"]["value"]) ? $depictionResult["results"]["bindings"][0]["depiction"]["value"] : getRandomImage(ImageEnum::PROFILE_FOLDER);
    $birthName = isset($birthNameResult["results"]["bindings"][0]["label"]["value"]) ? $birthNameResult["results"]["bindings"][0]["label"]["value"] : "";
    $birthYear = isset($birthYearResult["results"]["bindings"][0]["birthYear"]["value"]) ? $birthYearResult["results"]["bindings"][0]["birthYear"]["value"] : "";

    $abstract = ActionEnum::NO_RESULT;
    if (isset($abstractResult["results"]["bindings"][0]))
        $abstract = $abstractResult["results"]["bindings"][0]["abstractFr"]["value"];
    else if (isset($abstractResult["results"]["bindings"][1]))
        $abstract = $abstractResult["results"]["bindings"][1]["abstractEn"]["value"];

?>
<div id="main">
    <section>
        <h3>Welcome aboard !</h3>
        <br/><br/>

        <figure class="medium">

            <img src="<?php echo $depiction; ?>"/>
            <figcaption>
                <?php
                    echo $birthName.
                        " (".$birthYear.")";
                ?>
            </figcaption>
        </figure>
        <p>
            <?php
                echo
                    "<a href='/timburton/?action=gallery&subject=".$subject."&role=".$role."'>
                        <b>Filmographie</b>
                    </a>";
            ?>
        </p>
        <p class="resume">
            <?php echo $abstract; ?>
        </p>
    </section>
</div>