<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "";

        $db = connectDB();
        $result = $db->query("SELECT * FROM `film` WHERE id='".$id."'");
        $data = $result->fetch();
    }
?>

<div id="main">
    <section>
        <h3><?php echo $data['name']?></h3>
        <br/><br/>

        <table>
            <tr>
                <td><figure class="large">
                    <img src="/timburton/resources/film/<?php echo $data['illustration']?>"/>
                    <figcaption><?php echo $data['name']?> (<?php echo $data['date']?>)</figcaption>
                </figure></td>

                <td><p class="resume">
                    <?php echo $data['resume']?>
                </p></td>
            </tr>
        </table>
    </section>
</div>
