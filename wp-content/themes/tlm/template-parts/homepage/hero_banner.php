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
        <?php
            $imgId = is_array($heroBanner['bg_img']) ? $heroBanner['bg_img']["ID"] : 0;
            echo generate_img_tag($imgId, 'full');
        ?>
        <section>
            <h1 class="hb_title"><?php echo $title; ?></h1>
            <p class="hb_subtitle" ><?php echo $catchPhrase; ?></p>
        </section>
        <?php
            include_once(get_template_directory().'/template-parts/homepage/services.php');
        ?>
    </div>
