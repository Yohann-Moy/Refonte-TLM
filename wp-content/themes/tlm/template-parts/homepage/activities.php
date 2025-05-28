<?php
/**
 * Latest News
 *
 * @package TLM
 * @author Karl Clémence
 */?>

<?php
    $Activities = get_field('local_activities');
    $activitiesTitle = !empty($Activities['titre']) ? esc_html($Activities['titre']) : 'Titre';
    $activities = $Activities['all_activities']; 
?>

<section id="activities">
    <div class="allActivities">


        <?php //var_dump($activities); ?>


        <?php
        foreach($activities as $activity) :?>
            

            <div class="activity">

                <?php
                $imgId = $activity['bg_img']['ID'];
                echo generate_img_tag($imgId, 'large');
                ?>

                <div class="textContenainer">
                    <h2><?= $activitiesTitle?></h2>

                    <p><?= $activity['name'];?></p>
                    <p><?= $activity['descri'];?></p>
                    <a href="<?= $activity['btn']['link']?>"> <?= $activity['btn']['content']?></a>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>

</section>