<?php
/**
 * Latest News
 *
 * @package TLM
 * @author Karl Clémence
 */?>

<?php
$latestStats = get_field('statistics');
$statsTitle = !empty($latestStats['title']) ? esc_html($latestStats['title']) : 'Titre';
$stats = $latestStats['all_stats']; ?>


<section id="statistics">
    <h2><?= $statsTitle; ?></h2>
    <div class="statsContainer">
        <?php foreach ($stats as $stat): ?>
            <div class="item">
                <div class="roundedBox">
                    <?php 
                        $classe="generic";
                        if ($stat['main_marker']['unit'] === "%"):
                            $classe="pourcentage";
                        endif;
                    ?>
                    <p class="<?= $classe; ?>">
                        <span class="value"><?= $stat['main_marker']['value']; ?></span>
                        <?php 
                            if (!empty($stat['main_marker']['unit']) && ($stat['main_marker']['unit']) !== "/ (rien)"): ?>
                                <span class="unit"><?= $stat['main_marker']['unit']; ?></span>
                        <?php endif; ?>
                    </p>
                </div>
                <h3><?= $stat['subtitle']; ?></h3>
                <p class="description"><?= $stat['descri']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>