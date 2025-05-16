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
    'post_type' => 'vnements',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'ESC',
    'post_status' => 'publish'
];
$events = get_posts($args);
?>

<section id="latestEvents">
    <h2><?= $eventsTitle ?></h2>

    <?php foreach ($events as $post) :
        // Récupérer l'alt spécifique pour l'article
        $thumbnailID = get_post_thumbnail_id($post->ID);
        $thumbnailAlt = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
        $thumbnailAlt = !empty($thumbnailAlt) ? $thumbnailAlt : 'Image d\'illustration';
        ?>
        <article class="eventArticle">
            <img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= $thumbnailAlt; ?>" />
            <div class="textContainer">
            <?php $event_date = get_field('date', $post->ID);
                if ($event_date) :
                    // Extraire le jour pour vérifier si c'est "1"
                    $date_parts = explode(' ', $event_date);
                    $day = (int) $date_parts[0];
                    $month = isset($date_parts[1]) ? substr($date_parts[1], 0, 3) : '';
                    $formatted_date = ($day === 1) ? '1<sup>er</sup> ' . $month : $day . ' ' . $month;
                    ?>
                    <p class="date"><?= $formatted_date ?></p>
                <?php else : ?>
                    <p>Date Non définie</p>
                <?php endif; ?>
                <h3><?= $post->post_title; ?></h3>
                <p class="location"><?= get_field('location', $post->ID); ?></p>
                <p class="description"><?= get_field('infos', $post->ID); ?></p>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<?php wp_reset_postdata(); ?>