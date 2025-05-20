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
        <?php // TODO : Contrôler que les liens aient été renseignés en back-office ?>
        <a href="<?= $service['link'];?>" title="Redirection vers le service" >
            <?php if($service['icon']['mime_type'] === 'image/svg+xml'):?>
                <?= file_get_contents($service['icon']['url']);?>
            <?php else:?>
                <?php // TODO : Sans doute la possibilité de gérer les liens via la fonction generate_img_tag() ?>
                <img src="<?= $service['icon']['url']; ?>" alt="<?= $service['icon']['alt']; ?>" />
            <?php endif;?>
        </a>
    <?php endforeach;?>

</div>

