<?php 

/**
 * Services Rapides
 *
 * @package TLM
 * @author Karl Clémence
 */

?>

<?php 

$allServices = get_field('services');

?>

<div id="servicesRapides">
    <?php foreach($allServices as $service):?>
        <a href="<?= $service['link'];?>" title="Redirection vers le service" >
            <?php if($service['icon']['mime_type'] === 'image/svg+xml'):?>
                <?= file_get_contents($service['icon']['url']);?>
            <?php else:?>
                <img src="<?= $service['icon']['url']; ?>" alt="<?= $service['icon']['alt']; ?>" />
            <?php endif;?>
        </a>
    <?php endforeach;?>

</div>

