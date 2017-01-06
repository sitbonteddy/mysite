<?php
/**
 * Template Name: Homepage
 */
get_header();

$thumb_id = get_post_thumbnail_id($page->ID);
$thumb_url = wp_get_attachment_image_src($thumb_id, true);
$image = $thumb_url[0];
?>

<main id="home">

    <section class="full_screen"  style="background: url(<?php echo $image;?>) center center no-repeat;">
        <span class="inner_one">
            <span class="inner_two">
                <span class="inner_three">
                    <h1 class="heading_1 headline loading-bar">
                        <span class="one_light"><?php echo the_title();?></span>
                        <!--<span>Je suis</span-->
                        <span class="words-wrapper">
                        	<?php
                        	$i=0;
							if (have_posts()) :
								while (have_posts()) :
									global $post;
									the_post();
									$skills  = get_post_meta($post->ID,'teddy_skills',true);

									foreach($skills as $skill){
										if($i==0){
											echo '<b class="is-visible">'.$skill.'</b>';
										}else{
											echo  '<b>'.$skill.'</b>';
										}
										$i++;
									}
								endwhile;
							endif;
							?>
                        </span>
                    </h1>
                </span>
            </span>
        </span>
    </section>

</main>

<?php
get_footer('home');
?>