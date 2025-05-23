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
    <div class="allActivities">
        <?php
        foreach($activities as $activity) :
            //$imgId = get_post_thumbnail_id($activity->ID);
            ?>
            <pre>
            <?php var_dump($activity); ?>
            </pre>
            
            <?php
            //echo generate_img_tag($imgId, 'large');

        endforeach;
        ?>
    </div>

</section>