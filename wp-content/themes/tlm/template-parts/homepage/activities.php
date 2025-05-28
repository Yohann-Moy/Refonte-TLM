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

    <h2><?= $activitiesTitle?></h2>
    <div class="textContainer">
        <p>
            La nature vous attends au détour d’un sentier.<br>
            Enfilez votre sac à dos et vos chaussures.
        </p>
        <a href="#" class="btn tertiary">Partir à l’aventure !</a>
    </div>
    
    <div class="allActivities">

        <?php
        foreach($activities as $activity) :?>
            

            <div class="activity" data-name="<?= $activity['name'];?>" data-description="<?= $activity['descri'];?>" data-link="<?= $activity['btn']['link']?>" data-btn-content="<?= $activity['btn']['content']?>">

                <?php
                    $imgId = $activity['bg_img']['ID'];
                    echo generate_img_tag($imgId, 'large');
                ?>

                <span class="activity-name">
                    <?= $activity['name'];?>
                </span>
            </div>
            <?php
        endforeach;
        ?>
    </div>

</section>