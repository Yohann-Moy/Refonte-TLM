<?php
/**
 * Latest News
 *
 * @package TLM
 * @author Karl Clémence
 */

$latestNews = get_field('latest_news');
$newsTitle = verifyTextField($latestNews['title'], 'Titre');

$args = [
    'post_type' => 'post',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
];
$posts = get_posts($args);

?>  
<section id="latestNews">
    <h2><?= $newsTitle ?></h2>

    <div class="newsContainer">
    <?php if ($posts) : ?>
        <?php $postNumber = 0; ?>
        <!-- Main Article -->
        <?php foreach ($posts as $post) : ?>
            <?php $postNumber++; ?>
            <?php if ($postNumber === 1) : ?>
                <article class="mainArticle">

                <?php

                    // Récupère l'image associée au post
                    $imgId = get_post_thumbnail_id($post->ID);
                    echo generate_img_tag($imgId, 'large');
                ?>

                    <div class="textContainer">
                        <h3><?= verifyTextField($post->post_title, 'Titre'); ?></h3>
                        <p class="date">Publié le <?= (new DateTime($post->post_date))->format("d/m/Y"); ?></p>
                        <p class="description">
                            <?php
                                // TODO : Faire en sorte de vérifier que l'article ait un contenu
                                // Si il n'en a pas, ne pas l'afficher. 
                                echo get_the_excerpt($post->ID);
                            ?>
                        </p>
                        <a href="<?= get_permalink($post->ID); ?>" aria-label="Redirection vers l'article" title="Redirection vers l'article" class="readMore">Lire la suite</a>
                    </div>
                </article>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Side Articles -->
        <div class="sideSection">
            <?php $postNumber = 0; ?>
            <?php foreach ($posts as $post) : ?>
                <?php $postNumber++; ?>
                <?php if ($postNumber !== 1) : ?>
                    <article class="sideArticle">
                    <?php 
                        // TODO : Gérer le fait que le contenu des articles soit sous forme de lien
                        // Pour récupérer l'URL de chaque article : 
                        // echo get_permalink($post->ID);
                    ?>

                    <?php
                        $imgId = get_post_thumbnail_id($post->ID);
                        echo generate_img_tag($imgId, 'medium');
                    ?>

                        <div class="textContainer">
                            <p class="title"><?= verifyTextField($post->post_title); ?></p>
                            <p class="date">Publié le <?= (new DateTime($post->post_date))->format("d/m/Y"); ?></p>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
            <a href="<?= esc_url("/actualites"); ?>"  title="Redirection vers tous les articles" aria-label="Redirection vers tous les articles">Encore + d'actus</a>
        </div>
    <?php else : ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>
    </div>
</section>
<?php wp_reset_postdata(); ?>