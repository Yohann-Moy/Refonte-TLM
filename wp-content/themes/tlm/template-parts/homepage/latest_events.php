<?php 
/**
 * Latest Events
 *
 * @package TLM
 * @author Karl Clémence
 */
$latestEvents = get_field('latest_events');
$eventsTitle = verifyTextField($latestEvents['title'], 'Titre');

$args = [
    'post_type' => 'evenements',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'ASC',
    'post_status' => 'publish'
];
$events = get_posts($args);
//var_dump($events); // Debugging line to check the events
?>


<section id="latestEvents">
    <h2><?= $eventsTitle ?></h2>

    <div class="eventsContainer">
    <?php foreach ($events as $post) :
        setup_postdata($post);
        // Récupérer l'alt spécifique pour l'article
        $thumbnailID = get_post_thumbnail_id($post->ID);
        $thumbnailAlt = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
        $thumbnailAlt = !empty($thumbnailAlt) ? $thumbnailAlt : 'Image d\'illustration';
        ?>
        <article class="eventArticle">
            <img class="eventImg" src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= $thumbnailAlt; ?>" />
            <div class="textContainer">
            <?php $event_date = get_field('date_', $post->ID);
            var_dump(get_field('location_', 177)); // Debugging line to check the event date
                if ($event_date) :
                    // Extraire le jour pour vérifier si c'est "1"
                    $date_parts = explode(' ', $event_date);
                    $day = (int) $date_parts[0];
                    $month = isset($date_parts[1]) ? substr($date_parts[1], 0, 3) : '';
                    $formatted_date = ($day === 1) ? '1<sup>er</sup> ' . $month : $day . ' ' . $month;
                    ?>
                    <div class="dates">
                    <p class="date"><?= $formatted_date ?></p>
                    <img src="" alt="">
                <?php else : ?>
                    <p>Date Non définie</p>
                <?php endif; ?>
                </div>
                <h3><?= $post->post_title; ?></h3>
                <p class="location"><?= get_field('location_', $post->ID); ?></p>
                <p class="description"><?= get_field('infos_', $post->ID); ?></p>
            </div>
        </article>
        <?php wp_reset_postdata(); ?>
    <?php endforeach; ?>
    </div>
</section>

