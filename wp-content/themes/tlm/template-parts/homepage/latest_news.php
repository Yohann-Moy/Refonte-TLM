<?php 

/**
 * Latest News
 *
 * @package TLM
 * @author Karl Clémence
 */

?>

<?php 

$latestNews = get_field('latest_news');
$newsTitle = verifyTextField($latestNews['title'], 'Titre');

$args = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC'
];
$posts = get_posts($args);
?>
 <div class="latestNews">
    <h2><?= $newsTitle; ?></h2>
    <?php /**
    <div class="newsContainer">
    

    <pre>
    <?= var_dump($posts); ?>
    </pre>

    <?php 
    /** 
    foreach ($posts as $post): ?>
        <div class="newsItem">
            <h3><? get_the_title($post); ?></h3>
            <p><?= get_the_excerpt($post); ?></p>
            <a href="<?= get_permalink($post); ?>">Read more</a>
        </div>
    <?php endforeach; ?>

    </div>

</div>
*/ ?>