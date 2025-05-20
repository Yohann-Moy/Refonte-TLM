<?php 
/**
 * Latest Events
 *
 * @package TLM
 * @author Karl Clémence
 */

$latestEvents = get_field('latest_events');
$eventsTitle = verifyTextField($latestEvents['title'], 'Titre');

// Déclare un tableau d'arguments qui permettra, plus tard, de recuperer les derniers articles de type "event" publiés.
$args = [
    'post_type' => 'event',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'ASC',
    'post_status' => 'publish'
];

// Recupere les derniers articles de type "event" publiés et les stocke dans la variable $events
// $events est un tableau indexé contenant tous les articles de type "event" publiés.
// /!\ Chaque élément du tableau est un objet de type WP_Post.
$events = get_posts($args);
?>


<section id="latestEvents">
    <h2><?= $eventsTitle ?></h2>

    <div class="eventsContainer">
    <?php 
        // Pour chaque event :
        foreach ($events as $post) :

        ?>
        <article class="eventArticle">

            <?php 
                $imgId = get_post_thumbnail_id($post->ID);
                echo generate_img_tag($imgId, 'medium');
            ?>

            <div class="textContainer">
                <?php 
                    // Au sein d'ACF, les champs sont stockés dans un "Events group" qui, comme son nom l'indique est ... un groupe de champ.
                    // Ainsi donc, pour chaque article il y a un "Events group" associé.
                    // Ce groupe a pour nom "events" (sur ACF)
                    // Ainsi, à chaque tour de boucle, on recupere ce "Events group" et on stocke son contenu dans la variable $singleEvent
                    $singleEvent = get_field('events', $post->ID);

                    // /!\ La variable $singleEvent est un tableau associatif.
                    // Chaque "Events group" contient trois sous évélents (les champs : "date", "location" et "info").
                    // L'accès aux sous champ s'effectue par la syntaxe suivante : $singleEvent['nom_du_sous_champ']
                ?>
            <?php $event_date = $singleEvent["date"];

                if ($event_date) :
                    // Extraire le jour pour vérifier si c'est "1"
                    $date_parts = explode(' ', $event_date);
                    $day = (int) $date_parts[0];
                    $month = isset($date_parts[1]) ? substr($date_parts[1], 0, 3) : '';
                    $formatted_date = ($day === 1) ? '1<sup>er</sup> ' . $month : $day . ' ' . $month;
                    ?>
                    <div class="dates">
                    <p class="date"><?= $formatted_date ?></p>
                    <?php 
                        // TODO : Privilégier l'inclusion du code SVG à la place de la balise IMG
                        // Cela permettra de ne pas surcharger le réseau (en supprimant une requête HTTP) puisque le code SVG
                        // sera chargé dans l'HTML.
                    ?>
                    <img src="" alt=""> <!-- Ca dégage ;D ) -->
                <?php else : ?>
                    <p>Date Non définie</p>
                <?php endif; ?>
                </div>
                <?php 
                    // TODO : Gérer davantage le contrôle si c'est vide ou non pour ces 3 données.
                ?>
                <h3><?= $post->post_title; ?></h3>
                <p class="location"><?= $singleEvent['location']; ?></p>
                <p class="description"><?= $singleEvent['info']; ?></p>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
<?php wp_reset_postdata(); ?>

