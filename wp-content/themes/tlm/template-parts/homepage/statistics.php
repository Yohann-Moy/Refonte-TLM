<?php 

/**
 * Latest News
 *
 * @package TLM
 * @author Karl Clémence
 */

?>

<?php 

$latestStats = get_field('statistics');
$statsTitle = verifyTextField($latestStats['title'], 'Titre');
?>

<div class="statistics">
    <h2><?= $statsTitle; ?></h2>
    <div class="statContainer">
        <?php 
        $stats = $latestStats['all_stats'];
        ?>



        <?php foreach($stats as $stat):
                ?>
                <pre>
                <?php //var_dump($stat) ;?>
                <?php var_dump($stat['main_marker']['value']) ;?>
                <?php var_dump($stat['main_marker']['unit']) ;?>
                <?php var_dump($stat['subtitle']) ;?>
                <?php var_dump($stat['descri']) ;?>


                </pre>
            


    <?php endforeach; ?>
    </div>