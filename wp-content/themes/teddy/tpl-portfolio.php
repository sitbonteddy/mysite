<?php
/**
 * Template Name: Portfolio
 */
get_header();
?>

<section id="portfolio">
    <h1 class="heading_1"><?php echo the_title();?></h1>
    <div id="list_projects">

        <ul>
            <?php
                query_posts('post_type=portfolio&showposts=-1');
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        global $post;

                        $args = array('orderby' => 'date', 'order' => 'ASC', 'fields' => 'all');
                        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                        $title = get_the_title($post->ID);
                        $skills  = get_post_meta($post->ID,'teddy_skills',true);
                        $last_skills = end($skills);
                        ?>

                        <li>
                            <a class="" href="<?php echo the_permalink();?>">
                                <div class="img_resp" style="background-image:url(<?php echo $url;?>)"></div>
                                <div class="background_h">
                                   <span class="inner_one">
                                        <span class="inner_two">
                                            <span class="inner_three description">
                                                <h2><?php echo $title; ?></h2>
                                                <span class="under">
                                                    <?php foreach($skills as $skill){
                                                        if($skill == $last_skills){
                                                            echo ucfirst($skill);
                                                        }else{
                                                            echo ucfirst($skill).' • ';
                                                        }
                                                    } ?>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </a>
                        
                        </li>
                        <!-- /li -->
                        <?php
                    endwhile;
                endif;
            ?>
        </ul>



    </div>
</section>

<?php
get_footer();
?>