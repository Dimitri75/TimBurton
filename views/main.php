<?php
    $subject = SparqlEnum::SUBJECT_TIM_BURTON;
    if (isset($_GET['subject']))
        $subject = $_GET['subject'];

    $role = ActionEnum::DIRECTOR;
    if (isset($_GET['role']))
        $role = $_GET['role'];

    $depictionResult = resultFromQuery(getDepiction($subject));
    $abstractResult = resultFromQuery(getAbstract($subject))["results"]["bindings"];
    $birthNameResult = resultFromQuery(getLabel($subject));
    $birthYearResult = resultFromQuery(getBirthYear($subject));

    $depiction = isset($depictionResult["results"]["bindings"][0]["depiction"]["value"]) ? $depictionResult["results"]["bindings"][0]["depiction"]["value"] : getRandomImage(ImageEnum::PROFILE_FOLDER);
    $birthName = isset($birthNameResult["results"]["bindings"][0]["label"]["value"]) ? $birthNameResult["results"]["bindings"][0]["label"]["value"] : ActionEnum::NO_RESULT;
    $birthYear = isset($birthYearResult["results"]["bindings"][0]["birthYear"]["value"]) ? $birthYearResult["results"]["bindings"][0]["birthYear"]["value"] : ActionEnum::NO_RESULT;

    $abstract = ActionEnum::NO_RESULT;
    if (isset($abstractResult[0]))
        $abstract = isset($abstractResult[0]["abstractFr"]["value"]) ? $abstractResult[0]["abstractFr"]["value"] : $abstractResult[0]["abstractEn"]["value"];
    else if (isset($abstractResult[1]))
        $abstract =  isset($abstractResult[1]["abstractFr"]["value"]) ? $abstractResult[1]["abstractFr"]["value"] : $abstractResult[1]["abstractEn"]["value"];

?>
<div id="main">
    <section>
        <h3>Welcome aboard !</h3>
        <br/><br/>

        <figure class="medium">

            <img src="<?php echo $depiction; ?>"/>
            <figcaption>
                <?php
                    echo removeStringInParentheses($birthName);
                    if ($birthYear != ActionEnum::NO_RESULT)
                        echo " (".cleanDate($birthYear).")";
                ?>
            </figcaption>
        </figure>
        <p>
            <?php
                echo
                    "<a href='/timburton/?action=gallery&subject=".urlencode($subject)."&role=".urlencode($role)."'>
                        <b>Filmographie</b>
                    </a>";
            ?>
        </p>
        <p class="resume">
            <b>À propos :</b><br/>
            <?php echo $abstract; ?>
        </p>
    </section>
</div>