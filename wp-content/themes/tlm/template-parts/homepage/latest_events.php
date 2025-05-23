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
                <svg width="159" height="64" viewBox="0 0 159 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M157.414 33.4142C158.195 32.6332 158.195 31.3668 157.414 30.5858L144.686 17.8579C143.905 17.0768 142.639 17.0768 141.858 17.8579C141.077 18.6389 141.077 19.9052 141.858 20.6863L153.172 32L141.858 43.3137C141.077 44.0948 141.077 45.3611 141.858 46.1421C142.639 46.9232 143.905 46.9232 144.686 46.1421L157.414 33.4142ZM0 34H156V30H0L0 34Z" fill="white" fill-opacity="0.51"/>
                </svg>
                <?php else : ?>
                    <p>Date Non définie</p>
                <?php endif; ?>
                </div>
                <?php 
                    // TODO : Gérer davantage le contrôle si c'est vide ou non pour ces 3 données.
                ?>
                <h3><?= $post->post_title; ?></h3>
                
                <div class="location">
                    <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <mask id="mask0_373_1253" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="32">
                    <path d="M0 0.228516H30V31.7723H0V0.228516Z" fill="white"/>
                    </mask>
                    <g mask="url(#mask0_373_1253)">
                    <mask id="mask1_373_1253" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="-1" y="0" width="31" height="32">
                    <rect x="-0.0422363" y="0.228516" width="30.0417" height="31.5438" fill="url(#pattern0_373_1253)"/>
                    </mask>
                    <g mask="url(#mask1_373_1253)">
                    <rect y="0.859375" width="37.8526" height="37.8526" fill="url(#pattern1_373_1253)"/>
                    </g>
                    </g>
                    <defs>
                    <pattern id="pattern0_373_1253" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_373_1253" transform="scale(0.0175439 0.0166667)"/>
                    </pattern>
                    <pattern id="pattern1_373_1253" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image1_373_1253" transform="scale(0.0175439 0.0166667)"/>
                    </pattern>
                    <image id="image0_373_1253" width="57" height="60" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADkAAAA8CAAAAAD5vk3qAAAAAmJLR0QA/4ePzL8AAAIlSURBVEiJ7ZbPS1RRFMe/4ygNOm6EQqWYmZCwVURtxIghKgyiP0FtoSBCq8CIQBJCBHMhVEsFhcCFiwbFlSBIEiTiQgkJx4WiBOWPaRij8LQY7o9377l33ggtAr+r7zvnfO49zL3nvQHO9K8UcSVqrjTXVnzfWz0qc8HOzWMq6stwUxncmwIp/f7wICz38pAMZa6G6vPI5IiIsumS4CuOIyIar/KDAy6QaNp5DADwwg0SDXvAphMfSY/d5FcvSLsXXGCvVnUyezdxLtp4a0xHBx1gJKtqPjWL6MVJFf3TwJOdquS9/jv2q3g/T86rHYOJUZnYqeTAWE7kD5LBTM2GRBMqWiFda1y4d1tBMj8i7T2OvCHdlNnOxIFw1zkyJcy3FZPMy0iSI2PCrJsgsCVMI0dKFezQsTBRL3nJDp0XJseReWEu11qkvLCHHLkmTHWLCSZvC7fKkcvSPTXJXuk+Wu0AqNqXN+V+MJPa5+6QpowaxKQeb1AzxBwYALSrmchqb+fEior38GRsWxviobpiMNqnWqVCSivXB7Hr0UP1QDMLG9H6O21xrWDwOb8ncJO8GggcV+AOfW5zrQkA3T+W9Efj9ZuLw6mI9xEUFrRu/GsXmCm1EvLV4bZkvvZ8v3adPZ/sJ8sePG6yr9mhZz/ZRiy9Na/ARDgOwGIQXCpNSI2dbkcAeKLA0bJAIC3AjjJBAEUw7cx7/nCQP+3T3K/TcWf6H/UXoMUu+x06SAUAAAAASUVORK5CYII="/>
                    <image id="image1_373_1253" width="57" height="60" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADkAAAA8CAYAAADc1RI2AAAAAXNSR0IArs4c6QAAAIhJREFUaEPt1NEJgDAQBcGk/4qVQOzA/z3GCuLb4fZz3ruGf9tPDims5JCQS0klQwvgGor1+1QllQwtgGsolsODK66hBXANxXJdccU1tACuoViuK664hhbANRTLdcUV19ACuIZiua644hpaANdQLNcVV1xDC+AaiuW64opraAFcQ7FcV1yncP0AorTsBfJVNJIAAAAASUVORK5CYII="/>
                    </defs>
                    </svg>
                    <p class="location"><?= $singleEvent['location']; ?></p>
                </div>

                <p class="description"><?= $singleEvent['info']; ?></p>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
<?php wp_reset_postdata(); ?>

