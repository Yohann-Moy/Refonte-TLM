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
                <?php
                // Récupérer l'alt spécifique pour l'article
                $thumbnailID = get_post_thumbnail_id($post->ID);
                $thumbnailAlt = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
                $thumbnailAlt = !empty($thumbnailAlt) ? $thumbnailAlt : 'Image d\'illustration';
                ?>
                <article class="mainArticle">
                    <img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= $thumbnailAlt; ?>" />
                    <div class="textContainer">
                        <h3><?= $post->post_title; ?></h3>
                        <p class="date">Publié le <?= (new DateTime($post->post_date))->format("d/m/Y"); ?></p>
                        <p class="description"><?= get_the_excerpt($post->ID); ?></p>
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
                    <?php
                    $thumbnailID = get_post_thumbnail_id($post->ID);
                    $thumbnailAlt = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
                    $thumbnailAlt = !empty($thumbnailAlt) ? $thumbnailAlt : 'Image d\'illustration';
                    ?>
                    <article class="sideArticle">
                        <img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= $thumbnailAlt; ?>" />
                        <div class="textContainer">
                            <p class="title"><?= $post->post_title; ?></p>
                            <p class="date">Publié le <?= (new DateTime($post->post_date))->format("d/m/Y"); ?></p>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
            <a href="<?= get_permalink(get_option('page_for_posts')); ?>"  title="Redirection vers tous les articles" aria-label="Redirection vers tous les articles">Encore + d'actus</a>
        </div>
    <?php else : ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>
    </div>
</section>
<?php wp_reset_postdata(); ?>