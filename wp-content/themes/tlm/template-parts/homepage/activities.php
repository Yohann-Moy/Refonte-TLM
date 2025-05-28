<?php
/**
 * Latest News
 *
 * @package TLM
 * @author Karl Clémence
 */?>

<?php
    $Activities = get_field('local_activities');
    $activitiesTitle = !empty($Activities['titre']) ? esc_html($Activities['titre']) : 'Titre';
    $activities = $Activities['all_activities']; 
?>

<section id="activities">

    <h2><?= $activitiesTitle?></h2>
    <div class="textContainer"></div>
    
    <div class="allActivities">

        <?php

        // Initialisation du compteur d'activités
        $i = 0;

        foreach($activities as $activity) :?>

            <?php 
                $i++; // Incrémentation de $i (le compteur)
                // var_dump($activity['descri']);
            ?>
            

            <div class="activity" data-name="<?= $activity['name'];?>" data-description="<?= $activity['descri'];?>" data-link="<?= $activity['btn']['link']?>" data-btn-content="<?= $activity['btn']['content']?>" data-img-link = "<?= $activity['bg_img']['url'] ?>" data-img-alt = "<?= $activity['bg_img']['alt'] ? $activity['bg_img']['alt'] : 'Description alternative non renseignée' ?>" <?php echo $i != 1 ? "tabindex='0'" : "" ?>>

                <?php

                    $imgId = $activity['bg_img']['ID'];

                    // Si on est sur la première activité
                    if($i === 1):
                        // Stocke l'image alternative dans une variable dédiée (qui est exploitée après la boucle)
                        $img_bis = $activity['bg_img_bis']['ID'];

                        // Stocke les données de l'activité dans un tableau (qui est exploité après la boucle)
                        $data_last = [
                            "name" => $activity['name'],
                            "description" => $activity['descri'],
                            "link" => $activity['btn']['link'],
                            "btn-content" => $activity['btn']['content'],
                            "img_link" => $activity['bg_img']['url'],
                            "img_alt" => $activity['bg_img']['alt'] ? $activity['bg_img']['alt'] : 'Description alternative non renseignée',
                        ];
                    endif;

                    echo generate_img_tag($imgId, 'large');
                ?>

                <span class="activity-name">
                    <?= $activity['name'];?>
                </span>
            </div><!-- .activity -->
            <?php
        endforeach;
        ?>

        <div class="activity" data-name="<?= $data_last['name'];?>" data-description="<?= $data_last['description'];?>" data-link="<?= $data_last['link']?>" data-btn-content="<?= $data_last['btn-content']?>"  data-img-link = "<?= $data_last['img_link'] ?>" data-img-alt = "<?= $data_last['img_alt'] ?>" tabindex="0">
            <?php echo generate_img_tag($img_bis, 'large'); ?>
            <span class="activity-name">
                <?= $data_last['name'];?>
            </span>
        </div><!-- .activity -->


    </div><!-- .allActivities -->

</section><!-- #activities -->