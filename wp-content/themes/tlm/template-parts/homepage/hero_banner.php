<?php 

/**
 * Hero Banner
 *
 * @package TLM
 * @author Karl Clémence
 */

?>

<?php 

$heroBanner = get_field('hero_banner');
$title = verifyTextField($heroBanner['main_title'], 'Titre');
$catchPhrase = verifyTextField($heroBanner['catch_phrase'], 'Phrase d\'accroche');

?>
    <div class="heroBanner">
        <img src="<?php echo $heroBanner['bg_img']['url']; ?>" alt="<?php echo $heroBanner['bg_img']['alt']; ?>" />
        <section>
            <h1 class="hb_title"><?php echo $title; ?></h1>
            <p class="hb_subtitle" ><?php echo $catchPhrase; ?></p>
        </section>
        <?php
            include_once(get_template_directory().'/template-parts/homepage/services.php');
        ?>
    </div>
